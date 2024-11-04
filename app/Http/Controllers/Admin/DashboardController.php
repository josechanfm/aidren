<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Topic;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'total_topics' => Topic::count(),
        ];

        $latest_articles = Article::latest()->take(5)->get();
        $latest_topics = Topic::latest()->take(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'latest_articles' => $latest_articles,
            'latest_topics' => $latest_topics,
        ]);
    }
}
