<div wire:poll.5s>
    {{-- Hero Section --}}
    <div class="relative bg-gradient-to-br from-indigo-700 via-indigo-600 to-purple-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs><rect width="100%" height="100%" fill="url(#grid)"/></svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight">
                🛒 Used-EQA
            </h1>
            <p class="mt-4 text-lg sm:text-xl text-indigo-100 max-w-2xl mx-auto">
                ድሬ ዳዋ ውስጥ ያገለገሉ ዕቃዎችን ይግዙ ወይም ይሽጡ — Buy & Sell Used Items in Dire Dawa
            </p>
            @auth
                <a href="{{ route('listing.create') }}" class="mt-8 inline-flex items-center px-8 py-3 rounded-full bg-white text-indigo-700 font-bold text-lg shadow-lg hover:shadow-xl hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105">
                    ➕ እቃ ይሽጡ (Sell Now)
                </a>
            @else
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-3 rounded-full bg-white text-indigo-700 font-bold text-lg shadow-lg hover:shadow-xl hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105">
                        ይግቡ (Login)
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 rounded-full border-2 border-white text-white font-bold text-lg hover:bg-white/10 transition-all duration-300">
                        ይመዝገቡ (Register)
                    </a>
                </div>
            @endauth
        </div>
    </div>

    {{-- Search & Filters --}}
    <div class="sticky top-0 z-30 bg-white/80 backdrop-blur-lg border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search"
                           placeholder="ፈልግ... (Search items)"
                           class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                </div>
                <select wire:model.live="filterCondition" class="px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                    <option value="">ሁሉም ሁኔታ (All Conditions)</option>
                    <option value="New">አዲስ (New)</option>
                    <option value="Used">ያገለገለ (Used)</option>
                    <option value="Bonda">ቦንዳ (Bonda)</option>
                </select>
                <select wire:model.live="filterNeighborhood" class="px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                    <option value="">ሁሉም ሰፈር (All Areas)</option>
                    <option value="Kezira">Kezira (ገዚራ)</option>
                    <option value="Megala">Megala (መገላ)</option>
                    <option value="Taiwan">Taiwan (ታይዋን)</option>
                    <option value="Sabiyan">Sabiyan (ሳቢያን)</option>
                    <option value="Gende Depo">Gende Depo (ገንደ ዴፖ)</option>
                    <option value="01">01 Area</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Listings Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($listings->isEmpty())
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-50 mb-6">
                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-700">ምንም እቃ አልተገኘም</h3>
                <p class="text-gray-400 mt-2">No items found. Be the first to list something!</p>
                @auth
                    <a href="{{ route('listing.create') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">
                        ➕ እቃ ይጨምሩ (Add Item)
                    </a>
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($listings as $listing)
                    <a href="{{ route('listing.show', $listing) }}" wire:navigate
                       class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                        {{-- Image --}}
                        <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
                            @if($listing->images && count($listing->images) > 0)
                                <img src="{{ asset('storage/' . $listing->images[0]) }}"
                                     alt="{{ $listing->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Condition Badge --}}
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold
                                {{ $listing->condition === 'New' ? 'bg-emerald-500 text-white' : ($listing->condition === 'Used' ? 'bg-amber-500 text-white' : 'bg-red-500 text-white') }}">
                                {{ $listing->condition }}
                            </span>
                        </div>
                        {{-- Info --}}
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 text-lg truncate group-hover:text-indigo-600 transition-colors">
                                {{ $listing->title }}
                            </h3>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xl font-extrabold text-indigo-600">
                                    {{ number_format($listing->price) }} <span class="text-sm font-normal text-gray-400">ETB</span>
                                </span>
                            </div>
                            <div class="flex items-center gap-2 mt-3 text-sm text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $listing->neighborhood }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $listings->links() }}
            </div>
        @endif
    </div>
</div>
