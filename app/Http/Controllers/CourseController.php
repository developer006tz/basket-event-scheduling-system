<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function coursesDashboard(){
        $data['courses'] = Course::all();
        return view('courses.dashboard', $data);
    }

    // Create a new course
    public function coursesCreate(Request $request){
        if ($request->isMethod('GET')) {
            return view('courses.create');
        } else {
            $course = new Course();
            $course->fill($request->all());
            $course->save();
            return redirect('courses')->with('success', 'Course created successfully');
        }
    }

    // Update an existing course
    public function coursesUpdate(Request $request){
        if ($request->isMethod('GET')) {
            $data['course'] = Course::find($request->course_id);
            return view('courses.update', $data);
        } else {
            $course = Course::find($request->course_id);
            $course->fill($request->all());
            $course->save();
            return redirect('courses')->with('success', 'Course updated successfully');
        }
    }

    // Delete an existing course
    public function coursesDelete(Request $request){
        $course = Course::find($request->course_id);
        $course->delete();
        return redirect('courses')->with('success', 'Course deleted successfully');
    }
}
