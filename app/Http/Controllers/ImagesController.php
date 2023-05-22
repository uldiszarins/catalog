<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Catalog;
use App\Models\Category;

class ImagesController extends Controller
{
    public function getImages($category): View
    {
        $imagesData = Catalog::select('id', 'name')
            ->where('category', $category)
            ->where('photo', 1)
            ->get();

        $categoryName = Category::where('id', $category)->pluck('category_name')->first();

        return view('viewImages', [
            'imagesData' => $imagesData,
            'selectedCategory' => $category,
            'selectedCategoryName' => $categoryName,
        ]);
    }
}
