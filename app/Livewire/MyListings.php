<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class MyListings extends Component
{
    public function toggleSold(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403);
        }

        $listing->update(['is_sold' => !$listing->is_sold]);
    }

    public function deleteListing(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete images from storage
        if ($listing->images) {
            foreach ($listing->images as $image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($image);
            }
        }

        $listing->delete();
    }

    public function render()
    {
        $listings = auth()->user()->listings()->latest()->get();

        return view('livewire.my-listings', [
            'listings' => $listings,
        ]);
    }
}
