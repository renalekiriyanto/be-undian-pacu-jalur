<?php

namespace App\Livewire;

use App\Models\Jalur;
use Livewire\Component;

class Jalurindex extends Component
{
    public $title = 'List Jalur';

    public function render()
    {
        $data = Jalur::paginate(10);
        return view('livewire.jalurindex', [
            'data' => $data
        ]);
    }

    public function createPage()
    {
        return $this->redirect(JalurCreate::class);
    }
}