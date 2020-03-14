<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category_id    = $request->input('category_id');

        $products   = Product::select('*')
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->get();

        return $products;
    }
}
