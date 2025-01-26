<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $guared = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }
}
