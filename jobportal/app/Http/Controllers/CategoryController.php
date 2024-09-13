<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

// Make the views available
use Illuminate\Support\Facades\View;

// Authorization
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategorys = Category::all();

        return View::make('categorys.index')
            ->with('allCategorys', $allCategorys);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check CompanyPolicy for permission
        Gate::authorize('create', Category::class);

        return View::make('categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('categorys.index')
            ->with('success', 'Kategorie erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        return View::make('categorys.show')
            ->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        // Check Policy for permission
        Gate::authorize('update', $category);

        return View::make('categorys.edit')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categorys.index')
            ->with('success', 'Kategorie erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check Policy for permission
        Gate::authorize('delete', $category);

        $category->delete();

        return redirect()->route('categorys.index')
            ->with('success', 'Kategorie erfolgreich gelöscht!');
    }
}
