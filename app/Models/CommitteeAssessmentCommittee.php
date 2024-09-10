<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeAssessmentCommittee extends Model
{
    use HasFactory;

    protected $table = 'committee_assessment_committees';
    protected $fillable = ['committee_assessment_id', 'committee_id', 'position'];
}
