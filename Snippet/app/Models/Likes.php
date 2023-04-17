<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public $timestamps = false;
    public function posts() {
        return $this->hasMany(Likes::class);
    }
    protected $fillable = [
        'post_id',
        'user_id',
    ];

    use HasFactory;
}
