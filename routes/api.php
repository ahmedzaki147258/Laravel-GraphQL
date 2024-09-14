<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/student-export', [StudentController::class, 'export']);
Route::post('/student-import', [StudentController::class, 'import']);

Route::middleware(['checkTypeUser'])->group(function () {
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/student/{id}', [StudentController::class, 'show']);
    Route::post('/student', [StudentController::class, 'store']);
});
