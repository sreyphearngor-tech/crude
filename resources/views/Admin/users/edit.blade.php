<!-- Main Container with subtle gradient background -->
@extends('layout.style')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body, .dash-wrap { font-family: 'Geist', sans-serif; background: #f8f8fb; color: #1a1a2e; }

    .dash-wrap { display: flex; min-height: 100vh; }

    /* ===== SIDEBAR ===== */
    .sidebar {
        width: 220px; min-height: 100vh; background: #7c3aed;
        border-right: none; display: flex; flex-direction: column;
        position: sticky; top: 0; height: 100vh; padding: 20px 0; flex-shrink: 0;
    }
    .sidebar-logo {
        display: flex; align-items: center; gap: 10px;
        padding: 0 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.15);
    }
    .sidebar-logo .logo-icon {
        width: 32px; height: 32px; background: rgba(255,255,255,0.2); border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
    }
    .sidebar-logo .logo-icon svg { width: 16px; height: 16px; stroke: #fff; }
    .sidebar-logo span { font-size: 15px; font-weight: 600; color: #fff; letter-spacing: -0.3px; }
    .sidebar-logo span em { font-style: normal; color: #c4b5fd; font-weight: 400; }

    .sidebar-section { padding: 16px 12px 4px; }
    .sidebar-section-label {
        font-size: 11px; font-weight: 500; color: #c4b5fd;
        letter-spacing: 0.6px; text-transform: uppercase; padding: 0 8px; margin-bottom: 6px;
    }
    .sidebar-link {
        display: flex; align-items: center; gap: 10px;
        padding: 8px 10px; border-radius: 8px; text-decoration: none;
        color: #ddd6fe; font-size: 13.5px; font-weight: 400; transition: all 0.15s;
        width: 100%; border: none; background: none; cursor: pointer; font-family: 'Geist', sans-serif;
    }
    .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; stroke: #ddd6fe; }
    .sidebar-link:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .sidebar-link:hover svg { stroke: #fff; }
    .sidebar-link.active { background: rgba(255,255,255,0.2); color: #fff; font-weight: 500; }
    .sidebar-link.active svg { stroke: #fff; }

    .sidebar-footer {
        margin-top: auto; padding: 16px 12px 0;
        border-top: 1px solid rgba(255,255,255,0.15);
    }
    .user-row {
        display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 8px;
    }
    .user-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 600; color: #fff; flex-shrink: 0;
    }
    .user-name { font-size: 13px; font-weight: 500; color: #fff; }
    .user-role { font-size: 11px; color: #c4b5fd; }

    /* ===== MAIN ===== */
    .main-area { flex: 1; display: flex; flex-direction: column; min-width: 0; }

    .top-bar {
        background: #fff; border-bottom: 1px solid #efefef;
        padding: 12px 28px; display: flex; justify-content: space-between;
        align-items: center; position: sticky; top: 0; z-index: 10;
    }
    .top-bar-left { display: flex; align-items: center; gap: 8px; }
    .top-bar-left span { font-size: 13px; color: #a0a0b0; }
    .top-bar-left strong { font-size: 13px; font-weight: 500; color: #1a1a2e; }
    .top-bar-right { display: flex; align-items: center; gap: 12px; }

    .search-bar {
        display: flex; align-items: center; gap: 8px;
        background: #f5f5fa; border: 1px solid #efefef; border-radius: 8px;
        padding: 6px 12px; min-width: 200px;
    }
    .search-bar svg { width: 14px; height: 14px; stroke: #a0a0b0; flex-shrink: 0; }
    .search-bar input {
        background: none; border: none; outline: none; font-size: 13px;
        color: #1a1a2e; font-family: 'Geist', sans-serif; width: 100%;
    }
    .search-bar input::placeholder { color: #b0b0c0; }

    .icon-btn {
        width: 34px; height: 34px; border-radius: 8px; background: #f5f5fa;
        border: 1px solid #efefef; display: flex; align-items: center;
        justify-content: center; cursor: pointer; transition: background 0.15s;
    }
    .icon-btn svg { width: 15px; height: 15px; stroke: #6b6b80; }
    .icon-btn:hover { background: #efefef; }

    .top-avatar {
        width: 34px; height: 34px; border-radius: 50%; background: #ede9fe;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 600; color: #7c3aed;
    }

    .content { padding: 28px; flex: 1; }

    /* ===== PAGE HEADER ===== */
    .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
    .page-title { font-size: 22px; font-weight: 600; color: #1a1a2e; letter-spacing: -0.4px; }
    .page-sub { font-size: 13px; color: #a0a0b0; margin-top: 3px; }
    .date-badge {
        font-size: 12px; color: #6b6b80; background: #fff; border: 1px solid #efefef;
        padding: 6px 14px; border-radius: 8px; font-weight: 500;
    }

    /* ===== STAT CARDS ===== */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
    .stat-card {
        background: #fff; border: 1px solid #efefef; border-radius: 14px;
        padding: 20px 22px; display: flex; flex-direction: column; gap: 10px;
    }
    .stat-card-top { display: flex; justify-content: space-between; align-items: center; }
    .stat-label { font-size: 12px; font-weight: 500; color: #a0a0b0; text-transform: uppercase; letter-spacing: 0.4px; }
    .stat-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
    .stat-icon svg { width: 16px; height: 16px; }
    .stat-icon.blue { background: #ede9fe; }
    .stat-icon.blue svg { stroke: #7c3aed; }
    .stat-icon.green { background: #f0fdf4; }
    .stat-icon.green svg { stroke: #16a34a; }
    .stat-icon.red { background: #fef2f2; }
    .stat-icon.red svg { stroke: #dc2626; }
    .stat-value { font-size: 28px; font-weight: 600; color: #1a1a2e; letter-spacing: -0.8px; line-height: 1; }

    /* ===== TOOLBAR ===== */
    .toolbar {
        background: #fff; border: 1px solid #efefef; border-radius: 14px;
        padding: 16px 20px; display: flex; align-items: center;
        justify-content: space-between; gap: 12px; margin-bottom: 20px;
    }
    .toolbar-left { display: flex; align-items: center; gap: 10px; flex: 1; }
    .tb-input-wrap { position: relative; flex: 1; max-width: 280px; }
    .tb-input-wrap svg {
        position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
        width: 14px; height: 14px; stroke: #b0b0c0;
    }
    .tb-input {
        width: 100%; padding: 8px 12px 8px 34px; background: #f8f8fb;
        border: 1px solid #efefef; border-radius: 8px; font-size: 13px;
        color: #1a1a2e; font-family: 'Geist', sans-serif; outline: none; transition: border 0.15s;
    }
    .tb-input:focus { border-color: #c4b5fd; background: #fff; }
    .tb-select {
        padding: 8px 14px; background: #f8f8fb; border: 1px solid #efefef;
        border-radius: 8px; font-size: 13px; color: #6b6b80;
        font-family: 'Geist', sans-serif; outline: none; cursor: pointer; transition: border 0.15s;
    }
    .tb-select:focus { border-color: #c4b5fd; background: #fff; }
    .btn-add {
        display: inline-flex; align-items: center; gap: 7px;
        background: #7c3aed; color: #fff; padding: 8px 18px;
        border-radius: 8px; font-size: 13px; font-weight: 500;
        text-decoration: none; transition: background 0.15s; white-space: nowrap;
        font-family: 'Geist', sans-serif;
    }
    .btn-add svg { width: 14px; height: 14px; stroke: #fff; }
    .btn-add:hover { background: #6d28d9; }

    /* ===== TABLE ===== */
    #product-data-container { transition: opacity 0.2s; }
    #product-data-container.loading { opacity: 0.4; pointer-events: none; }
</style>

<div class="dash-wrap">

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <span>eShop <em>Admin</em></span>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Favorites</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Overview
            </a>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-section-label">Manage</div>
            <a href="{{ route('admin.product.index') }}" id="productLink"
               class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Products
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">Manage</div>
            <a href="{{ route('admin.product.index') }}" id="productLink"
               class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
             Categories
            </a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-section-label">Manage</div>
            <a href="{{ route('admin.product.index') }}" id="productLink"
               class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        Users
        </a>
        </div>

        <div class="sidebar-footer">
            <div class="user-row">
                <div class="user-avatar">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                <div>
                    <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 6px;">
                @csrf
                <button type="submit" class="sidebar-link" style="color:#fca5a5;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke:#fca5a5;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>
<div class="min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-50 via-gray-50 to-white py-16 px-4">
    <div class="max-w-2xl mx-auto">

        <!-- Header: Clean & Balanced -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
            <div class="space-y-1">
                <span class="text-blue-600 font-bold tracking-widest uppercase text-xs">Admin Control</span>
                <h2 class="text-4xl font-black text-gray-900 tracking-tight">Edit Profile</h2>
                <p class="text-gray-500 font-medium">ធ្វើបច្ចុប្បន្នភាពព័ត៌មានគណនីអ្នកប្រើប្រាស់</p>
            </div>
            <a href="{{ route('admin.product.index') }}"
               class="inline-flex items-center group px-5 py-2.5 bg-white border border-gray-200 rounded-2xl shadow-sm text-sm font-bold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to List
            </a>
        </div>

        <!-- Main Card: Glassmorphism look -->
        <div class="max-auto bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-[0_20px_50px_rgba(8,_112,_184,_0.07)] border border-white overflow-hidden">

            <!-- Success Alert: Modern Slide-in look -->
            @if(session('success'))
                <div class="bg-emerald-500 p-4 flex items-center gap-3 text-white">
                    <div class="bg-white/20 p-1 rounded-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 sm:p-12">
                @csrf
                @method('PUT')

                <!-- User Profile Summary Area -->
                <div class="relative flex flex-col items-center sm:flex-row gap-6 mb-12 p-6 rounded-[2rem] bg-gray-50/50 border border-gray-100">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative h-24 w-24 rounded-[1.8rem] bg-white flex items-center justify-center text-blue-600 text-4xl font-black shadow-inner">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="text-center sm:text-left space-y-1">
                        <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ $user->name }}</h3>
                        <div class="flex items-center justify-center sm:justify-start gap-2">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter bg-blue-600 text-white">Verified User</span>
                            <span class="text-xs font-bold text-gray-400 italic">ID: #USR-{{ $user->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <!-- Input Group: Full Name -->
                    <div class="relative group">
                        <label class="absolute -top-3 left-5 bg-white px-2 text-xs font-black text-blue-600 z-10">Full Name</label>
                        <div class="relative">
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="block w-full px-6 py-5 rounded-2xl bg-white border-2 border-gray-100 text-gray-700 font-bold focus:border-blue-500 focus:ring-0 transition-all outline-none @error('name') border-red-400 @enderror"
                                   placeholder="Enter full name">
                            <div class="absolute inset-y-0 right-5 flex items-center text-gray-300 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        </div>
                        @error('name') <p class="absolute -bottom-6 left-2 text-[10px] text-red-500 font-black uppercase italic">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input Group: Email -->
                    <div class="relative group pt-2">
                        <label class="absolute top-[-4px] left-5 bg-white px-2 text-xs font-black text-blue-600 z-10">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="block w-full px-6 py-5 rounded-2xl bg-white border-2 border-gray-100 text-gray-700 font-bold focus:border-blue-500 focus:ring-0 transition-all outline-none @error('email') border-red-400 @enderror"
                                   placeholder="example@mail.com">
                            <div class="absolute inset-y-0 right-5 flex items-center text-gray-300 group-focus-within:text-blue-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                        </div>
                        @error('email') <p class="absolute -bottom-6 left-2 text-[10px] text-red-500 font-black uppercase italic">{{ $message }}</p> @enderror
                    </div>

                    <!-- Input Group: Role Selection -->
                    <div class="relative pt-2">
                        <label class="absolute top-[-4px] left-5 bg-white px-2 text-xs font-black text-blue-600 z-10">Assign Permissions</label>
                        <div class="relative">
                            <select name="role"
                                    class="block w-full px-6 py-5 rounded-2xl bg-white border-2 border-gray-100 text-gray-700 font-bold appearance-none focus:border-blue-500 focus:ring-0 transition-all outline-none cursor-pointer">
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Full System Access)</option>
                                <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Client (Customer Access Only)</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-5 flex items-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button: High Impact -->
                <div class="mt-14">
                    <button type="submit"
                            class="relative w-full group overflow-hidden py-5 rounded-[1.8rem] bg-gray-900 text-white text-lg font-black tracking-tighter transition-all hover:bg-blue-600 active:scale-[0.98]">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Update
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                    </button>
                    <p class="text-center text-[10px] text-gray-400 mt-4 font-bold uppercase tracking-widest">Changes are saved instantly upon submission</p>
                </div>
            </form>
        </div>
    </div>
</div>

