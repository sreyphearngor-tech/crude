<x-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body,
        .dash-wrap {
            font-family: 'Geist', sans-serif;
            background: #f8f8fb;
            color: #1a1a2e;
        }

        .dash-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #7c3aed;
            border-right: none;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 20px 0;
            flex-shrink: 0;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar-logo .logo-icon {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo .logo-icon svg {
            width: 16px;
            height: 16px;
            stroke: #fff;
        }

        .sidebar-logo span {
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.3px;
        }

        .sidebar-logo span em {
            font-style: normal;
            color: #c4b5fd;
            font-weight: 400;
        }

        .sidebar-section {
            padding: 16px 12px 4px;
        }

        .sidebar-section-label {
            font-size: 11px;
            font-weight: 500;
            color: #c4b5fd;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            text-decoration: none;
            color: #ddd6fe;
            font-size: 13.5px;
            font-weight: 400;
            transition: all 0.15s;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
            font-family: 'Geist', sans-serif;
        }

        .sidebar-link svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            stroke: #ddd6fe;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .sidebar-link:hover svg {
            stroke: #fff;
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            font-weight: 500;
        }

        .sidebar-link.active svg {
            stroke: #fff;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .user-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
        }

        .user-role {
            font-size: 11px;
            color: #c4b5fd;
        }

        /* ===== MAIN ===== */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .top-bar {
            background: #fff;
            border-bottom: 1px solid #efefef;
            padding: 12px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .top-bar-left span {
            font-size: 13px;
            color: #a0a0b0;
        }

        .top-bar-left strong {
            font-size: 13px;
            font-weight: 500;
            color: #1a1a2e;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f5f5fa;
            border: 1px solid #efefef;
            border-radius: 8px;
            padding: 6px 12px;
            min-width: 200px;
        }

        .search-bar svg {
            width: 14px;
            height: 14px;
            stroke: #a0a0b0;
            flex-shrink: 0;
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            font-size: 13px;
            color: #1a1a2e;
            font-family: 'Geist', sans-serif;
            width: 100%;
        }

        .search-bar input::placeholder {
            color: #b0b0c0;
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: #f5f5fa;
            border: 1px solid #efefef;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s;
        }

        .icon-btn svg {
            width: 15px;
            height: 15px;
            stroke: #6b6b80;
        }

        .icon-btn:hover {
            background: #efefef;
        }

        .top-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #ede9fe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #7c3aed;
        }

        .content {
            padding: 28px;
            flex: 1;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.4px;
        }

        .page-sub {
            font-size: 13px;
            color: #a0a0b0;
            margin-top: 3px;
        }

        .date-badge {
            font-size: 12px;
            color: #6b6b80;
            background: #fff;
            border: 1px solid #efefef;
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 500;
        }

        /* ===== STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid #efefef;
            border-radius: 14px;
            padding: 20px 22px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .stat-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            color: #a0a0b0;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 16px;
            height: 16px;
        }

        .stat-icon.blue {
            background: #ede9fe;
        }

        .stat-icon.blue svg {
            stroke: #7c3aed;
        }

        .stat-icon.green {
            background: #f0fdf4;
        }

        .stat-icon.green svg {
            stroke: #16a34a;
        }

        .stat-icon.red {
            background: #fef2f2;
        }

        .stat-icon.red svg {
            stroke: #dc2626;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 600;
            color: #1a1a2e;
            letter-spacing: -0.8px;
            line-height: 1;
        }

        /* ===== TOOLBAR ===== */
        .toolbar {
            background: #fff;
            border: 1px solid #efefef;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .tb-input-wrap {
            position: relative;
            flex: 1;
            max-width: 280px;
        }

        .tb-input-wrap svg {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            stroke: #b0b0c0;
        }

        .tb-input {
            width: 100%;
            padding: 8px 12px 8px 34px;
            background: #f8f8fb;
            border: 1px solid #efefef;
            border-radius: 8px;
            font-size: 13px;
            color: #1a1a2e;
            font-family: 'Geist', sans-serif;
            outline: none;
            transition: border 0.15s;
        }

        .tb-input:focus {
            border-color: #c4b5fd;
            background: #fff;
        }

        .tb-select {
            padding: 8px 14px;
            background: #f8f8fb;
            border: 1px solid #efefef;
            border-radius: 8px;
            font-size: 13px;
            color: #6b6b80;
            font-family: 'Geist', sans-serif;
            outline: none;
            cursor: pointer;
            transition: border 0.15s;
        }

        .tb-select:focus {
            border-color: #c4b5fd;
            background: #fff;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #7c3aed;
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s;
            white-space: nowrap;
            font-family: 'Geist', sans-serif;
        }

        .btn-add svg {
            width: 14px;
            height: 14px;
            stroke: #fff;
        }

        .btn-add:hover {
            background: #6d28d9;
        }

        /* ===== TABLE ===== */
        #product-data-container {
            transition: opacity 0.2s;
        }

        #product-data-container.loading {
            opacity: 0.4;
            pointer-events: none;
        }
    </style>

    <div class="dash-wrap">

        {{-- SIDEBAR --}}
        <aside class="sidebar" id="mainSidebar">
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span>eShop <em>Admin</em></span>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Favorites</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Overview
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Manage</div>
                <a href="{{ route('admin.product.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Products
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Inventory</div>
                <a href="{{ route('admin.categories.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Categories
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">People</div>
                <a href="{{ route('admin.users.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
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
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="stroke:#fca5a5;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-area">
            <div class="content">
                <header class="flex justify-between items-center mb-8"
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight"
                            style="font-size: 30px; font-weight: 800; color: #111827;">Add New Product</h2>
                        <p class="text-gray-500" style="color: #6b7280; margin-top: 4px;">Fill in the details to add a
                            new product to your store.</p>
                    </div>
                    <div class="text-sm font-bold text-gray-400 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100"
                        style="font-size: 14px; font-weight: 700; background: #fff; padding: 8px 16px; border-radius: 12px; border: 1px solid #f3f4f6;">
                        {{ now()->format('d M, Y') }}
                    </div>
                </header>

                <div class="max-w-5xl mx-auto pb-20" style="max-w: 1024px; margin: 0 auto; padding-bottom: 80px;">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl"
                            style="margin-bottom: 24px; padding: 16px; background: #fef2f2; border-left: 4px solid #ef4444; color: #b91c1c; border-radius: 0 12px 12px 0;">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data"
                        style="display: flex; flex-direction: column; gap: 32px;">
                        @csrf

                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">

                            <div style="display: flex; flex-direction: column; gap: 24px;">
                                <div
                                    style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid #f3f4f6;">
                                    <h3
                                        style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                        <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        General Information
                                    </h3>
                                    <div style="display: flex; flex-direction: column; gap: 16px;">
                                        <div>
                                            <label
                                                style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 4px;">Product
                                                Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                placeholder="Enter product name..." required
                                                style="width: 100%; padding: 10px 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; outline: none;">
                                        </div>
                                        <div>
                                            <label
                                                style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 4px;">Description</label>
                                            <span
                                                style="display: block; font-size: 12px; color: #9ca3af; margin-bottom: 4px;">Describe
                                                the key features and details of the product.</span>
                                            <textarea name="description" rows="6" placeholder="Write something about this product..."
                                                style="width: 100%; padding: 10px 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; outline: none; font-family: inherit;">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid #f3f4f6;">
                                    <h3
                                        style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                        <svg style="width: 20px; height: 20px; color: #3b82f6;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Product Images
                                    </h3>
                                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div>
                                                <label
                                                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 128px; width: 100%; border: 2px dashed #e5e7eb; border-radius: 16px; cursor: pointer; background: #fff;">
                                                    <div style="text-align: center; padding: 12px;">
                                                        <svg style="width: 24px; height: 24px; color: #9ca3af; margin-bottom: 8px; margin-0-auto: true;"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                        <p
                                                            style="font-size: 10px; color: #6b7280; text-transform: uppercase; font-weight: 700;">
                                                            Image {{ $i }} {{ $i == 1 ? '(Main)' : '' }}
                                                        </p>
                                                    </div>
                                                    <input type="file" name="image{{ $i == 1 ? '' : $i }}"
                                                        style="display: none;" accept="image/*" />
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; flex-direction: column; gap: 24px;">
                                <div
                                    style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid #f3f4f6;">
                                    <h3
                                        style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px;">
                                        Organization</h3>
                                    <div>
                                        <div
                                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                            <label
                                                style="font-size: 14px; font-weight: 600; color: #374151;">Category</label>
                                            <button type="button" onclick="openCategoryModal()"
                                                style="color: #2563eb; font-size: 12px; font-weight: 700; background: none; border: none; cursor: pointer; text-decoration: underline;">+
                                                Add New</button>
                                        </div>
                                        <select name="category_id" id="category_id" required
                                            style="width: 100%; padding: 10px 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; outline: none;">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div
                                    style="background: #fff; padding: 24px; border-radius: 16px; border: 1px solid #f3f4f6;">
                                    <h3
                                        style="font-size: 12px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px;">
                                        Pricing & Stock</h3>
                                    <div style="display: flex; flex-direction: column; gap: 16px;">
                                        <div>
                                            <label
                                                style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 4px;">Price
                                                ($)</label>
                                            <input type="number" step="0.01" name="price"
                                                value="{{ old('price') }}" placeholder="0.00" required
                                                style="width: 100%; padding: 10px 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; outline: none;">
                                        </div>
                                        <div>
                                            <label
                                                style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 4px;">Quantity
                                                in Stock</label>
                                            <input type="number" name="qty" value="{{ old('qty') }}"
                                                placeholder="0" required
                                                style="width: 100%; padding: 10px 16px; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; outline: none;">
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    <button type="submit"
                                        style="width: 100%; background: #2563eb; color: #fff; font-weight: 700; padding: 12px; border-radius: 12px; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(37,99,235,0.2);">
                                        Save Product
                                    </button>
                                    <a href="{{ route('admin.product.index') }}"
                                        style="width: 100%; background: #fff; color: #6b7280; font-weight: 700; padding: 12px; border-radius: 12px; border: 1px solid #e5e7eb; text-align: center; text-decoration: none;">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="categoryModal"
                    class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4"
                    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; z-index: 50;">
                    <div
                        style="background: #fff; padding: 24px; border-radius: 16px; width: 100%; max-w: 360px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; border-bottom: 1px solid #f3f4f6; padding-bottom: 12px;">
                            <h3 style="font-size: 18px; font-weight: 700; color: #1f2937;">Add New Category</h3>
                            <button type="button" onclick="closeCategoryModal()"
                                style="background: none; border: none; font-size: 24px; color: #9ca3af; cursor: pointer;">&times;</button>
                        </div>

                        <form id="ajaxCategoryForm">
                            @csrf
                            <div style="margin-bottom: 16px;">
                                <label
                                    style="display: block; font-size: 14px; font-weight: 500; color: #374151; margin-bottom: 4px;">Category
                                    Name</label>
                                <input type="text" id="newCategoryName" name="name"
                                    placeholder="e.g. Smartphones" required
                                    style="width: 100%; border: 1px solid #e5e7eb; padding: 10px; border-radius: 12px; outline: none; background: #f9fafb;">
                                <p id="categoryError"
                                    style="color: #ef4444; font-size: 12px; margin-top: 4px; display: none;"></p>
                            </div>

                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                <button type="button" onclick="closeCategoryModal()"
                                    style="background: #f3f4f6; color: #374151; padding: 8px 16px; border-radius: 12px; border: none; font-weight: 600; cursor: pointer;">Cancel</button>
                                <button type="submit" id="saveCategoryBtn"
                                    style="background: #2563eb; color: #fff; padding: 8px 16px; border-radius: 12px; border: none; font-weight: 600; cursor: pointer;">Save
                                    Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openCategoryModal() {
            const modal = document.getElementById('categoryModal');
            modal.style.display = 'flex';
            document.getElementById('newCategoryName').focus();
        }

        function closeCategoryModal() {
            const modal = document.getElementById('categoryModal');
            modal.style.display = 'none';
            document.getElementById('ajaxCategoryForm').reset();
            document.getElementById('categoryError').style.display = 'none';
        }

        document.getElementById('ajaxCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nameInput = document.getElementById('newCategoryName');
            const errorMsg = document.getElementById('categoryError');
            const saveBtn = document.getElementById('saveCategoryBtn');
            const categorySelect = document.getElementById('category_id');

            saveBtn.disabled = true;
            saveBtn.innerText = 'Saving...';
            errorMsg.style.display = 'none';

            // FIXED: Using plural 'admin.categories.store' route name matching your web.php config
            fetch("{{ route('admin.categories.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: nameInput.value
                    })
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw data;
                    return data;
                })
                .then(data => {
                    // Check if backend returned data nested under 'category' or direct root parameters
                    const categoryData = data.category ? data.category : data;

                    const option = new Option(categoryData.name, categoryData.id, true, true);
                    categorySelect.add(option);
                    closeCategoryModal();
                })
                .catch(err => {
                    errorMsg.innerText = err.errors?.name?.[0] ||
                    'Something went wrong or name already exists!';
                    errorMsg.style.display = 'block';
                })
                .finally(() => {
                    saveBtn.disabled = false;
                    saveBtn.innerText = 'Save Category';
                });
        });
    </script>
</x-layout>
