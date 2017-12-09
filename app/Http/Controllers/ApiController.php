<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Market;
use App\Http\Resources\MarketResource;
use App\Product;

class ApiController extends Controller
{
    public function markets()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return new MarketResource(Market::all());
    }

    public function market($id)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        return new \App\Http\Resources\Market(Market::find($id));
    }

    public function categories()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return new CategoryResource(Category::all());
    }

    public function category($id)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        return new \App\Http\Resources\Category(Category::find($id));
    }

    public function products()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return new ProductResource(Product::all());
    }

    public function product($id)
    {
        /** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
        /** @noinspection PhpUndefinedMethodInspection */
        return new \App\Http\Resources\Product(Product::find($id));
    }
}
