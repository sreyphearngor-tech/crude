<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Modern UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <div class="flex flex-col md:flex-row">
        <aside class="w-full md:w-64 bg-slate-900 md:min-h-screen text-white">
            <div class="p-6 text-2xl font-bold border-b border-slate-800">
                <span class="text-blue-400">Core</span>Admin
            </div>
            <nav class="mt-6">
                <a href="#" class="flex items-center py-3 px-6 bg-slate-800 border-l-4 border-blue-400">
                    <i class="fas fa-chart-line mr-3 text-blue-400"></i> Dashboard
                </a>
                <a href="#"
                    class="flex items-center py-3 px-6 hover:bg-slate-800 hover:text-blue-400 transition-colors">
                    <i class="fas fa-users mr-3"></i> Users
                </a>
                <a href="#"
                    class="flex items-center py-3 px-6 hover:bg-slate-800 hover:text-blue-400 transition-colors">
                    <i class="fas fa-cog mr-3"></i> Settings
                </a>

                <form action="{{ route('logout') }}" method="POST" class="mt-10 px-6">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full py-2 px-4 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-300">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Welcome Back, Admin</h1>
                    <p class="text-slate-500">Here's what's happening today.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div
                        class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                        JD
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-medium uppercase">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">$24,500</h3>
                    <span class="text-green-500 text-xs font-bold">+12% from last month</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-medium uppercase">Active Users</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">1,240</h3>
                    <span class="text-blue-500 text-xs font-bold">Steady growth</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-medium uppercase">Pending Tasks</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">18</h3>
                    <span class="text-orange-500 text-xs font-bold">Requires attention</span>
                </div>
            </div>

            <div
                class="bg-white rounded-xl shadow-sm border border-slate-100 h-64 flex items-center justify-center text-slate-400 italic">
                Main dashboard data table or charts go here...
            </div>
        </main>
    </div>

</body>

</html>
