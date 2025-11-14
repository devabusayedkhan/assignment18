<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = DB::table('products')->paginate(10);
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        // Store image
        $imageName = $this->fileUpload($request->file('image'), 'media');

        // Insert into database
        DB::table('products')->insert([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/products')->with('success', 'Product created successfully.');
    }

    // Show single product
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('products.edit', compact('product'));
    }

    // Update existing product
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // old data
        $oldData = DB::table('products')->where('id', $id)->first();

        $data = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $oldData->image,
            'updated_at' => now(),
        ];


        if ($request->hasFile('image')) {
            // delete old file
            $this->fileDelete($oldData->image);
            // update file
            $newImage = $this->fileUpload($request->file('image'), 'media');
            $data['image'] = $newImage;
        }

        DB::table('products')->where('id', $id)->update($data);

        return redirect('/products')->with('success', 'Product updated successfully.');
    }



    // Delete product
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        $this->fileDelete($product->image);
        DB::table('products')->where('id', $id)->delete();
        return redirect('/products')->with('success', 'Product deleted successfully.');
    }
}
