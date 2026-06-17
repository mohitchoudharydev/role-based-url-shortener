<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvitationController extends Controller
{
    use AuthorizesRequests;
    public function create()
    {
        $this->authorize('create', Invitation::class);
        return view('invitations.create');
    }

public function store(Request $request)
{
    $user = auth()->user();
    $this->authorize('create', Invitation::class);

    if ($user->role === 'SuperAdmin') {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'company_name' => 'required'
        ]);

        $company = Company::create([
            'name' => $request->company_name
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $company->id,
            'role' => 'Admin',
            'password' => bcrypt('password')
        ]);
    }

    elseif ($user->role === 'Admin') {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Member'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $user->company_id,
            'role' => $request->role,
            'password' => bcrypt('password')
        ]);
    }

    return redirect()
        ->route('dashboard')
        ->with('success', 'Invitation sent successfully');
}
}