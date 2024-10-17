<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\CourseResource;
use App\Filament\Resources\LessonResource;
use App\Http\Controllers\CourseController;
use App\Filament\Resources\ChapterResource;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\CodeEditorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/courses/{course}/chapter/{chapter}/lesson/{lesson}/exercise/{exercise}', [CodeEditorController::class, 'show'])->name('exercises.show');
Route::post('/courses/{course}/chapter/{chapter}/lesson/{lesson}/exercise/{exercise}/submit', [CodeEditorController::class, 'submit'])->name('exercises.check');


Route::get('/admin/courses/{record}/relations/chapters', [CourseResource\RelationManagers\ChaptersRelationManager::class, 'index'])->name('filament.resources.courses.relations.chapters');
Route::get('/admin/chapters/{record}/relations/lessons', [ChapterResource\RelationManagers\LessonsRelationManager::class, 'index'])->name('filament.resources.chapters.relations.lessons');
Route::get('/admin/lessons/{record}/relations/exercises', [LessonResource\RelationManagers\ExercisesRelationManager::class, 'index'])->name('filament.resources.lessons.relations.exercises');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
