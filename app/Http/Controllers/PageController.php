<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\News;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class PageController extends Controller
{
    public function home()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'news' => News::with('media')->latest('published_at')->take(6)->get()
        ]);

    }
    public function newsList(Request $request){
        return Inertia::render('NewsList', [
            'news' => News::with('media')->paginate(10)
        ]);
    }
    public function newsShow(News $news){
        return Inertia::render('NewsShow', [
            'news' => $news
        ]);
    }
    public function servcies()
    {
        return Inertia::render('Services');
    }
    public function mediators()
    {
        return Inertia::render('Mediators');
    }
    public function aboutUs()
    {
        return Inertia::render('AboutUs');
    }
    public function contact()
    {
        return Inertia::render('Contact');
    }
    public function approach()
    {
        return Inertia::render('Approach');
    }
    public function contactSubmit(Request $request){
        dd($request->all());
    }
}
