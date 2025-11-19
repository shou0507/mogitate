<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('seasons');

        $seasons = Season::all();

        return view('show', compact('product', 'seasons'));
    }

    public function create()
    {
        return view('register');
    }

    public function store(StoreProductRequest $request)
    {
        $path = $request->file('image')->store('image', 'public');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
            'seasons' => $request->seasons,
        ]);

        return redirect('/products');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public');
            $product->image = $path;
        }

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];

        $product->seasons()->sync($validated['seasons'] ?? []);

        $product->save();

        return redirect("/products");
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $sort = $request->sort;

        $query = Product::query();

        if(!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if($sort === 'asc') {
            $query->orderBy('price', 'asc');
        } elseif($sort === 'desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('index', compact('products'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }
}
