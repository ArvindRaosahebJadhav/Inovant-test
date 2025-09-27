<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    // this method show products page
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    // this method will show create product page
    public function create()
    {
        return view('products.create');
    }
    // this method will store product in database
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            // 'description' => 'nullable|min:10',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ];
        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // here we insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // here we will Store the image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            //save image to product directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in database
            $product->image = $imageName;
            $product->save();
        }



        return redirect()->route('products.index')->with('success', 'product added successfully');
    }
    // this method will edit product page
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }
    // this method will update product in database
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);


        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            // 'description' => 'nullable|min:10',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ];
        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        // here we update product in db
        // $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // delete old image
            File::delete(public_path('uploads/products/' . $product->image));
            // here we will Store the image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            //save image to product directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in database
            $product->image = $imageName;
            $product->save();
        }



        return redirect()->route('products.index')->with('success', 'product updateds successfully');
    }
    // this method will delete product from database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        //delete image
        File::delete(public_path('uploads/products/' . $product->image));
        //delete product from database

        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted successfully');
    }
}
