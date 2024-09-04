<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $table = 'timelines';
    protected $fillable = ['start_registration', 'end_registration', 'start_form', 'end_form', 'start_selection', 'end_selection', 'start_initial_assessment', 'end_initial_assessment', 'start_final_assessment', 'end_final_assessment'];
}
