<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Slot;
use App\User;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index() {
        User::requirePermission('admin-calendar');

        $user = auth()->user();

        $availableSlots=$user->slots()->where('status', 'available')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedSlots=$user->slots()->where('status', 'reserved')->paginate(getenv('AIOT_PAGINATE_ROWS'));

        return view('backend.slots', ['reservedSlots'=>$reservedSlots, 'availableSlots'=>$availableSlots, 'patients'=>Patient::orderBy('lastname')->get(), 'slotStati' => $this->getAllStati()]);
    }

    private function getAllStati() {
        return Slot::SLOT_STATI;
    }

    public function assignPatient($slotId) {
        $request = request();
        $patientId = $request->patient_id;
        $slot = Slot::findOrFail($slotId);
        $patient = Patient::findOrFail($patientId);
        $slot->patient()->associate($patient);
        $slot->save();
        return redirect("/slots");
    }
}
