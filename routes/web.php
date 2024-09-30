<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\PortfolioController;
use App\Http\Controllers\Member\ExperienceController;
<<<<<<< HEAD
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PrivateMessageController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
=======
use App\Http\Controllers\ChatbotController;

>>>>>>> 54b8652db0bae3c542bdf4b01692f124c3b39c7a
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
    $latestNews = News::latest('published_at')->take(6)->get();
    
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'news' => $latestNews
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('news', NewsController::class)->names('news');
    });
    //Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
}
);
// Route::post('/user/confirm-password', [PasswordController::class, 'confirm'])
//     ->name('password.confirm');

// Route::get('/user/profile', [ProfileController::class, 'show'])
//     ->name('profile.show')
//     ->middleware(['password.confirm']);


Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [TopicController::class, 'index'])->name('forum');
    Route::get('/forum/topic/{topic}', [TopicController::class, 'show'])->name('forum.topic');
    Route::resource('forum/topics', TopicController::class)->names('forum.topics');
    Route::post('/forum/topic', [TopicController::class, 'store'])->name('forum.topic.store');
    Route::post('/forum/message', [MessageController::class, 'store'])->name('forum.message.store');
    Route::get('/messages', [PrivateMessageController::class, 'index'])->name('messages');
    Route::post('/messages', [PrivateMessageController::class, 'store'])->name('messages.store');

});

