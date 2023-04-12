<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\View\View;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function index(): View
    {
        return view('viewLanguages', [
            'languages' => Language::all(),
        ]);
    }

    public function show(Int $languageId): View
    {
        $language = Language::findOrFail($languageId);

        return view('editLanguages', [
            'language' => $language,
        ]);
    }

    public function create(): View
    {
        return view('createLanguage');
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
