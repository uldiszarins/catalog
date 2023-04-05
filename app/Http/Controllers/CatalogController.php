<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CatalogRequest;
use App\Http\Service\CatalogService;

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

        $languages = Language::all();

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
            'category' => $request->category,
            'name' => $request->name,
            'inventory_number' => $request->inventory_number,
            'language' => $request->language,
            'author' => $request->author,
            'year' => $request->year,
            'page_count' => $request->page_count,
            'photo' => $request->photo,
            'location' => $request->location,
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
