@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')

{{-- Stats row --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total URLs</div>
        <div class="stat-value">{{ $totalUrls ?? 0 }}</div>
        <div class="stat-sub">across your workspace</div>
    </div>
    <div class="stat-card" style="--accent:#22C98C">
        <div class="stat-label">My Links</div>
        <div class="stat-value">{{ $myUrls ?? 0 }}</div>
        <div class="stat-sub">created by you</div>
    </div>
    @if(auth()->user()->role === 'SuperAdmin')
    <div class="stat-card" style="--accent:#F5A623">
        <div class="stat-label">Companies</div>
        <div class="stat-value">{{ $companies ?? 0 }}</div>
        <div class="stat-sub">active workspaces</div>
    </div>
    @endif
    <div class="stat-card" style="--accent:#A78BFA">
        <div class="stat-label">Team Members</div>
        <div class="stat-value">{{ $teamCount ?? 0 }}</div>
        <div class="stat-sub">in your company</div>
    </div>
</div>

{{-- Quick actions --}}
<div class="mb-6">
    <h2 style="font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:var(--text-dim);margin-bottom:14px">
        Quick Actions
    </h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">

        @if(in_array(auth()->user()->role, ['Admin','Member']))
        <a href="{{ route('urls.create') }}" style="text-decoration:none">
            <div class="card" style="padding:20px;cursor:pointer;transition:border-color 0.15s,transform 0.15s" onmouseenter="this.style.borderColor='var(--accent)';this.style.transform='translateY(-2px)'" onmouseleave="this.style.borderColor='var(--border)';this.style.transform=''">
                <div style="width:36px;height:36px;background:var(--accent-glow);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--accent)" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </div>
                <div style="font-size:14px;font-weight:600;margin-bottom:2px">Create Short URL</div>
                <div style="font-size:12px;color:var(--text-muted)">Shorten a long link instantly</div>
            </div>
        </a>
        @endif

        <a href="{{ route('urls.index') }}" style="text-decoration:none">
            <div class="card" style="padding:20px;cursor:pointer;transition:border-color 0.15s,transform 0.15s" onmouseenter="this.style.borderColor='var(--accent)';this.style.transform='translateY(-2px)'" onmouseleave="this.style.borderColor='var(--border)';this.style.transform=''">
                <div style="width:36px;height:36px;background:rgba(34,201,140,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#22C98C" stroke-width="2">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                    </svg>
                </div>
                <div style="font-size:14px;font-weight:600;margin-bottom:2px">View All URLs</div>
                <div style="font-size:12px;color:var(--text-muted)">Browse your short links</div>
            </div>
        </a>

        @if(in_array(auth()->user()->role, ['SuperAdmin', 'Admin', 'Manager']))
        <a href="{{ route('invitations.create') }}" style="text-decoration:none">
            <div class="card" style="padding:20px;cursor:pointer;transition:border-color 0.15s,transform 0.15s" onmouseenter="this.style.borderColor='var(--accent)';this.style.transform='translateY(-2px)'" onmouseleave="this.style.borderColor='var(--border)';this.style.transform=''">
                <div style="width:36px;height:36px;background:rgba(167,139,250,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A78BFA" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </div>
                <div style="font-size:14px;font-weight:600;margin-bottom:2px">Invite a Teammate</div>
                <div style="font-size:12px;color:var(--text-muted)">Send an invitation by email</div>
            </div>
        </a>
        @endif

        @if(auth()->user()->role === 'SuperAdmin')
        <a href="{{ route('companies.index') }}" style="text-decoration:none">
            <div class="card" style="padding:20px;cursor:pointer;transition:border-color 0.15s,transform 0.15s" onmouseenter="this.style.borderColor='var(--accent)';this.style.transform='translateY(-2px)'" onmouseleave="this.style.borderColor='var(--border)';this.style.transform=''">
                <div style="width:36px;height:36px;background:rgba(245,166,35,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:12px">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F5A623" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
                <div style="font-size:14px;font-weight:600;margin-bottom:2px">Manage Companies</div>
                <div style="font-size:12px;color:var(--text-muted)">View all registered companies</div>
            </div>
        </a>
        @endif
    </div>
</div>

@endsection