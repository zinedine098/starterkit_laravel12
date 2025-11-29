<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Lihat semua kategori
    public function index()
    {
        return Category::all();
    }

    // Simpan kategori (ADMIN ONLY)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return response()->json($category, 201);
    }

    // Lihat detail kategori
    public function show(Category $category)
    {
        return $category;
    }

    // Update kategori (ADMIN ONLY)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return $category;
    }

    // Hapus kategori (ADMIN ONLY)
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}
