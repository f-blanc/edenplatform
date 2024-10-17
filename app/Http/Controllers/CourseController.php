<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::where('is_active', true)->get();
        return view('courses.courses', compact('courses'));
    }

    /**
     * Display the specified course along with its chapters, lessons, and exercises.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Retrieve the course by its slug with chapters, lessons and exercises
        $course = Course::where('slug', $slug)
            ->with(['chapters' => function ($query) {
                $query->where('is_active', true)->with(['lessons' => function ($query) {
                    $query->where('is_active', true)->with(['exercises' => function ($query) {
                        $query->where('is_active', true);
                    }]);
                }]);
            }])
            ->where('is_active', true)
            ->firstOrFail();

        return view('courses.show', compact('course'));

    }
}
