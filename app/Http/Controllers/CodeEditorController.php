<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;

class CodeEditorController extends Controller
{
    public function show($course, $chapter, $lesson, $exercise)
    {
        $exercise = Exercise::findOrFail($exercise);
        return view('code-editor', compact(
            'exercise',
            'course',
            'chapter',
            'lesson'
        ));
    }

    public function submit(Request $request, $course, $chapter, $lesson, $exercise)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'code' => 'required'
        ]);

        $exercise = Exercise::findOrFail($request->input('exercise_id'));
        $submittedCode = $request->input('code');

        if ($submittedCode === $exercise->expected_code) {
            return response()->json(['success' => true, 'message' => 'Code soumis avec succès et correspondant à la solution. Bravo!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Le code soumis ne correspond pas.']);
        }
    }
}
