<x-user title="Formulir Hubungan DKM dan YAA" name="Formulir Hubungan DKM dan YAA">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('form.index') }}"
                                    class="text-decoration-none">Formulir</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Formulir Hubungan DKM dan YAA</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-block p-2">
                    <nav class="text-end">
                        <a href="{{ route('form.managementRelationship', ['user' => $user->id]) }}" 
                           class="btn btn-primary text-light mb-2 mt-0">Selanjutnya
                           <i class="bi bi-arrow-right" style="margin-left: 1rem; margin-right: 0.5rem"></i>
                        </a>
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
                    <form action="{{ route('form.relationshipAct') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pillarTwo->id ?? '' }}">
                @endif

                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <form id="systemAssessment"
                                    action="{{ route('system_assessment.pillarTwoAct', ['user' => $pillarTwo->mosque->user->id, 'action' => 'penilaian']) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $systemAssessment->id ?? '' }}">
                                    <input type="hidden" name="pillar_two_id" value="{{ $pillarTwo->id }}">

                                    <input type="hidden" name="pillar_two_question_two[]">
                                    <input type="hidden" name="pillar_two_question_three[]">
                                    <input type="hidden" name="pillar_two_question_four[]">
                                    <input type="hidden" name="pillar_two_question_five[]">

                                    <button type="submit" class="btn btn-primary mb-4">Tampilkan Nilai</button>
                                </form>
                            @endif

                            <h5 class="card-title fw-bold mb-3">Kerjasama dengan YAA</h5>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
                                    <form
                                        action="{{ route('committe_assessment.pillarTwoAct', ['user' => $pillarTwo->mosque->user->id, 'action' => 'penilaian']) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="pillar_two_id" value="{{ $pillarTwo->id }}">
                                @endif
                            @endif

                            <!-- Pertanyaan 1 -->
                            <div class="mb-3">
                                <label for="question_two" class="form-label">1. Divisi Sosial Religi</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiSR"
                                        id="belumAda" value="belum_ada"
                                        {{ $pillarTwo ? (in_array('Belum Ada', (array) old('status_divisiSR', json_decode($pillarTwo->question_two ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="belumAda">Belum Ada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiSR"
                                        id="ada" value="ada"
                                        {{ $pillarTwo ? (!in_array('Belum Ada', (array) old('status_divisiSR', json_decode($pillarTwo->question_two ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="ada">Ada</label>
                                </div>
                            </div>

                            <div class="mb-3" id="checkboxContainer">
                                @foreach (['Astra Gema Islami', 'Amaliah Astra Awards', 'Workshop/Seminar/Diskusi/Pelatihan Masjid Astra'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_two[]"
                                            value="{{ $option }}" id="question_two{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_two', json_decode($pillarTwo->question_two ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_two{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_two[]"
                                        value="custom" id="question_two4" data-index="4"
                                        {{ in_array('custom', (array) old('question_two', json_decode($pillarTwo->question_two ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label w-100" for="question_two4">
                                        <input type="text" class="form-control" id="option_two" name="option_two"
                                            value="{{ old('option_two', $pillarTwo->option_two ?? '') }}"
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarTwo && $pillarTwo->file_question_two ? 'mb-2' : 'mb-3' }}">
                                    <label for="file_question_two" class="form-label fw-medium">Dokumen Pendukung
                                        (bisa
                                        lebih dari satu dokumen)</label>
                                    <input class="form-control" type="file" id="file_question_two"
                                        name="file_question_two">

                                    <div class="form-text">Hanya file bertipe zip yang di izinkan.</div>

                                    @error('file_question_two')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarTwo && $pillarTwo->file_question_two)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung
                                            (bisa
                                            lebih dari satu dokumen)</label>
                                    @endif

                                    <a href="{{ url($pillarTwo->file_question_two) }}"
                                        class="text-primary text-decoration-none" download>
                                        Download Dokumen
                                    </a>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_two_question_two == null ? 'N/A' : $systemAssessment->pillar_two_question_two . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_two_question_two == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_two_question_two"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_two_question_two"
                                                id="committee_pillar_two_question_two" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_two_question_two)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_two_question_two', $committeeAssessment->pillar_two_question_two ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_two_question_two', $committeeAssessment->pillar_two_question_two ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_two_question_two', $committeeAssessment->pillar_two_question_two ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_two_question_two', $committeeAssessment->pillar_two_question_two ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Pertanyaan 2 -->
                            <div class="mb-3">
                                <label for="question_three" class="form-label">2. Divisi Layanan Amal</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiLA"
                                        id="belumAda2" value="belum_ada"
                                        {{ $pillarTwo ? (in_array('Belum Ada', (array) old('status_divisiLA', json_decode($pillarTwo->question_three ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="belumAda2">Belum Ada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiLA"
                                        id="ada2" value="ada"
                                        {{ $pillarTwo ? (!in_array('Belum Ada', (array) old('status_divisiLA', json_decode($pillarTwo->question_three ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="ada2">Ada</label>
                                </div>
                            </div>
                            <div class="mb-3" id="checkboxContainer2">
                                @foreach (['Payroll Zakat/Sedekah', 'Kurban', 'Sinergi Event & Kegiatan Lainnya'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_three[]"
                                            value="{{ $option }}" id="question_three{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_three', json_decode($pillarTwo->question_three ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_three{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_three[]"
                                        value="custom" id="question_three4" data-index="4"
                                        {{ in_array('custom', (array) old('question_three', json_decode($pillarTwo->question_three ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label w-100" for="question_three4">
                                        <input type="text" class="form-control" id="option_three"
                                            name="option_three"
                                            value="{{ old('option_three', $pillarTwo->option_three ?? '') }}"
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    </label>
                                </div>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarTwo && $pillarTwo->file_question_three ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarTwo && $pillarTwo->file_question_three)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarTwo->file_question_three, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_two_question_three == null ? 'N/A' : $systemAssessment->pillar_two_question_three . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_two_question_three == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_two_question_three"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_two_question_three"
                                                id="committee_pillar_two_question_three" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_two_question_three)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_two_question_three', $committeeAssessment->pillar_two_question_three ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_two_question_three', $committeeAssessment->pillar_two_question_three ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_two_question_three', $committeeAssessment->pillar_two_question_three ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_two_question_three', $committeeAssessment->pillar_two_question_three ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Pertanyaan 3 -->
                            <div class="mb-3">
                                <label class="form-label" for="question_four">3. Divisi Kemitraan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiK"
                                        id="belumAda3" value="belum_ada"
                                        {{ $pillarTwo ? (in_array('Belum Ada', (array) old('status_divisiK', json_decode($pillarTwo->question_four ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="belumAda3">Belum Ada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiK"
                                        id="ada3" value="ada"
                                        {{ $pillarTwo ? (!in_array('Belum Ada', (array) old('status_divisiK', json_decode($pillarTwo->question_four ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="ada3">Ada</label>
                                </div>
                            </div>
                            <div class="mb-3" id="checkboxContainer3">
                                @foreach (['Perawatan AC', 'Umroh', 'Aqiqah', 'Kegiatan Sinergi lainnya'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_four[]"
                                            value="{{ $option }}" id="question_four{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_four', json_decode($pillarTwo->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_four{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>

                                        {{-- Kondisi untuk "Kegiatan Sinergi lainnya" --}}
                                        @if ($option === 'Kegiatan Sinergi lainnya')
                                            <input type="text" class="form-control mt-2" id="option_four"
                                                name="option_four" placeholder="Kegiatan Sinergi lainnya"
                                                value="{{ old('option_four', $pillarTwo->option_four ?? '') }}"
                                                @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        @endif
                                    </div>
                                @endforeach

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarTwo && $pillarTwo->file_question_four ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarTwo && $pillarTwo->file_question_four)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarTwo->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_two_question_four == null ? 'N/A' : $systemAssessment->pillar_two_question_four . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_two_question_four == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_two_question_four"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_two_question_four"
                                                id="committee_pillar_two_question_four" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_two_question_four)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_two_question_four', $committeeAssessment->pillar_two_question_four ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_two_question_four', $committeeAssessment->pillar_two_question_four ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_two_question_four', $committeeAssessment->pillar_two_question_four ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_two_question_four', $committeeAssessment->pillar_two_question_four ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Pertanyaan 4 -->
                            <div class="mb-3">
                                <label class="form-label">4. Divisi Administrasi & Keuangan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiAK"
                                        id="belumAda4" value="belum_ada"
                                        {{ $pillarTwo ? (in_array('Belum Ada', (array) old('status_divisiAK', json_decode($pillarTwo->question_five ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="belumAda4">Belum Ada</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_divisiAK"
                                        id="ada4" value="ada"
                                        {{ $pillarTwo ? (!in_array('Belum Ada', (array) old('status_divisiAK', json_decode($pillarTwo->question_five ?? '[]', true) ?? '')) ? 'checked' : '') : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label" for="ada4">Ada</label>
                                </div>
                            </div>
                            <div class="mb-3" id="checkboxContainer4">
                                @foreach (['Sudah menggunakan Sistem Aplikasi Keuangan Online YAA', 'Berbagi Informasi di Amaliah.id'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_five[]"
                                            value="{{ $option }}" id="question_five{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_five', json_decode($pillarTwo->question_five ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_five{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarTwo && $pillarTwo->file_question_five ? 'mb-2' : 'mb-3' }}">
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

                            @if ($pillarTwo && $pillarTwo->file_question_five)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarTwo->file_question_five, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_two_question_five == null ? 'N/A' : $systemAssessment->pillar_two_question_five . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-bold">
                                        @if ($systemAssessment->pillar_two_question_five == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-4 row">
                                        <label for="committee_pillar_two_question_five"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_two_question_five"
                                                id="committee_pillar_two_question_five" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_two_question_five)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_two_question_five', $committeeAssessment->pillar_two_question_five ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_two_question_five', $committeeAssessment->pillar_two_question_five ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_two_question_five', $committeeAssessment->pillar_two_question_five ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_two_question_five', $committeeAssessment->pillar_two_question_five ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_two_id ?? '')
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
                const selectedCheckbox1 = $('input[name="question_two[]"]:checked');
                const selectedCheckbox2 = $('input[name="question_three[]"]:checked');
                const selectedCheckbox3 = $('input[name="question_four[]"]:checked');
                const selectedCheckbox4 = $('input[name="question_five[]"]:checked');

                // Jawaban 1
                if (selectedCheckbox1.length) {
                    let indexes = [];
                    selectedCheckbox1.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_two[]"]').val(indexes.join(','));
                }

                // Jawaban 2
                if (selectedCheckbox2.length) {
                    let indexes = [];
                    selectedCheckbox2.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_three[]"]').val(indexes.join(','));
                }

                // Jawaban 3
                if (selectedCheckbox3.length) {
                    let indexes = [];
                    selectedCheckbox3.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_four[]"]').val(indexes.join(','));
                }

                // Jawaban 4
                if (selectedCheckbox4.length) {
                    let indexes = [];
                    selectedCheckbox4.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_five[]"]').val(indexes.join(','));
                }

                // =============================================================================================

                const optionInput2 = document.getElementById('option_two');
                const optionInput3 = document.getElementById('option_three');
                const optionInput4 = document.getElementById('option_four');
                const customCheckbox2 = document.getElementById('question_two4');
                const customCheckbox3 = document.getElementById('question_three4');
                const customCheckbox4 = document.getElementById('question_four4');

                function updateCheckbox() {
                    const trimmedValue2 = optionInput2.value.trim();
                    customCheckbox2.checked = trimmedValue2.length > 0;

                    const trimmedValue3 = optionInput3.value.trim();
                    customCheckbox3.checked = trimmedValue3.length > 0;

                    const trimmedValue4 = optionInput4.value.trim();
                    customCheckbox4.checked = trimmedValue4.length > 0;
                }

                updateCheckbox();

                optionInput2.addEventListener('input', updateCheckbox);
                optionInput3.addEventListener('input', updateCheckbox);
                optionInput4.addEventListener('input', updateCheckbox);

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

                // Pertanyaan 1
                const checkboxContainer = document.getElementById('checkboxContainer');
                const radioBelumAda = document.getElementById('belumAda');
                const radioAda = document.getElementById('ada');

                // Function to toggle checkbox visibility for Pertanyaan 1
                function toggleCheckbox1() {
                    if (radioAda.checked) {
                        checkboxContainer.style.display = 'block';
                    } else {
                        checkboxContainer.style.display = 'none';
                    }
                }

                // Event listeners for Pertanyaan 1
                radioBelumAda.addEventListener('change', toggleCheckbox1);
                radioAda.addEventListener('change', toggleCheckbox1);

                // Initial check for Pertanyaan 1
                toggleCheckbox1();

                // Pertanyaan 2
                const checkboxContainer2 = document.getElementById('checkboxContainer2');
                const radioBelumAda2 = document.getElementById('belumAda2');
                const radioAda2 = document.getElementById('ada2');

                // Function to toggle checkbox visibility for Pertanyaan 2
                function toggleCheckbox2() {
                    if (radioAda2.checked) {
                        checkboxContainer2.style.display = 'block';
                    } else {
                        checkboxContainer2.style.display = 'none';
                    }
                }

                // Event listeners for Pertanyaan 2
                radioBelumAda2.addEventListener('change', toggleCheckbox2);
                radioAda2.addEventListener('change', toggleCheckbox2);

                // Initial check for Pertanyaan 2
                toggleCheckbox2();

                // Pertanyaan 3
                const checkboxContainer3 = document.getElementById('checkboxContainer3');
                const radioBelumAda3 = document.getElementById('belumAda3');
                const radioAda3 = document.getElementById('ada3');

                // Function to toggle checkbox visibility for Pertanyaan 2
                function toggleCheckbox3() {
                    if (radioAda3.checked) {
                        checkboxContainer3.style.display = 'block';
                    } else {
                        checkboxContainer3.style.display = 'none';
                    }
                }

                // Event listeners for Pertanyaan 2
                radioBelumAda3.addEventListener('change', toggleCheckbox3);
                radioAda3.addEventListener('change', toggleCheckbox3);

                // Initial check for Pertanyaan 2
                toggleCheckbox3();

                // Pertanyaan 4
                const checkboxContainer4 = document.getElementById('checkboxContainer4');
                const radioBelumAda4 = document.getElementById('belumAda4');
                const radioAda4 = document.getElementById('ada4');

                // Function to toggle checkbox visibility for Pertanyaan 2
                function toggleCheckbox4() {
                    if (radioAda4.checked) {
                        checkboxContainer4.style.display = 'block';
                    } else {
                        checkboxContainer4.style.display = 'none';
                    }
                }

                // Event listeners for Pertanyaan 2
                radioBelumAda4.addEventListener('change', toggleCheckbox4);
                radioAda4.addEventListener('change', toggleCheckbox4);

                // Initial check for Pertanyaan 2
                toggleCheckbox4();
            });
        </script>
    @endprepend
</x-user>
