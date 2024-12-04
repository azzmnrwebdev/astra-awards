<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    protected $table = 'presentations';
    protected $fillable = ['mosque_id', 'file', 'year'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }

    public function startAssessment()
    {
        return $this->hasMany(StartAssessment::class, 'presentation_id');
    }

    public function startAssessmentForJury($juryId)
    {
        return $this->hasMany(StartAssessment::class, 'presentation_id')
            ->where('jury_id', $juryId);
    }
}
