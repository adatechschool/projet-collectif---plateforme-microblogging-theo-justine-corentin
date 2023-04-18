<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->hasMany(User::class);
    }
    protected $fillable = [
        'followed_id',
        'following_id',
    ];

    use HasFactory;
}
