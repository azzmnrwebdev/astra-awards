<x-user title="Formulir Program Sosial" name="Formulir Program Sosial">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('form.index') }}"
                                    class="text-decoration-none">Formulir</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Formulir Program Sosial</li>
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
                    <form action="{{ route('form.programAct') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $pillarThree->id ?? '' }}">
                @endif

                <div class="col mb-4">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <form id="systemAssessment"
                                    action="{{ route('system_assessment.pillarThreeAct', ['user' => $pillarThree->mosque->user->id, 'action' => 'penilaian']) }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $systemAssessment->id ?? '' }}">
                                    <input type="hidden" name="pillar_three_id" value="{{ $pillarThree->id }}">

                                    <input type="hidden" name="pillar_three_question_one">
                                    <input type="hidden" name="pillar_three_question_two">
                                    <input type="hidden" name="pillar_three_question_three">
                                    <input type="hidden" name="pillar_three_question_four[]">
                                    <input type="hidden" name="pillar_three_question_five">
                                    <input type="hidden" name="pillar_three_question_six[]">

                                    <button type="submit" class="btn btn-primary mb-4">Tampilkan Nilai</button>
                                </form>
                            @endif

                            <h5 class="card-title fw-bold mb-3">Program Sosial yang dikelola DKM</h5>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <form
                                        action="{{ route('committe_assessment.pillarThreeAct', ['user' => $pillarThree->mosque->user->id, 'action' => 'penilaian']) }}"
                                        method="POST">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input type="hidden" name="pillar_three_id" value="{{ $pillarThree->id }}">
                                @endif
                            @endif

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label">1. Bentuk Program Sosial yang Dikelola
                                    oleh
                                    DKM</label>
                                @foreach (['Bantuan sosial sesekali, dilaksanakan insidental (ex. Bantuan bencana).', 'Bantuan sosial di momen-momen tertentu (ex. Santunan di PHBI dll).', 'Bantuan sosial dan program pemberdayaan (program non pemberdayaan masih mendominasi).', 'Program pemberdayaan 4 pilar (pendidikan, ekonomi, lingkungan dan kesehatan).'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_one"
                                            value="{{ $option }}" id="question_one{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ old('question_one', $pillarThree->question_one ?? '') == $option ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_one{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_one == null ? 'N/A' : $systemAssessment->pillar_three_question_one . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_one == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_three_question_one"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_one"
                                                id="committee_pillar_three_question_one" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_one)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_one', $committeeAssessment->pillar_three_question_one ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_one', $committeeAssessment->pillar_three_question_one ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_one', $committeeAssessment->pillar_three_question_one ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_one', $committeeAssessment->pillar_three_question_one ?? '') == 9 ? 'selected' : '' }}>
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
                            <h5 class="card-title fw-bold mb-3">Informasi Penerima Manfaat</h5>

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label">2. Penerima Manfaat Program
                                    Sosial</label>
                                @foreach (['Belum ada Penerima Manfaat.', 'Ring 1 perusahaan.', 'Ring 1 dan di luar Ring 1 Perusahaan.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_two"
                                            value="{{ $option }}" id="question_two{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ old('question_two', $pillarThree->question_two ?? '') == $option ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_two{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_two == null ? 'N/A' : $systemAssessment->pillar_three_question_two . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_two == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_three_question_two"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_two"
                                                id="committee_pillar_three_question_two" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_two)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_two', $committeeAssessment->pillar_three_question_two ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_two', $committeeAssessment->pillar_three_question_two ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_two', $committeeAssessment->pillar_three_question_two ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_two', $committeeAssessment->pillar_three_question_two ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-3">
                                <label for="question_three" class="form-label">3. Jumlah Penerima
                                    Manfaat</label>
                                <select class="form-select" name="question_three" id="question_three"
                                    @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    @foreach (['Belum ada', 'Kurang dari 100', '100 sampai 1000', 'Lebih dari 1000'] as $key => $option)
                                        <option value="{{ $option }}" data-index="{{ $key + 1 }}"
                                            {{ old('question_three', $pillarThree->question_three ?? '') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_three == null ? 'N/A' : $systemAssessment->pillar_three_question_three . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_three == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_three_question_three"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_three"
                                                id="committee_pillar_three_question_three" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_three)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_three', $committeeAssessment->pillar_three_question_three ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_three', $committeeAssessment->pillar_three_question_three ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_three', $committeeAssessment->pillar_three_question_three ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_three', $committeeAssessment->pillar_three_question_three ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label">4. Sumber Pembiayaan</label>
                                @foreach (['Kotak amal masjid.', 'Sumbangan jamaah atau karyawan via transfer.', 'Sumbangan dari perusahaan.', 'Sumbangan via digital (QRIS dll).', 'Sumbangan via payroll.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_four[]"
                                            value="{{ $option }}" id="question_four{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_four', json_decode($pillarThree->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_four{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_four[]"
                                        value="custom" id="question_four6" data-index="6"
                                        {{ in_array('custom', (array) old('question_four', json_decode($pillarThree->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label w-100" for="question_four6">
                                        <input type="text" class="form-control" id="option_four"
                                            name="option_four"
                                            value="{{ old('option_four', $pillarThree->option_four ?? '') }}"
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div class="{{ $pillarThree && $pillarThree->file_question_four ? 'mb-2' : 'mb-0' }}">
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

                            @if ($pillarThree && $pillarThree->file_question_four)
                                <div class="@if (auth()->check() && auth()->user()->hasRole('admin')) mb-3 @endif">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen Pendukung</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarThree->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <p class="card-text fw-medium text-danger">
                                    @if ($pillarThree->file_question_four == null)
                                        *) Dokumen Pendukung: N/A
                                    @endif
                                </p>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_four == null ? 'N/A' : $systemAssessment->pillar_three_question_four . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_four == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="row">
                                        <label for="committee_pillar_three_question_four"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_four"
                                                id="committee_pillar_three_question_four" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_four)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_four', $committeeAssessment->pillar_three_question_four ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_four', $committeeAssessment->pillar_three_question_four ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_four', $committeeAssessment->pillar_three_question_four ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_four', $committeeAssessment->pillar_three_question_four ?? '') == 9 ? 'selected' : '' }}>
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
                            <h5 class="card-title fw-bold mb-3">Sustainability DKM</h5>

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label">5. Program Keberlanjutan
                                    (Sustainability) di
                                    DKM</label>
                                <textarea class="form-control" name="question_five" rows="5"
                                    @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>{{ old('question_five', $pillarThree->question_five ?? '') }}</textarea>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_five == null ? 'N/A' : $systemAssessment->pillar_three_question_five . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_five == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-3 row">
                                        <label for="committee_pillar_three_question_five"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_five"
                                                id="committee_pillar_three_question_five" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_five)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_five', $committeeAssessment->pillar_three_question_five ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_five', $committeeAssessment->pillar_three_question_five ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_five', $committeeAssessment->pillar_three_question_five ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_five', $committeeAssessment->pillar_three_question_five ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Pertanyaan 6 --}}
                            <div class="mb-3">
                                <label for="question_six" class="form-label">6. Program yang terkait keberlanjutan
                                    (sustainability)</label>
                                @foreach (['Hemat Air.', 'Hemat Listrik.', 'Pengelolaan sampah.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_six[]"
                                            value="{{ $option }}" id="question_six{{ $loop->index + 1 }}"
                                            data-index="{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_six', json_decode($pillarThree->question_six ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_six{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_six[]"
                                        value="custom" id="question_six4" data-index="4"
                                        {{ in_array('custom', (array) old('question_six', json_decode($pillarThree->question_six ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                        @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    <label class="form-check-label w-100" for="question_six4">
                                        <input type="text" class="form-control" id="option_six" name="option_six"
                                            placeholder="Lainnya.."
                                            value="{{ old('option_six', $pillarThree->option_six ?? '') }}"
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                    </label>
                                </div>

                                @error('question_six')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if (auth()->check() && auth()->user()->hasRole('user'))
                                <div
                                    class="{{ $pillarThree && $pillarThree->file_question_six ? 'mb-2' : 'mb-3 mb-md-4' }}">
                                    <label for="file_question_six" class="form-label fw-medium">Upload dokumen
                                        poster,
                                        foto screen shoot dan lain-lain yang menunjukkan bukti Astra Sustainability
                                        Aspiration</label>
                                    <input class="form-control" type="file" id="file_question_six"
                                        name="file_question_six">

                                    <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                        izinkan.</div>

                                    @error('file_question_six')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>
                            @endif

                            @if ($pillarThree && $pillarThree->file_question_six)
                                <div class="mb-3">
                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                        <label class="form-label fw-medium d-block">Dokumen poster, foto screen
                                            shoot dan lain-lain yang menunjukkan bukti Astra Sustainability
                                            Aspiration</label>
                                    @endif

                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarThree->file_question_six, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <p class="card-text fw-medium text-danger">
                                    @if ($pillarThree->file_question_four == null)
                                        *) Dokumen Pendukung: N/A
                                    @endif
                                </p>
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <p class="card-text mb-0 mt-2 fw-medium">
                                        Penilaian
                                        Sistem:&nbsp;{{ $systemAssessment->pillar_three_question_six == null ? 'N/A' : $systemAssessment->pillar_three_question_six . ' Poin' }}
                                    </p>
                                    <p class="card-text fw-medium text-danger">
                                        @if ($systemAssessment->pillar_three_question_six == null)
                                            *) Formula tidak tersedia untuk kondisi jawaban
                                        @endif
                                    </p>

                                    <div class="mb-4 row">
                                        <label for="committee_pillar_three_question_six"
                                            class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                            Panitia:</label>
                                        <div class="col-md-8 col-xl-9">
                                            <select name="committee_pillar_three_question_six"
                                                id="committee_pillar_three_question_six" class="form-select">
                                                @if (!$committeeAssessment || !$committeeAssessment->pillar_three_question_six)
                                                    <option value="">-- Pilih Nilai --</option>
                                                @endif

                                                <option value="1"
                                                    {{ old('committee_pillar_three_question_six', $committeeAssessment->pillar_three_question_six ?? '') == 1 ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="3"
                                                    {{ old('committee_pillar_three_question_six', $committeeAssessment->pillar_three_question_six ?? '') == 3 ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="7"
                                                    {{ old('committee_pillar_three_question_six', $committeeAssessment->pillar_three_question_six ?? '') == 7 ? 'selected' : '' }}>
                                                    7</option>
                                                <option value="9"
                                                    {{ old('committee_pillar_three_question_six', $committeeAssessment->pillar_three_question_six ?? '') == 9 ? 'selected' : '' }}>
                                                    9</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                @if ($systemAssessment->pillar_three_id ?? '')
                                    <div class="mb-4 text-end">
                                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                                    </div>

                                    <hr/>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('form.managementRelationship', ['user' => $pillarThree->mosque->user->id, 'action' => 'penilaian']) }}"
                                            class="btn btn-outline-dark">Sebelumnya</a>
                                        <a href="{{ route('form.administration', ['user' => $pillarThree->mosque->user->id, 'action' => 'penilaian']) }}"
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
                                    <a href="{{ route('form.managementRelationship') }}"
                                        class="btn btn-outline-dark">Sebelumnya</a>
                                    <a href="{{ route('form.administration') }}"
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
                const selectedRadio2 = $('input[name="question_two"]:checked');
                const selectedOption = $('select[name="question_three"] option:selected');
                const selectedCheckbox1 = $('input[name="question_four[]"]:checked');
                const textInput = $('textarea[name="question_five"]').val();
                const selectedCheckbox2 = $('input[name="question_six[]"]:checked');

                // Jawaban 1
                if (selectedRadio1.length) {
                    const index = selectedRadio1.data('index');
                    $('input[name="pillar_three_question_one"]').val(index);
                }

                // Jawaban 2
                if (selectedRadio2.length) {
                    const index = selectedRadio2.data('index');
                    $('input[name="pillar_three_question_two"]').val(index);
                }

                // Jawaban 3
                const dataIndex = selectedOption.data('index');
                $('input[name="pillar_three_question_three"]').val(dataIndex);

                // Jawaban 4
                if (selectedCheckbox1.length) {
                    let indexes = [];
                    selectedCheckbox1.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_three_question_four[]"]').val(indexes.join(','));
                }

                // Jawaban 5
                if ($.trim(textInput) !== "") {
                    $('input[name="pillar_three_question_five"]').val(9);
                } else {
                    $('input[name="pillar_three_question_five"]').val(1);
                }

                // Jawaban 6
                if (selectedCheckbox2.length) {
                    let indexes = [];
                    selectedCheckbox2.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_three_question_six[]"]').val(indexes.join(','));
                }

                // =============================================================================================

                const optionInput4 = document.getElementById('option_four');
                const optionInput6 = document.getElementById('option_six');
                const customCheckbox4 = document.getElementById('question_four6');
                const customCheckbox6 = document.getElementById('question_six4');

                function updateCheckbox() {
                    const trimmedValue4 = optionInput4.value.trim();
                    customCheckbox4.checked = trimmedValue4.length > 0;

                    const trimmedValue6 = optionInput6.value.trim();
                    customCheckbox6.checked = trimmedValue6.length > 0;
                }

                updateCheckbox();

                optionInput4.addEventListener('input', updateCheckbox);
                optionInput6.addEventListener('input', updateCheckbox);

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
