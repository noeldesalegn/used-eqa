<div>
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white">📋 Manage Listings</h1>
                    <p class="mt-1 text-indigo-200">Approve, reject, or remove listings</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="text-indigo-200 hover:text-white transition text-sm">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Tabs --}}
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach(['pending' => '⏳ Pending', 'approved' => '✅ Approved', 'rejected' => '❌ Rejected', 'all' => '📦 All'] as $key => $label)
                <button wire:click="setTab('{{ $key }}')"
                        class="px-5 py-2.5 rounded-xl font-semibold text-sm transition-all
                            {{ $tab === $key ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200 dark:shadow-indigo-900' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Search & Filter --}}
        <div class="flex flex-col sm:flex-row gap-3 mb-6">
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search listings..."
                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all">
            </div>
            <select wire:model.live="filterCategory" class="px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition-all">
                <option value="">All Categories</option>
                <option value="Electronics">Electronics</option>
                <option value="Vehicles">Vehicles</option>
                <option value="Furniture">Furniture</option>
                <option value="Clothing">Clothing</option>
                <option value="Phones">Phones</option>
                <option value="Computers">Computers</option>
                <option value="Books">Books</option>
                <option value="Sports">Sports</option>
                <option value="Home Appliances">Home Appliances</option>
                <option value="Other">Other</option>
            </select>
        </div>

        {{-- Listings Table --}}
        @if($listings->count() > 0)
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                            <tr>
                                <th class="text-left px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Item</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600 dark:text-gray-300">Seller</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600 dark:text-gray-300">Category</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600 dark:text-gray-300">Price</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600 dark:text-gray-300">Status</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600 dark:text-gray-300">Date</th>
                                <th class="text-right px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($listings as $listing)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($listing->images && count($listing->images) > 0)
                                                <img src="{{ asset('storage/' . $listing->images[0]) }}" class="w-12 h-12 rounded-lg object-cover border dark:border-gray-600" alt="">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-300 dark:text-gray-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-semibold text-gray-800 dark:text-gray-200 truncate max-w-[200px]">{{ $listing->title }}</p>
                                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $listing->condition }} · {{ $listing->neighborhood }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-gray-600 dark:text-gray-400">{{ $listing->user->name }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300">
                                            {{ $listing->category }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 font-semibold text-gray-800 dark:text-gray-200">{{ number_format($listing->price) }} ETB</td>
                                    <td class="px-4 py-4">
                                        @if($listing->status === 'pending')
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300">⏳ Pending</span>
                                        @elseif($listing->status === 'approved')
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300">✅ Approved</span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300">❌ Rejected</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-gray-500 dark:text-gray-400 text-xs">{{ $listing->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($listing->status !== 'approved')
                                                <button wire:click="approve({{ $listing->id }})"
                                                        wire:confirm="Approve this listing?"
                                                        class="text-xs bg-emerald-500 text-white px-3 py-1.5 rounded-lg hover:bg-emerald-600 transition font-medium">
                                                    Approve
                                                </button>
                                            @endif
                                            @if($listing->status !== 'rejected')
                                                <button wire:click="openRejectModal({{ $listing->id }})"
                                                        class="text-xs bg-amber-500 text-white px-3 py-1.5 rounded-lg hover:bg-amber-600 transition font-medium">
                                                    Reject
                                                </button>
                                            @endif
                                            <button wire:click="deleteListing({{ $listing->id }})"
                                                    wire:confirm="Delete this listing permanently? This cannot be undone."
                                                    class="text-xs bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition font-medium">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @if($listing->status === 'rejected' && $listing->rejection_reason)
                                    <tr class="bg-red-50 dark:bg-red-900/20">
                                        <td colspan="7" class="px-6 py-2 text-sm text-red-600 dark:text-red-400">
                                            <strong>Rejection Reason:</strong> {{ $listing->rejection_reason }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $listings->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-16 text-center">
                <div class="text-5xl mb-3">📭</div>
                <h3 class="text-xl font-bold text-gray-700 dark:text-gray-300">No listings found</h3>
                <p class="text-gray-400 dark:text-gray-500 mt-1">No listings match your current filters</p>
            </div>
        @endif
    </div>

    {{-- Rejection Reason Modal --}}
    @if($showRejectModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md mx-4 p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">❌ Reject Listing</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Please provide a reason for rejecting this listing. The seller will see this reason.</p>
                <textarea wire:model="rejectionReason" rows="3" placeholder="Enter rejection reason..."
                          class="w-full rounded-xl border border-gray-300 dark:border-gray-600 p-3 bg-white dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 transition"></textarea>
                @error('rejectionReason') <span class="text-red-500 dark:text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror

                <div class="flex justify-end gap-3 mt-5">
                    <button wire:click="$set('showRejectModal', false)"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium text-sm">
                        Cancel
                    </button>
                    <button wire:click="reject"
                            class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition font-medium text-sm">
                        Reject Listing
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
