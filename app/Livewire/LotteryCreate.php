<?php

namespace App\Livewire;

use App\Models\Arena;
use App\Models\Lottery;
use App\Models\Matching;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class LotteryCreate extends Component
{
    public $title = 'Create Lottery';
    public $day_of;
    public $id_arena;
    public $name_arena;
    public $is_last_day;
    public $date_match;

    public function mount()
    {
        $this->is_last_day = false;
    }

    public function render()
    {
        return view('livewire.lottery-create');
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
}
