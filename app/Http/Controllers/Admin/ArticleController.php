<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'category' => 'array', // Expecting an array of categories for filtering
            'category.*' => 'string', // Each category should be a string
            'per_page' => 'integer|min:1|max:100', // Pagination parameter
        ]);
        $articles=Article::query();
        if($request->filter){
            foreach($request->filter as $field=>$values){
                //dd($field, $values);
                if(!is_null($values) && is_array($values)){
                    $articles=$articles->whereIn($field,$values);
                }
            }
        }
        if($request->sorter && isset($request->sorter['order'])){
            // dd($request->sorter['field']);
            if($request->sorter['order']=='ascend'){
                $articles->orderBy($request->sorter['field'],'ASC');
            }
            if($request->sorter['order']=='descend'){
                $articles->orderBy($request->sorter['field'],'DESC');
            }
        }
        
        $categories=Config::item('article_categories');
        foreach($categories as $i=>$cat){
            $categories[$i]['text']=$cat['label'];
            unset($categories[$i]['label']);
        }
        
        return Inertia::render('Admin/Articles', [
            'categories'=>$categories,
            'articles' => $articles->paginate($request->per_page)
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ArticleForm',[
            'categories'=>Config::item('article_categories'),
            'article' => Article::make()
            //'article' => (Object)[]
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
            $validated = $request->validate([
                'category'=>'required|string|max:255',
                'title' => 'required|string|max:255',
                'content' => 'nullable|string',
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
    }

    public function edit(Article $article)
    {
        //dd($article);
        return Inertia::render('Admin/ArticleForm', [
            'categories'=>Config::item('article_categories'),
            'article' => $article // This will include any associated media
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

        return redirect()->route('admin.articles.index')->with('success', 'Articles deleted successfully.');
    }
}
