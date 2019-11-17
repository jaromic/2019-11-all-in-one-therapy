<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Slot extends Model
{
    public const SLOT_STATI = [ 'available', 'reserved', 'confirmed' ];

    /** @var array Laravel will cast those to Carbon instances automatically */
    protected $dates = [
        'start',
        'end'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function getNextWorkingDays($numberOfDays) {
        $now = Carbon::now();
        $dates=[];
        for($i=0;$i<$numberOfDays;++$i) {
            $date = $now->copy()->addDays($i);
            if($date->dayOfWeekIso>=6) {
                continue;
            } else {
                array_push($dates, $date);
            }
        }
        return $dates;
    }

    /**
     * @return mixed
     */
    public static function getMyReservedAndConfirmedSlots() {
        $user = auth()->user();
        $patient = $user->patient;
        if($patient) {
            $result =$patient->slots()->whereIn('status', ['reserved', 'confirmed'])->get();
        } else {
            $result=new Collection();
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public static function getAvailableSlots() {
        return Slot::where('status', 'available')->get();
    }
}
