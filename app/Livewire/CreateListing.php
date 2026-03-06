<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Listing;

#[Layout('layouts.app')]
class CreateListing extends Component
{
    use WithFileUploads;

    public $title, $description, $price, $category, $condition, $neighborhood, $phone_number;
    public $photos = [];

    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:2048', // 2MB Max per photo
            'title' => 'required|min:5',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $imagePaths = [];
        foreach ($this->photos as $photo) {
            $imagePaths[] = $photo->store('listing-photos', 'public');
        }

        Listing::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,
            'condition' => $this->condition,
            'neighborhood' => $this->neighborhood,
            'phone_number' => $this->phone_number,
            'images' => $imagePaths,
            'status' => 'pending',
        ]);

        return redirect()->route('listing.mine')->with('message', 'እቃው ተልኳል! admin ያረጋግጡልዎታል (Item submitted! Admin will review it.)');
    }

    public function render()
    {
        return view('livewire.create-listing');
    }
}
