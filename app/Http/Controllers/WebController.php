<?php

namespace App\Http\Controllers;

use App\Category;
use App\Market;
use App\Notifications\ProductNotification;
use App\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $markets = Market::all();
        $products = Product::all();
        /** @noinspection PhpUndefinedMethodInspection */
        return view('home')
            ->withMarkets($markets)
            ->withCategories($categories)
            ->withProducts($products);
    }

    public function createMarket()
    {
        return view('Market.create');
    }

    public function createMarketSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|max:16',
            'password' => 'required|max:16',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:19|min:12',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('market.create')
                ->withErrors($validator)
                ->withInput();
        }

        $market = new Market();
        $market->login = $request->login;
        $market->password = bcrypt($request->password);
        $market->name = $request->name;
        $market->address = $request->address;
        $market->phone = $request->phone;
        $market->latitude = $request->latitude;
        $market->longitude = $request->longitude;
        $market->save();

        if ($request->file('image') != null) {
            $filename = 'market_' . $market->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/Images/', $filename);
            $market->update(['image' => $filename]);
        }

        return redirect()->route('home');
    }

    public function deleteMarket($id)
    {
        $market = Market::find($id);
        if ($market->image != null)
            File::delete(public_path() . '\Images\\' . $market->image);

        $market->delete();
        return redirect()->route('home');
    }


    public function createCategory()
    {
        return view('Category.create');
    }

    public function createCategorySubmit(Request $request)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required',
        ]);

        /** @noinspection PhpUndefinedMethodInspection */
        if ($validator->fails()) {
            return redirect()->route('category.create')
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $filename = 'category_' . $category->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/Images/', $filename);
        $category->update(['image' => $filename]);

        return redirect()->route('home');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category->image != null)
            File::delete(public_path() . '\Images\\' . $category->image);
        $category->delete();
        return redirect()->route('home');
    }


    public function createProduct()
    {
        $markets = Market::all();
        $categories = Category::all();
        return view('Product.create')
            ->withMarkets($markets)
            ->withCategories($categories);
    }

    public function createProductSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'market' => 'required',
            'category' => 'required',
            'name' => 'required|max:255',
            'date' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);

        if ($validator->fails()) {
            $markets = Market::all();
            $categories = Category::all();
            return redirect()->route('product.create')
                ->withMarkets($markets)
                ->withCategories($categories)
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->market = $request->market;
        $product->category = $request->category;
        $product->name = $request->name;
        $product->date = $request->date;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->unit = $request->unit;
        $product->new_price = doubleval($request->price) * (1 - doubleval($request->discount) / 100);
        $product->save();

        if ($request->file('image') != null) {
            $filename = 'product_' . $product->id . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/Images/', $filename);
            $product->update(['image' => $filename]);
        }

        $product->notify(new ProductNotification());

        return redirect()->route('home');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product->image != null)
            File::delete(public_path() . '\Images\\' . $product->image);
        $product->delete();
        return redirect()->route('home');
    }
}
