<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('viewLanguages', [
            'languages' => Language::all(),
            'categories' => $categories,
        ]);
    }

    public function show(Int $languageId): View
    {
        $language = Language::findOrFail($languageId);
        $categories = Category::all();
        return view('editLanguages', [
            'language' => $language,
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('createLanguage', [
            'categories' => $categories,
        ]);
    }

    public function update(LanguageRequest $request, Int $languageId): RedirectResponse
    {
        $request->validated();

        $bank = Language::findOrFail($languageId);
        $bank->update([
            'language' => $request->language,
        ]);

        return redirect()
            ->route('language.show', ['language' => $languageId])
            ->with('status', 'Dati izlaboti');
    }
}
