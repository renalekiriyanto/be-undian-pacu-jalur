<?php

namespace App\Livewire;

use App\Models\Village;
use Livewire\Component;

class DaerahList extends Component
{
    public $title = 'Daerah List';

    public function render()
    {
        $data = Village::paginate(20);
        return view('livewire.daerah-list', [
            'data' => $data
        ]);
    }
}
