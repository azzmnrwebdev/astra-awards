<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = ['name', 'parent_company_id', 'business_line_id'];

    public function parentCompany()
    {
        return $this->belongsTo(ParentCompany::class, 'parent_company_id');
    }

    public function businessLine()
    {
        return $this->belongsTo(BusinessLine::class, 'business_line_id');
    }

    public function mosque()
    {
        return $this->hasMany(Mosque::class, 'company_id');
    }
}
