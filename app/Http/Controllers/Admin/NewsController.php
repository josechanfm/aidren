<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return Inertia::render('Admin/News', ['news' => $news]);
    }

    public function create()
    {
        return Inertia::render('Admin/NewsCreate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:255',
            'published_at' => 'required|date',
            'thumbnail' => 'required|image|max:2048', // 2MB Max
            'attachments.*' => 'file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240', // 10MB Max
        ]);

        $news = News::create($validated);

        if ($request->hasFile('thumbnail')) {
            $news->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $news->addMedia($attachment)->toMediaCollection('attachments');
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'News item created successfully.');
    }

    public function edit(News $news)
    {
        return Inertia::render('Admin/NewsCreate', [
            'news' => $news
        ]);
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:255',
            'published_at' => 'required|date',
        ]);

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
