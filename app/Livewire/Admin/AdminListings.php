<?php

namespace App\Livewire\Admin;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdminListings extends Component
{
    use WithPagination;

    public $tab = 'pending';
    public $search = '';
    public $filterCategory = '';
    public $showRejectModal = false;
    public $rejectingListingId = null;
    public $rejectionReason = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTab()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
        $this->resetPage();
    }

    public function approve($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);
    }

    public function openRejectModal($id)
    {
        $this->rejectingListingId = $id;
        $this->rejectionReason = '';
        $this->showRejectModal = true;
    }

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|min:5',
        ]);

        $listing = Listing::findOrFail($this->rejectingListingId);
        $listing->update([
            'status' => 'rejected',
            'rejection_reason' => $this->rejectionReason,
        ]);

        $this->showRejectModal = false;
        $this->rejectingListingId = null;
        $this->rejectionReason = '';
    }

    public function deleteListing($id)
    {
        $listing = Listing::findOrFail($id);

        if ($listing->images) {
            foreach ($listing->images as $image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($image);
            }
        }

        $listing->delete();
    }

    public function render()
    {
        $query = Listing::with('user')
            ->when($this->tab !== 'all', fn($q) => $q->where('status', $this->tab))
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterCategory, fn($q) => $q->where('category', $this->filterCategory))
            ->latest();

        return view('livewire.admin.listings', [
            'listings' => $query->paginate(15),
        ]);
    }
}
