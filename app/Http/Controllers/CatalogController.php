<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CatalogRequest;
use App\Http\Service\CatalogService;
use App\Models\Catalog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            ->route('catalog.create')
            ->with('status', 'Dati pievienoti!');
    }

    public function update(CatalogRequest $request, int $catalogId): RedirectResponse
    {
        $request->validated();

        $file = $request->file('file');

        $catalog = [
            'category' => $request->category,
            'name' => $request->name,
            'inventory_number' => $request->inventory_number,
            'language' => $request->language,
            'author' => $request->author,
            'year' => $request->year,
            'page_count' => $request->page_count,
            'photo' => ($file ? 1 : 0),
            'location' => $request->location,
        ];

        if ($file) {
            // Store the file in the storage directory
            $fileName = $catalogId . '_big.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public', $fileName);
        }

        try {
            CatalogService::updateCatalog($catalog, $catalogId);
        } catch (\Exception $e) {
            return redirect()
                ->route('catalog.show', ['catalog' => $catalogId])
                ->withInput()
                ->withErrors(['msg' => 'Kļūda! ' . $e->getMessage()]);
        }

        return redirect()
            ->route('home')
            ->with('status', 'Dati izlaboti!');
    }

    public function destroy(int $catalogId): RedirectResponse
    {
        $catalog = Catalog::find($catalogId);

        try {
            $catalog->delete();
        } catch (\Exception $e) {
            return redirect()
                ->route('catalog.show', ['catalog' => $catalogId])
                ->withErrors(['msg' => 'Ierakstu nedrīkst dzēst! ' . $e->getMessage()]);
        }

        //return response(null, Response::HTTP_NO_CONTENT);
        return redirect()
            ->route('home')
            ->with('status', 'Ieraksts izdzēsts');
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
        $catalogData = Catalog::select(DB::raw("catalogs.id as catalog_id"), 'category_name', 'name', 'inventory_number', DB::raw("languages.language as language"), 'author', 'year', 'page_count', 'location', DB::raw("IFNULL(photo, 0) as photo"))
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
            'recordsTotal' => count($catalogData),
            'recordsFiltered' => count($catalogData),
            'data' => $catalogData,
        ];
    }

    public function logout()
    {
        Auth::logout();

        return Redirect()->route('home');
    }
}
