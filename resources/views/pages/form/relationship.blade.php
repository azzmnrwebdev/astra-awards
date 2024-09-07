<x-user title="Formulir Hubungan DKM dan YAA" name="Formulir Hubungan DKM dan YAA">
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
                                <h5 class="card-title fw-bold mb-3">Informasi DKM</h5>

                                <img src="{{ asset('storage/' . $user->mosque->logo) }}" alt="Logo"
                                    style="width: 200px;">

                                <p class="card-text mb-0"><span class="fw-medium">Nama:</span> {{ $user->name }}
                                </p>
                                <p class="card-text mb-0"><span class="fw-medium">Email:</span> {{ $user->email }}
                                </p>
                                <p class="card-text mb-0"><span class="fw-medium">Nomor Ponsel:</span>
                                    {{ $user->phone_number }}</p>

                                <hr>

                                <p class="card-text mb-0"><span class="fw-medium">Nama Masjid/Musala:</span>
                                    {{ $user->mosque->name }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Kategori Masjid:</span>
                                    {{ $user->mosque->categoryMosque->name }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Alamat:</span>
                                    {{ $user->mosque->address }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Kota/Kabupaten:</span>
                                    {{ $user->mosque->city->name }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Provinsi:</span>
                                    {{ $user->mosque->city->province->name }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Kapasitas Jamaah:</span>
                                    {{ $user->mosque->capacity }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Kategori Area:</span>
                                    {{ $user->mosque->categoryArea->name }}</p>

                                <hr>

                                <p class="card-text mb-0"><span class="fw-medium">Jabatan di DKM:</span>
                                    {{ $user->mosque->position }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Ketua Pengurus DKM:</span>
                                    {{ $user->mosque->leader }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Email Ketua Pengurus DKM:</span>
                                    {{ $user->mosque->leader_email }}</p>
                                <p class="card-text mb-0"><span class="fw-medium">Nomor Ponsel Ketua Pengurus
                                        DKM:</span>
                                    {{ $user->mosque->leader_phone }}</p>

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

                <form action="{{ route('form.relationshipAct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $pillarTwo->id ?? '' }}">

                    <div class="col">
                        <div class="card h-100 border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Kerjasama dengan YAA</h5>

                                <!-- Pertanyaan 1 -->
                                <div class="mb-3">
                                    <label for="question_one" class="form-label">1. Kerjasama dengan YAA</label>
                                    @foreach (['Belum ada', 'Ada, hanya menjadi peserta kegiatan YAA', 'Ada, kerjasama dengan salah satu Divisi di YAA (Sosial Religi, Layanan Amal, Kemitraan)', 'Ada, kerjasama dengan seluruh Divisi YAA'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="question_one"
                                                value="{{ $option }}" id="question_one{{ $loop->index + 1 }}"
                                                data-index="{{ $loop->index + 1 }}"
                                                {{ old('question_one', $pillarTwo->question_one ?? '') == $option ? 'checked' : '' }}
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

                                <!-- Pertanyaan 2 -->
                                <div class="mb-3">
                                    <label for="question_two" class="form-label">2. Divisi Sosial Religi</label>
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
                                            <input type="text" class="form-control" id="option_two"
                                                name="option_two"
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

                                <!-- Pertanyaan 3 -->
                                <div class="mb-3">
                                    <label for="question_three" class="form-label">3. Divisi Layanan Amal</label>
                                    @foreach (['Payroll Zakat/Sedekah', 'Kurban', 'Sinergi Event & Kegiatan Lainnya'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_three[]"
                                                value="{{ $option }}"
                                                id="question_three{{ $loop->index + 1 }}"
                                                data-index="{{ $loop->index + 1 }}"
                                                {{ in_array($option, (array) old('question_three', json_decode($pillarTwo->question_three ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                                @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                            <label class="form-check-label"
                                                for="question_three{{ $loop->index + 1 }}">
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
                                    <div
                                        class="{{ $pillarTwo && $pillarTwo->file_question_three ? 'mb-2' : 'mb-3' }}">
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

                                <!-- Pertanyaan 4 -->
                                <div class="mb-3">
                                    <label class="form-label">4. Divisi Kemitraan</label>
                                    @foreach (['Perawatan AC', 'Umroh', 'Aqiqah dan Kegiatan Sinergi lainnya'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_four[]"
                                                value="{{ $option }}" id="question_four{{ $loop->index + 1 }}"
                                                data-index="{{ $loop->index + 1 }}"
                                                {{ in_array($option, (array) old('question_four', json_decode($pillarTwo->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                                @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                            <label class="form-check-label"
                                                for="question_four{{ $loop->index + 1 }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_four[]"
                                            value="custom" id="question_four4" data-index="4"
                                            {{ in_array('custom', (array) old('question_four', json_decode($pillarTwo->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                            @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        <label class="form-check-label w-100" for="question_four4">
                                            <input type="text" class="form-control" id="option_four"
                                                name="option_four"
                                                value="{{ old('option_four', $pillarTwo->option_four ?? '') }}"
                                                @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                        </label>
                                    </div>

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

                                <!-- Pertanyaan 5 -->
                                <div class="mb-3">
                                    <label class="form-label">5. Divisi Administrasi & Keuangan</label>
                                    @foreach (['Sudah menggunakan Sistem Aplikasi Keuangan Online YAA', 'Berbagi Informasi di Amaliah.id'] as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_five[]"
                                                value="{{ $option }}" id="question_five{{ $loop->index + 1 }}"
                                                data-index="{{ $loop->index + 1 }}"
                                                {{ in_array($option, (array) old('question_five', json_decode($pillarTwo->question_five ?? '[]', true) ?? '')) ? 'checked' : '' }}
                                                @if (auth()->check() && auth()->user()->hasRole('admin')) disabled @endif>
                                            <label class="form-check-label"
                                                for="question_five{{ $loop->index + 1 }}">
                                                {{ $option }}
                                            </label>
                                        </div>
                                    @endforeach

                                    @error('question_five')
                                        <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                @if (auth()->check() && auth()->user()->hasRole('user'))
                                    <!-- Submit Button -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if (auth()->check() && auth()->user()->hasRole('admin'))
                <div class="col-md-10 col-lg-4" style="z-index: 3;">
                    <div class="card border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <form id="systemAssessment" action="{{ route('system_assessment.pillarTwoAct') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="pillar_two_id" value="{{ $pillarTwo->id }}">

                                <input type="hidden" name="pillar_two_question_one">
                                <input type="hidden" name="pillar_two_question_two[]">
                                <input type="hidden" name="pillar_two_question_three[]">
                                <input type="hidden" name="pillar_two_question_four[]">
                                <input type="hidden" name="pillar_two_question_five[]">

                                <button type="submit" class="btn btn-primary">Tampilkan Nilai</button>
                            </form>

                            <hr />

                            <h5 class="card-title">Niai Berdasarkan Sistem</h5>

                            @if ($systemAssessment)
                                <p class="card-text mb-0 fw-bold"><span class="fw-medium">1. Kerjasama dengan
                                        YAA</span>
                                    ({{ $systemAssessment->pillar_two_question_one ?? 0 }} Poin)</p>
                                <p class="card-text mb-0 fw-bold"><span class="fw-medium">2. Divisi Sosial
                                        Religi</span>
                                    ({{ $systemAssessment->pillar_two_question_two ?? 0 }} Poin)</p>
                                <p class="card-text mb-0 fw-bold"><span class="fw-medium">3. Divisi Layanan
                                        Amal</span>
                                    ({{ $systemAssessment->pillar_two_question_three ?? 0 }} Poin)</p>
                                <p class="card-text mb-0 fw-bold"><span class="fw-medium">4. Divisi Kemitraan</span>
                                    ({{ $systemAssessment->pillar_two_question_four ?? 0 }} Poin)</p>
                                <p class="card-text fw-bold"><span class="fw-medium">5. Divisi Administrasi &
                                        Keuangan</span>
                                    ({{ $systemAssessment->pillar_two_question_five ?? 0 }} Poin)</p>

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
                const selectedCheckbox1 = $('input[name="question_two[]"]:checked');
                const selectedCheckbox2 = $('input[name="question_three[]"]:checked');
                const selectedCheckbox3 = $('input[name="question_four[]"]:checked');
                const selectedCheckbox4 = $('input[name="question_five[]"]:checked');

                // Jawaban 1
                if (selectedRadio1.length) {
                    const index = selectedRadio1.data('index');
                    $('input[name="pillar_two_question_one"]').val(index);
                }

                // Jawaban 2
                if (selectedCheckbox1.length) {
                    let indexes = [];
                    selectedCheckbox1.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_two[]"]').val(indexes.join(','));
                }

                // Jawaban 3
                if (selectedCheckbox2.length) {
                    let indexes = [];
                    selectedCheckbox2.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_three[]"]').val(indexes.join(','));
                }

                // Jawaban 4
                if (selectedCheckbox3.length) {
                    let indexes = [];
                    selectedCheckbox3.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_four[]"]').val(indexes.join(','));
                }

                // Jawaban 5
                if (selectedCheckbox4.length) {
                    let indexes = [];
                    selectedCheckbox4.each(function() {
                        indexes.push($(this).data('index'));
                    });

                    $('input[name="pillar_two_question_five[]"]').val(indexes.join(','));
                }

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
            });
        </script>
    @endprepend
</x-user>
