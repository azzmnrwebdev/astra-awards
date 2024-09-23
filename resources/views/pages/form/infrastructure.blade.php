<x-user title="Formulir Peribadahan dan Infrastruktur" name="Formulir Peribadahan dan Infrastruktur">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-4">
            @if (Session('success'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-success mb-2" role="alert">
                        {{ Session('success') }}
                    </div>
                </div>
            @endif

            @if (Session('success_assessment'))
                <div class="col-md-10 col-lg-12">
                    <div class="alert alert-success mb-2" role="alert">
                        {{ Session('success_assessment') }}
                    </div>
                </div>
            @endif

            @if (Session('error'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-danger mb-2" role="alert">
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
                    <form action="{{ route('form.infrastructureAct') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pillarFive->id ?? '' }}">
                @endif

                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <form id="systemAssessment"
                                    action="{{ route('system_assessment.pillarFiveAct', ['user' => $pillarFive->mosque->user->id, 'action' => 'penilaian']) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $systemAssessment->id ?? '' }}">
                                    <input type="hidden" name="pillar_five_id" value="{{ $pillarFive->id }}">

                                    <input type="hidden" name="pillar_five_question_one">
                                    <input type="hidden" name="pillar_five_question_two">
                                    <input type="hidden" name="pillar_five_question_three">
                                    <input type="hidden" name="pillar_five_question_four">
                                    <input type="hidden" name="pillar_five_question_five">

                                    <button type="submit" class="btn btn-primary mb-4">Tampilkan Nilai</button>
                                </form>
                            @endif

                            <h5 class="card-title fw-bold mb-3">Kegiatan shalat wajib dan kajian</h5>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <form
                                        action="{{ route('committe_assessment.pillarFiveAct', ['user' => $pillarFive->mosque->user->id, 'action' => 'penilaian']) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="pillar_five_id" value="{{ $pillarFive->id }}">
                                @endif
                            @endif

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label fw-medium">1. Pelaksanaan kegiatan
                                    shalat
                                    wajib
                                    5 waktu berjamaah yang dikelola oleh DKM</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        value="Ada, 2 waktu sholat wajib berjamaah." id="question_one1"
                                        data-index="1"
                                        {{ old('question_one', $pillarFive->question_one ?? '') == 'Ada, 2 waktu sholat wajib berjamaah.' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one1">
                                        Ada, 2 waktu sholat wajib berjamaah.
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one2" value="Ada, 3 waktu sholat wajib berjamaah" data-index="2"
                                        {{ old('question_one', $pillarFive->question_one ?? '') == 'Ada, 3 waktu sholat wajib berjamaah' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one2">
                                        Ada, 3 waktu sholat wajib berjamaah
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one3" value="Ada, 4 waktu sholat wajib berjamaah" data-index="3"
                                        {{ old('question_one', $pillarFive->question_one ?? '') == 'Ada, 4 waktu sholat wajib berjamaah' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one3">
                                        Ada, 4 waktu sholat wajib berjamaah
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one4" value="Ada, 5 waktu sholat wajib berjamaah."
                                        data-index="4"
                                        {{ old('question_one', $pillarFive->question_one ?? '') == 'Ada, 5 waktu sholat wajib berjamaah.' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one4">
                                        Ada, 5 waktu sholat wajib berjamaah.
                                    </label>
                                </div>

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror

                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    @if ($systemAssessment->pillar_five_id ?? '')
                                        <p class="card-text mb-0 mt-2 fw-medium">
                                            Penilaian
                                            Sistem:&nbsp;{{ $systemAssessment->pillar_five_question_one == null ? 'N/A' : $systemAssessment->pillar_five_question_one . ' Poin' }}
                                        </p>
                                        <p class="card-text fw-medium text-danger">
                                            @if ($systemAssessment->pillar_five_question_one == null)
                                                *) Formula tidak tersedia untuk kondisi jawaban
                                            @endif
                                        </p>

                                        <div class="mb-3 row">
                                            <label for="committee_pillar_five_question_one"
                                                class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                                Panitia:</label>
                                            <div class="col-md-8 col-xl-9">
                                                <select name="committee_pillar_five_question_one"
                                                    id="committee_pillar_five_question_one" class="form-select">
                                                    @if (!$committeeAssessment || !$committeeAssessment->pillar_five_question_one)
                                                        <option value="">-- Pilih Nilai --</option>
                                                    @endif

                                                    <option value="1"
                                                        {{ old('committee_pillar_five_question_one', $committeeAssessment->pillar_five_question_one ?? '') == 1 ? 'selected' : '' }}>
                                                        1</option>
                                                    <option value="3"
                                                        {{ old('committee_pillar_five_question_one', $committeeAssessment->pillar_five_question_one ?? '') == 3 ? 'selected' : '' }}>
                                                        3</option>
                                                    <option value="7"
                                                        {{ old('committee_pillar_five_question_one', $committeeAssessment->pillar_five_question_one ?? '') == 7 ? 'selected' : '' }}>
                                                        7</option>
                                                    <option value="9"
                                                        {{ old('committee_pillar_five_question_one', $committeeAssessment->pillar_five_question_one ?? '') == 9 ? 'selected' : '' }}>
                                                        9</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label fw-medium">2. Ada kelompok
                                    ekstrakulikuler
                                    di bawah Masjid/Musala, misal: Tim Multimedia,
                                    Kelompok Tahsin, Kelompok Relawan atau lainnya</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Belum ada" id="question_two1" data-index="1"
                                        {{ old('question_two', $pillarFive->question_two ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)"
                                        id="question_two2" data-index="2"
                                        {{ old('question_two', $pillarFive->question_two ?? '') == 'Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two2">
                                        Ada
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFive && $pillarFive->file_question_two ? 'mb-2' : 'mb-0' }}">
                                    <label for="file_question_two" class="form-label fw-medium">Dokumen
                                        Pendukung</label>
                                    <input class="form-control" type="file" id="file_question_two"
                                        name="file_question_two">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_two')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarFive && $pillarFive->file_question_two)
                                <div class="@if (auth()->check() && auth()->user()->hasRole('admin')) mb-3 @endif">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFive->file_question_two, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_five_question_two == null ? 'N/A' : $systemAssessment->pillar_five_question_two . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_five_question_two == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="row">
                                        <label for="committee_pillar_five_question_two"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_five_question_two"
                                                id="committee_pillar_five_question_two" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_five_question_two)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_five_question_two', $committeeAssessment->pillar_five_question_two ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_five_question_two', $committeeAssessment->pillar_five_question_two ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_five_question_two', $committeeAssessment->pillar_five_question_two ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_five_question_two', $committeeAssessment->pillar_five_question_two ?? '') == 9 ? 'selected' : '' }}>
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
                            <h5 class="card-title fw-bold mb-3">Pengelolaan Kebersihan dan Kerapian</h5>

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-3">
                                <label for="question_three" class="form-label fw-medium">3. Apakah ada petugas
                                    khusus
                                    yang rutin melakukan pekerjaan kebersihan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Tidak ada" id="question_three1" data-index="1"
                                        {{ old('question_three', $pillarFive->question_three ?? '') == 'Tidak ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, tetapi tidak rutin" id="question_three2" data-index="2"
                                        {{ old('question_three', $pillarFive->question_three ?? '') == 'Ada, tetapi tidak rutin' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three2">
                                        Ada, tetapi tidak rutin
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, setiap minggu" id="question_three3" data-index="3"
                                        {{ old('question_three', $pillarFive->question_three ?? '') == 'Ada, setiap minggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three3">
                                        Ada, setiap minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, setiap hari" id="question_three4" data-index="4"
                                        {{ old('question_three', $pillarFive->question_three ?? '') == 'Ada, setiap hari' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_three4">
                                        Ada, setiap hari
                                    </label>
                                </div>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFive && $pillarFive->file_question_three ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarFive && $pillarFive->file_question_three)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFive->file_question_three, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_five_question_three == null ? 'N/A' : $systemAssessment->pillar_five_question_three . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_five_question_three == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_five_question_three"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_five_question_three"
                                                id="committee_pillar_five_question_three" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_five_question_three)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_five_question_three', $committeeAssessment->pillar_five_question_three ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_five_question_three', $committeeAssessment->pillar_five_question_three ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_five_question_three', $committeeAssessment->pillar_five_question_three ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_five_question_three', $committeeAssessment->pillar_five_question_three ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label fw-medium">4. Rutinitas kegiatan
                                    kebersihan Masjid/Musala</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Dibersihkan sebulan sekali" id="question_four1" data-index="1"
                                        {{ old('question_four', $pillarFive->question_four ?? '') == 'Dibersihkan sebulan sekali' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four1">
                                        Dibersihkan sebulan sekali
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Rutin, dibersihkan setiap dua minggu" id="question_four2"
                                        data-index="2"
                                        {{ old('question_four', $pillarFive->question_four ?? '') == 'Rutin, dibersihkan setiap dua minggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four2">
                                        Rutin, dibersihkan setiap dua minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Rutin dibersihkan seminggu" id="question_four3" data-index="3"
                                        {{ old('question_four', $pillarFive->question_four ?? '') == 'Rutin dibersihkan seminggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four3">
                                        Rutin, dibersihkan seminggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Rutin dibersihkan setiap hari" id="question_four4" data-index="4"
                                        {{ old('question_four', $pillarFive->question_four ?? '') == 'Rutin dibersihkan setiap hari' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four4">
                                        Rutin, dibersihkan setiap hari
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFive && $pillarFive->file_question_four ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarFive && $pillarFive->file_question_four)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFive->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_five_question_four == null ? 'N/A' : $systemAssessment->pillar_five_question_four . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_five_question_four == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_five_question_four"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_five_question_four"
                                                id="committee_pillar_five_question_four" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_five_question_four)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_five_question_four', $committeeAssessment->pillar_five_question_four ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_five_question_four', $committeeAssessment->pillar_five_question_four ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_five_question_four', $committeeAssessment->pillar_five_question_four ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_five_question_four', $committeeAssessment->pillar_five_question_four ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label fw-medium">5. Monitoring pekerjaan
                                    kebersihan Masjid/Musala secara berkala</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Tidak ada" id="question_five1" data-index="1"
                                        {{ old('question_five', $pillarFive->question_five ?? '') == 'Tidak ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, setiap dua minggu" id="question_five2" data-index="2"
                                        {{ old('question_five', $pillarFive->question_five ?? '') == 'Ada, setiap dua minggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five2">
                                        Ada, setiap dua minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada setiap minggu" id="question_five3" data-index="3"
                                        {{ old('question_five', $pillarFive->question_five ?? '') == 'Ada setiap minggu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five3">
                                        Ada, setiap minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, setiap hari" id="question_five4" data-index="4"
                                        {{ old('question_five', $pillarFive->question_five ?? '') == 'Ada, setiap hari' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five4">
                                        Ada, setiap hari
                                    </label>
                                </div>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFive && $pillarFive->file_question_five ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarFive && $pillarFive->file_question_five)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFive->file_question_five, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_five_question_five == null ? 'N/A' : $systemAssessment->pillar_five_question_five . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_five_question_five == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-4 row">
                                        <label for="committee_pillar_five_question_five"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_five_question_five"
                                                id="committee_pillar_five_question_five" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_five_question_five)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_five_question_five', $committeeAssessment->pillar_five_question_five ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_five_question_five', $committeeAssessment->pillar_five_question_five ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_five_question_five', $committeeAssessment->pillar_five_question_five ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_five_question_five', $committeeAssessment->pillar_five_question_five ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_five_id ?? '')
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                                    </div>

                                    </form>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                </form>
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
                    $('input[name="pillar_five_question_one"]').val(index);
                }

                // Jawaban 2
                if (selectedRadio2.length) {
                    const index = selectedRadio2.data('index');
                    $('input[name="pillar_five_question_two"]').val(index);
                }

                // Jawaban 3
                if (selectedRadio3.length) {
                    const index = selectedRadio3.data('index');
                    $('input[name="pillar_five_question_three"]').val(index);
                }

                // Jawaban 4
                if (selectedRadio4.length) {
                    const index = selectedRadio4.data('index');
                    $('input[name="pillar_five_question_four"]').val(index);
                }

                // Jawaban 5
                if (selectedRadio5.length) {
                    const index = selectedRadio5.data('index');
                    $('input[name="pillar_five_question_five"]').val(index);
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
