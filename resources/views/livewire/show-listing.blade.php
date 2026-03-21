<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Back Button --}}
        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium mb-6 group">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            ወደ ዝርዝር ተመለስ (Back to Listings)
        </a>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 overflow-hidden">
            {{-- Image Gallery --}}
            <div class="relative" x-data="{ activeImage: 0 }">
                @if($listing->images && count($listing->images) > 0)
                    <div class="aspect-[16/9] bg-gray-900 overflow-hidden">
                        @foreach($listing->images as $index => $image)
                            <img x-show="activeImage === {{ $index }}"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 src="{{ asset('storage/' . $image) }}"
                                 alt="{{ $listing->title }}"
                                 class="w-full h-full object-contain">
                        @endforeach

                        @if(count($listing->images) > 1)
                            {{-- Prev/Next --}}
                            <button @click="activeImage = (activeImage - 1 + {{ count($listing->images) }}) % {{ count($listing->images) }}"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full backdrop-blur-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button @click="activeImage = (activeImage + 1) % {{ count($listing->images) }}"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full backdrop-blur-sm transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>

                            {{-- Thumbnails --}}
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                                @foreach($listing->images as $index => $image)
                                    <button @click="activeImage = {{ $index }}"
                                            :class="activeImage === {{ $index }} ? 'ring-2 ring-white scale-110' : 'opacity-60 hover:opacity-100'"
                                            class="w-14 h-14 rounded-lg overflow-hidden border-2 border-white/50 transition-all">
                                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="aspect-[16/9] bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-300 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                {{-- Sold Overlay --}}
                @if($listing->is_sold)
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                        <span class="bg-red-600 text-white text-3xl font-extrabold px-10 py-4 rounded-2xl rotate-[-12deg] shadow-2xl tracking-wider">
                            ተሽጧል — SOLD
                        </span>
                    </div>
                @endif
            </div>

            {{-- Details --}}
            <div class="p-6 sm:p-8 lg:p-10">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">{{ $listing->title }}</h1>
                        <div class="flex items-center gap-3 mt-3">
                            <span class="px-4 py-1.5 rounded-full text-sm font-bold
                                {{ $listing->condition === 'New' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300' : ($listing->condition === 'Used' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300' : 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300') }}">
                                {{ $listing->condition === 'New' ? 'አዲስ (New)' : ($listing->condition === 'Used' ? 'ያገለገለ (Used)' : 'ቦንዳ (Bonda)') }}
                            </span>
                            <span class="text-gray-400 dark:text-gray-500">•</span>
                            <span class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $listing->neighborhood }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">{{ number_format($listing->price) }} <span class="text-base font-medium text-gray-400 dark:text-gray-500">ETB</span></p>
                    </div>
                </div>

                {{-- Description --}}
                @if($listing->description)
                    <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-6">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-3">ዝርዝር መግለጫ (Description)</h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-line">{{ $listing->description }}</p>
                    </div>
                @endif

                {{-- Seller Info & Contact --}}
                <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-6">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">ሻጭ መረጃ (Seller Info)</h2>
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/30 dark:to-purple-900/30 rounded-2xl p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ strtoupper(substr($listing->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 dark:text-gray-200 text-lg">{{ $listing->user->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Posted {{ $listing->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @if($listing->phone_number)
                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="tel:{{ $listing->phone_number }}"
                                   class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    ደውሉ (Call)
                                </a>
                                <a href="sms:{{ $listing->phone_number }}"
                                   class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-white dark:bg-gray-800 text-indigo-600 dark:text-indigo-400 border-2 border-indigo-600 dark:border-indigo-500 rounded-xl font-bold hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    መልዕክት (SMS)
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Posted date --}}
                <div class="mt-6 text-center text-sm text-gray-400 dark:text-gray-500">
                    Listed on {{ $listing->created_at->format('M d, Y \a\t h:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
