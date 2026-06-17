@extends('layouts.app')

@section('page-title', 'Invite a Teammate')

@section('topbar-actions')
    <a href="{{ route('dashboard') }}" class="btn btn-ghost">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
        Dashboard
    </a>
@endsection

@section('content')

<div style="max-width:520px">

    @if(session('success'))
    <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0">
            <path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
            <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
        </svg>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span class="card-title">Send Invitation</span>
            <div style="width:32px;height:32px;background:rgba(167,139,250,0.1);border-radius:8px;display:flex;align-items:center;justify-content:center">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#A78BFA" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                    <line x1="19" y1="8" x2="19" y2="14"/>
                    <line x1="22" y1="11" x2="16" y2="11"/>
                </svg>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('invitations.store') }}">
                @csrf

  <div class="form-group">
    <label class="form-label" for="name">Name</label>
    <input
        id="name"
        type="text"
        name="name"
        class="form-control"
        placeholder="Enter full name"
        value="{{ old('name') }}"
        required
    >
    @error('name')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label class="form-label" for="email">Email address</label>
    <input
        id="email"
        type="email"
        name="email"
        class="form-control"
        placeholder="colleague@company.com"
        value="{{ old('email') }}"
        required
    >
    @error('email')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

@if(auth()->user()->role === 'Admin')
<div class="form-group">
    <label class="form-label" for="role">Role</label>

    <select id="role" name="role" class="form-control">
        <option value="Admin">Admin</option>
        <option value="Member">Member</option>
    </select>

    @error('role')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>
@endif
@if(auth()->user()->role === 'SuperAdmin')
<div class="form-group">
    <label class="form-label" for="company_name">
        Company Name
    </label>

    <input
        id="company_name"
        type="text"
        name="company_name"
        class="form-control"
        placeholder="Enter company name"
        value="{{ old('company_name') }}"
        required
    >

    @error('company_name')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>
@endif

<div style="background:var(--surface-2);border:1px solid var(--border);border-radius:8px;padding:14px;margin-bottom:20px">
    <div style="font-size:12px;font-weight:600;color:var(--text-muted);margin-bottom:8px">
        Invitation Rules
    </div>

    <div style="font-size:12px;color:var(--text-dim);line-height:1.7">

        @if(auth()->user()->role === 'SuperAdmin')
            You are inviting an <strong>Admin</strong> for a new company.
        @endif

        @if(auth()->user()->role === 'Admin')
            <strong>Admin</strong> — Company management<br>
            <strong>Member</strong> — Create and view own URLs
        @endif

    </div>
</div>

                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/>
                    </svg>
                    Send Invitation Email
                </button>
            </form>
        </div>
    </div>

</div>

@endsection