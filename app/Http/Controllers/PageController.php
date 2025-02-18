<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Page::query();
            return DataTables::of($query)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('pages.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="' . route('pages.show', $row->id) . '" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                            <form action="' . route('pages.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'html' => 'nullable|string',
        ]);

        // Create a new page using mass assignment
        Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'html' => $request->html,
        ]);

        // Redirect or return success message
        return redirect()->route('pages.index')->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        // dd($page->html);
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id, // Exclude current page
            'html' => 'nullable|string',
        ]);

        // Update the page using mass assignment
        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'html' => $request->html,
        ]);

        // Redirect or return success message
        return redirect()->route('pages.index')->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        try {
            // Archive the page by adding a suffix to the slug
            $page->updateQuietly([
                'slug' => $page->slug . '-archived-' . Str::random(5)  // more unique
            ]);

            // Delete the page
            $page->delete();

            // Redirect with success message
            return redirect()->route('pages.index')->with('success', 'Page archived and deleted successfully.');
        } catch (\Exception $e) {
            // Redirect with error message
            return redirect()->route('pages.index')->with('error', 'Failed to archive and delete page.');
        }
    }
}
