<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'id_undian', 'id');
    }
}
