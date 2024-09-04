<x-user title="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah"
    name="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah">
    <div class="container py-4">
        <form action="{{ route('form.managementRelationshipAct') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if (auth()->check() && auth()->user()->hasRole('user'))
                <input type="hidden" name="id" value="{{ $pillarOne->id ?? '' }}">
            @endif

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
                                    <h5 class="card-title fw-bold mb-3">Informasi DKM</h5>

                                    <p class="card-text mb-0"><span class="fw-medium">Nama:</span> {{ $user->name }}
                                    </p>
                                    <p class="card-text mb-0"><span class="fw-medium">Email:</span> {{ $user->email }}
                                    </p>
                                    <p class="card-text mb-0"><span class="fw-medium">Nomor Ponsel:</span>
                                        {{ $user->phone_number }}</p>

                                    <hr>

                                    <p class="card-text mb-0"><span class="fw-medium">Nama Masjid/Mushala:</span>
                                        {{ $user->mosque->name }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Alamat:</span>
                                        {{ $user->mosque->address }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Kota/Kabupaten:</span>
                                        {{ $user->mosque->city }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Provinsi:</span>
                                        {{ $user->mosque->province->name }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Kapasitas Jamaah:</span>
                                        {{ $user->mosque->capacity }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Kategori Area:</span>
                                        {{ $user->mosque->categoryArea->name }}</p>

                                    <hr>

                                    <p class="card-text mb-0"><span class="fw-medium">Jabatan di DKM:</span>
                                        {{ $user->mosque->position }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Ketua Pengurus DKM:</span>
                                        {{ $user->mosque->leader }}</p>

                                    <hr>

                                    <p class="card-text mb-0"><span class="fw-medium">Perusahaan:</span>
                                        {{ $user->mosque->company->name }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Induk Perusahaan:</span>
                                        {{ $user->mosque->company->parentCompany->name }}</p>
                                    <p class="card-text mb-0"><span class="fw-medium">Lini Bisnis:</span>
                                        {{ $user->mosque->company->businessLine->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col mb-4">
                        <div class="card h-100 border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Koordinasi Manajemen dengan Pengurus DKM</h5>

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
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_one)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_one, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
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
                                        class="{{ $pillarOne && $pillarOne->file_question_two_one ? 'mb-2' : 'mb-3' }}">
                                        <label for="file_question_two_one" class="form-label fw-medium">Dokumen SK
                                            kepengurusan
                                            DKM
                                            dari manajemen</label>
                                        <input class="form-control" type="file" id="file_question_two_one"
                                            name="file_question_two_one">
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_two_one)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_two_one, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <div
                                        class="{{ $pillarOne && $pillarOne->file_question_two_two ? 'mb-2' : 'mb-3' }}">
                                        <label for="file_question_two_two" class="form-label fw-medium">Dokumen
                                            program
                                            kerja
                                            dan anggaran yang sudah disetujui oleh manajemen</label>
                                        <input class="form-control" type="file" id="file_question_two_two"
                                            name="file_question_two_two">
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_two_two)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_two_two, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <div
                                        class="{{ $pillarOne && $pillarOne->file_question_two_three ? 'mb-2' : 'mb-0' }}">
                                        <label for="file_question_two_three" class="form-label fw-medium">Dokumen
                                            penunjang
                                            lainnya(foto & notulensi rapat,dll)</label>
                                        <input class="form-control" type="file" id="file_question_two_three"
                                            name="file_question_two_three">
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_two_three)
                                    <div class="mb-0">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_two_three, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card h-100 border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Interaksi DKM dengan Jamaah</h5>

                                {{-- Pertanyaan 3 --}}
                                <div class="mb-3">
                                    <label for="question_three" class="form-label fw-medium">3. Media Interaksi dan
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
                                    <div
                                        class="{{ $pillarOne && $pillarOne->file_question_three ? 'mb-2' : 'mb-3' }}">
                                        <label for="file_question_three" class="form-label fw-medium">Dokumen
                                            Pendukung</label>
                                        <input class="form-control" type="file" id="file_question_three"
                                            name="file_question_three">
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_three)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_three, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                {{-- Pertanyaan 4 --}}
                                <div class="mb-3">
                                    <label for="question_four" class="form-label fw-medium">4. Memiliki Grup WhatsApp
                                        Jamaah</label>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_four"
                                            value="Update per minggu" id="question_four1" data-index="1"
                                            {{ old('question_four', $pillarOne->question_four ?? '') == 'Update per minggu' ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label" for="question_four1">
                                            Update per minggu
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
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_four)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_four, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                {{-- Pertanyaan 5 --}}
                                <div class="mb-3">
                                    <label for="question_five" class="form-label fw-medium">5. Program Pembinaan
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
                                    </div>
                                @endif

                                @if ($pillarOne && $pillarOne->file_question_five)
                                    <div class="mb-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-indexe="modal" data-indext="#documentModal" data-indexurl('/' .
                                            ltrim($pillarOne->file_question_five, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <div class="col-md-10 col-lg-4" style="z-index: 3;">
                        <div class="card border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <form id="systemAssessment" action="{{ route('system_assessment.pillarOneAct') }}"
                                    method="POST">
                                    @csrf

                                    <input type="hidden" name="pillar_one_id" value="{{ $pillarOne->id }}">

                                    <input type="hidden" name="pillar_one_question_one">
                                    <input type="hidden" name="pillar_one_question_two">
                                    <input type="hidden" name="pillar_one_question_three">
                                    <input type="hidden" name="pillar_one_question_four">
                                    <input type="hidden" name="pillar_one_question_five">

                                    <button type="submit" class="btn btn-primary">Tampilkan Nilai</button>
                                </form>

                                <hr />

                                <h5 class="card-title">Niai Berdasarkan Sistem</h5>

                                @if ($systemAssessment)
                                    <p class="card-text mb-0 fw-bold"><span class="fw-medium">1. Koordinasi Manajemen
                                            dengan
                                            Pengurus DKM</span>
                                        ({{ $systemAssessment->pillar_one_question_one ?? 0 }} Poin)</p>
                                    <p class="card-text mb-0 fw-bold"><span class="fw-medium">2. Kegiatan Bersama
                                            antara DKM
                                            dengan Manajemen Perusahaan</span>
                                        ({{ $systemAssessment->pillar_one_question_two ?? 0 }} Poin)</p>
                                    <p class="card-text mb-0 fw-bold"><span class="fw-medium">3. Media Interaksi dan
                                            Komunikasi dengan Jamaah</span>
                                        ({{ $systemAssessment->pillar_one_question_three ?? 0 }} Poin)</p>
                                    <p class="card-text mb-0 fw-bold"><span class="fw-medium">4. Memiliki Grup
                                            WhatsApp Jamaah</span>
                                        ({{ $systemAssessment->pillar_one_question_four ?? 0 }} Poin)</p>
                                    <p class="card-text fw-bold"><span class="fw-medium">5. Program Pembinaan
                                            Keagamaan Untuk
                                            Jamaah</span>
                                        ({{ $systemAssessment->pillar_one_question_five ?? 0 }} Poin)</p>

                                    <h6 class="card-subtitle mb-0 text-body-dark">Total Nilai:
                                        {{ $totalValue }} Poin</h6>
                                @else
                                    <p class="card-text mb-0">Nilai belum dihitung</p>
                                @endif

                                <hr />

                                {{-- Panitia --}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentModalLabel">Lihat Dokumen</h1>
                    <button type="button" class="btn-close" data-indexss="modal" aria-label="Close"></button>
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
