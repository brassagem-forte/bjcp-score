<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    use HasFactory;

    public function style()
    {
        return $this->belongsTo(Style::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getIconAttribute()
    {
        switch ($this->place) {
            case '1':
                return '🥇';
                break;
            case '2':
                return '🥈';
                break;
            case '3':
                return '🥉';
                break;
        }
    }


}
