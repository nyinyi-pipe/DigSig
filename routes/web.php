<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SignaturePadController;


/// Add PDF Controller route
#Route::get('/create/pdf', [PDFController::class, 'createPDF'])->name('createPDF');

// Add New Route
Route::get('signaturepad', [SignaturePadController::class, 'index']);
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');



Route::get('/', function () {
    return view('welcome');
});
