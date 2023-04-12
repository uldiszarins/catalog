<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CatalogRequest;
use App\Http\Service\CatalogService;
use App\Models\Catalog;

class CatalogController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function create(): View
    {
        $languages = Language::all();

        return view('createCatalog', [
            'inventoryNumber' => 3001,
            'languages' => $languages,
            'max_inventory_number' => $this->getInventoryNumber(1),
        ]);
    }

    public function show(Int $catalogId): View
    {
        $catalog = Catalog::findOrFail($catalogId);
        $languages = Language::all();

        return view('editCatalog', [
            'catalog' => $catalog,
            'languages' => $languages,
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
                ->withInput()
                ->withErrors(['msg' => 'Kļūda! ' . $e->getMessage()]);
        }

        return redirect()
            ->route('home')
            ->with('status', 'Dati pievienoti!');
    }

    public function getInventoryNumber(Int $category): Int
    {
        $maxInventoryNumber = Catalog::where('category', $category)->max('inventory_number');

        // TODO: neiedod 001 nekad
        if (!$maxInventoryNumber) {
            $maxInventoryNumber = $category . '001';
        }
        return ($maxInventoryNumber + 1);
    }

    public function getCatalogData(Int $category = null)
    {
        $catalogData = Catalog::select('id', 'category', 'name', 'inventory_number', 'language', 'author', 'year', 'page_count', 'location')
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->orderBy('id', 'ASC')
            ->get();
        return [
            'draw' => 1,
            'recordsTotal' => 100,
            'recordsFiltered' => 20,
            'data' => $catalogData,
        ];
    }
}
