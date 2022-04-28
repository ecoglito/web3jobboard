<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Job;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::all();

        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    public function add() {
        $companies = Company::all();
        
        return view('companies.add', [
            'companies' => $companies,
        ]);
    }

    
    public function create(Request $request) {
        $request->validate([
            'company' => 'required:min:2',
        ]);

        $company = new Company();
        $company->company = request('company');
        $company->save();
     
        return redirect()

        ->route('companies.index')
        ->with('success', "Your company '{$request->input('company')}' was succesfully posted.");
    }

    public function profile($id) {
        $jobs = Job::with(['company'])->where('company_id', '=', $id)->get();
        $company = Company::where('id', '=', $id)->first();

        return view('companies.profile', [
            'jobs' => $jobs,
            'company' => $company,
        ]);
    }
}
