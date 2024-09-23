<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationFailed;
use App\Mail\VerificationSuccess;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $theadName = [
            ['class' => 'text-center py-3', 'label' => 'No'],
            ['class' => 'text-start py-3', 'label' => 'Nama'],
            ['class' => 'text-center py-3', 'label' => 'Perusahaan'],
            ['class' => 'text-center py-3', 'label' => 'Nomor Ponsel'],
            ['class' => 'text-center py-3', 'label' => 'Status Akun'],
            ['class' => 'text-center py-3', 'label' => 'Tanggal Bergabung'],
            ['class' => 'text-center py-3', 'label' => 'Aksi'],
        ];

        $companies = Company::all();

        $companyId = $request->input('perusahaan');
        $status = $request->input('status');
        $search = $request->input('pencarian');

        $query = User::with(['mosque.company'])->where('role', 'user');

        if ($companyId) {
            $query->whereHas('mosque', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });
        }

        if ($status !== null) {
            $query->where('status', (int)$status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereRaw('LOWER(users.phone_number) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhereHas('mosque.company', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($search) . '%']);
                    });
            });
        }

        // $query = User::query()
        //     ->select('users.*', 'companies.name as perusahaan')
        //     ->join('mosques', 'users.id', '=', 'mosques.user_id')
        //     ->join('companies', 'mosques.company_id', '=', 'companies.id')
        //     ->where('users.role', 'user');

        // if (!empty($search)) {
        //     if ($status == 2) {
        //         $query->whereRaw('LOWER(companies.name) LIKE ?', ['%' . strtolower($search) . '%']);
        //     } else {
        //         $query->where(function ($q) use ($search) {
        //             $q->whereRaw('LOWER(users.name) LIKE ?', ['%' . strtolower($search) . '%'])
        //                 ->orWhereRaw('LOWER(users.email) LIKE ?', ['%' . strtolower($search) . '%'])
        //                 ->orWhereRaw('LOWER(users.phone_number) LIKE ?', ['%' . strtolower($search) . '%']);
        //         });
        //     }
        // }

        // if ($status !== null) {
        //     if ($status != 2)
        //         $query->where('users.status', $status);
        // }

        $users = $query->orderByDesc('users.updated_at')->latest('users.created_at')->paginate(10);

        return view('admin.pages.user.index', compact('theadName', 'companies', 'companyId', 'status', 'search', 'users'));
    }

    public function show(User $user)
    {
        return view('admin.pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string',
            'phone_number' => 'nullable|numeric|unique:users,phone_number,' . $user->id,
            'email' => 'required|string|email|unique:users,email,' . $user->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user->update([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
            ]);

            return redirect(route('user.show', ['user' => $user->id]))->with('success', 'DKM berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui DKM: ' . $e->getMessage());
        }
    }

    public function editStatus(User $user)
    {
        if ($user->status === 0) {
            return view('admin.pages.user.edit-status', compact('user'));
        } else {
            return redirect()->back()->with('error', 'DKM ini sudah aktif dan tidak bisa akses halaman edit status');
        }
    }

    public function updateStatus(Request $request, User $user)
    {
        $rules = [
            'status' => 'required|in:0,1,2',
        ];

        if ($request->input('status') == 2) {
            $rules['rejection_reason'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $previousStatus = $user->status;

            $user->update([
                'status' => $request->input('status'),
            ]);

            if ($previousStatus == 0 && $request->input('status') == 0) {
                DB::rollBack();

                return redirect()->back()->with('error', 'Pilih status disetujui atau ditolak');
            }

            if ($previousStatus == 0 && $request->input('status') == 2) {
                $this->invalidateUserSession($user->id);

                $mosque = $user->mosque;

                $this->deleteFileIfExists($mosque->logo);

                $mosque->delete();
                $user->delete();

                Mail::to($user->email)->send(new VerificationFailed($user, $request->input('rejection_reason')));

                DB::commit();

                return redirect(route('user.index'))->with('success', 'Akun DKM telah ditolak dan DKM telah dikeluarkan.');
            }

            if ($previousStatus == 0 && $request->input('status') == 1) {
                Mail::to($user->email)->send(new VerificationSuccess($user));

                DB::commit();
            }

            return redirect(route('user.index'))->with('success', 'DKM berhasil disetujui');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memverifikasi status DKM: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->input('name_confirmation') !== $user->name) {
            return redirect()->back()->with('error', 'Nama yang dikonfirmasi tidak cocok dengan nama DKM');
        }

        try {
            DB::transaction(function () use ($user) {
                if ($user->mosque) {
                    $mosque = $user->mosque;

                    $this->deleteFileIfExists($mosque->logo);

                    $this->deletePillar($mosque->pillarOne);
                    $this->deletePillar($mosque->pillarTwo);
                    $this->deletePillar($mosque->pillarThree);
                    $this->deletePillar($mosque->pillarFour);
                    $this->deletePillar($mosque->pillarFive);

                    if ($mosque->presentation) {
                        $this->deleteFileIfExists($mosque->presentation->file);
                        $mosque->presentation->delete();
                    }

                    $mosque->delete();
                }

                $user->delete();
            });

            return redirect()->back()->with('success', 'DKM berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus DKM: ' . $e->getMessage());
        }
    }

    private function deletePillar($pillar)
    {
        if ($pillar) {
            foreach ($pillar->getFillable() as $field) {
                if (strpos($field, 'file_question') !== false) {
                    $this->deleteFileIfExists($pillar->$field);
                }
            }

            $pillar->delete();
        }
    }

    private function deleteFileIfExists($file)
    {
        if (!empty($file) && Storage::disk('public')->exists(Str::after($file, 'storage/'))) {
            Storage::disk('public')->delete(Str::after($file, 'storage/'));
        }
    }

    protected function invalidateUserSession($userId)
    {
        $sessions = DB::table('sessions')->where('user_id', $userId)->get();

        foreach ($sessions as $session) {
            Session::getHandler()->destroy($session->id);
        }
    }
}
