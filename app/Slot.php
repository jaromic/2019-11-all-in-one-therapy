<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
}
