<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = [
        "discussion_id",
        "user_id",
        "body",
    ];

    public function user()  
    {
        return $this->belongsTo(user::class);
    }

    public function discussion()  
    {
        return $this->belongsTo(discussion::class);
    }
}
