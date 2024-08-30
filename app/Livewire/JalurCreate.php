<?php

namespace App\Livewire;

use App\Models\Jalur;
use App\Models\Village;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class JalurCreate extends Component
{
    public $title = 'Tambah Jalur';

    #[Validate('required')]
    public $jalur_name;
    #[Validate('required')]
    public $daerah_dipilih;

    public function render()
    {
        session()->flash('coba', ['Pertama', 'Kedua']);
        $list_daerah = Village::all();
        return view('livewire.jalur-create', [
            'villages' => $list_daerah
        ]);
    }

    public function jalurPage()
    {
        return $this->redirect(Jalurindex::class);
    }

    public function storeRecord()
    {
        // Check daerah
        $daerah = Village::find((int)$this->daerah_dipilih);
        dd($this->daerah_dipilih);
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

        return redirect(Jalurindex::class)->with('success', ['Berhasil daftar jalur']);
    }
}
