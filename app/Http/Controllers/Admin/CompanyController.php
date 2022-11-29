<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        if ($request->hasFile('logo')) {
            $request->validated();
            $logo = $request->file('logo')->store('logos', 'public');
            $image = Image::make(public_path("storage/{$logo}"))->fit(100, 100);
            $image->save();
            Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo
            ]);
        } else {
            Company::create([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website
            ]);
        }

        return redirect()->route('admin.companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($request->hasFile('logo')) {
            $request->validated();
            $logo = $request->file('logo')->store('logos', 'public');
            $image = Image::make(public_path("storage/{$logo}"))->fit(100, 100);
            $image->save();
            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logo
            ]);
        } else {
            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website
            ]);
        }

        return redirect()->route('admin.companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index');
    }
}
