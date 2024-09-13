<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

// Make the views available
use Illuminate\Support\Facades\View;

// Authorization
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCompanys = Company::all();

        return View::make('companys.index')
            ->with('allCompanys', $allCompanys);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check CompanyPolicy for permission
        Gate::authorize('create', Company::class);

        return View::make('companys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        // Check if user has already a company; only one company per user allowed
        $userId = auth()->id();
        if (Company::where('user_id', $userId)->exists()) {
            return redirect()->back()->withErrors('Du kannst nur eine Firma erstellen!');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Company::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => $userId,
        ]);

        return redirect()->route('companys.index')
            ->with('success', 'Firma erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $company = Company::find($id);

        return View::make('companys.show')
            ->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $company = Company::find($id);

        // Check CompanyPolicy for permission
        Gate::authorize('update', $company);

        return View::make('companys.edit')
            ->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companys.index')
            ->with('success', 'Firma erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Check CompanyPolicy for permission
        Gate::authorize('delete', $company);

        $company->delete();

        return redirect()->route('companys.index')
            ->with('success', 'Firma erfolgreich gelöscht!');
    }
}
