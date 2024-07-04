<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    //show
    public function show($id)
    {
        $companies = Companies::find(1);
        return view('admin.company.show', compact('companies'));
    }

    //edit
    public function edit($id)
    {
        $companies = Companies::find($id);
        return view('admin.company.edit', compact('companies'));
    }

    //update
    public function update(Request $request, Companies $companies)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $companies->update([
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('companies.show', 1)->with('success', 'Company updated successfully');
    }
}
