<?php

namespace App\Http\Controllers;

use App\Models\CommitteeAssessment;
use App\Models\PillarFive;
use App\Models\PillarFour;
use App\Models\PillarOne;
use App\Models\PillarThree;
use App\Models\PillarTwo;
use App\Models\Presentation;
use App\Models\SystemAssessment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $userLogin = Auth::user();
        $admin = User::where('id', $userLogin->id)
            ->where('role', 'admin')
            ->with('distributionToCommitte')
            ->first();

        $pillarOnes = collect();
        $pillarTwos = collect();
        $pillarThrees = collect();
        $pillarFours = collect();
        $pillarFives = collect();

        if ($admin && $admin->distributionToCommitte) {
            $userIds = $admin->distributionToCommitte->pluck('user_id');

            $query = User::where('role', 'user')
                ->whereIn('id', $userIds)
                ->with(['mosque', 'mosque.pillarFive']);

            $search = $request->input('pencarian');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('mosque', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                    })->orWhereHas('mosque.company', function ($q3) use ($search) {
                        $q3->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
                    });
                });
            }

            $pillarTypes = ['pillarOne', 'pillarTwo', 'pillarThree', 'pillarFour', 'pillarFive'];
            $pillars = [];

            foreach ($pillarTypes as $pillarType) {
                $pillars[$pillarType] = (clone $query)->whereHas("mosque.$pillarType")->paginate(10);
            }

            $pillarOnes = $pillars['pillarOne'];
            $pillarTwos = $pillars['pillarTwo'];
            $pillarThrees = $pillars['pillarThree'];
            $pillarFours = $pillars['pillarFour'];
            $pillarFives = $pillars['pillarFive'];
        }

        if ($userLogin->role !== "admin") {
            return view('pages.form.index');
        }

        return view('pages.form.index', compact('search', 'pillarOnes', 'pillarTwos', 'pillarThrees', 'pillarFours', 'pillarFives'));
    }

    public function managementRelationship($user = null, $action = null)
    {
        $year = date('Y');

        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarOne = PillarOne::where('mosque_id', $mosque->id)->where('year', $year)->first();

            return view('pages.form.management-relationship', compact('pillarOne'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarOne = $user->mosque->pillarOne;

            if (!$pillarOne) {
                return redirect()->back()->with('error', 'Peserta belum mengisi formulir Hubungan DKM dengan YAA');
            }

            $systemAssessment = SystemAssessment::with(['pillarOne'])->where('pillar_one_id', $pillarOne->id)->first();
            $committeeAssessment = CommitteeAssessment::with(['pillarOne'])->where('pillar_one_id', $pillarOne->id)->first();

            return view('pages.form.management-relationship', compact('user', 'pillarOne', 'systemAssessment', 'committeeAssessment'));
        }
    }

    public function managementRelationshipAct(Request $request)
    {
        if (
            !$request->input('question_one') &&
            !$request->input('question_two') &&
            !$request->input('question_three') &&
            !$request->input('question_four') &&
            !$request->input('question_five')
        ) {
            return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
        }

        $rules = [
            'question_one' => 'string',
            'question_two' => 'string',
            'question_three' => 'string',
            'question_four' => 'string',
            'question_five' => 'string',
            'file_question_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_two' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_five' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $messages = [
            'question_one.string' => 'Jawaban 1 harus berupa text.',
            'question_two.string' => 'Jawaban 2 harus berupa text.',
            'question_three.string' => 'Jawaban 5 harus berupa text.',
            'question_four.string' => 'Jawaban 6 harus berupa text.',
            'question_five.string' => 'Jawaban 7 harus berupa text.',
            'file_question_one.file' => 'Dokumen harus berbentuk file.',
            'file_question_one.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_two_one.file' => 'Dokumen harus berbentuk file.',
            'file_question_two_one.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_two_two.file' => 'Dokumen harus berbentuk file.',
            'file_question_two_two.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_two_three.file' => 'Dokumen harus berbentuk file.',
            'file_question_two_three.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_three.file' => 'Dokumen harus berbentuk file.',
            'file_question_three.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_four.file' => 'Dokumen harus berbentuk file.',
            'file_question_four.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_five.file' => 'Dokumen harus berbentuk file.',
            'file_question_five.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosqueId = Auth::user()->mosque->id;

        $pillarOne = PillarOne::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosqueId,
                'question_one' => $request->input('question_one'),
                'question_two' => $request->input('question_two'),
                'question_three' => $request->input('question_three'),
                'question_four' => $request->input('question_four'),
                'question_five' => $request->input('question_five'),
                'year' => $year
            ]
        );

        $pillarOne->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarOne->file_question_one, 'pillarOnes');
        $pillarOne->file_question_two_one = $this->handleFileUpdate($request, 'file_question_two_one', $pillarOne->file_question_two_one, 'pillarOnes');
        $pillarOne->file_question_two_two = $this->handleFileUpdate($request, 'file_question_two_two', $pillarOne->file_question_two_two, 'pillarOnes');
        $pillarOne->file_question_two_three = $this->handleFileUpdate($request, 'file_question_two_three', $pillarOne->file_question_two_three, 'pillarOnes');
        $pillarOne->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarOne->file_question_three, 'pillarOnes');
        $pillarOne->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarOne->file_question_four, 'pillarOnes');
        $pillarOne->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarOne->file_question_five, 'pillarOnes');

        $pillarOne->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function relationship($user = null, $action = null)
    {
        $year = date('Y');

        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarTwo = PillarTwo::where('mosque_id', $mosque->id)->where('year', $year)->first();

            return view('pages.form.relationship', compact('pillarTwo'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarTwo = $user->mosque->pillarTwo;

            if (!$pillarTwo) {
                return redirect()->back()->with('error', 'Peserta belum mengisi formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah');
            }

            $systemAssessment = SystemAssessment::with(['pillarTwo'])->where('pillar_two_id', $pillarTwo->id)->first();
            $committeeAssessment = CommitteeAssessment::with(['pillarTwo'])->where('pillar_two_id', $pillarTwo->id)->first();

            return view('pages.form.relationship', compact('user', 'pillarTwo', 'systemAssessment', 'committeeAssessment'));
        }
    }

    public function relationshipAct(Request $request)
    {
        if (
            !$request->input('status_divisiSR') &&
            !$request->input('status_divisiLA') &&
            !$request->input('status_divisiK') &&
            !$request->input('status_divisiAK')
        ) {
            return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
        }

        $isAllStatusAda =
            $request->input('status_divisiSR') === 'ada' &&
            $request->input('status_divisiLA') === 'ada' &&
            $request->input('status_divisiK') === 'ada' &&
            $request->input('status_divisiAK') === 'ada';

        if ($isAllStatusAda) {
            if (
                !$request->input('question_two') &&
                !$request->input('question_three') &&
                !$request->input('question_four') &&
                !$request->input('question_five')
            ) {
                return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
            }
        }

        $rules = [
            'file_question_two' => 'file|mimes:zip',
            'file_question_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_five' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $messages = [
            'file_question_two.file' => 'Dokumen harus berbentuk file.',
            'file_question_two.mimes' => 'Dokumen yang diupload harus berformat ZIP.',
            'file_question_three.file' => 'Dokumen harus berbentuk file.',
            'file_question_three.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_four.file' => 'Dokumen harus berbentuk file.',
            'file_question_four.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_five.file' => 'Dokumen harus berbentuk file.',
            'file_question_five.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosque = Auth::user()->mosque;

        $isQuestionTwo = $request->input('status_divisiSR');
        $isQuestionThree = $request->input('status_divisiLA');
        $isQuestionFour = $request->input('status_divisiK');
        $isQuestionFive = $request->input('status_divisiAK');

        $questionTwo = $request->input('question_two', []);
        $questionThree = $request->input('question_three', []);
        $questionFour = $request->input('question_four', []);

        $optionTwoValue = $request->input('option_two', '');
        $optionThreeValue = $request->input('option_three', '');
        $optionFourValue = $request->input('option_four', '');

        if ($isQuestionTwo === "ada") {
            if (empty($questionTwo)) {
                $questionTwo = json_encode(null);
            } else {
                if (!empty($optionTwoValue)) {
                    if (!in_array('custom', $questionTwo)) {
                        $questionTwo[] = 'custom';
                        $optionTwoValue = $request->input('option_two');
                    }
                } else {
                    $questionTwo = array_filter($questionTwo, function ($value) {
                        return $value !== 'custom';
                    });
                }

                $questionTwo = json_encode($questionTwo);
            }
        } else {
            $questionTwo = json_encode(["Belum Ada"]);
            $optionTwoValue = null;
        }

        if ($isQuestionThree === "ada") {
            if (empty($questionThree)) {
                $questionThree = json_encode(null);
            } else {
                if (!empty($optionThreeValue)) {
                    if (!in_array('custom', $questionThree)) {
                        $questionThree[] = 'custom';
                        $optionThreeValue = $request->input('option_three');
                    }
                } else {
                    $questionThree = array_filter($questionThree, function ($value) {
                        return $value !== 'custom';
                    });
                }

                $questionThree = json_encode($questionThree);
            }
        } else {
            $questionThree = json_encode(["Belum Ada"]);
            $optionThreeValue = null;
        }

        if ($isQuestionFour === "ada") {
            if (empty($questionFour)) {
                $questionFour = json_encode(null);
            } else {
                if (!empty($optionFourValue)) {
                    if (!in_array('custom', $questionFour)) {
                        $questionFour[] = 'custom';
                        $optionFourValue = $request->input('option_four');
                    }
                } else {
                    $questionFour = array_filter($questionFour, function ($value) {
                        return $value !== 'custom';
                    });
                }

                $questionFour = json_encode($questionFour);
            }
        } else {
            $questionFour = json_encode(["Belum Ada"]);
            $optionFourValue = null;
        }

        $questionFive = null;
        if ($isQuestionFive === "ada") {
            $questionFive = json_encode($request->input('question_five'));
        } else {
            $questionFive = json_encode(["Belum Ada"]);
        }

        $pillarTwo = PillarTwo::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosque->id,
                'question_two' => $questionTwo,
                'option_two' => $optionTwoValue,
                'question_three' => $questionThree,
                'option_three' => $optionThreeValue,
                'question_four' => $questionFour,
                'option_four' => $optionFourValue,
                'question_five' => $questionFive,
                'year' => $year
            ]
        );

        $pillarTwo->file_question_two = $this->handleFileUpdate($request, 'file_question_two', $pillarTwo->file_question_two, 'pillarTwos');
        $pillarTwo->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarTwo->file_question_three, 'pillarTwos');
        $pillarTwo->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarTwo->file_question_four, 'pillarTwos');
        $pillarTwo->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarTwo->file_question_five, 'pillarTwos');

        $pillarTwo->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function program($user = null, $action = null)
    {
        $year = date('Y');

        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarThree = PillarThree::where('mosque_id', $mosque->id)->where('year', $year)->first();

            return view('pages.form.program', compact('pillarThree'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarThree = $user->mosque->pillarThree;

            if (!$pillarThree) {
                return redirect()->back()->with('error', 'Peserta belum mengisi formulir Program Sosial');
            }

            $systemAssessment = SystemAssessment::with(['pillarThree'])->where('pillar_three_id', $pillarThree->id)->first();
            $committeeAssessment = CommitteeAssessment::with(['pillarThree'])->where('pillar_three_id', $pillarThree->id)->first();

            return view('pages.form.program', compact('user', 'pillarThree', 'systemAssessment', 'committeeAssessment'));
        }
    }

    public function programAct(Request $request)
    {
        if (
            !$request->input('question_one') &&
            !$request->input('question_two') &&
            !$request->input('question_three') &&
            !$request->input('question_four') &&
            !$request->input('question_five') &&
            !$request->input('question_six')
        ) {
            return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
        }

        $rules = [
            'question_one' => 'string',
            'question_two' => 'string',
            'question_three' => 'string',
            'question_five' => 'nullable|string|max:1000',
            'file_question_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_six' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $messages = [
            'question_one.string' => 'Jawaban 1 harus berupa text.',
            'question_two.string' => 'Jawaban 2 harus berupa text.',
            'question_three.string' => 'Jawaban 3 harus berupa text.',
            'question_five.string' => 'Jawaban 5 harus berupa text.',
            'question_five.max' => 'Jawaban 5 tidak boleh melebihi dari 1000 karakter.',
            'file_question_one.file' => 'Dokumen harus berbentuk file.',
            'file_question_one.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_four.file' => 'Dokumen harus berbentuk file.',
            'file_question_four.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_six.file' => 'Dokumen harus berbentuk file.',
            'file_question_six.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosque = Auth::user()->mosque;
        $questionFour = $request->input('question_four', []);
        $questionSix = $request->input('question_six', []);
        $optionFourValue = $request->input('option_four', '');
        $optionSixValue = $request->input('option_six', '');

        if (empty($questionFour)) {
            $questionFour = null;
        } else {
            if (!empty($optionFourValue)) {
                if (!in_array('custom', $questionFour)) {
                    $questionFour[] = 'custom';
                }
            } else {
                $questionFour = array_filter($questionFour, function ($value) {
                    return $value !== 'custom';
                });
            }

            $questionFour = json_encode($questionFour);
        }

        if (empty($questionSix)) {
            $questionSix = null;
        } else {
            if (!empty($optionSixValue)) {
                if (!in_array('custom', $questionSix)) {
                    $questionSix[] = 'custom';
                }
            } else {
                $questionSix = array_filter($questionSix, function ($value) {
                    return $value !== 'custom';
                });
            }

            $questionSix = json_encode($questionSix);
        }

        $pillarThree = PillarThree::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosque->id,
                'question_one' => $request->input('question_one'),
                'question_two' => $request->input('question_two'),
                'question_three' => $request->input('question_three'),
                'question_four' => $questionFour,
                'option_four' => $request->input('option_four') ?? null,
                'question_five' => $request->input('question_five'),
                'question_six' => $questionSix,
                'option_six' => $request->input('option_six') ?? null,
                'year' => $year
            ]
        );

        $pillarThree->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarThree->file_question_one, 'pillarThrees');
        $pillarThree->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarThree->file_question_four, 'pillarThrees');
        $pillarThree->file_question_six = $this->handleFileUpdate($request, 'file_question_six', $pillarThree->file_question_six, 'pillarThrees');

        $pillarThree->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function administration($user = null, $action = null)
    {
        $year = date('Y');

        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarFour = PillarFour::where('mosque_id', $mosque->id)->where('year', $year)->first();

            return view('pages.form.administration', compact('pillarFour'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarFour = $user->mosque->pillarFour;

            if (!$pillarFour) {
                return redirect()->back()->with('error', 'Peserta belum mengisi formulir Administrasi dan Keuangan');
            }

            $systemAssessment = SystemAssessment::with(['pillarFour'])->where('pillar_four_id', $pillarFour->id)->first();
            $committeeAssessment = CommitteeAssessment::with(['pillarFour'])->where('pillar_four_id', $pillarFour->id)->first();

            return view('pages.form.administration', compact('user', 'pillarFour', 'systemAssessment', 'committeeAssessment'));
        }
    }

    public function administrationAct(Request $request)
    {
        if (
            !$request->input('question_one') &&
            !$request->input('question_two') &&
            !$request->input('question_three') &&
            !$request->input('question_four') &&
            !$request->input('question_five')
        ) {
            return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
        }

        $rules = [
            'question_one' => 'string',
            'question_two' => 'string',
            'question_three' => 'string',
            'question_four' => 'string',
            'question_five' => 'string',
            'file_question_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_two' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_six' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $messages = [
            'question_one.string' => 'Jawaban 1 harus berupa text.',
            'question_four.string' => 'Jawaban 2 harus berupa text.',
            'question_two.string' => 'Jawaban 3 harus berupa text.',
            'question_three.string' => 'Jawaban 4 harus berupa text.',
            'question_five.string' => 'Jawaban 5 harus berupa text.',
            'file_question_one.file' => 'Dokumen harus berbentuk file.',
            'file_question_one.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_two.file' => 'Dokumen harus berbentuk file.',
            'file_question_two.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_four.file' => 'Dokumen harus berbentuk file.',
            'file_question_four.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_six.file' => 'Dokumen harus berbentuk file.',
            'file_question_six.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosque = Auth::user()->mosque;

        $pillarFour = PillarFour::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosque->id,
                'question_one' => $request->input('question_one'),
                'question_two' => $request->input('question_two'),
                'question_three' => $request->input('question_three'),
                'question_four' => $request->input('question_four'),
                'question_five' => $request->input('question_five'),
                'year' => $year
            ]
        );

        $pillarFour->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarFour->file_question_one, 'pillarFours');
        $pillarFour->file_question_two = $this->handleFileUpdate($request, 'file_question_two', $pillarFour->file_question_two, 'pillarFours');
        $pillarFour->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarFour->file_question_four, 'pillarFours');
        $pillarFour->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarFour->file_question_five, 'pillarFours');

        $pillarFour->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function infrastructure($user = null, $action = null)
    {
        $year = date('Y');

        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarFive = PillarFive::where('mosque_id', $mosque->id)->where('year', $year)->first();

            return view('pages.form.infrastructure', compact('pillarFive'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarFive = $user->mosque->pillarFive;

            if (!$pillarFive) {
                return redirect()->back()->with('error', 'Peserta belum mengisi formulir Peribadahan dan Infrastruktur');
            }

            $systemAssessment = SystemAssessment::with(['pillarFive'])->where('pillar_five_id', $pillarFive->id)->first();
            $committeeAssessment = CommitteeAssessment::with(['pillarFive'])->where('pillar_five_id', $pillarFive->id)->first();

            return view('pages.form.infrastructure', compact('user', 'pillarFive', 'systemAssessment', 'committeeAssessment'));
        }
    }

    public function infrastructureAct(Request $request)
    {
        if (
            !$request->input('question_one') &&
            !$request->input('question_two') &&
            !$request->input('question_three') &&
            !$request->input('question_four') &&
            !$request->input('question_five')
        ) {
            return redirect()->back()->with('error', 'Harus mengisi setidaknya salah satu bidang data.');
        }

        $rules = [
            'question_one' => 'string',
            'question_two' => 'string',
            'question_three' => 'string',
            'question_four' => 'string',
            'question_five' => 'string',
            'file_question_two' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_five' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $messages = [
            'question_one.string' => 'Jawaban 1 harus berupa text.',
            'question_two.string' => 'Jawaban 2 harus berupa text.',
            'question_three.string' => 'Jawaban 3 harus berupa text.',
            'question_four.string' => 'Jawaban 4 harus berupa text.',
            'question_five.string' => 'Jawaban 5 harus berupa text.',
            'file_question_two.file' => 'Dokumen harus berbentuk file.',
            'file_question_two.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_three.file' => 'Dokumen harus berbentuk file.',
            'file_question_three.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_four.file' => 'Dokumen harus berbentuk file.',
            'file_question_four.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
            'file_question_five.file' => 'Dokumen harus berbentuk file.',
            'file_question_five.mimes' => 'Dokumen yang diupload harus berformat PDF, JPG, JPEG, atau PNG.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $year = date('Y');
        $mosqueId = Auth::user()->mosque->id;

        $pillarFive = PillarFive::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosqueId,
                'question_one' => $request->input('question_one'),
                'question_two' => $request->input('question_two'),
                'question_three' => $request->input('question_three'),
                'question_four' => $request->input('question_four'),
                'question_five' => $request->input('question_five'),
                'year' => $year
            ]
        );

        $pillarFive->file_question_two = $this->handleFileUpdate($request, 'file_question_two', $pillarFive->file_question_two, 'pillarFives');
        $pillarFive->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarFive->file_question_three, 'pillarFives');
        $pillarFive->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarFive->file_question_four, 'pillarFives');
        $pillarFive->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarFive->file_question_five, 'pillarFives');

        $pillarFive->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function history(Request $request)
    {
        $mosque = Auth::user()->mosque;
        $year = $request->input('tahun', date('Y'));

        if ($mosque) {
            $pillarTwo = PillarTwo::where('mosque_id', $mosque->id)->where('year', $year)->first();
            $pillarOne = PillarOne::where('mosque_id', $mosque->id)->where('year', $year)->first();
            $pillarThree = PillarThree::where('mosque_id', $mosque->id)->where('year', $year)->first();
            $pillarFour = PillarFour::where('mosque_id', $mosque->id)->where('year', $year)->first();
            $pillarFive = PillarFive::where('mosque_id', $mosque->id)->where('year', $year)->first();
            $presentation = Presentation::where('mosque_id', $mosque->id)->where('year', $year)->first();
        }

        return view('pages.form.history', compact('pillarTwo', 'pillarOne', 'pillarThree', 'pillarFour', 'pillarFive', 'presentation'));
    }

    private function handleFileUpdate(Request $request, $inputName, $currentFilePath, $path)
    {
        if ($request->hasFile($inputName)) {
            if ($currentFilePath && Storage::disk('public')->exists(Str::after($currentFilePath, 'storage/'))) {
                Storage::disk('public')->delete(Str::after($currentFilePath, 'storage/'));
            }

            return $this->handleUploadFile($inputName, $request->file($inputName), $path);
        }

        return $currentFilePath;
    }

    private function handleUploadFile($name, $file, $path)
    {
        $fileName = $name . '_' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $fileName, 'public');

        return 'storage/' . $filePath;
    }
}
