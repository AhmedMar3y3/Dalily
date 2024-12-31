<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        Category::create($validatedData);
    
        return redirect()->back()->with('success', 'Category created successfully.');
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function viewPlaces($id)
    {
        $category = Category::find($id);
        $places = $category->places()->paginate(15);
        return view('category.show', compact('places', 'category'));
    }
}
