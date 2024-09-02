<?php

namespace App\Livewire;

use App\Models\Village;
use Livewire\Component;

class AsalPencarian extends Component
{
    public $search = '';

    public function render()
    {
        $data = Village::take(10)->get();

        if (!empty($this->search)) {
            $data = Village::where('name', 'like', '%' . $this->search . '%')->take(10)->get();
        }

        return view('livewire.asal-pencarian', [
            'data' => $data
        ]);
    }

    public function selectDaerah($id)
    {
        $this->dispatch('selectDaerah', id: $id);
    }
}