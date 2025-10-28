<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{

    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:languages',
            'direction' => 'required|in:ltr,rtl',
        ]);

        Language::create($request->all());

        return redirect()->route('languages.index')->with('success', 'Language added successfully');
    }

    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:languages,code,' . $language->id,
            'direction' => 'required|in:ltr,rtl',

        ]);

        $language->update($request->all());

        return redirect()->route('languages.index')->with('success', 'Language updated successfully');
    }

    public function destroy(Language $language)
    {
        if ($language->is_default) {
            return redirect()->route('languages.index')->with('error', 'You cannot delete the default language.');
        }

        $language->delete();

        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }




    public function setDefault($id)
    {
        Language::where('is_default', true)->update(['is_default' => false]);

        $language = Language::findOrFail($id);
        $language->is_default = true;
        $language->save();

        return redirect()->back()->with('success', 'Default language updated successfully.');
    }
}
