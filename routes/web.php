<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/image', function () {
//     $heroImage = asset('image1.png');
//     $uploadedPath = Storage::disk('s3')->put('public','image1.png', $heroImage);
//     return Storage::disk('s3')->url($uploadedPath);
// });
// ;

// Route::get('/image', function () {
//     $heroImage = public_path('image1.png'); // Assuming the image is in the public directory
//     $uploadedPath = Storage::disk('s3')->put('public', $heroImage);
//     return Storage::disk('s3')->url($uploadedPath);
// });




