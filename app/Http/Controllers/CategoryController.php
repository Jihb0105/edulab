<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->where(function ($query){
            if ($search = request()->query('search')) {
                $query->where("title", "LIKE", "%{$search}%");
            }
        })->paginate(10);
        return view('admins.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admins.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admins.categories.index')->with('success', 'New category has been added.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view("admins.categories.show", compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admins.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $category->title = $request->title;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admins.categories.index')->with('success', "Category has been updated successfully");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admins.categories.index')->with('success', "Category has been deleted successfully");
    }
}
