<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ShowListing extends Component
{
    public Listing $listing;

    public function mount(Listing $listing)
    {
        $this->listing = $listing->load('user');
    }

    public function render()
    {
        return view('livewire.show-listing');
    }
}
