<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
         $categories = Category::all();
        $statuses = Status::all(); 
        return view('admin.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string', 
            'category_id' => 'required|integer|exists:categories,id', 
            'status_id' => 'required|integer|exists:statuses,id', 
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
        ]);

        
        $slug = Str::slug($request->title);
        $validatedData['slug'] = $slug; 

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['img'] = 'images/' . $imageName;
        }

      
        $product = Product::create($validatedData); 

        return redirect()->route('admin.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         $categories = Category::all();
        $statuses = Status::all();
        return view('admin.edit', compact('product', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'status_id' => 'required|integer|exists:statuses,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
        ]);

        
        $slug = Str::slug($request->title);
        $validatedData['slug'] = $slug; 

        if ($request->hasFile('img')) {
          
            if ($product->img && file_exists(public_path($product->img))) {
                unlink(public_path($product->img));
            }

            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validatedData['img'] = 'images/' . $imageName;
        }

        $product->update($validatedData); 

        return redirect()->route('admin.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
      
        if ($product->img && file_exists(public_path($product->img))) {
            unlink(public_path($product->img));
        }

        $product->delete();
        return redirect()->route('admin.index')->with('success', 'Product deleted successfully!');
    }
}
