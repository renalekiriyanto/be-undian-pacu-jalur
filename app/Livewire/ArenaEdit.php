<?php

namespace App\Livewire;

use App\Models\Arena;
use App\Models\Village;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class ArenaEdit extends Component
{
    public $title = 'Edit Arena';
    public $arena_id;
    #[Validate('required')]
    public $arena_name;
    #[Validate('required')]
    public $daerah_code;
    public $daerah_name;

    public function mount($id)
    {
        $this->arena_id = (int)$id;
        $arena = Arena::findOrFail((int)$id);
        $this->arena_name = $arena->name;
        $this->daerah_code = $arena->asal->code;
        $this->daerah_name = $arena->asal->name;
    }

    public function render()
    {
        return view('livewire.arena-edit');
    }

    public function updateRecord()
    {
        // Check daerah
        $daerah = Village::where('code', $this->daerah_code)->first();
        if (!$daerah) {
            return session()->flash('error', ['Daerah tidak ditemukan/belum terdaftar']);
        }

        $slug_arena = Str::slug($this->arena_name);
        // Check arena slug if was exists
        $arena = arena::where('slug', $slug_arena)->first();
        if ($arena) {
            return session()->flash('error', ['Jalur sudah terdaftar']);
        }
        $arena = Arena::find($this->arena_id);
        $arena->update([
            'id_desa' => $daerah->id,
            'name' => $this->arena_name,
            'slug' => $slug_arena
        ]);

        session()->flash('success', ['Berhasil edit arena']);
        $this->redirect(ArenaIndex::class);
    }

    #[On('selectDaerah')]
    public function getDaerah($id)
    {
        $daerah = Village::find($id);

        $this->daerah_code = $daerah->code;
        $this->daerah_name = $daerah->name;
        // $this->dispatchBrowserEvent('closeModal');
    }
}
