<?php

namespace App\Livewire;

use App\Models\Jalur;
use App\Models\Village;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class JalurEdit extends Component
{
    public $title = 'Edit Jalur';
    public $jalur_id;
    #[Validate('required')]
    public $jalur_name;
    #[Validate('required')]
    public $daerah_code;
    public $daerah_name;

    public function mount($id)
    {
        $this->jalur_id = (int)$id;
        $jalur = Jalur::findOrFail((int)$id);
        $this->jalur_name = $jalur->name;
        $this->daerah_code = $jalur->asal->code;
        $this->daerah_name = $jalur->asal->name;
    }

    public function render()
    {
        return view('livewire.jalur-edit');
    }

    public function updateRecord()
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
        $jalur = Jalur::find($this->jalur_id);
        $jalur->update([
            'id_desa' => $daerah->id,
            'name' => $this->jalur_name,
            'slug' => $slug_jalur
        ]);

        session()->flash('success', ['Berhasil edit jalur']);
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
}
