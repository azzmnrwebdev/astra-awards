<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuryAssessment extends Model
{
    use HasFactory;

    protected $table = 'jury_assessments';
    protected $fillable = [
        'presentation_id',
        'presentation_file',
    ];
}
