<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentWork extends Model
{
    protected $table = 'student_works';
    
    public function exercises(){
        return $this->belongsTo('App\Exercise', 'exercise_id','id');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
