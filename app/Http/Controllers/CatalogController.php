<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'categories' => Category::all()->toArray(),
        ]);
    }

    public function create(): View
    {
        $categories = Category::all()->toArray();

        $languages = Language::all()->toArray();

        return view('createCatalog', [
            'inventoryNumber' => 3001,
            'languages' => $languages,
            'categories' => $categories,
        ]);
    }

    public function store(CatalogRequest $request): RedirectResponse
    {
        $request->validated();
        $catalog = [
            'b_name' => $request->b_name,
            'b_code' => $request->b_code,
        ];

        try {
            CatalogService::createCatalog($catalog);
        } catch (\Exception $e) {
            return redirect()
                ->route('catalog.create')
                ->withErrors(['msg' => 'Kļūda! ' . $e->getMessage()]);
        }

        return redirect()
            ->route('home')
            ->with('status', 'Dati pievienoti!');
    }
}
