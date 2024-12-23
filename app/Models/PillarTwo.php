<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarTwo extends Model
{
    use HasFactory;

    protected $table = 'pillar_twos';
    protected $fillable = ['mosque_id', 'question_two', 'option_two', 'question_three', 'option_three', 'question_four', 'option_four', 'question_five', 'file_question_two', 'file_question_three', 'file_question_four', 'file_question_five', 'year'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function systemAssessment()
    {
        return $this->hasOne(SystemAssessment::class, 'pillar_two_id')->where('year', date('Y'));
    }

    public function committeeAssessmnet()
    {
        return $this->hasOne(CommitteeAssessment::class, 'pillar_two_id')->where('year', date('Y'));
    }

    public function committeeAssessmentWithCustomYear()
    {
        return $this->hasOne(CommitteeAssessment::class, 'pillar_two_id');
    }
}
