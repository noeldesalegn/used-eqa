<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;

class BrowseListings extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCondition = '';
    public $filterNeighborhood = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCondition()
    {
        $this->resetPage();
    }

    public function updatingFilterNeighborhood()
    {
        $this->resetPage();
    }

    public function render()
    {
        $listings = Listing::query()
            ->approved()
            ->where('is_sold', false)
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterCondition, fn($q) => $q->where('condition', $this->filterCondition))
            ->when($this->filterNeighborhood, fn($q) => $q->where('neighborhood', $this->filterNeighborhood))
            ->latest()
            ->paginate(12);

        return view('livewire.browse-listings', [
            'listings' => $listings,
        ]);
    }
}
