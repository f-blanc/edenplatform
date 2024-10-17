<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    //
    public function index()
    {
        $exercises = Exercise::all();
        return view('home', compact('exercises'));
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', compact('exercise'));
    }
}
