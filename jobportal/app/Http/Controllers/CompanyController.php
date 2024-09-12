<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;

// Make the views available
use Illuminate\Support\Facades\View;

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
        return View::make('companys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Company::create($request->all());

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
        $company = Company::find($id);
        $company->delete();

        return redirect()->route('companys.index')
            ->with('success', 'Firma erfolgreich gelöscht!');
    }
}
