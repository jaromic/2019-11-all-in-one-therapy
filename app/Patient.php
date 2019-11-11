<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function getDokumentationen() {
        return $this->hasMany('App\Documentation');
    }

}
