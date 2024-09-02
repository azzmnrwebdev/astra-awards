<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarTwo extends Model
{
    use HasFactory;

    protected $table = 'pillar_twos';
    protected $fillable = ['mosque_id', 'question_one', 'question_two', 'option_two', 'question_three', 'option_three', 'question_four', 'option_four', 'question_five', 'file_question_two', 'file_question_three', 'file_question_four'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }
}
