<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarFour extends Model
{
    use HasFactory;

    protected $table = 'pillar_fours';
    protected $fillable = ['mosque_id', 'question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'file_question_one', 'file_question_two', 'file_question_four', 'file_question_five'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function systemAssessment()
    {
        return $this->hasOne(SystemAssessment::class, 'pillar_four_id');
    }

    public function committeeAssessmnet()
    {
        return $this->hasOne(CommitteeAssessment::class, 'pillar_four_id');
    }
}
