<div wire:poll.10s>
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-white flex items-center gap-3">
                🛡️ Admin Dashboard
            </h1>
            <p class="mt-1 text-indigo-200">Manage listings, users, and platform activity</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 text-center hover:shadow-md transition">
                <div class="text-3xl font-extrabold text-indigo-600">{{ $totalUsers }}</div>
                <div class="text-sm text-gray-500 mt-1">👥 Users</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 text-center hover:shadow-md transition">
                <div class="text-3xl font-extrabold text-blue-600">{{ $totalListings }}</div>
                <div class="text-sm text-gray-500 mt-1">📦 All Listings</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-amber-200 p-5 text-center hover:shadow-md transition bg-amber-50">
                <div class="text-3xl font-extrabold text-amber-600">{{ $pendingListings }}</div>
                <div class="text-sm text-gray-500 mt-1">⏳ Pending</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-200 p-5 text-center hover:shadow-md transition bg-emerald-50">
                <div class="text-3xl font-extrabold text-emerald-600">{{ $approvedListings }}</div>
                <div class="text-sm text-gray-500 mt-1">✅ Approved</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-red-200 p-5 text-center hover:shadow-md transition bg-red-50">
                <div class="text-3xl font-extrabold text-red-600">{{ $rejectedListings }}</div>
                <div class="text-sm text-gray-500 mt-1">❌ Rejected</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-purple-200 p-5 text-center hover:shadow-md transition bg-purple-50">
                <div class="text-3xl font-extrabold text-purple-600">{{ $soldListings }}</div>
                <div class="text-sm text-gray-500 mt-1">💰 Sold</div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <a href="{{ route('admin.listings') }}" wire:navigate
               class="flex items-center gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-indigo-300 transition-all group">
                <div class="bg-indigo-100 p-3 rounded-xl group-hover:bg-indigo-200 transition">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Manage Listings</h3>
                    <p class="text-sm text-gray-500">Approve, reject, or delete listings</p>
                </div>
                @if($pendingListings > 0)
                    <span class="ml-auto bg-amber-500 text-white text-sm font-bold px-3 py-1 rounded-full animate-pulse">{{ $pendingListings }} pending</span>
                @endif
            </a>

            <a href="{{ route('admin.users') }}" wire:navigate
               class="flex items-center gap-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-indigo-300 transition-all group">
                <div class="bg-emerald-100 p-3 rounded-xl group-hover:bg-emerald-200 transition">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Manage Users</h3>
                    <p class="text-sm text-gray-500">View and manage user accounts</p>
                </div>
            </a>
        </div>

        {{-- Recent Pending Listings --}}
        @if($recentPending->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-amber-50 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        ⏳ Recent Pending Listings
                    </h2>
                    <a href="{{ route('admin.listings') }}" wire:navigate class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                        View All →
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($recentPending as $listing)
                        <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50 transition">
                            @if($listing->images && count($listing->images) > 0)
                                <img src="{{ asset('storage/' . $listing->images[0]) }}" class="w-14 h-14 rounded-xl object-cover border shadow-sm" alt="">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center text-gray-300">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-800 truncate">{{ $listing->title }}</h3>
                                <p class="text-sm text-gray-500">by {{ $listing->user->name }} · {{ number_format($listing->price) }} ETB · {{ $listing->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="$dispatch('approve-from-dashboard', { id: {{ $listing->id }} })"
                                        class="text-xs bg-emerald-500 text-white px-3 py-1.5 rounded-lg hover:bg-emerald-600 transition font-medium">
                                    ✅ Approve
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="text-5xl mb-3">🎉</div>
                <h3 class="text-xl font-bold text-gray-700">All caught up!</h3>
                <p class="text-gray-400 mt-1">No pending listings to review</p>
            </div>
        @endif
    </div>
</div>
