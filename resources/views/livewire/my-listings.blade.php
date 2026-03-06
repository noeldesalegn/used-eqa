<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">
            📦 የእኔ እቃዎች (My Listings)
        </h1>
        <a href="{{ route('listing.create') }}" wire:navigate
           class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg hover:shadow-xl transform hover:scale-105">
            ➕ አዲስ ይጨምሩ (Add New)
        </a>
    </div>

    @if(session('message'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl flex items-center gap-3" 
             x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition>
            <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    @if($listings->isEmpty())
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-50 mb-6">
                <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700">ገና ምንም አልለጠፉም</h3>
            <p class="text-gray-400 mt-2">You haven't listed anything yet.</p>
            <a href="{{ route('listing.create') }}" wire:navigate
               class="mt-6 inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition">
                ➕ የመጀመሪያ እቃዎን ይለጥፉ (Post Your First Item)
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach($listings as $listing)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="flex flex-col sm:flex-row">
                        {{-- Image --}}
                        <div class="sm:w-48 sm:h-40 h-48 bg-gray-100 shrink-0 overflow-hidden">
                            @if($listing->images && count($listing->images) > 0)
                                <img src="{{ asset('storage/' . $listing->images[0]) }}"
                                     alt="{{ $listing->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between gap-3">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $listing->title }}</h3>
                                    <div class="flex items-center gap-2 shrink-0">
                                        {{-- Approval Status --}}
                                        @if($listing->status === 'pending')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">⏳ በመጠባበቅ (Pending)</span>
                                        @elseif($listing->status === 'rejected')
                                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">❌ ውድቅ (Rejected)</span>
                                        @endif
                                        {{-- Sold Status --}}
                                        @if($listing->is_sold)
                                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">ተሽጧል (SOLD)</span>
                                        @elseif($listing->status === 'approved')
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">✅ ለሽያጭ (Active)</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-xl font-extrabold text-indigo-600 mt-1">{{ number_format($listing->price) }} ETB</p>
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                    <span>{{ $listing->condition }}</span>
                                    <span>•</span>
                                    <span>{{ $listing->neighborhood }}</span>
                                    <span>•</span>
                                    <span>{{ $listing->created_at->diffForHumans() }}</span>
                                </div>
                                @if($listing->status === 'rejected' && $listing->rejection_reason)
                                    <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600">
                                        <strong>ምክንያት (Reason):</strong> {{ $listing->rejection_reason }}
                                    </div>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-3 mt-4 pt-3 border-t border-gray-100">
                                <a href="{{ route('listing.show', $listing) }}" wire:navigate
                                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    View
                                </a>
                                <a href="{{ route('listing.edit', $listing) }}" wire:navigate
                                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <button wire:click="toggleSold({{ $listing->id }})"
                                        wire:confirm="Are you sure?"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-lg transition
                                        {{ $listing->is_sold ? 'text-emerald-600 bg-emerald-50 hover:bg-emerald-100' : 'text-amber-600 bg-amber-50 hover:bg-amber-100' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $listing->is_sold ? 'Unsold' : 'Mark Sold' }}
                                </button>
                                <button wire:click="deleteListing({{ $listing->id }})"
                                        wire:confirm="Are you sure you want to delete this listing?"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
