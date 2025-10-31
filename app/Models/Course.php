<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function professeure(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function etudiantes(){
        return $this->belongsToMany(User::class, 'course_user');
    }
}
