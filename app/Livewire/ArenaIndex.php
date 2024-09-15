<?php

namespace App\Livewire;

use App\Models\Arena;
use Livewire\Component;

class ArenaIndex extends Component
{
    public $title = 'List Arena';

    public function render()
    {
        $data = Arena::paginate(10);

        return view('livewire.arena-index',[
            'data' => $data
        ]);
    }

    public function createPage()
    {
        return $this->redirect(ArenaCreate::class);
    }

    public function pageEditArena($id)
    {
        return $this->redirect(route('arena.edit', $id));
    }

    public function deleteArena($id)
    {
        Arena::destroy((int)$id);

        session()->flash('success', ['Berhasil hapus arena']);
    }
}
