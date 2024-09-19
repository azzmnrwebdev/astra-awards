<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommitteeAssessment;
use Illuminate\Support\Facades\Auth;
use App\Models\CommitteeAssessmentCommittee;

class CommitteeAssessmentController extends Controller
{
    public function pillarOneAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_one_question_one') &&
            !$request->input('committee_pillar_one_question_two') &&
            !$request->input('committee_pillar_one_question_three') &&
            !$request->input('committee_pillar_one_question_four') &&
            !$request->input('committee_pillar_one_question_five') &&
            !$request->input('committee_pillar_one_question_six') &&
            !$request->input('committee_pillar_one_question_seven')
        ) {
            return redirect()->back()->with('error', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_one_question_one' => $request->input('committee_pillar_one_question_one'),
            'pillar_one_question_two' => $request->input('committee_pillar_one_question_two'),
            'pillar_one_question_three' => $request->input('committee_pillar_one_question_three'),
            'pillar_one_question_four' => $request->input('committee_pillar_one_question_four'),
            'pillar_one_question_five' => $request->input('committee_pillar_one_question_five'),
            'pillar_one_question_six' => $request->input('committee_pillar_one_question_six'),
            'pillar_one_question_seven' => $request->input('committee_pillar_one_question_seven'),
        ];

        $questionMapping = [
            'pillar_one_question_one' => '1',
            'pillar_one_question_two' => '2',
            'pillar_one_question_three' => '3',
            'pillar_one_question_four' => '4',
            'pillar_one_question_five' => '5',
            'pillar_one_question_six' => '6',
            'pillar_one_question_seven' => '7',
        ];

        $updatedQuestions = [];
        $newlyUpdatedQuestions = [];
        $formName = "Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah";
        $committeeAssessment = CommitteeAssessment::where('pillar_one_id', $request->input('pillar_one_id'))->first();

        if ($committeeAssessment) {
            foreach ($data as $key => $value) {
                $questionNumber = $questionMapping[$key] ?? '';

                if (!is_null($value)) {
                    if (is_null($committeeAssessment->{$key})) {
                        $newlyUpdatedQuestions[] = $questionNumber;
                    } elseif ($committeeAssessment->{$key} != $value) {
                        $updatedQuestions[] = $questionNumber;
                    }
                }
            }

            $committeeAssessment->update($data);

            if (!empty($updatedQuestions) || !empty($newlyUpdatedQuestions)) {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $this->formatPosition($newlyUpdatedQuestions, $updatedQuestions, $formName)
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_one_id' => $request->input('pillar_one_id')], $data));

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $newlyUpdatedQuestions[] = $questionMapping[$key];
                }
            }

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $this->formatPosition($newlyUpdatedQuestions, [], $formName)
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function pillarTwoAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_two_question_two') &&
            !$request->input('committee_pillar_two_question_three') &&
            !$request->input('committee_pillar_two_question_four') &&
            !$request->input('committee_pillar_two_question_five')
        ) {
            return redirect()->back()->with('error', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_two_question_two' => $request->input('committee_pillar_two_question_two'),
            'pillar_two_question_three' => $request->input('committee_pillar_two_question_three'),
            'pillar_two_question_four' => $request->input('committee_pillar_two_question_four'),
            'pillar_two_question_five' => $request->input('committee_pillar_two_question_five'),
        ];

        $questionMapping = [
            'pillar_two_question_two' => '1',
            'pillar_two_question_three' => '2',
            'pillar_two_question_four' => '3',
            'pillar_two_question_five' => '4',
        ];

        $updatedQuestions = [];
        $newlyUpdatedQuestions = [];
        $formName = "Formulir Hubungan DKM dengan YAA";
        $committeeAssessment = CommitteeAssessment::where('pillar_two_id', $request->input('pillar_two_id'))->first();

        if ($committeeAssessment) {
            foreach ($data as $key => $value) {
                $questionNumber = $questionMapping[$key] ?? '';

                if (!is_null($value)) {
                    if (is_null($committeeAssessment->{$key})) {
                        $newlyUpdatedQuestions[] = $questionNumber;
                    } elseif ($committeeAssessment->{$key} != $value) {
                        $updatedQuestions[] = $questionNumber;
                    }
                }
            }

            $committeeAssessment->update($data);

            if (!empty($updatedQuestions) || !empty($newlyUpdatedQuestions)) {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $this->formatPosition($newlyUpdatedQuestions, $updatedQuestions, $formName)
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_two_id' => $request->input('pillar_two_id')], $data));

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $newlyUpdatedQuestions[] = $questionMapping[$key];
                }
            }

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $this->formatPosition($newlyUpdatedQuestions, [], $formName)
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function pillarThreeAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_three_question_one') &&
            !$request->input('committee_pillar_three_question_two') &&
            !$request->input('committee_pillar_three_question_three') &&
            !$request->input('committee_pillar_three_question_four') &&
            !$request->input('committee_pillar_three_question_five') &&
            !$request->input('committee_pillar_three_question_six')
        ) {
            return redirect()->back()->with('error', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_three_question_one' => $request->input('committee_pillar_three_question_one'),
            'pillar_three_question_two' => $request->input('committee_pillar_three_question_two'),
            'pillar_three_question_three' => $request->input('committee_pillar_three_question_three'),
            'pillar_three_question_four' => $request->input('committee_pillar_three_question_four'),
            'pillar_three_question_five' => $request->input('committee_pillar_three_question_five'),
            'pillar_three_question_six' => $request->input('committee_pillar_three_question_six'),
        ];

        $questionMapping = [
            'pillar_three_question_one' => '1',
            'pillar_three_question_two' => '2',
            'pillar_three_question_three' => '3',
            'pillar_three_question_four' => '4',
            'pillar_three_question_five' => '5',
            'pillar_three_question_six' => '6',
        ];

        $updatedQuestions = [];
        $newlyUpdatedQuestions = [];
        $formName = "Formulir Program Sosial";
        $committeeAssessment = CommitteeAssessment::where('pillar_three_id', $request->input('pillar_three_id'))->first();

        if ($committeeAssessment) {
            foreach ($data as $key => $value) {
                $questionNumber = $questionMapping[$key] ?? '';

                if (!is_null($value)) {
                    if (is_null($committeeAssessment->{$key})) {
                        $newlyUpdatedQuestions[] = $questionNumber;
                    } elseif ($committeeAssessment->{$key} != $value) {
                        $updatedQuestions[] = $questionNumber;
                    }
                }
            }

            $committeeAssessment->update($data);

            if (!empty($updatedQuestions) || !empty($newlyUpdatedQuestions)) {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $this->formatPosition($newlyUpdatedQuestions, $updatedQuestions, $formName)
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_three_id' => $request->input('pillar_three_id')], $data));

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $newlyUpdatedQuestions[] = $questionMapping[$key];
                }
            }

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $this->formatPosition($newlyUpdatedQuestions, [], $formName)
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function pillarFourAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_four_question_one') &&
            !$request->input('committee_pillar_four_question_two') &&
            !$request->input('committee_pillar_four_question_three') &&
            !$request->input('committee_pillar_four_question_four') &&
            !$request->input('committee_pillar_four_question_five')
        ) {
            return redirect()->back()->with('error', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_four_question_one' => $request->input('committee_pillar_four_question_one'),
            'pillar_four_question_two' => $request->input('committee_pillar_four_question_two'),
            'pillar_four_question_three' => $request->input('committee_pillar_four_question_three'),
            'pillar_four_question_four' => $request->input('committee_pillar_four_question_four'),
            'pillar_four_question_five' => $request->input('committee_pillar_four_question_five'),
        ];

        $questionMapping = [
            'pillar_four_question_one' => '1',
            'pillar_four_question_two' => '3',
            'pillar_four_question_three' => '4',
            'pillar_four_question_four' => '2',
            'pillar_four_question_five' => '5',
        ];

        $updatedQuestions = [];
        $newlyUpdatedQuestions = [];
        $formName = "Formulir Administrasi dan Keuangan";
        $committeeAssessment = CommitteeAssessment::where('pillar_four_id', $request->input('pillar_four_id'))->first();

        if ($committeeAssessment) {
            foreach ($data as $key => $value) {
                $questionNumber = $questionMapping[$key] ?? '';

                if (!is_null($value)) {
                    if (is_null($committeeAssessment->{$key})) {
                        $newlyUpdatedQuestions[] = $questionNumber;
                    } elseif ($committeeAssessment->{$key} != $value) {
                        $updatedQuestions[] = $questionNumber;
                    }
                }
            }

            $committeeAssessment->update($data);

            if (!empty($updatedQuestions) || !empty($newlyUpdatedQuestions)) {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $this->formatPosition($newlyUpdatedQuestions, $updatedQuestions, $formName)
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_four_id' => $request->input('pillar_four_id')], $data));

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $newlyUpdatedQuestions[] = $questionMapping[$key];
                }
            }

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $this->formatPosition($newlyUpdatedQuestions, [], $formName)
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function pillarFiveAct(Request $request)
    {
        if (
            !$request->input('committee_pillar_five_question_one') &&
            !$request->input('committee_pillar_five_question_two') &&
            !$request->input('committee_pillar_five_question_three') &&
            !$request->input('committee_pillar_five_question_four') &&
            !$request->input('committee_pillar_five_question_five')
        ) {
            return redirect()->back()->with('error', 'Harus menilai setidaknya salah satu bidang data.');
        }

        $data = [
            'pillar_five_question_one' => $request->input('committee_pillar_five_question_one'),
            'pillar_five_question_two' => $request->input('committee_pillar_five_question_two'),
            'pillar_five_question_three' => $request->input('committee_pillar_five_question_three'),
            'pillar_five_question_four' => $request->input('committee_pillar_five_question_four'),
            'pillar_five_question_five' => $request->input('committee_pillar_five_question_five'),
        ];

        $questionMapping = [
            'pillar_five_question_one' => '1',
            'pillar_five_question_two' => '2',
            'pillar_five_question_three' => '3',
            'pillar_five_question_four' => '4',
            'pillar_five_question_five' => '5',
        ];

        $updatedQuestions = [];
        $newlyUpdatedQuestions = [];
        $formName = "Formulir Peribadahan dan Infrastruktur";
        $committeeAssessment = CommitteeAssessment::where('pillar_five_id', $request->input('pillar_five_id'))->first();

        if ($committeeAssessment) {
            foreach ($data as $key => $value) {
                $questionNumber = $questionMapping[$key] ?? '';

                if (!is_null($value)) {
                    if (is_null($committeeAssessment->{$key})) {
                        $newlyUpdatedQuestions[] = $questionNumber;
                    } elseif ($committeeAssessment->{$key} != $value) {
                        $updatedQuestions[] = $questionNumber;
                    }
                }
            }

            $committeeAssessment->update($data);

            if (!empty($updatedQuestions) || !empty($newlyUpdatedQuestions)) {
                CommitteeAssessmentCommittee::create([
                    'committee_assessment_id' => $committeeAssessment->id,
                    'committee_id' => Auth::id(),
                    'position' => $this->formatPosition($newlyUpdatedQuestions, $updatedQuestions, $formName)
                ]);
            }
        } else {
            $committeeAssessment = CommitteeAssessment::create(array_merge(['pillar_five_id' => $request->input('pillar_five_id')], $data));

            foreach ($data as $key => $value) {
                if (!is_null($value)) {
                    $newlyUpdatedQuestions[] = $questionMapping[$key];
                }
            }

            CommitteeAssessmentCommittee::create([
                'committee_assessment_id' => $committeeAssessment->id,
                'committee_id' => Auth::id(),
                'position' => $this->formatPosition($newlyUpdatedQuestions, [], $formName)
            ]);
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    protected function formatPosition($newQuestions, $updatedQuestions, $name)
    {
        $position = '';

        if (count($newQuestions) > 0) {
            if (count($newQuestions) == 1) {
                $position = "Pertanyaan {$newQuestions[0]} di {$name} telah dinilai";
            } elseif (count($newQuestions) == 2) {
                $position = "Pertanyaan {$newQuestions[0]} dan {$newQuestions[1]} di {$name} telah dinilai";
            } else {
                $lastNew = array_pop($newQuestions);
                $position = "Pertanyaan " . implode(', ', $newQuestions) . " dan {$lastNew} di {$name} telah dinilai";
            }
        }

        if (count($updatedQuestions) > 0) {
            if ($position != '') {
                $position .= ' ';
            }

            if (count($updatedQuestions) == 1) {
                $position .= "Pertanyaan {$updatedQuestions[0]} di {$name} nilainya telah diubah";
            } elseif (count($updatedQuestions) == 2) {
                $position .= "Pertanyaan {$updatedQuestions[0]} dan {$updatedQuestions[1]} di {$name} nilainya telah diubah";
            } else {
                $lastUpdated = array_pop($updatedQuestions);
                $position .= "Pertanyaan " . implode(', ', $updatedQuestions) . " dan {$lastUpdated} di {$name} nilainya telah diubah";
            }
        }

        return $position;
    }
}
