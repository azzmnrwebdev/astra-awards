<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryArea extends Model
{
    use HasFactory;

    protected $table = 'category_areas';
    protected $fillable = ['name'];

    public function mosque()
    {
        return $this->hasMany(Mosque::class, 'category_area_id');
    }
}
