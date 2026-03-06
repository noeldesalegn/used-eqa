<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdminUsers extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);

        // Prevent removing your own admin
        if ($user->id === auth()->id()) {
            return;
        }

        $user->update(['is_admin' => !$user->is_admin]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return;
        }

        $user->delete();
    }

    public function render()
    {
        $users = User::withCount('listings')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.users', [
            'users' => $users,
        ]);
    }
}
