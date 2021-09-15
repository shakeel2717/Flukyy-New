<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'username',
        'email',
        'password',
        'status',
    ];



    public function contest()
    {
        return $this->hasMany(contest::class);
    }
}
