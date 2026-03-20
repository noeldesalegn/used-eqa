<div>
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white">👥 Manage Users</h1>
                    <p class="mt-1 text-indigo-200">View and manage user accounts</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="text-indigo-200 hover:text-white transition text-sm">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Search --}}
        <div class="relative mb-6">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or email..."
                   class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all max-w-md">
        </div>

        {{-- Users Table  --}}
        @if($users->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left px-6 py-4 font-semibold text-gray-600">User</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600">Email</th>
                                <th class="text-center px-4 py-4 font-semibold text-gray-600">Listings</th>
                                <th class="text-center px-4 py-4 font-semibold text-gray-600">Role</th>
                                <th class="text-left px-4 py-4 font-semibold text-gray-600">Joined</th>
                                <th class="text-right px-6 py-4 font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $user->listings_count }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($user->is_admin)
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-700">🛡️ Admin</span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">User</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-gray-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->id !== auth()->id())
                                            <div class="flex items-center justify-end gap-2">
                                                <button wire:click="toggleAdmin({{ $user->id }})"
                                                        wire:confirm="{{ $user->is_admin ? 'Remove admin privileges?' : 'Grant admin privileges?' }}"
                                                        class="text-xs px-3 py-1.5 rounded-lg font-medium transition
                                                            {{ $user->is_admin ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-indigo-500 text-white hover:bg-indigo-600' }}">
                                                    {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                                </button>
                                                <button wire:click="deleteUser({{ $user->id }})"
                                                        wire:confirm="Delete this user and all their listings? This cannot be undone."
                                                        class="text-xs bg-red-500 text-white px-3 py-1.5 rounded-lg hover:bg-red-600 transition font-medium">
                                                    Delete
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 italic">You</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                <div class="text-5xl mb-3">👤</div>
                <h3 class="text-xl font-bold text-gray-700">No users found</h3>
                <p class="text-gray-400 mt-1">No users match your search</p>
            </div>
        @endif
    </div>
</div>
