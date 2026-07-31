<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                    class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Overview
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Manage</div>
                <a href="<?php echo e(route('admin.product.index')); ?>"
                    class="sidebar-link <?php echo e(request()->routeIs('admin.product.*') ? 'active' : ''); ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Products
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">Inventory</div>
                <a href="<?php echo e(route('admin.categories.index')); ?>"
                    class="sidebar-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    Categories
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-label">People</div>
                <a href="<?php echo e(route('admin.users.index')); ?>"
                    class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-row">
                    <div class="user-avatar"><?php echo e(substr(Auth::user()->name ?? 'A', 0, 1)); ?></div>
                    <div>
                        <div class="user-name"><?php echo e(Auth::user()->name ?? 'Admin'); ?></div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST" style="margin-top: 6px;">
                    <?php echo csrf_field(); ?>
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

        
        <div class="main-area">
            <header class="top-bar">
                <div class="top-bar-left">
                    <svg style="width:16px;height:16px;stroke:#b0b0c0;" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span>Dashboards</span>
                    <span style="color:#d0d0e0;">/</span>
                    <strong>Overview</strong>
                </div>
                <div class="top-bar-right">
                    <div class="search-bar">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" placeholder="Search...">
                    </div>
                    <div class="icon-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div class="top-avatar"><?php echo e(substr(Auth::user()->name ?? 'A', 0, 1)); ?></div>
                </div>
            </header>

            <div class="content">
                <div class="page-header">
                    <div>
                        <div class="page-title">Dashboard Overview</div>
                        <div class="page-sub">Manage your inventory and store performance.</div>
                    </div>
                    <div class="date-badge"><?php echo e(now()->format('D, d M Y')); ?></div>
                </div>

                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-top">
                            <div class="stat-label">Total Products</div>
                            <div class="stat-icon blue">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value"><?php echo e(number_format($totalProducts)); ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-top">
                            <div class="stat-label">Customers</div>
                            <div class="stat-icon green">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value"><?php echo e(number_format($totalUsers)); ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-top">
                            <div class="stat-label">Out of Stock</div>
                            <div class="stat-icon red">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value"><?php echo e($outOfStock); ?></div>
                    </div>
                </div>

                
                <div class="toolbar">
                    <div class="toolbar-left">
                        <div class="tb-input-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" id="searchProduct" class="tb-input"
                                placeholder="Search product...">
                        </div>
                        <select id="filterCategory" class="tb-select">
                            <option value="">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <a href="<?php echo e(route('admin.product.create')); ?>" class="btn-add">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Add Product
                    </a>
                </div>

                
                <div id="product-data-container">
                    <?php echo $__env->make('products.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchProducts(page, search, category) {
                $('#product-data-container').addClass('loading');
                $.ajax({
                    url: "<?php echo e(route('admin.dashboard')); ?>",
                    data: {
                        page: page,
                        search: search,
                        category: category
                    },
                    success: function(data) {
                        $('#product-data-container').html(data).removeClass('loading');
                    },
                    error: function() {
                        alert('Failed to load data matrix.');
                        $('#product-data-container').removeClass('loading');
                    }
                });
            }

            let timer;
            $(document).on('keyup', '#searchProduct', function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetchProducts(1, $(this).val(), $('#filterCategory').val());
                }, 300);
            });

            $(document).on('change', '#filterCategory', function() {
                fetchProducts(1, $('#searchProduct').val(), $(this).val());
            });

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchProducts(page, $('#searchProduct').val(), $('#filterCategory').val());
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH D:\wamp64\www\migrate\crude\resources\views/admin/product/index.blade.php ENDPATH**/ ?>