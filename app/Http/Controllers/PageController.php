<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PageController extends Controller
{
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
