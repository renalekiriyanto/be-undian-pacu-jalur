<?php

namespace App\Livewire;

use App\Models\Lottery;
use App\Models\Matching;
use Livewire\Component;
use Livewire\Attributes\On;

class MatchCreate extends Component
{
    public $title = "Create Match";
    public $id_lottery;
    public $name_lottery;
    public $total_hilir;
    public $total_putaran;

    public function render()
    {
        return view('livewire.match-create');
    }

    public function matchPage()
    {
        return $this->redirect(MatchIndex::class);
    }

    #[On('selectLottery')]
    public function getLottery($id)
    {
        $lottery = Lottery::find($id);
        if(!$lottery)
        {
            return session()->flash('error', ['Undian tidak ditemukan/belum terdaftar']);
        }

        $this->id_lottery = $id;
        $this->name_lottery = $lottery->name;
    }

    public function storeRecord()
    {
        $lottery = Lottery::find($this->id_lottery);
        if(!$lottery)
        {
            return session()->flash('error', ['Undian tidak ditemukan/belum terdaftar']);
        }

        for($i=1; $i<= $this->total_hilir; $i++)
        {
            // if($this->total_hilir > 1)
            // {

            // } else {
            // }
            $is_bay = false;
            if($this->total_hilir % 2 == 0)
            {
                $is_bay = false;
            } else {
                if($i == $this->total_hilir)
                {
                    $is_bay = true;
                }
            }
            $match = Matching::create([
                'id_undian' => $lottery->id,
                'id_putaran' => 1,
                'urutan_hilir' => $i,
                'hari' => $lottery->day_of,
                'is_bay' => $is_bay
            ]);
        }

        session()->flash('success', ['Berhasil buat match']);
        $this->redirect(MatchIndex::class);
    }
}