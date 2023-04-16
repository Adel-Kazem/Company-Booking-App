<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function createUserOfCompanyForm()
    {
        return view('admin.createUser');
    }
    public function storeUserOfCompany(Request $request)
    {
        $user = new User($request->all());
        $user->role = 'company';
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/create/user')->with('success', 'User created successfully');
    }

    public function createCompanyForm()

    {
        $users = User::where('role', 'company')->get();
        return view('admin.createCompany', compact('users'));
    }

    public function storeCompany(Request $request)
    {
        $company = new Company($request->all());
        $company->user_id = $request->input('user_id');
        $company->save();

        return redirect('/admin/create/company')->with('success', 'Company created successfully');
    }

    public function showCompanies()
    {
        $companies = Company::all();
        return view('admin.updateCompany', compact('companies'));
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->active = !$company->active;
        $company->save();

        return redirect('/admin/update/company')->with('success', 'Company status updated successfully');
    }
}
