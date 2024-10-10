<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article;
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
            'news' => Article::where('category','news')->with('media')->latest('published_at')->take(6)->get()
        ]);

    }
    public function newsList(Request $request){
        return Inertia::render('NewsList', [
            'articles' => Article::where('category','news')->with('media')->paginate(5)
        ]);
    }
    public function newsShow(Article $article){
        if($article->category!=='news'){
            return to_route('news.list');
        }
        return Inertia::render('NewsShow', [
            'article' => $article
        ]);
    }

    public function clauseList(Request $request){
        return Inertia::render('ClauseList', [
            'articles' => Article::where('category','clause')->with('media')->paginate(6)
        ]);
    }
    public function clauseShow(Article $article){
        if($article->category!=='clause'){
            return to_route('clause.list');
        }
        return Inertia::render('ClauseShow', [
            'article' => $article
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
