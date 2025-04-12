<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\FactResource;
use App\Models\Fact;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::paginate(20));
    }


    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }
}
