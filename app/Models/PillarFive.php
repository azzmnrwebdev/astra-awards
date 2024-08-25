<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarFive extends Model
{
    use HasFactory;

    protected $table = 'pillar_fives';
    protected $fillable = ['mosque_id', 'question_one', 'question_two', 'question_three', 'question_four', 'question_five', 'file_question_two'];

    public function mosque()
    {
        return $this->belongsTo(Mosque::class, 'mosque_id');
    }
}
