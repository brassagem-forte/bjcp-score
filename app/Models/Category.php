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

    public function scopeOrderedMissingWithStyles($query, $id)
    {
        return $query->with(['styles' => function ($subQuery) use ($id) {
            $subQuery->whereNotIn('id', function ($subQuery) use ($id) {
                $subQuery->select('style_id')->from('style_user')->where('user_id', $id);
            });
        }])->orderBy('categories.id', 'asc');


            // ->whereDoesntHave('styles', function ($subQuery) use ($id) {
            //     $subQuery->join('style_user', 'styles.id', '=', 'style_users.style_id')->where('user_id', $id);
            // });
    }

}
