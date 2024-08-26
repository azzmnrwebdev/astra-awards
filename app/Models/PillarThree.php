<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarThree extends Model
{
    use HasFactory;

    protected $table = 'pillar_threes';
    protected $fillable = ['mosque_id', 'question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'question_six', 'file_question_one', 'file_question_four', 'file_question_six'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }
}
