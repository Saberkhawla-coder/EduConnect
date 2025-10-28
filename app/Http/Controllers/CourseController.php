<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    function index(){
        $courses=Course::All();
        return $courses;
    }
    function edit(){
       
    }
    function update(){
       
    }
    function create(){
       
    }
     function store(){
       
    }
    function show(){
       
    }
    function destory(){
       
    }

}
