<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\PortfolioController;
use App\Http\Controllers\Member\ExperienceController;
use App\Http\Controllers\ChatbotController;

//use App\Http\Controllers\Auth\PasswordController;

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

Route::resource('registration', RegistrationController::class)->names('registration');

Route::get('/services', [PageController::class, 'servcies'])->name('services');
Route::get('/mediators', [PageController::class, 'mediators'])->name('mediators');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('aboutUs');
Route::get('/approach', [PageController::class, 'approach'])->name('approach');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact', [PageController::class, 'contactSubmit']);
Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::prefix('member')->name('member.')->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('portfolios', PortfolioController::class)->names('portfolios');
            Route::post('profile', [PortfolioController::class,'profile'])->name('profile');

            Route::resource('portfolio/experiences', ExperienceController::class)->names('portfolio.experiences');
            Route::put('portfolio/skills', [PortfolioController::class, 'updateSkills'])->name('portfolio.skills.update');
        });
        //Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
    }
);
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot');
    Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');
    Route::post('/chat', [ChatbotController::class, 'chat'])->name('chat');
});

// Route::post('/user/confirm-password', [PasswordController::class, 'confirm'])
//     ->name('password.confirm');

// Route::get('/user/profile', [ProfileController::class, 'show'])
//     ->name('profile.show')
//     ->middleware(['password.confirm']);

