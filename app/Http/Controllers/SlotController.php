<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Slot;
use App\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {
        User::requirePermission('admin-calendar');

        $user = auth()->user();

        $availableSlots=$user->slots()->where('status', 'available')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedSlots=$user->slots()->where('status', 'reserved')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedAndConfirmedSlots=$user->slots()->whereIn('status', ['reserved','confirmed'])->paginate(getenv('AIOT_PAGINATE_ROWS'));

        return view('backend.slots', ['reservedAndConfirmedSlots'=>$reservedAndConfirmedSlots, 'reservedSlots'=>$reservedSlots, 'availableSlots'=>$availableSlots, 'patients'=>Patient::orderBy('lastname')->get(), 'slotStati' => $this->getAllStati()]);
    }

    private function getAllStati() {
        return Slot::SLOT_STATI;
    }

    /**
     * @param $slotId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function assignPatient($slotId) {
        $request = request();
        $patientId = $request->patient_id;
        $slot = Slot::findOrFail($slotId);
        $patient = Patient::findOrFail($patientId);
        $slot->patient()->associate($patient);
        $slot->status='confirmed';
        $slot->save();
        return redirect("/slots");
    }

    /**
     * @param $slotId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function setStatus($slotId) {
        $request = request();
        $status = $request->status;

        $this->checkIsValidStatus($status);

        $slot = Slot::findOrFail($slotId);
        $slot->status = $status;
        $slot->patient()->dissociate();
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
    public function destroy($id) {
        Slot::destroy($id);
        return redirect('/slots');
    }

}
