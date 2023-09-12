<?php

use App\Http\Controllers\CalculateController;
use Illuminate\Support\Facades\Route;

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

Route::get('password-reset', function () {})->name('password.reset');

Route::get('test', [CalculateController::class, 'calculate']);

Route::get('tutorial', function(){
    $app = app();
    $hello = $app->make(\App\Services\CalculateService::class);
    var_dump($hello);
});

