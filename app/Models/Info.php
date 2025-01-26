<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "firstname",
        "lastname",
        "firstname",
        "pic",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
