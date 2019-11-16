<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index() {
        User::requirePermission('admin-calendar');

        $user = auth()->user();

        $availableSlots=$user->slots()->where('status', 'available')->paginate(getenv('AIOT_PAGINATE_ROWS'));
        $reservedSlots=$user->slots()->where('status', 'reserved')->paginate(getenv('AIOT_PAGINATE_ROWS'));

        return view('backend.slots', ['reservedSlots'=>$reservedSlots, 'availableSlots'=>$availableSlots]);
    }
}
