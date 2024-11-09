<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function getAllCategories(Category $category) {
        $categories = $category->get();
        return $categories;
    }
}
