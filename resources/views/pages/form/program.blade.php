<x-user title="Formulir Program Sosial" name="Formulir Program Sosial">
    <div class="container py-4">
        <form action="{{ route('form.programAct') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $pillarThree->id ?? '' }}">

            <div class="row row-cols-1 g-3">
                @if (Session('success'))
                    <div class="col-md-10 col-lg-8">
                        <div class="alert alert-success mb-2" role="alert">
                            {{ Session('success') }}
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
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Program Sosial yang dikelola DKM</h5>

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label">1. Bentuk Program Sosial yang Dikelola oleh
                                    DKM</label>
                                @foreach (['Bantuan sosial sesekali, dilaksanakan insidental (ex. Bantuan bencana).', 'Bantuan sosial di momen-momen tertentu (ex. Santunan di PHBI dll).', 'Bantuan sosial dan program pemberdayaan (program non pemberdayaan masih mendominasi).', 'Program pemberdayaan 4 pilar (pendidikan, ekonomi, lingkungan dan kesehatan).'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_one"
                                            value="{{ $option }}" id="question_one{{ $loop->index + 1 }}"
                                            {{ old('question_one', $pillarThree->question_one ?? '') == $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="question_one{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarThree && $pillarThree->file_question_one ? 'mb-2' : 'mb-0' }}">
                                <label for="file_question_one" class="form-label fw-medium">Dokumen Pendukung</label>
                                <input class="form-control" type="file" id="file_question_one"
                                    name="file_question_one">

                                <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                    izinkan.</div>

                                @error('file_question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if ($pillarThree && $pillarThree->file_question_one)
                                <div class="mb-0">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarThree->file_question_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Informasi Penerima Manfaat</h5>

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label">2. Penerima Manfaat Program Sosial</label>
                                @foreach (['Belum ada Penerima Manfaat.', 'Ring 1 perusahaan.', 'Ring 1 dan di luar Ring 1 Perusahaan.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question_two"
                                            value="{{ $option }}" id="question_two{{ $loop->index + 1 }}"
                                            {{ old('question_two', $pillarThree->question_two ?? '') == $option ? 'checked' : '' }}>
                                        <label class="form-check-label" for="question_two{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-3">
                                <label for="beneficiaries_count" class="form-label">3. Jumlah Penerima Manfaat</label>
                                <select class="form-select" name="question_three">
                                    @foreach (['0', 'Kurang dari 100', '100 sampai 1000', 'Lebih dari 1000'] as $option)
                                        <option value="{{ $option }}"
                                            {{ old('question_three', $pillarThree->question_three ?? '') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label">4. Sumber Pembiayaan</label>
                                @foreach (['Kotak amal masjid.', 'Sumbangan jamaah atau karyawan via transfer.', 'Sumbangan dari perusahaan.', 'Sumbangan via digital (QRIS dll).', 'Sumbangan via payroll.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_four[]"
                                            value="{{ $option }}" id="question_four{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_four', json_decode($pillarThree->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="question_four{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_four[]"
                                        value="custom" id="question_four6"
                                        {{ in_array('custom', (array) old('question_four', json_decode($pillarThree->question_four ?? '[]', true) ?? '')) ? 'checked' : '' }}>
                                    <label class="form-check-label w-100" for="question_four6">
                                        <input type="text" class="form-control" id="option_four" name="option_four"
                                            value="{{ old('option_four', $pillarThree->option_four ?? '') }}">
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarThree && $pillarThree->file_question_four ? 'mb-2' : 'mb-0' }}">
                                <label for="file_question_four" class="form-label fw-medium">Dokumen Pendukung</label>
                                <input class="form-control" type="file" id="file_question_four"
                                    name="file_question_four">

                                <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                    izinkan.</div>

                                @error('file_question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if ($pillarThree && $pillarThree->file_question_four)
                                <div class="mb-0">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarThree->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Sustainability DKM</h5>

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label">5. Program Sustainability di
                                    DKM</label>
                                <textarea class="form-control" name="question_five" rows="5">{{ old('question_five', $pillarThree->question_five ?? '') }}</textarea>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Pertanyaan 6 --}}
                            <div class="mb-3">
                                <label for="question_six" class="form-label">6. Jelaskan dengan Sebutkan Program yang
                                    sesuai dengan Astra
                                    Sustainability Aspiration</label>
                                @foreach (['Hemat Air.', 'Hemat Listrik.', 'Pengelolaan sampah.'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_six[]"
                                            value="{{ $option }}" id="question_six{{ $loop->index + 1 }}"
                                            {{ in_array($option, (array) old('question_six', json_decode($pillarThree->question_six ?? '[]', true) ?? '')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="question_six{{ $loop->index + 1 }}">
                                            {{ $option }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="question_six[]"
                                        value="custom" id="question_six4"
                                        {{ in_array('custom', (array) old('question_six', json_decode($pillarThree->question_six ?? '[]', true) ?? '')) ? 'checked' : '' }}>
                                    <label class="form-check-label w-100" for="question_six4">
                                        <input type="text" class="form-control" id="option_six" name="option_six"
                                            value="{{ old('option_six', $pillarThree->option_six ?? '') }}">
                                    </label>
                                </div>

                                @error('question_six')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div
                                class="{{ $pillarThree && $pillarThree->file_question_six ? 'mb-2' : 'mb-3 mb-md-4' }}">
                                <label for="file_question_six" class="form-label fw-medium">Upload dokumen, poster,
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

                            @if ($pillarThree && $pillarThree->file_question_six)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarThree->file_question_six, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
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
