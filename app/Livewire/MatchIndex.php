<?php

namespace App\Livewire;

use App\Models\Matching;
use Livewire\Component;

class MatchIndex extends Component
{
    public $title = "Match List";

    public function render()
    {
        $data = Matching::paginate(10);
        return view('livewire.match-index',[
            'data' => $data
        ]);
    }

    public function createPage()
    {
        return $this->redirect(MatchCreate::class);
    }
}