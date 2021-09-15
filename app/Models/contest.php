<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contest extends Model
{
    use HasFactory;

    public function participate()
    {
        return $this->hasMany(participate::class);
    }

    public function user()
    {
        return $this->belongsTo(users::class);
    }
}
