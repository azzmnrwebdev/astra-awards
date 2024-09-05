<?php

namespace App\Http\Controllers;

use App\Models\PillarFive;
use App\Models\PillarFour;
use App\Models\PillarOne;
use App\Models\PillarThree;
use App\Models\PillarTwo;
use App\Models\SystemAssessment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        $pillarOnes = User::where('role', 'user')
            ->whereHas('mosque.pillarOne')
            ->paginate(10);

        $pillarTwos = User::where('role', 'user')
            ->whereHas('mosque.pillarTwo')
            ->paginate(10);

        $pillarThrees = User::where('role', 'user')
            ->whereHas('mosque.pillarThree')
            ->paginate(10);

        $pillarFours = User::where('role', 'user')
            ->whereHas('mosque.pillarFour')
            ->paginate(10);

        $pillarFives = User::where('role', 'user')
            ->whereHas('mosque.pillarFive')
            ->paginate(10);

        return view('pages.form.index', compact('pillarOnes', 'pillarTwos', 'pillarThrees', 'pillarFours', 'pillarFives'));
    }

    public function managementRelationship($user = null, $action = null)
    {
        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarOne = PillarOne::where('mosque_id', $mosque->id)->first();

            return view('pages.form.management-relationship', compact('pillarOne'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarOne = $user->mosque->pillarOne;

            $systemAssessment = SystemAssessment::with(['pillarOne'])->where('pillar_one_id', $pillarOne->id)->first();

            if ($systemAssessment) {
                $totalValue = $systemAssessment->pillar_one_question_one + $systemAssessment->pillar_one_question_two + $systemAssessment->pillar_one_question_three + $systemAssessment->pillar_one_question_four + $systemAssessment->pillar_one_question_five;
                return view('pages.form.management-relationship', compact('user', 'pillarOne', 'systemAssessment', 'totalValue'));
            }

            return view('pages.form.management-relationship', compact('user', 'pillarOne', 'systemAssessment'));
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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        if (!$user && !$action) {
            $mosque = Auth::user()->mosque;

            if (!$mosque) {
                return redirect(route('form.index'));
            }

            $pillarTwo = PillarTwo::where('mosque_id', $mosque->id)->first();

            return view('pages.form.relationship', compact('pillarTwo'));
        } else {
            $user = User::where('id', $user)->first();
            $pillarTwo = $user->mosque->pillarTwo;

            $systemAssessment = SystemAssessment::with(['pillarTwo'])->where('pillar_two_id', $pillarTwo->id)->first();

            if ($systemAssessment) {
                $totalValue = $systemAssessment->pillar_two_question_one + $systemAssessment->pillar_two_question_two + $systemAssessment->pillar_two_question_three + $systemAssessment->pillar_two_question_four + $systemAssessment->pillar_two_question_five;
                return view('pages.form.relationship', compact('user', 'pillarTwo', 'systemAssessment', 'totalValue'));
            }

            return view('pages.form.relationship', compact('user', 'pillarTwo', 'systemAssessment'));
        }
    }

    public function relationshipAct(Request $request)
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
            'file_question_two' => 'file|mimes:zip',
            'file_question_three' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mosque = Auth::user()->mosque;
        $questionTwo = $request->input('question_two', []);
        $questionThree = $request->input('question_three', []);
        $questionFour = $request->input('question_four', []);
        $optionTwoValue = $request->input('option_two', '');
        $optionThreeValue = $request->input('option_three', '');
        $optionFourValue = $request->input('option_four', '');

        if (empty($questionTwo)) {
            $questionTwo = null;
        } else {
            if (!empty($optionTwoValue)) {
                if (!in_array('custom', $questionTwo)) {
                    $questionTwo[] = 'custom';
                }
            } else {
                $questionTwo = array_filter($questionTwo, function ($value) {
                    return $value !== 'custom';
                });
            }

            $questionTwo = json_encode($questionTwo);
        }

        if (empty($questionThree)) {
            $questionThree = null;
        } else {
            if (!empty($optionThreeValue)) {
                if (!in_array('custom', $questionThree)) {
                    $questionThree[] = 'custom';
                }
            } else {
                $questionThree = array_filter($questionThree, function ($value) {
                    return $value !== 'custom';
                });
            }

            $questionThree = json_encode($questionThree);
        }

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

        $pillarTwo = PillarTwo::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'mosque_id' => $mosque->id,
                'question_one' => $request->input('question_one'),
                'question_two' => $questionTwo,
                'option_two' => $request->input('option_two') ?? null,
                'question_three' => $questionThree,
                'option_three' => $request->input('option_three') ?? null,
                'question_four' => $questionFour,
                'option_four' => $request->input('option_four') ?? null,
                'question_five' => json_encode($request->input('question_five')),
            ]
        );

        $pillarTwo->file_question_two = $this->handleFileUpdate($request, 'file_question_two', $pillarTwo->file_question_two, 'pillarTwos');
        $pillarTwo->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarTwo->file_question_three, 'pillarTwos');
        $pillarTwo->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarTwo->file_question_four, 'pillarTwos');

        $pillarTwo->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function program()
    {
        $mosqueId = Auth::user()->mosque->id;
        $pillarThree = PillarThree::where('mosque_id', $mosqueId)->first();

        return view('pages.form.program', compact('pillarThree'));
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
            'question_five' => 'string',
            'file_question_one' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_six' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            ]
        );

        $pillarThree->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarThree->file_question_one, 'pillarThrees');
        $pillarThree->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarThree->file_question_four, 'pillarThrees');
        $pillarThree->file_question_six = $this->handleFileUpdate($request, 'file_question_six', $pillarThree->file_question_six, 'pillarThrees');

        $pillarThree->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function administration()
    {
        $mosqueId = Auth::user()->mosque->id;
        $pillarFour = PillarFour::where('mosque_id', $mosqueId)->first();

        return view('pages.form.administration', compact('pillarFour'));
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
            'file_question_four' => 'file|mimes:pdf,jpg,jpeg,png',
            'file_question_six' => 'file|mimes:pdf,jpg,jpeg,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            ]
        );

        $pillarFour->file_question_one = $this->handleFileUpdate($request, 'file_question_one', $pillarFour->file_question_one, 'pillarFours');
        $pillarFour->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarFour->file_question_four, 'pillarFours');
        $pillarFour->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarFour->file_question_five, 'pillarFours');

        $pillarFour->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function infrastructure()
    {
        $mosqueId = Auth::user()->mosque->id;
        $pillarFive = PillarFive::where('mosque_id', $mosqueId)->first();

        return view('pages.form.infrastructure', compact('pillarFive'));
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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            ]
        );

        $pillarFive->file_question_two = $this->handleFileUpdate($request, 'file_question_two', $pillarFive->file_question_two, 'pillarFives');
        $pillarFive->file_question_three = $this->handleFileUpdate($request, 'file_question_three', $pillarFive->file_question_three, 'pillarFives');
        $pillarFive->file_question_four = $this->handleFileUpdate($request, 'file_question_four', $pillarFive->file_question_four, 'pillarFives');
        $pillarFive->file_question_five = $this->handleFileUpdate($request, 'file_question_five', $pillarFive->file_question_five, 'pillarFives');

        $pillarFive->save();

        return redirect()->back()->with('success', 'Data berhasil disimpan');
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
