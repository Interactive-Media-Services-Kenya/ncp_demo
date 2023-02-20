<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(){
        $categories = ProductCategory::all();

        return view('admin.product-categories.index',compact('categories'));
    }
}
