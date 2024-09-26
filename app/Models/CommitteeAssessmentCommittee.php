<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeAssessmentCommittee extends Model
{
    use HasFactory;

    protected $table = 'committee_assessment_committees';
    protected $fillable = ['committee_assessment_id', 'user_id', 'committee_id', 'position'];

    public function committeeAssessment()
    {
        return $this->belongsTo(CommitteeAssessment::class, 'committee_assessment_id');
    }
}
