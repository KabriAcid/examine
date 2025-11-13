<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Home::class)->name('welcome');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/mock/{examId?}', App\Livewire\MockExam::class)->name('mock.exam');

// Student Routes (Protected)
Route::middleware(['auth', 'verified'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', App\Livewire\Student\Dashboard::class)->name('dashboard');
    Route::get('/exams', fn() => view('livewire.student.exams'))->name('exams');
    Route::get('/practice', fn() => view('livewire.student.practice'))->name('practice');
    Route::get('/results', fn() => view('livewire.student.results'))->name('results');
    Route::get('/performance', fn() => view('livewire.student.performance'))->name('performance');
    Route::get('/subjects', fn() => view('livewire.student.subjects'))->name('subjects');
    Route::get('/settings', fn() => view('livewire.student.settings'))->name('settings');
    Route::get('/help', fn() => view('livewire.student.help'))->name('help');
    Route::get('/more', App\Livewire\Student\MobileMore::class)->name('more');
});

// Old dashboard route for compatibility
Route::get('/dashboard', function () {
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
