<x-user title="Formulir Administrasi & Keuangan" name="Formulir Administrasi dan Keuangan">
    <div class="container py-4">
        <form action="{{ route('form.administrationAct') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $pillarFour->id ?? '' }}">

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
                            <h5 class="card-title fw-bold mb-3">Struktur Organisasi, Rencana Kegiatan & Budget</h5>

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label fw-medium">1. Yayasan Amaliah Astra sudah
                                    membuat sistem keuangan masjid online, Apakah DKM
                                    sudah menggunakan sistem ini?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one" value="Tidak"
                                        id="question_one1"
                                        {{ old('question_one', $pillarFour->question_one ?? '') == 'Tidak' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one1">
                                        Tidak
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one2" value="Ya"
                                        {{ old('question_one', $pillarFour->question_one ?? '') == 'Ya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one2">
                                        Ya
                                    </label>
                                </div>

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarFour && $pillarFour->file_question_one ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_one" class="form-label fw-medium">Dokumen Pendukung</label>
                                <input class="form-control" type="file" id="file_question_one"
                                    name="file_question_one">

                                <div class="form-text">Hanya file bertipe jpg, png, jpeg dan pdf yang di
                                    izinkan.</div>

                                @error('file_question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            @if ($pillarFour && $pillarFour->file_question_one)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label fw-medium">2. DKM memiliki pengurus masjid
                                    dibawah umur 30 tahun?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two" value="Tidak ada"
                                        id="question_two1"
                                        {{ old('question_two', $pillarFour->question_two ?? '') == 'Tidak ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two" value="Ada"
                                        id="question_two2"
                                        {{ old('question_two', $pillarFour->question_two ?? '') == 'Ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two2">
                                        Ada
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-0">
                                <label for="question_three" class="form-label fw-medium">3. Berapa persen jumlah
                                    pengurus masjid dibawah umur 30 tahun dari total pengurus DKM</label>

                                <input type="text" class="form-control" name="question_three" id="question_three"
                                    value="{{ old('question_three', $pillarFour->question_three ?? '') }}">

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Laporan Keuangan</h5>

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_four" class="form-label fw-medium">4. Laporan Keuangan
                                    Masjid/Musala</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Belum ada" id="question_four1"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Belum ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Ada, update lebih dari sebulan yang lalu" id="question_four2"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Ada, update lebih dari sebulan yang lalu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four2">
                                        Ada, update lebih dari sebulan yang lalu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value=" Ada, rutin dilakukan evaluasi dan update per bulan"
                                        id="question_four3"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == ' Ada, rutin dilakukan evaluasi dan update per bulan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four3">
                                        Ada, rutin dilakukan evaluasi dan update per bulan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Ada, rutin update per bulan dan ada pelaporan ke jamaah"
                                        id="question_four4"
                                        {{ old('question_four', $pillarFour->question_four ?? '') == 'Ada, rutin update per bulan dan ada pelaporan ke jamaah' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four4">
                                        Ada, rutin update per bulan dan ada pelaporan ke jamaah
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

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

                            @if ($pillarFour && $pillarFour->file_question_four)
                                <div class="mb-0">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_four, '/')) }}">
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
                            <h5 class="card-title fw-bold mb-3">Laporan Tahunan</h5>

                            {{-- Pertanyaan 4 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label fw-medium">5. Laporan Kegiatan dan
                                    keuangan Tahunan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Belum ada" id="question_five1"
                                        {{ old('question_five', $pillarFour->question_five ?? '') == 'Belum ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada" id="question_five2"
                                        {{ old('question_five', $pillarFour->question_five ?? '') == 'Ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five2">
                                        Ada
                                    </label>
                                </div>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

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

                            @if ($pillarFour && $pillarFour->file_question_five)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarFour->file_question_five, '/')) }}">
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
