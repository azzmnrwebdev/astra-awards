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
        return $this->hasOne(PillarOne::class, 'mosque_id')->where('year', date('Y'));
    }

    public function pillarOneWithCustomYear()
    {
        return $this->hasOne(PillarOne::class, 'mosque_id');
    }

    public function pillarTwo()
    {
        return $this->hasOne(PillarTwo::class, 'mosque_id')->where('year', date('Y'));
    }

    public function pillarTwoWithCustomYear()
    {
        return $this->hasOne(PillarTwo::class, 'mosque_id');
    }

    public function pillarThree()
    {
        return $this->hasOne(PillarThree::class, 'mosque_id')->where('year', date('Y'));
    }

    public function pillarThreeWithCustomYear()
    {
        return $this->hasOne(PillarThree::class, 'mosque_id');
    }

    public function pillarFour()
    {
        return $this->hasOne(PillarFour::class, 'mosque_id')->where('year', date('Y'));
    }

    public function pillarFourWithCustomYear()
    {
        return $this->hasOne(PillarFour::class, 'mosque_id');
    }

    public function pillarFive()
    {
        return $this->hasOne(PillarFive::class, 'mosque_id')->where('year', date('Y'));
    }

    public function pillarFiveWithCustomYear()
    {
        return $this->hasOne(PillarFive::class, 'mosque_id');
    }

    public function presentation()
    {
        return $this->hasOne(Presentation::class, 'mosque_id')->where('year', date('Y'));
    }

    public function presentationWithCustomYear()
    {
        return $this->hasOne(Presentation::class, 'mosque_id');
    }

    public function endAssessment()
    {
        return $this->hasMany(EndAssessment::class, 'mosque_id')->where('year', date('Y'));
    }

    public function endAssessmentWithCustomYear()
    {
        return $this->hasMany(EndAssessment::class, 'mosque_id');
    }

    public function endAssessmentForJury($juryId)
    {
        return $this->hasMany(EndAssessment::class, 'mosque_id')
            ->where('jury_id', $juryId)->where('year', date('Y'));
    }

    public function endAssessmentForJuryWithCustomYear($juryId)
    {
        return $this->hasMany(EndAssessment::class, 'mosque_id')
            ->where('jury_id', $juryId);
    }

    public function getTotalPillarValueAttribute()
    {
        $totalValue = 0;

        if ($this->pillarOneWithCustomYear && $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear) {
            $totalValue += $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_one +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_two +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_three +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_four +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_five +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_six +
                $this->pillarOneWithCustomYear->committeeAssessmentWithCustomYear->pillar_one_question_seven;
        }

        if ($this->pillarTwoWithCustomYear && $this->pillarTwoWithCustomYear->committeeAssessmentWithCustomYear) {
            $totalValue += $this->pillarTwoWithCustomYear->committeeAssessmentWithCustomYear->pillar_two_question_two +
                $this->pillarTwoWithCustomYear->committeeAssessmentWithCustomYear->pillar_two_question_three +
                $this->pillarTwoWithCustomYear->committeeAssessmentWithCustomYear->pillar_two_question_four +
                $this->pillarTwoWithCustomYear->committeeAssessmentWithCustomYear->pillar_two_question_five;
        }

        if ($this->pillarThreeWithCustomYear && $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear) {
            $totalValue += $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_one +
                $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_two +
                $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_three +
                $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_four +
                $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_five +
                $this->pillarThreeWithCustomYear->committeeAssessmentWithCustomYear->pillar_three_question_six;
        }

        if ($this->pillarFourWithCustomYear && $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear) {
            $totalValue += $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear->pillar_four_question_one +
                $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear->pillar_four_question_two +
                $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear->pillar_four_question_three +
                $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear->pillar_four_question_four +
                $this->pillarFourWithCustomYear->committeeAssessmentWithCustomYear->pillar_four_question_five;
        }

        if ($this->pillarFiveWithCustomYear && $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear) {
            $totalValue += $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear->pillar_five_question_one +
                $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear->pillar_five_question_two +
                $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear->pillar_five_question_three +
                $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear->pillar_five_question_four +
                $this->pillarFiveWithCustomYear->committeeAssessmentWithCustomYear->pillar_five_question_five;
        }

        return $totalValue;
    }
}
