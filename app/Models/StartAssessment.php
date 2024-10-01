<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartAssessment extends Model
{
    use HasFactory;

    protected $table = 'start_assessments';
    protected $fillable = [
        'presentation_id',
        'presentation_file',
    ];
}
