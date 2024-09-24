<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::resource('registration', App\Http\Controllers\RegistrationController::class)->names('registration');

Route::get('/services', [PageController::class, 'servcies'])->name('services');
Route::get('/mediators', [PageController::class, 'mediators'])->name('mediators');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');
Route::get('/approach', [PageController::class, 'approach'])->name('approach');

Route::post('/contact', [ContactController::class, 'submit']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
