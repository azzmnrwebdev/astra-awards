<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mosque extends Model
{
    use HasFactory;

    protected $table = 'mosques';
    protected $fillable = [
        'user_id',
        'position',
        'category_area_id',
        'category_mosque_id',
        'name',
        'capacity',
        'logo',
        'leader',
        'leader_phone',
        'leader_email',
        'company_id',
        'address',
        'city_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoryArea()
    {
        return $this->belongsTo(CategoryArea::class, 'category_area_id');
    }

    public function categoryMosque()
    {
        return $this->belongsTo(CategoryMosque::class, 'category_mosque_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function pillarOne()
    {
        return $this->hasOne(PillarOne::class, 'mosque_id');
    }

    public function pillarTwo()
    {
        return $this->hasOne(PillarTwo::class, 'mosque_id');
    }

    public function pillarThree()
    {
        return $this->hasOne(PillarThree::class, 'mosque_id');
    }

    public function pillarFour()
    {
        return $this->hasOne(PillarFour::class, 'mosque_id');
    }

    public function pillarFive()
    {
        return $this->hasOne(PillarFive::class, 'mosque_id');
    }

    public function presentation()
    {
        return $this->hasOne(Presentation::class, 'mosque_id');
    }

    public function endAssessment()
    {
        return $this->hasOne(EndAssessment::class, 'mosque_id');
    }

    public function getTotalPillarValueAttribute()
    {
        $totalValue = 0;
        $anyAssessment = false;

        if ($this->pillarOne && $this->pillarOne->committeeAssessmnet) {
            $totalValue += $this->pillarOne->committeeAssessmnet->pillar_one_question_one +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_two +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_three +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_four +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_five +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_six +
                $this->pillarOne->committeeAssessmnet->pillar_one_question_seven;

            $anyAssessment = true;
        }

        if ($this->pillarTwo && $this->pillarTwo->committeeAssessmnet) {
            $totalValue += $this->pillarTwo->committeeAssessmnet->pillar_two_question_two +
                $this->pillarTwo->committeeAssessmnet->pillar_two_question_three +
                $this->pillarTwo->committeeAssessmnet->pillar_two_question_four +
                $this->pillarTwo->committeeAssessmnet->pillar_two_question_five;

            $anyAssessment = true;
        }

        if ($this->pillarThree && $this->pillarThree->committeeAssessmnet) {
            $totalValue += $this->pillarThree->committeeAssessmnet->pillar_three_question_one +
                $this->pillarThree->committeeAssessmnet->pillar_three_question_two +
                $this->pillarThree->committeeAssessmnet->pillar_three_question_three +
                $this->pillarThree->committeeAssessmnet->pillar_three_question_four +
                $this->pillarThree->committeeAssessmnet->pillar_three_question_five +
                $this->pillarThree->committeeAssessmnet->pillar_three_question_six;

            $anyAssessment = true;
        }

        if ($this->pillarFour && $this->pillarFour->committeeAssessmnet) {
            $totalValue += $this->pillarFour->committeeAssessmnet->pillar_four_question_one +
                $this->pillarFour->committeeAssessmnet->pillar_four_question_two +
                $this->pillarFour->committeeAssessmnet->pillar_four_question_three +
                $this->pillarFour->committeeAssessmnet->pillar_four_question_four +
                $this->pillarFour->committeeAssessmnet->pillar_four_question_five;

            $anyAssessment = true;
        }

        if ($this->pillarFive && $this->pillarFive->committeeAssessmnet) {
            $totalValue += $this->pillarFive->committeeAssessmnet->pillar_five_question_one +
                $this->pillarFive->committeeAssessmnet->pillar_five_question_two +
                $this->pillarFive->committeeAssessmnet->pillar_five_question_three +
                $this->pillarFive->committeeAssessmnet->pillar_five_question_four +
                $this->pillarFive->committeeAssessmnet->pillar_five_question_five;

            $anyAssessment = true;
        }

        return $totalValue;
    }
}
