<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\resume;

Route::get('/', function () {
    return view('resume.form');
});
Route::post('generate',[Resume::class,'generateResume'])->name('resume.generate');
Route::post('show',[Resume::class,'showResume'])->name('resume.show');