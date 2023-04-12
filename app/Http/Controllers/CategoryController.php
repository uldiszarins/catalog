<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Catalog;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('viewCategories');
    }
}
