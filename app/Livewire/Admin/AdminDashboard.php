<?php

namespace App\Livewire\Admin;

use App\Models\Listing;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalUsers' => User::count(),
            'totalListings' => Listing::count(),
            'pendingListings' => Listing::pending()->count(),
            'approvedListings' => Listing::approved()->count(),
            'rejectedListings' => Listing::rejected()->count(),
            'soldListings' => Listing::where('is_sold', true)->count(),
            'recentPending' => Listing::pending()->with('user')->latest()->take(5)->get(),
        ]);
    }
}
