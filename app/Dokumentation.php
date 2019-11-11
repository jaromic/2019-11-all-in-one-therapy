<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumentation extends Model
{
    public function getUser() {
        return $this->hasOne('App\User');
    }

    public function getPatient() {
        return $this->hasOne('App\Patient');
    }
}
