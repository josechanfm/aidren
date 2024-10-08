<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Articles', [
            'articles' => Article::paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ArticleForm',[
            'articles' => (object)[]
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category'=>'required|string|max:255',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'author' => 'nullable|string|max:255',
                'published_at' => 'nullable|date',
                'thumbnail' => 'nullable|image|max:2048', // 2MB Max
                'attachments' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png|max:20480', // 10MB Max
            ]);
            $article = Article::create($validated);

            if ($request->hasFile('thumbnail')) {
                $article->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $article->addMedia($attachment)->toMediaCollection('attachments');
                }
            }
            return redirect()->route('admin.articles.index')->with('success', 'Articles item created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to create article: ' . $e->getMessage()]);
        }
    }

    public function edit(Articles $article)
    {
        //dd($article);
        return Inertia::render('Admin/ArticleForm', [
            'articles' => $article // This will include any associated media
        ]);
    }

    public function update(Request $request, Article $article)
    {
        try {
            $validated = $request->validate([
                'category'=>'required|string|max:255',
                'title' => 'required|max:255',
                'content' => 'required',
                'author' => 'nullable|max:255',
                'published_at' => 'nullable|date',
                'thumbnail' => 'nullable|image|max:2048', // 2MB Max
                'attachments' => 'nullable|array',
                'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,png,jpg,jpeg|max:20480', // 20MB Max
            ]);

            $article->update($validated);

            // Handle thumbnail update
            if ($request->hasFile('thumbnail')) {
                $article->clearMediaCollection('thumbnail');
                $article->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
            }
            
            // Handle attachments update
            if ($request->hasFile('attachments')) {
                //$article->clearMediaCollection('attachments');
                foreach ($request->file('attachments') as $attachment) {
                    $article->addMedia($attachment)->toMediaCollection('attachments');
                }
            }

            return redirect()->route('admin.articles.index')->with('success', 'Articles updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update article: ' . $e->getMessage()]);
        }
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Articles deleted successfully.');
    }
}
