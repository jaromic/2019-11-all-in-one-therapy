<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Slot;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

class SlotController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        User::requirePermission('admin-calendar');

        $user = auth()->user();

        $availableSlots = $user->slots()->where('status', 'available')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedSlots = $user->slots()->where('status', 'reserved')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedAndConfirmedSlots = $user->slots()->whereIn('status', ['reserved', 'confirmed'])->paginate(getenv('AIOT_PAGINATE_ROWS'));

        return view('backend.slots', ['reservedAndConfirmedSlots' => $reservedAndConfirmedSlots, 'reservedSlots' => $reservedSlots, 'availableSlots' => $availableSlots, 'patients' => Patient::orderBy('lastname')->get(), 'slotStati' => $this->getAllStati()]);
    }

    private function getAllStati()
    {
        return Slot::SLOT_STATI;
    }

    /**
     * @param $slotId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function assignPatient($slotId)
    {
        $request = request();
        $patientId = $request->patient_id;
        $slot = Slot::findOrFail($slotId);
        $patient = Patient::findOrFail($patientId);
        $slot->patient()->associate($patient);
        $slot->status = 'confirmed';
        $slot->save();
        return redirect("/slots");
    }

    /**
     * @param $slotId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setStatus($slotId)
    {
        $request = request();
        $status = $request->status;

        $this->checkIsValidStatus($status);

        $slot = Slot::findOrFail($slotId);
        $slot->status = $status;
        if($status=='available') {
            $slot->patient()->dissociate();
        }
        $slot->save();
        return redirect("/slots");
    }

    /**
     * @param $status
     */
    public function checkIsValidStatus($status): void
    {
        if (!in_array($status, $this->getAllStati())) {
            throw new InvalidArgumentException("Invalid status.");
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Slot::destroy($id);
        return redirect('/slots');
    }

    /**
     *
     */
    public function reserve()
    {
        $request = request();
        $slot = Slot::findOrFail($request->slot_id);
        $patient = auth()->user()->patient;

        $slot->patient()->associate($patient);
        $slot->status = 'reserved';
        $slot->save();
        return redirect(route('backend'));
    }

    /**
     *
     */
    public function cancel($slot_id)
    {
        $slot = Slot::findOrFail($slot_id);

        if ($slot->status == 'reserved') {
            $slot->patient()->dissociate();
            $slot->status = 'available';
            $slot->save();
        } else {
            return redirect(route('backend'))->withErrors(['status'=>'Bereits vom Behandler bestätigte Termine können nicht storniert werden.']);
        }
        return redirect(route('backend'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function createForDay()
    {
        $request = request();
        try {
            $date = Carbon::parse($request->day_date);
            $startTime = Carbon::parse($request->start);
            $endTime = Carbon::parse($request->end);
        } catch (\Exception $e) {
            throw new InvalidArgumentException("At least one of the date/time parameters in the request is invalid.");
        }
        $slotSizeMinutes = 30;

        $currentDateTime = $date->setHours(0)->copy();
        $endDateTime = $date->copy()->addHours($endTime->hour)->addMinutes($endTime->minute);

        if ($endDateTime <= $currentDateTime) {
            throw new \Exception("End datetime {$endDateTime} <= Current datetime {$currentDateTime}");
        }

        $currentDateTime->setHours($startTime->hour);
        $currentDateTime->setMinutes($startTime->minute);

        while ($currentDateTime < $endDateTime->copy()->subMinutes($slotSizeMinutes)) {
            $slot = new Slot();
            $slot->user()->associate($request->user());
            $slot->start = $currentDateTime;
            $currentDateTime->addMinutes($slotSizeMinutes);
            $slot->end = $currentDateTime;
            $slot->save();
        }

        return redirect('/slots');
    }

}
