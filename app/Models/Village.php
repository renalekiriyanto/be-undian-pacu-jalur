<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'code_kecamatan', 'code');
    }

    public function scopeFilter($query, $filters = [])
    {
        $query->when($filters['search'], function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', "%$search%");
            });
        });
    }
}