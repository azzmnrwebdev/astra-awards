<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarOne extends Model
{
    use HasFactory;

    protected $table = 'pillar_ones';
    protected $fillable = ['mosque_id', 'question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'file_question_one', 'file_question_two_one', 'file_question_two_two', 'file_question_two_three', 'file_question_three', 'file_question_four', 'file_question_five'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function systemAssessment()
    {
        return $this->hasOne(SystemAssessment::class, 'pillar_one_id');
    }

    public function committeeAssessmnet()
    {
        return $this->hasOne(CommitteeAssessment::class, 'pillar_one_id');
    }
}
