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
        'jury_id',
        'presentation_file_pillar_one',
        'presentation_file_pillar_two',
        'presentation_file_pillar_three',
        'presentation_file_pillar_four',
        'presentation_file_pillar_five',
        'year'
    ];

    public function jury()
    {
        return $this->belongsTo(User::class, 'jury_id');
    }
}
