<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CatalogRequest;
use App\Http\Service\CatalogService;
use App\Models\Catalog;
use Illuminate\Support\Facades\DB;

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

    public function update(CatalogRequest $request, int $catalogId): RedirectResponse
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
            CatalogService::updateCatalog($catalog, $catalogId);
        } catch (\Exception $e) {
            return redirect()
                ->route('catalog.create')
                ->withInput()
                ->withErrors(['msg' => 'Kļūda! ' . $e->getMessage()]);
        }

        return redirect()
            ->route('home')
            ->with('status', 'Dati izlaboti!');
    }

    public function getInventoryNumber(Int $category): Int
    {
        $maxInventoryNumber = Catalog::where('category', $category)
            ->max('inventory_number');

        if (!$maxInventoryNumber) {
            return $category . '001';
        }

        return $maxInventoryNumber + 1;
    }

    public function getCatalogData(Int $category = null)
    {
        $catalogData = Catalog::select(DB::raw("catalogs.id as catalog_id"), 'category_name', 'name', 'inventory_number', DB::raw("languages.language as language"), 'author', 'year', 'page_count', 'location')
            ->leftJoin('categories', function ($join) {
                $join->on('categories.id', '=', 'catalogs.category');
            })
            ->leftJoin('languages', function ($join) {
                $join->on('languages.id', '=', 'catalogs.language');
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('category', $category);
            })
            ->orderBy('catalogs.id', 'ASC')
            ->get();

        return [
            'draw' => 1,
            'recordsTotal' => 100,
            'recordsFiltered' => 20,
            'data' => $catalogData,
        ];
    }
}
