<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
        return view('pages.company.index')->with(['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            // dd($request);
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'nullable|email|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
                'website' => 'nullable|max:255',
            ]);

            //dd($validatedData);
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = storage_path('app/public/');
                $image->move($path, $filename);
                $validatedData['logo'] = $filename;
            }

            $company = Company::create($validatedData);

            return redirect()->route('companies.index')
                ->with('success', 'Company created successfully.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('companies.index')
                ->with('error', 'Company Not created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('pages.company.edit')->with(['company' => $company]);
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
        dd($request);
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'nullable|email|max:255',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
                'website' => 'nullable|max:255',
            ]);
        
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = storage_path('app/public/');
                $image->move($path, $filename);
                $validatedData['logo'] = $filename;
            }
        
            $company = Company::updateOrCreate(['id' => $request->id], $validatedData);
        
            return redirect()->route('companies.index')
                ->with('success', 'Company updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->route('companies.index')
                ->with('error', 'Company not updated');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
