@extends('layouts.app')

@section('page-title', 'Companies')

@section('content')

<div class="mb-6" style="display:flex;align-items:center;justify-content:space-between">
    <div>
        <h1 style="font-size:20px;font-weight:700;letter-spacing:-0.3px">All Companies</h1>
        <p style="font-size:13px;color:var(--text-muted);margin-top:2px">Registered workspaces on LinkSnap</p>
    </div>
        @if(in_array(auth()->user()->role,['SuperAdmin']))
        <a href="{{ route('companies.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Create Company
        </a>
    @endif
    <span class="badge badge-blue">{{ $companies->count() }} total</span>
</div>

@if($companies->count() > 0)
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Members</th>
                    <th>URLs Created</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="width:36px;height:36px;border-radius:10px;background:var(--surface-2);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:var(--text-muted);flex-shrink:0">
                                {{ strtoupper(substr($company->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:14px">{{ $company->name }}</div>
                                <div style="font-size:11px;color:var(--text-dim)">ID #{{ $company->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:6px">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                                <path d="M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                            <span style="font-size:14px">{{ $company->users_count }}</span>
                        </div>
                    </td>
                    <td>
                        <span style="font-size:14px">{{ $company->short_urls_count ?? 0 }}</span>
                    </td>
                    <td>
                        <span class="badge badge-green">
                            <span style="width:5px;height:5px;border-radius:50%;background:currentColor;display:inline-block"></span>
                            Active
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@else
<div class="card">
    <div class="empty-state">
        <div class="empty-state-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--text-dim)" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <h3>No companies registered</h3>
        <p>Companies will appear here once users register.</p>
    </div>
</div>
@endif

@endsection