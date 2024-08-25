<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCompany extends Model
{
    use HasFactory;

    protected $table = 'parent_companies';
    protected $fillable = ['name'];

    public function company()
    {
        return $this->hasMany(Company::class, 'parent_company_id');
    }
}
