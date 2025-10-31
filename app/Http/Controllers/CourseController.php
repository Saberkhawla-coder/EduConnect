<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json(['courses' => $courses]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|min:5|max:50',
            'desc' => 'required|string|min:5|max:255',
            'teacher_id' => 'required|integer|exists:users,id',
        ]);

        $course = new Course();
        $course->titre = $request->titre;
        $course->desc = $request->desc;
        $course->teacher_id = $request->teacher_id;
        $course->save();

        return response()->json(['course' => $course], 201);
    }

    public function show(Course $course)
    {
        return response()->json(['course' => $course]);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'titre' => 'sometimes|string|min:5|max:50',
            'desc' => 'sometimes|string|min:5|max:255',
        ]);

        $course->update(
            $request->only(['titre', 'desc']));
        return response()->json(['course' => $course]);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
