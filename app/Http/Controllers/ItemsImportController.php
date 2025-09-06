<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemsImport;
use App\Imports\UsersImport;

class ItemsImportController extends Controller
{
    public function itemImportPost(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success', 'Items imported successfully!');
    }
}
