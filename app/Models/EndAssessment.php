<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndAssessment extends Model
{
    use HasFactory;

    protected $table = 'end_assessments';
    protected $fillable = [
        'mosque_id',
        'presentation_value',
    ];
}
