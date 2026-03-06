<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class EditListing extends Component
{
    use WithFileUploads;

    public Listing $listing;

    public $title, $description, $price, $condition, $neighborhood, $phone_number;
    public $photos = [];
    public $existingImages = [];

    public function mount(Listing $listing)
    {
        if ($listing->user_id !== auth()->id()) {
            abort(403);
        }

        $this->listing = $listing;
        $this->title = $listing->title;
        $this->description = $listing->description;
        $this->price = $listing->price;
        $this->condition = $listing->condition;
        $this->neighborhood = $listing->neighborhood;
        $this->phone_number = $listing->phone_number;
        $this->existingImages = $listing->images ?? [];
    }

    public function removeExistingImage($index)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($this->existingImages[$index]);
        unset($this->existingImages[$index]);
        $this->existingImages = array_values($this->existingImages);
    }

    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:2048',
            'title' => 'required|min:5',
            'price' => 'required|numeric',
        ]);

        $imagePaths = $this->existingImages;

        foreach ($this->photos as $photo) {
            $imagePaths[] = $photo->store('listing-photos', 'public');
        }

        $this->listing->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'condition' => $this->condition,
            'neighborhood' => $this->neighborhood,
            'phone_number' => $this->phone_number,
            'images' => $imagePaths,
        ]);

        return redirect()->route('listing.mine')->with('message', 'እቃው ተስተካክሏል! (Item Updated!)');
    }

    public function render()
    {
        return view('livewire.edit-listing');
    }
}
