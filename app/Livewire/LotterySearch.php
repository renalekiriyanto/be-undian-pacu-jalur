<?php

namespace App\Livewire;

use App\Models\Lottery;
use Livewire\Component;

class LotterySearch extends Component
{
    public $search;
    public function render()
    {
        $data = Lottery::take(10)->get();
        if(!empty($this->search))
        {
            $data = Lottery::where('name', 'like', '%'.$this->search.'%')->take(10)->get();
        }
        return view('livewire.lottery-search',['data' => $data]);
    }

    public function selectLottery($id)
    {
        $this->dispatch('selectLottery', id: $id);
    }
}