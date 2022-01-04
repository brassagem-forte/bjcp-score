<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function styles()
    {
        return $this->hasMany(Style::class);
    }

    public function scopeOrderedWithStyles($query)
    {
        return $query->with(['styles' => function ($subQuery) {
            $subQuery->orderBy('code', 'asc');
        }])->orderBy('categories.id', 'asc');
    }

}
