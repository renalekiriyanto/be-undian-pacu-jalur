<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arena extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function asal()
    {
        return $this->belongsTo(Village::class, 'id_desa', 'id');
    }

    public function scopeFilterByName($query, $name)
    {
        if (isset($name)) {
            return $query->where('name', "%$name%");
        }
    }

    public function scopeFilter($query, $filters)
    {
        return $query->filterByName($filters['name'] ?? null);
    }
}