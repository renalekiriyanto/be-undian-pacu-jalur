<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalur extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'jalur';

    public function asal()
    {
        return $this->belongsTo(Village::class, 'id', 'id_desa');
    }
}