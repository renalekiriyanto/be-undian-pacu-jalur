<?php

namespace App\Livewire;

use App\Models\Arena;
use Livewire\Component;

class ArenaPencarian extends Component
{
    public $search = '';

    public function render()
    {
        $data = Arena::take(10)->get();

        if (!empty($this->search)) {
            $data = Arena::where('name', 'like', '%' . $this->search . '%')->take(10)->get();
        }

        return view('livewire.arena-pencarian', [
            'data' => $data
        ]);
    }

    public function selectArena($id)
    {
        $this->dispatch('selectArena', id: $id);
    }
}