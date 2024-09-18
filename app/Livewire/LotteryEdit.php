<?php

namespace App\Livewire;

use App\Models\Arena;
use App\Models\Lottery;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class LotteryEdit extends Component
{
    public $title = 'Edit Lottery';
    public $day_of;
    public $id_arena;
    public $name_arena;
    public $is_last_day;
    public $date_match;

    public $lottery_id;
    public $lottery_name;

    public function mount($id)
    {
        $this->lottery_id = (int)$id;
        $lottery = Lottery::findOrFail((int)$id);
        $this->lottery_name = $lottery->name;
        $this->id_arena = $lottery->id_arena;
        $this->name_arena = $lottery->arena->name;
        $this->is_last_day = $lottery->is_last_day;
    }

    public function render()
    {
        return view('livewire.lottery-edit');
    }

    #[On('selectArena')]
    public function getArena($id)
    {
        $arena = Arena::find($id);

        $this->id_arena = $arena->id;
        $this->name_arena = $arena->name;
    }

    public function storeRecord()
    {
        // Check arena
        $arena = Arena::find($this->id_arena);
        if (!$arena) {
            return session()->flash('error', ['Arena tidak ditemukan/belum terdaftar']);
        }

        $undian = Lottery::create([
            'id_arena' => $this->id_arena,
            'name' => "Hari ke-$this->day_of di $arena->name Tanggal $this->date_match",
            'day_of' => $this->day_of,
            'slug' => Str::slug("Hari ke-{{$this->day_of}} di {{$arena->name}} Tanggal {{$this->date_match}}"),
            'match_date' => $this->date_match
        ]);

        session()->flash('success', ['Berhasil buat undian']);
        $this->redirect(LotteryIndex::class);
    }

    public function lotteryPage()
    {
        return $this->redirect(LotteryIndex::class);
    }
}
