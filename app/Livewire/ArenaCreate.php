<?php

namespace App\Livewire;

use App\Models\Arena;
use App\Models\Jalur;
use App\Models\Village;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class ArenaCreate extends Component
{
    public $title = 'Tambah Arena';
    public $arena_name;
    public $daerah_code;
    public $daerah_name;

    public function render()
    {
        return view('livewire.arena-create');
    }

    public function storeRecord()
    {
        // Check daerah
        $daerah = Village::where('code', $this->daerah_code)->first();
        if (!$daerah) {
            return session()->flash('error', ['Daerah tidak ditemukan/belum terdaftar']);
        }

        $slug_jalur = Str::slug($this->arena_name);
        // Check jalur slug if was exists
        $jalur = Arena::where('slug', $slug_jalur)->first();
        if ($jalur) {
            return session()->flash('error', ['Aena  sudah terdaftar']);
        }

        $jalur = Arena::create([
            'id_desa' => $daerah->id,
            'name' => $this->arena_name,
            'slug' => $slug_jalur
        ]);

        session()->flash('success', ['Berhasil daftar arena']);
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

    public function jalurPage()
    {
        return $this->redirect(ArenaIndex::class);
    }
}
