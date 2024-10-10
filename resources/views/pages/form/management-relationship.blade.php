<x-user title="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah"
    name="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('form.index') }}"
                                    class="text-decoration-none">Formulir</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Formulir Hubungan Manajemen
                                Perusahaan dengan
                                DKM dan Jamaah</li>
                        </ol>
                    </nav>
                </div>
            </div>

            @if (Session('success'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-success mb-4" role="alert">
                        {{ Session('success') }}
                    </div>
                </div>
            @endif

            @if (Session('error'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-danger mb-4" role="alert">
                        {{ Session('error') }}
                    </div>
                </div>
            @endif

            <div class="col-md-10 col-lg-8">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <div class="col mb-4">
                        <div class="card h-100 border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Informasi Peserta</h5>

                                <img src="{{ asset('storage/' . $user->mosque->logo) }}" alt="Logo"
                                    style="width: 250px;">

                                <div class="table-responsive mt-4">
                                    <table class="table table-borderless text-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Nama Lengkap</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Alamat Email</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Nomor Ponsel</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->phone_number }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Jabatan</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->position }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Status Akun</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">
                                                    @if ($user->status === 1)
                                                        <span class="badge text-bg-success">Aktif</span>
                                                    @else
                                                        <span class="badge text-bg-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Nama Masjid/Musala</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Kategori Masjid/Musala</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->categoryMosque->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Kapasitas Jama'ah</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->capacity }} Jama'ah</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Ketua Pengurus</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->leader }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Email Ketua</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->leader_email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Nomor Ponsel Ketua</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->leader_phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Kategori Area</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->categoryArea->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Perusahaan</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->company->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Induk Perusahaan</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->company->parentCompany->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Lini Bisnis</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->company->businessLine->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Provinsi</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->city->province->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Kota/Kabupaten</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->city->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-0 py-1 fw-medium">Alamat</td>
                                                <td class="px-1 py-1 fw-medium">:</td>
                                                <td class="px-0 py-1">{{ $user->mosque->address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->check() && auth()->user()->hasRole('user'))
                    <form action="{{ route('form.managementRelationshipAct') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pillarOne->id ?? '' }}">
                @endif

                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <form id="systemAssessment"
                                    action="{{ route('system_assessment.pillarOneAct', ['user' => $pillarOne->mosque->user->id, 'action' => 'penilaian']) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $systemAssessment->id ?? '' }}">
                                    <input type="hidden" name="pillar_one_id" value="{{ $pillarOne->id }}">

                                    <input type="hidden" name="pillar_one_question_one">
                                    <input type="hidden" name="pillar_one_question_two">
                                    <input type="hidden" name="pillar_one_question_three">
                                    <input type="hidden" name="pillar_one_question_four">
                                    <input type="hidden" name="pillar_one_question_five">

                                    <button type="submit" class="btn btn-primary mb-4">Tampilkan Nilai</button>
                                </form>
                            @endif

                            <h5 class="card-title fw-bold mb-3">Koordinasi Manajemen dengan Pengurus DKM</h5>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <form
                                        action="{{ route('committe_assessment.pillarOneAct', ['user' => $pillarOne->mosque->user->id, 'action' => 'penilaian']) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="pillar_one_id" value="{{ $pillarOne->id }}">
                                @endif
                            @endif

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label fw-medium">1. Koordinasi Manajemen
                                    dengan Pengurus DKM</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        value="Belum ada" id="question_one1" data-index="1"
                                        {{ old('question_one', $pillarOne->question_one ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one2" value="Ada, hanya pelaporan dokumen" data-index="2"
                                        {{ old('question_one', $pillarOne->question_one ?? '') == 'Ada, hanya pelaporan dokumen' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one2">
                                        Ada, hanya pelaporan dokumen
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one3" value="Ada, rapat tidak rutin dan pelaporan dokumen"
                                        data-index="3"
                                        {{ old('question_one', $pillarOne->question_one ?? '') == 'Ada, rapat tidak rutin dan pelaporan dokumen' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one3">
                                        Ada, rapat tidak rutin dan pelaporan dokumen
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one4" value="Ada, rapat rutin dan pelaporan dokumen"
                                        data-index="4"
                                        {{ old('question_one', $pillarOne->question_one ?? '') == 'Ada, rapat rutin dan pelaporan dokumen' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one4">
                                        Ada, rapat rutin dan pelaporan dokumen
                                    </label>
                                </div>

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarOne && $pillarOne->file_question_one ? 'mb-2' : 'mb-3' }}">
                                    <label for="file_question_one" class="form-label fw-medium">Dokumen
                                        Pendukung</label>
                                    <input class="form-control" type="file" id="file_question_one"
                                        name="file_question_one">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_one')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarOne && $pillarOne->file_question_one)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_one_question_one == null ? 'N/A' : $systemAssessment->pillar_one_question_one . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_one_question_one == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_one_question_one"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_one"
                                                id="committee_pillar_one_question_one" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_one)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_one', $committeeAssessment->pillar_one_question_one ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_one', $committeeAssessment->pillar_one_question_one ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_one', $committeeAssessment->pillar_one_question_one ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_one', $committeeAssessment->pillar_one_question_one ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label fw-medium">2. Kegiatan Bersama antara
                                    DKM
                                    dengan Manajemen Perusahaan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Belum ada" id="question_two1" data-index="1"
                                        {{ old('question_two', $pillarOne->question_two ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        id="question_two2"
                                        value="Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)"
                                        data-index="2"
                                        {{ old('question_two', $pillarOne->question_two ?? '') == 'Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two2">
                                        Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        id="question_two3"
                                        value="Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)"
                                        data-index="3"
                                        {{ old('question_two', $pillarOne->question_two ?? '') == 'Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two3">
                                        Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        id="question_two4"
                                        value="Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat"
                                        data-index="4"
                                        {{ old('question_two', $pillarOne->question_two ?? '') == 'Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two4">
                                        Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div
                                    class="{{ $pillarOne && $pillarOne->file_question_two_three ? 'mb-2' : 'mb-3' }}">
                                    <label for="file_question_two_three" class="form-label fw-medium">Dokumen
                                        penunjang
                                        lainnya(foto & notulensi rapat,dll)</label>

                                    <input class="form-control" type="file" id="file_question_two_three"
                                        name="file_question_two_three">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_two_three')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarOne && $pillarOne->file_question_two_three)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            penunjang
                                            lainnya(foto & notulensi rapat,dll)</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_three, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_one_question_two == null ? 'N/A' : $systemAssessment->pillar_one_question_two . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_one_question_two == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="row mb-3">
                                        <label for="committee_pillar_one_question_two"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_two"
                                                id="committee_pillar_one_question_two" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_two)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_two', $committeeAssessment->pillar_one_question_two ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_two', $committeeAssessment->pillar_one_question_two ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_two', $committeeAssessment->pillar_one_question_two ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_two', $committeeAssessment->pillar_one_question_two ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 3 --}}
                            <div class="{{ $pillarOne && $pillarOne->file_question_two_one ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_two_one" class="form-label fw-medium">3. Dokumen SK
                                    kepengurusan
                                    DKM
                                    dari manajemen</label>

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <input class="form-control" type="file" id="file_question_two_one"
                                        name="file_question_two_one">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>
                                @endif

                                @error('file_question_two_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if ($pillarOne && $pillarOne->file_question_two_one)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @else
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <div class="mb-3">
                                        <p class="card-text fw-medium text-danger">
                                            *) Tidak ada dokumen yang di unggah
                                        </p>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <div class="row mb-3">
                                        <label for="committee_pillar_one_question_three"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_three"
                                                id="committee_pillar_one_question_three" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_three)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_three', $committeeAssessment->pillar_one_question_three ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_three', $committeeAssessment->pillar_one_question_three ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_three', $committeeAssessment->pillar_one_question_three ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_three', $committeeAssessment->pillar_one_question_three ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 4 --}}
                            <div class="{{ $pillarOne && $pillarOne->file_question_two_two ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_two_two" class="form-label fw-medium">4. Dokumen
                                    program
                                    kerja
                                    dan anggaran yang sudah disetujui oleh manajemen</label>

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <input class="form-control" type="file" id="file_question_two_two"
                                        name="file_question_two_two">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>
                                @endif

                                @error('file_question_two_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if ($pillarOne && $pillarOne->file_question_two_two)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_two, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @else
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <div class="mb-3">
                                        <p class="card-text fw-medium text-danger">
                                            *) Tidak ada dokumen yang di unggah
                                        </p>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <div class="row mb-3">
                                        <label for="committee_pillar_one_question_four"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_four"
                                                id="committee_pillar_one_question_four" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_four)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_four', $committeeAssessment->pillar_one_question_four ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_four', $committeeAssessment->pillar_one_question_four ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_four', $committeeAssessment->pillar_one_question_four ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_four', $committeeAssessment->pillar_one_question_four ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Interaksi DKM dengan Jamaah</h5>

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_three" class="form-label fw-medium">5. Media Interaksi dan
                                    Komunikasi dengan Jamaah(mading atau medsos)</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Belum ada" id="question_three1" data-index="1"
                                        {{ old('question_three', $pillarOne->question_three ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per bulan" id="question_three2" data-index="2"
                                        {{ old('question_three', $pillarOne->question_three ?? '') == 'Ada, rutin update per bulan' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three2">
                                        Ada, rutin update per bulan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per minggu" id="question_three3" data-index="3"
                                        {{ old('question_three', $pillarOne->question_three ?? '') == 'Ada, rutin update per minggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three3">
                                        Ada, rutin update per minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per hari" id="question_three4" data-index="4"
                                        {{ old('question_three', $pillarOne->question_three ?? '') == 'Ada, rutin update per hari' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three4">
                                        Ada, rutin update per hari
                                    </label>
                                </div>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarOne && $pillarOne->file_question_three ? 'mb-2' : 'mb-3' }}">
                                    <label for="file_question_three" class="form-label fw-medium">Dokumen
                                        Pendukung</label>
                                    <input class="form-control" type="file" id="file_question_three"
                                        name="file_question_three">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_three')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarOne && $pillarOne->file_question_three)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_three, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_one_question_three == null ? 'N/A' : $systemAssessment->pillar_one_question_three . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_one_question_three == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_one_question_five"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_five"
                                                id="committee_pillar_one_question_five" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_five)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_five', $committeeAssessment->pillar_one_question_five ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_five', $committeeAssessment->pillar_one_question_five ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_five', $committeeAssessment->pillar_one_question_five ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_five', $committeeAssessment->pillar_one_question_five ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 6 --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label fw-medium">6. Memiliki Grup WhatsApp
                                    Jamaah</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Belum ada grup" id="question_four1" data-index="1"
                                        {{ old('question_four', $pillarOne->question_four ?? '') == 'Belum ada grup' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four1">
                                        Belum ada grup WhatsApp
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota kurang dari 10% karyawan muslim" id="question_four2"
                                        data-index="2"
                                        {{ old('question_four', $pillarOne->question_four ?? '') == 'Anggota kurang dari 10% karyawan muslim' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four2">
                                        Anggota kurang dari 10% karyawan muslim
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota 10 sampai 30% karyawan muslim" id="question_four3"
                                        data-index="3"
                                        {{ old('question_four', $pillarOne->question_four ?? '') == 'Anggota 10 sampai 30% karyawan muslim' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four3">
                                        Anggota 10 sampai 30% karyawan muslim
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota lebih dari 30% karyawan muslim" id="question_four4"
                                        data-index="4"
                                        {{ old('question_four', $pillarOne->question_four ?? '') == 'Anggota lebih dari 30% karyawan muslim' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four4">
                                        Anggota lebih dari 30% karyawan muslim
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarOne && $pillarOne->file_question_four ? 'mb-2' : 'mb-3' }}">
                                    <label for="file_question_four" class="form-label fw-medium">Dokumen
                                        Pendukung</label>
                                    <input class="form-control" type="file" id="file_question_four"
                                        name="file_question_four">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_four')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarOne && $pillarOne->file_question_four)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_one_question_four == null ? 'N/A' : $systemAssessment->pillar_one_question_four . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_one_question_four == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_one_question_six"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_six"
                                                id="committee_pillar_one_question_six" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_six)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_six', $committeeAssessment->pillar_one_question_six ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_six', $committeeAssessment->pillar_one_question_six ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_six', $committeeAssessment->pillar_one_question_six ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_six', $committeeAssessment->pillar_one_question_six ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 7 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label fw-medium">7. Program Pembinaan
                                    Keagamaan
                                    Untuk Jamaah</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Tidak ada" id="question_five1" data-index="1"
                                        {{ old('question_five', $pillarOne->question_five ?? '') == 'Tidak ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, tapi tidak rutin" id="question_five2" data-index="2"
                                        {{ old('question_five', $pillarOne->question_five ?? '') == 'Ada, tapi tidak rutin' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five2">
                                        Ada, tapi tidak rutin
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, sebulan sekali" id="question_five3" data-index="3"
                                        {{ old('question_five', $pillarOne->question_five ?? '') == 'Ada, sebulan sekali' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five3">
                                        Ada, sebulan sekali
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, seminggu sekali" id="question_five4" data-index="4"
                                        {{ old('question_five', $pillarOne->question_five ?? '') == 'Ada, seminggu sekali' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five4">
                                        Ada, seminggu sekali
                                    </label>
                                </div>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div
                                    class="{{ $pillarOne && $pillarOne->file_question_five ? 'mb-2' : 'mb-3 mb-md-4' }}">
                                    <label for="file_question_five" class="form-label fw-medium">Dokumen
                                        Pendukung</label>
                                    <input class="form-control" type="file" id="file_question_five"
                                        name="file_question_five">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_five')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarOne && $pillarOne->file_question_five)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_five, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_one_question_five == null ? 'N/A' : $systemAssessment->pillar_one_question_five . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_one_question_five == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-4 row">
                                        <label for="committee_pillar_one_question_seven"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_one_question_seven"
                                                id="committee_pillar_one_question_seven" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_one_question_seven)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_one_question_seven', $committeeAssessment->pillar_one_question_seven ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_one_question_seven', $committeeAssessment->pillar_one_question_seven ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_one_question_seven', $committeeAssessment->pillar_one_question_seven ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_one_question_seven', $committeeAssessment->pillar_one_question_seven ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_one_id ?? '')
                                    <div class="mb-4 text-end">
                                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                                    </div>

                                    <hr/>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('form.relationship', ['user' => $pillarOne->mosque->user->id, 'action' => 'penilaian']) }}"
                                            class="btn btn-outline-dark">Sebelumnya</a>
                                        <a href="{{ route('form.program', ['user' => $pillarOne->mosque->user->id, 'action' => 'penilaian']) }}"
                                            class="btn btn-outline-dark">Selanjutnya</a>
                                    </div>

                                    </form>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="mb-4 text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                                <hr/>

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('form.relationship') }}"
                                        class="btn btn-outline-dark">Sebelumnya</a>
                                    <a href="{{ route('form.program') }}"
                                        class="btn btn-outline-dark">Selanjutnya</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->hasRole('user'))
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentModalLabel">Lihat Dokumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="documentContent"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectedRadio1 = $('input[name="question_one"]:checked');
                const selectedRadio2 = $('input[name="question_two"]:checked');
                const selectedRadio3 = $('input[name="question_three"]:checked');
                const selectedRadio4 = $('input[name="question_four"]:checked');
                const selectedRadio5 = $('input[name="question_five"]:checked');

                // Jawaban 1
                if (selectedRadio1.length) {
                    const index = selectedRadio1.data('index');
                    $('input[name="pillar_one_question_one"]').val(index);
                }

                // Jawaban 2
                if (selectedRadio2.length) {
                    const index = selectedRadio2.data('index');
                    $('input[name="pillar_one_question_two"]').val(index);
                }

                // Jawaban 3
                if (selectedRadio3.length) {
                    const index = selectedRadio3.data('index');
                    $('input[name="pillar_one_question_three"]').val(index);
                }

                // Jawaban 4
                if (selectedRadio4.length) {
                    const index = selectedRadio4.data('index');
                    $('input[name="pillar_one_question_four"]').val(index);
                }

                // Jawaban 5
                if (selectedRadio5.length) {
                    const index = selectedRadio5.data('index');
                    $('input[name="pillar_one_question_five"]').val(index);
                }

                // =============================================================================================

                $('#documentModal').on('show.bs.modal', function(event) {
                    let button = $(event.relatedTarget);
                    let url = button.data('url');
                    let modal = $(this);
                    let documentContent = modal.find('#documentContent');

                    documentContent.html('');

                    if (url.match(/\.(jpg|jpeg|png)$/i)) {
                        documentContent.html('<img src="' + url + '" class="img-fluid" alt="Dokumen Gambar">');
                    } else if (url.match(/\.pdf$/i)) {
                        documentContent.html('<embed src="' + url +
                            '" type="application/pdf" width="100%" height="500px" />');
                    } else {
                        documentContent.html('<p>File format tidak didukung.</p>');
                    }
                });
            });
        </script>
    @endprepend
</x-user>
