<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemAssessment extends Model
{
    use HasFactory;

    protected $table = 'system_assessments';
    protected $fillable = [
        'pillar_one_id',
        'pillar_one_question_one',
        'pillar_one_question_two',
        'pillar_one_question_three',
        'pillar_one_question_four',
        'pillar_one_question_five'
    ];

    public function pillarOne()
    {
        return $this->belongsTo(PillarOne::class, 'pillar_one_id');
    }
}
