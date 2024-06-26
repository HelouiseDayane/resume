<?php

use App\Mail\TestEmail;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {
    $recipientEmail = 'testemail@mail.com'; // Troque pelo seu endereço de e-mail de teste
    Mail::to($recipientEmail)->send(new TestEmail());

    return 'E-mail de teste enviado!';
});
