<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndAssessment extends Model
{
    use HasFactory;

    protected $table = 'end_assessments';
    protected $fillable = [
        'mosque_id',
        'jury_id',
        'presentation_value_pillar_one',
        'presentation_value_pillar_two',
        'presentation_value_pillar_three',
        'presentation_value_pillar_four',
        'presentation_value_pillar_five',
        'year'
    ];

    public function jury()
    {
        return $this->belongsTo(User::class, 'jury_id');
    }
}
