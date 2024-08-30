<?php

namespace App\Livewire;

use Livewire\Component;

class Jalurindex extends Component
{
    public $title = 'List Jalur';

    public function render()
    {
        return view('livewire.jalurindex');
    }

    public function createPage()
    {
        return $this->redirect(JalurCreate::class);
    }
}
