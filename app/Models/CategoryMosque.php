<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMosque extends Model
{
    use HasFactory;

    protected $table = 'category_mosques';
    protected $fillable = ['name', 'description'];

    public function mosque()
    {
        return $this->hasMany(Mosque::class, 'category_mosque_id');
    }
}
