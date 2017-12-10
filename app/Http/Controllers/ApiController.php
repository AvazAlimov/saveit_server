<?php

namespace App\Http\Controllers;

use App\Market;
use App\Product;
use App\Category;
use App\Http\Resources\MarketResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

use Illuminate\Http\Request;

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

    public function products()
    {
        return new ProductResource(Product::all());
    }

    public function product($id)
    {
        return new \App\Http\Resources\Product(Product::find($id));
    }
}
