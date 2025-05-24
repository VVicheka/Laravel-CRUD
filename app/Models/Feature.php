<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'name',
        'image',
        'user_id'
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
