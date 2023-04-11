<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'description',
        'img_url',
        'user_id',
    ];


    use HasFactory;
}
