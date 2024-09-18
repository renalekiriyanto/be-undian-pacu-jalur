<?php

namespace App\Livewire;

use App\Models\Lottery;
use Livewire\Component;

class LotteryIndex extends Component
{
    public $title = 'List Undian';
    public function render()
    {
        $data = Lottery::paginate(10);
        return view('livewire.lottery-index', [
            'data' => $data
        ]);
    }

    public function createPage()
    {
        return $this->redirect(LotteryCreate::class);
    }

    public function pageEditUndian($id)
    {
        return $this->redirect(route('lottery.edit', $id));
    }

    public function deleteUndian($id)
    {
        Lottery::destroy((int)$id);

        session()->flash('success', ['Berhasil hapus undian']);
    }
}
