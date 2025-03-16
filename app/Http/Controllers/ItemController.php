<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image type and size
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
        // dd($imagePath);

        Item::create([
            'name' => $request->name,
            'image' => $imagePath, // Save image path in database
        ]);

        return redirect()->route('item.index');
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $item->image = $imagePath; // Update image path
        }

        $item->name = $request->name;
        $item->save();

        return redirect()->route('item.index');
    }

    public function destroy(Item $item)
    {
        // Delete image from storage if it's being used
        if (file_exists(storage_path('app/public/' . $item->image))) {
            unlink(storage_path('app/public/' . $item->image));
        }

        $item->delete();

        return redirect()->route('item.index');
    }
}
