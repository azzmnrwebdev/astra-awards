<x-user title="Formulir Administrasi & Keuangan" name="Formulir Administrasi dan Keuangan">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('form.index') }}"
                                    class="text-decoration-none">Formulir</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Formulir Administrasi dan Keuangan
                            </li>
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
                    <form action="{{ route('form.administrationAct') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pillarFour->id ?? '' }}">
                @endif

                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <form id="systemAssessment"
                                    action="{{ route('system_assessment.pillarFourAct', ['user' => $pillarFour->mosque->user->id, 'action' => 'penilaian']) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $systemAssessment->id ?? '' }}">
                                    <input type="hidden" name="pillar_four_id" value="{{ $pillarFour->id }}">

                                    <input type="hidden" name="pillar_four_question_one">
                                    <input type="hidden" name="pillar_four_question_two">
                                    <input type="hidden" name="pillar_four_question_three">
                                    <input type="hidden" name="pillar_four_question_four">
                                    <input type="hidden" name="pillar_four_question_five">

                                    <button type="submit" class="btn btn-primary mb-4">Tampilkan Nilai</button>
                                </form>
                            @endif

                            <h5 class="card-title fw-bold mb-3">Laporan Keuangan</h5>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <form
                                        action="{{ route('committe_assessment.pillarFourAct', ['user' => $pillarFour->mosque->user->id, 'action' => 'penilaian']) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="pillar_four_id" value="{{ $pillarFour->id }}">
                                @endif
                            @endif

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label fw-medium">1. Yayasan Amaliah Astra
                                    sudah
                                    membuat sistem keuangan masjid online, Apakah DKM
                                    sudah menggunakan sistem ini?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        value="Tidak" id="question_one1" data-index="1"
                                        {{ old('question_one', $pillarFour->question_one ?? '') == 'Tidak' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one1">
                                        Tidak
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one2" value="Ya" data-index="2"
                                        {{ old('question_one', $pillarFour->question_one ?? '') == 'Ya' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_one2">
                                        Ya
                                    </label>
                                </div>

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFour && $pillarFour->file_question_one ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarFour && $pillarFour->file_question_one)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_four_question_one == null ? 'N/A' : $systemAssessment->pillar_four_question_one . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_four_question_one == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_four_question_one"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_four_question_one"
                                                id="committee_pillar_four_question_one" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_four_question_one)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_four_question_one', $committeeAssessment->pillar_four_question_one ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_four_question_one', $committeeAssessment->pillar_four_question_one ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_four_question_one', $committeeAssessment->pillar_four_question_one ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_four_question_one', $committeeAssessment->pillar_four_question_one ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- pertanyaan 2  --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label fw-medium">2. Laporan Keuangan
                                    Masjid/Musala</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Belum ada" id="question_four1" data-index="1"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Ada, update lebih dari sebulan yang lalu" id="question_four2"
                                        data-index="2"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Ada, update lebih dari sebulan yang lalu' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four2">
                                        Ada, update lebih dari sebulan yang lalu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Ada, rutin dilakukan evaluasi dan update per bulan" id="question_four3"
                                        data-index="3"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Ada, rutin dilakukan evaluasi dan update per bulan' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four3">
                                        Ada, rutin dilakukan evaluasi dan update per bulan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Ada, rutin update per bulan dan ada pelaporan ke jamaah"
                                        id="question_four4" data-index="4"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Ada, rutin update per bulan dan ada pelaporan ke jamaah' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_four4">
                                        Ada, rutin update per bulan dan ada pelaporan ke jamaah
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFour && $pillarFour->file_question_four ? 'mb-2' : 'mb-0' }}">
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

                            @if ($pillarFour && $pillarFour->file_question_four)
                                <div class="@if (auth()->check() && auth()->user()->hasRole('admin')) mb-3 @endif">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_four_question_four == null ? 'N/A' : $systemAssessment->pillar_four_question_four . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_four_question_four == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="row">
                                        <label for="committee_pillar_four_question_four"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_four_question_four"
                                                id="committee_pillar_four_question_four" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_four_question_four)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_four_question_four', $committeeAssessment->pillar_four_question_four ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_four_question_four', $committeeAssessment->pillar_four_question_four ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_four_question_four', $committeeAssessment->pillar_four_question_four ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_four_question_four', $committeeAssessment->pillar_four_question_four ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Organisasi</h5>

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label fw-medium">3. DKM memiliki pengurus
                                    masjid
                                    dibawah umur 30 tahun?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Tidak ada" id="question_two1" data-index="1"
                                        {{ old('question_two', $pillarFour->question_two ?? '') == 'Tidak ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Ada" id="question_two2" data-index="2"
                                        {{ old('question_two', $pillarFour->question_two ?? '') == 'Ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_two2">
                                        Ada
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_four_question_two == null ? 'N/A' : $systemAssessment->pillar_four_question_two . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_four_question_two == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_four_question_two"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_four_question_two"
                                                id="committee_pillar_four_question_two" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_four_question_two)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_four_question_two', $committeeAssessment->pillar_four_question_two ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_four_question_two', $committeeAssessment->pillar_four_question_two ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_four_question_two', $committeeAssessment->pillar_four_question_two ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_four_question_two', $committeeAssessment->pillar_four_question_two ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_three" class="form-label fw-medium">4. Berapa persen jumlah
                                    pengurus masjid dibawah umur 30 tahun dari total pengurus DKM</label>

                                <select class="form-select" name="question_three"
                                    @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    @foreach (['0-20%', '21-30%', '31-40%', '41-50%'] as $key => $option)
                                        <option value="{{ $option }}" data-index="{{ $key + 1 }}"
                                            {{ old('question_three', $pillarFour->question_three ?? '') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarFour && $pillarFour->file_question_four ? 'mb-2' : 'mb-0' }}">
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

                            @if ($pillarFour && $pillarFour->file_question_four)
                                <div class="@if (auth()->check() && auth()->user()->hasRole('admin')) mb-3 @endif">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_four_question_three == null ? 'N/A' : $systemAssessment->pillar_four_question_three . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_four_question_three == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="row">
                                        <label for="committee_pillar_four_question_three"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_four_question_three"
                                                id="committee_pillar_four_question_three" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_four_question_three)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_four_question_three', $committeeAssessment->pillar_four_question_three ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_four_question_three', $committeeAssessment->pillar_four_question_three ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_four_question_three', $committeeAssessment->pillar_four_question_three ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_four_question_three', $committeeAssessment->pillar_four_question_three ?? '') == 9 ? 'selected' : '' }}>
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
                            <h5 class="card-title fw-bold mb-3">Laporan Tahunan</h5>

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label fw-medium">5. Laporan Kegiatan
                                    dan
                                    keuangan Tahunan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Belum ada" id="question_five1" data-index="1"
                                        {{ old('question_five', $pillarFour->question_five ?? '') == 'Belum ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada" id="question_five2" data-index="2"
                                        {{ old('question_five', $pillarFour->question_five ?? '') == 'Ada' ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="question_five2">
                                        Ada
                                    </label>
                                </div>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div
                                    class="{{ $pillarFour && $pillarFour->file_question_five ? 'mb-2' : 'mb-3 mb-md-4' }}">
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

                            @if ($pillarFour && $pillarFour->file_question_five)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen
                                            Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_five, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_four_question_five == null ? 'N/A' : $systemAssessment->pillar_four_question_five . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_four_question_five == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-4 row">
                                        <label for="committee_pillar_four_question_five"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_four_question_five"
                                                id="committee_pillar_four_question_five" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_four_question_five)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_four_question_five', $committeeAssessment->pillar_four_question_five ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_four_question_five', $committeeAssessment->pillar_four_question_five ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_four_question_five', $committeeAssessment->pillar_four_question_five ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_four_question_five', $committeeAssessment->pillar_four_question_five ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_four_id ?? '')
                                    <div class="mb-4 text-end">
                                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                                    </div>

                                    <hr/>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('form.program', ['user' => $pillarFour->mosque->user->id, 'action' => 'penilaian']) }}"
                                            class="btn btn-outline-dark">Sebelumnya</a>
                                        <a href="{{ route('form.infrastructure', ['user' => $pillarFour->mosque->user->id, 'action' => 'penilaian']) }}"
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
                                    <a href="{{ route('form.program') }}"
                                        class="btn btn-outline-dark">Sebelumnya</a>
                                    <a href="{{ route('form.infrastructure') }}"
                                        class="btn btn-outline-dark">Selanjutnya</a>
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
                const selectedRadio2 = $('input[name="question_four"]:checked');
                const selectedRadio3 = $('input[name="question_two"]:checked');
                const selectedOption = $('select[name="question_three"] option:selected');
                const selectedRadio4 = $('input[name="question_five"]:checked');

                // Jawaban 1
                if (selectedRadio1.length) {
                    const index = selectedRadio1.data('index');
                    $('input[name="pillar_four_question_one"]').val(index);
                }

                // Jawaban 2
                if (selectedRadio2.length) {
                    const index = selectedRadio2.data('index');
                    $('input[name="pillar_four_question_four"]').val(index);
                }

                // Jawaban 3
                if (selectedRadio3.length) {
                    const index = selectedRadio3.data('index');
                    $('input[name="pillar_four_question_two"]').val(index);
                }

                // Jawaban 4
                const dataIndex = selectedOption.data('index');
                $('input[name="pillar_four_question_three"]').val(dataIndex);

                // Jawaban 5
                if (selectedRadio4.length) {
                    const index = selectedRadio4.data('index');
                    $('input[name="pillar_four_question_five"]').val(index);
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
