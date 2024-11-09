<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function getAllProducts(Product $product) {
        $products = $product->get();
        return $products;
    }
}
