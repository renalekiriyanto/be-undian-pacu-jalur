<?php

namespace App\Livewire;

use App\Models\Lottery;
use App\Models\Matching;
use Livewire\Component;

class TambahPutaran extends Component
{
    public $id_undian;
    public $jumlah_hilir;

    public function mount($id_undian)
    {
        $this->id_undian = $id_undian;
    }
    public function render()
    {
        return view('livewire.tambah-putaran');
    }

    public function tambahPutaran()
    {
        $is_bay = false;
        !$this->jumlah_hilir % 2 === 0 ? $is_bay = true : $is_bay = false;

        $putaran_ke = 1;
        // Cek kalau sudah ada putaran sebelumnya
        $match = Matching::where('id_undian', $this->id_undian)
        ->orderBy('id_putaran', 'desc')
        ->first();

        if($match) $putaran_ke += $match->id_putaran;

        // Ambil data undian untuk dapatkan hari keberapa
        $undian = Lottery::find($this->id_undian)->pluck('day_of');

        for($i=1; $i <= $this->jumlah_hilir; $i++){
            Matching::create([
                'id_undian' => $this->id_undian,
                'id_putaran' => $putaran_ke,
                'urutan_hilir' => $i,
                'hari' => $undian[0] ?? 1,
                'is_bay' => $i == $this->jumlah_hilir ? $is_bay : false
            ]);
        }

        session()->flash('success', ['Berhasil tambah putaran']);
        $this->dispatch('tambahPutaran');
    }
}