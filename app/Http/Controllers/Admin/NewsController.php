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
        $news = News::latest()->take(10)->get();
        return Inertia::render('Admin/News', ['news' => $news]);
    }

    public function create()
    {
        return Inertia::render('Admin/NewsForm',[
            'news' => (object)[]
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author' => 'nullable|string|max:255',
                'published_at' => 'nullable|date',
                'thumbnail' => 'nullable|image|max:2048', // 2MB Max
                'attachments' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:20480', // 10MB Max
            ]);
            $news = News::create($validated);

            if ($request->hasFile('thumbnail')) {
                $news->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }
            if ($request->hasFile('attachments')) {
                dd($attachment);

                foreach ($request->file('attachments') as $attachment) {
                    $news->addMedia($attachment)->toMediaCollection('attachments');
                }
            }

            return redirect()->route('admin.news.index')->with('success', 'News item created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create news: ' . $e->getMessage()]);
        }
    }

    public function edit(News $news)
    {
        //dd($news);
        return Inertia::render('Admin/NewsForm', [
            'news' => $news // This will include any associated media
        ]);
    }

    public function update(Request $request, News $news)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'author' => 'nullable|max:255',
                'published_at' => 'nullable|date',
                'thumbnail' => 'nullable|image|max:2048', // 2MB Max
                'attachments' => 'nullable|array',
                'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,png,jpg,jpeg|max:20480', // 20MB Max
            ]);

            $news->update($validated);

            // Handle thumbnail update
            if ($request->hasFile('thumbnail')) {
                $news->clearMediaCollection('thumbnail');
                $news->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }
            
            // Handle attachments update
            if ($request->hasFile('attachments')) {
                $news->clearMediaCollection('attachments');
                foreach ($request->file('attachments') as $attachment) {
                    $news->addMedia($attachment)->toMediaCollection('attachments');
                }
            }

            return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update news: ' . $e->getMessage()]);
        }
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}
