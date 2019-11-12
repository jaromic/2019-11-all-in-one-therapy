<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function dokumentations() {
        return $this->hasMany('App\Dokumentation')  ;
    }

}
