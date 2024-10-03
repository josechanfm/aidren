<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\PortfolioController;
use App\Http\Controllers\Member\ExperienceController;
use App\Http\Controllers\Admin\NewsController;
use App\Models\News;
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

// Route::get('/', function () {
//     $latestNews = News::latest('published_at')->take(6)->get();
    
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'news' => $latestNews
//     ]);
// })->name('home');
Route::resource('registration', RegistrationController::class)->names('registration');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/news', [PageController::class, 'newsList'])->name('news.list');
Route::get('/news/{news}', [PageController::class, 'newsShow'])->name('news.show');

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
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('portfolios', PortfolioController::class)->names('portfolios');
            Route::post('profile', [PortfolioController::class,'profile'])->name('profile');
            Route::resource('portfolio/experiences', ExperienceController::class)->names('portfolio.experiences');
            Route::put('portfolio/skills', [PortfolioController::class, 'updateSkills'])->name('portfolio.skills.update');

            Route::get('forum', [App\Http\Controllers\Member\Forum\TopicController::class, 'index'])->name('forum');
            Route::get('forum/topic/{topic}', [App\Http\Controllers\Member\Forum\TopicController::class, 'show'])->name('forum.topic');
            Route::resource('forum/topics', App\Http\Controllers\Member\Forum\TopicController::class)->names('forum.topics');
            Route::post('forum/topic', [App\Http\Controllers\Member\Forum\TopicController::class, 'store'])->name('topic.store');

            Route::resource('forum/topic/{topic}/messages', App\Http\Controllers\Member\Forum\MessageController::class)->names('topic.messages');
    
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
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
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

