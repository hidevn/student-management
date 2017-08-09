<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    public function solutions(){
        return $this->hasMany('App\StudentWork', 'exercise_id', 'id');
    }
}
