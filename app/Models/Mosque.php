<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mosque extends Model
{
    use HasFactory;

    protected $table = 'mosques';
    protected $fillable = ['user_id', 'category_area_id', 'name', 'capacity', 'leader', 'company_id', 'address', 'city', 'province_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoryArea()
    {
        return $this->belongsTo(CategoryArea::class, 'category_area_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function pillarOne()
    {
        return $this->hasOne(PillarOne::class, 'mosque_id');
    }

    public function pillarTwo()
    {
        return $this->hasOne(PillarTwo::class, 'mosque_id');
    }

    public function pillarThree()
    {
        return $this->hasOne(PillarThree::class, 'mosque_id');
    }

    public function pillarFour()
    {
        return $this->hasOne(PillarFour::class, 'mosque_id');
    }

    public function pillarFive()
    {
        return $this->hasOne(PillarFive::class, 'mosque_id');
    }
}
