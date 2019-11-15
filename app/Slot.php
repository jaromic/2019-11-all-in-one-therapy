<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
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
}
