<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function show($slug)
{
    $categories = Category::query()->where('slug',$slug)->firstOrFail();
    $products = $categories->products()->paginate(10);
    $title = $categories->title;
    return view('categories.show', compact('categories', 'products', 'title'));
}
}
