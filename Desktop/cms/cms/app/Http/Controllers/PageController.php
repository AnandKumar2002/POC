<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $page = Page::create([
            'title' => $request->title,
            'html' => $request->html,
            'css' => $request->css,
            'js' => $request->js,
        ]);

        return response()->json($page, 201);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('pages.show', compact('page'));
    }
}
