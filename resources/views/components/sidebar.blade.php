<aside class="w-64 bg-white shadow-md hidden md:block">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-indigo-600">G-Scores</h1>
    </div>
    <nav class="px-4 pb-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700' }}">
            Dashboard
        </a>
        <a href="{{ route('scores.lookup.form') }}" class="block px-4 py-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('scores.*') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700' }}">
            Tra cứu điểm
        </a>
        <a href="{{ route('statistics') }}" class="block px-4 py-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('statistics') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700' }}">
            Thống kê
        </a>
        <a href="{{ route('top10') }}" class="block px-4 py-2 rounded-lg hover:bg-indigo-50 {{ request()->routeIs('top10') ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700' }}">
            Top 10 khối A
        </a>
    </nav>
</aside>