<?php

namespace App\Http\Controllers;

use App\Market;
use App\Notifications\ProductNotification;
use App\Product;
use App\Category;
use App\Http\Resources\MarketResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function markets()
    {
        return new MarketResource(Market::all());
    }

    public function market($id)
    {
        return new \App\Http\Resources\Market(Market::find($id));
    }

    public function marketCreate(Request $request)
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

        if ($validator->fails())
            return response()->json(['status' => -1]);

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

        return new \App\Http\Resources\Market(Market::find($market->id));
    }


    public function categories()
    {
        return new CategoryResource(Category::all());
    }

    public function category($id)
    {
        return new \App\Http\Resources\Category(Category::find($id));
    }

    public function categoryCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required',
        ]);

        if ($validator->fails())
            return response()->json(['status' => -1]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $filename = 'category_' . $category->id . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/Images/', $filename);
        $category->update(['image' => $filename]);

        return new \App\Http\Resources\Category(Category::find($category->id));
    }


    public function products()
    {
        return new ProductResource(Product::all());
    }

    public function product($id)
    {
        return new \App\Http\Resources\Product(Product::find($id));
    }

    public function productCreate(Request $request)
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

        if ($validator->fails())
            return response()->json(['status' => -1]);

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

        return new \App\Http\Resources\Product(Product::find($product->id));
    }
}
