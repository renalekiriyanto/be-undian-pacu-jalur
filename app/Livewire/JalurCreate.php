<?php

namespace App\Livewire;

use App\Models\Jalur;
use App\Models\Village;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

class JalurCreate extends Component
{
    public $title = 'Tambah Jalur';

    #[Validate('required')]
    public $jalur_name;
    #[Validate('required')]
    public $daerah_code;
    public $daerah_name;

    public function render()
    {
        session()->flash('coba', ['Pertama', 'Kedua']);
        $list_daerah = Village::all();
        return view('livewire.jalur-create', [
            'villages' => $list_daerah
        ]);
    }

    public function storeRecord()
    {
        // Check daerah
        $daerah = Village::where('code', $this->daerah_code)->first();
        if (!$daerah) {
            return session()->flash('error', ['Daerah tidak ditemukan/belum terdaftar']);
        }

        $slug_jalur = Str::slug($this->jalur_name);
        // Check jalur slug if was exists
        $jalur = Jalur::where('slug', $slug_jalur)->first();
        if ($jalur) {
            return session()->flash('error', ['Jalur sudah terdaftar']);
        }

        $jalur = Jalur::create([
            'id_desa' => $daerah->id,
            'name' => $this->jalur_name,
            'slug' => $slug_jalur
        ]);

        session()->flash('success', ['Berhasil daftar jalur']);
        $this->redirect(Jalurindex::class);
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
        return $this->redirect(Jalurindex::class);
    }
}