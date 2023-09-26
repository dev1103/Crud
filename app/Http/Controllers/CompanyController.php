<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data = Company::latest()->paginate(10);
        return view('admin.company.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'url',
        ],[   
            'logo.dimensions' => 'Logo\'s minimun height and width should be 100 X 100.',
        ]);

        $imageName = NULL;

        if($request->logo) {
            $namewithextension = $request->logo->getClientOriginalName();
            $name = explode('.', $namewithextension)[0]; 
            $imageName = $name.'_'.time().'.'.$request->logo->extension(); 
         
            $request->logo->move(storage_path('app/public'), $imageName);
        }

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $imageName;
        $company->website = $request->website;
        $company->save();

        session()->flash('success','You have added company successfully.');
        return redirect()->route('company.index');
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
        return view('admin.company.form',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'website' => 'url',
        ],[   
            'logo.dimensions' => 'Logo\'s minimun height and width should be 100 X 100.',
        ]);

        $imageName = $company->logo;

        if($request->logo) {
            $namewithextension = $request->logo->getClientOriginalName();
            $name = explode('.', $namewithextension)[0]; 
            $imageName = $name.'_'.time().'.'.$request->logo->extension(); 
         
            $request->logo->move(storage_path('app/public'), $imageName);
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $imageName;
        $company->website = $request->website;
        $company->save();

        session()->flash('success','You have updated company successfully.');
        return redirect()->route('company.index');
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

        session()->flash('success','You have deleted company successfully.');
        return redirect()->route('company.index');
    }
}
