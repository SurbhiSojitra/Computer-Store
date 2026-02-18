<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::latest()->get();
        return view('admin.productList', compact('products'));
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image'     => 'required|image',
            'price'     => 'required|numeric',
            'category'  => 'required',
            'stock'     => 'required|numeric',
            'desc'      => 'nullable',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);

        Product::create([
            'name'        => $request->name,
            'image'       => 'uploads/products/' . $imageName,
            'description' => $request->desc,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return back()->with('success', 'product added successfully!');
    }

    public function products(Request $request)
    {

        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $products = $query->latest()->get();
        return view('products', compact('products'));
    }

    public function home()
    {
        $featured = Product::latest()->take(3)->get();
        return view('home', compact('featured'));
    }

    public function productDetails($id)
    {
        $product = Product::findOrfail($id);
        return view('productDetails', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->only(['name', 'price', 'category', 'stock', 'desc']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $imageName);
            $data['image'] = 'uploads/products/' . $imageName;
        }

        $data['description'] = $request->desc;

        $product->update($data);

        return redirect()->route('admin.productList')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.productList')->with('success', 'Product deleted successfully!');
    }
}
