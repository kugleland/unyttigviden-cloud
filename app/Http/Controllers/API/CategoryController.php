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

    public function all()
    {
        $allFacts = Fact::all();
        $factsCount = $allFacts->count();
        $randomFacts = $allFacts->shuffle();
        $randomFacts->all();

        $pseudoCategory = new Category();
        $pseudoCategory->id = 0;
        $pseudoCategory->title = 'All';
        $pseudoCategory->description = 'All';
        $pseudoCategory->emoji = '🌍';
        $pseudoCategory->icon = '🌍';
        $pseudoCategory->image_url = asset('images/logo-wide.png');
        $pseudoCategory->color = '🌍';
        $pseudoCategory->color_light = '🌍';
        $pseudoCategory->color_dark = '🌍';
        $pseudoCategory->facts = FactResource::collection($randomFacts);
        return CategoryResource::make($pseudoCategory);
    }
}
