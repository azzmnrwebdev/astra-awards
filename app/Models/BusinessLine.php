<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLine extends Model
{
    use HasFactory;

    protected $table = 'business_lines';
    protected $fillable = ['name'];

    public function company()
    {
        return $this->hasMany(Company::class, 'business_line_id');
    }
}
