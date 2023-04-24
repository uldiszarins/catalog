<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('viewCategories');
    }

    public function show(Int $categoryId): View
    {
        $category = Category::findOrFail($categoryId);

        return view('editCategory', [
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, int $categoryId)
    {
        $request->validated();

        $catalog = Category::findOrFail($categoryId);

        $catalog->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()
            ->route('category.index')
            ->with('status', 'Dati izlaboti!');
    }

}
