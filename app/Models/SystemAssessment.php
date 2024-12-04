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
        'pillar_one_question_five',
        'pillar_two_id',
        'pillar_two_question_two',
        'pillar_two_question_three',
        'pillar_two_question_four',
        'pillar_two_question_five',
        'pillar_three_id',
        'pillar_three_question_one',
        'pillar_three_question_two',
        'pillar_three_question_three',
        'pillar_three_question_four',
        'pillar_three_question_five',
        'pillar_three_question_six',
        'pillar_four_id',
        'pillar_four_question_one',
        'pillar_four_question_two',
        'pillar_four_question_three',
        'pillar_four_question_four',
        'pillar_four_question_five',
        'pillar_five_id',
        'pillar_five_question_one',
        'pillar_five_question_two',
        'pillar_five_question_three',
        'pillar_five_question_four',
        'pillar_five_question_five',
        'year'
    ];

    public function pillarOne()
    {
        return $this->belongsTo(PillarOne::class, 'pillar_one_id');
    }

    public function pillarTwo()
    {
        return $this->belongsTo(PillarTwo::class, 'pillar_two_id');
    }

    public function pillarThree()
    {
        return $this->belongsTo(PillarThree::class, 'pillar_three_id');
    }

    public function pillarFour()
    {
        return $this->belongsTo(PillarFour::class, 'pillar_four_id');
    }

    public function pillarFive()
    {
        return $this->belongsTo(PillarFive::class, 'pillar_five_id');
    }
}
