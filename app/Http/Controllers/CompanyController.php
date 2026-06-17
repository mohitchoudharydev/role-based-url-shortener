<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'SuperAdmin') {
            abort(403);
        }

        $companies = Company::withCount('users')->get();

        return view('companies.index', compact('companies'));
    }

    public function create(Request $request)
{
    abort_if(auth()->user()->role !== 'SuperAdmin', 403);

    $admins = User::where('role', 'Admin')->get();

    return view('companies.create', compact('admins'));
}


}