<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $table = 'distributions';
    protected $fillable = ['user_id', 'committe_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function committe()
    {
        return $this->belongsTo(User::class, 'committe_id');
    }
}
