<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    public function scopeUsdBalance($query)
    {
        return $query->where('currency', 'USD')->where('users_id', session('user')[0]->id);
    }


    public function scopeThisUser($query)
    {
        return $query->where('users_id', session('user')[0]->id);
    }

    public function scopeTokenBalance($query)
    {
        return $query->where('currency', 'Token')->where('users_id', session('user')[0]->id);
    }
}
