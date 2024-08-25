<x-user title="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah"
    name="Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah">
    <div class="container py-4">
        <form action="{{ route('form.managementRelationshipAct') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $pillarOne->id ?? '' }}">

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
                            <h5 class="card-title fw-bold mb-3">Koordinasi Manajemen dengan Pengurus DKM</h5>

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3">
                                <label for="question_one" class="form-label fw-medium">1. Koordinasi Manajemen
                                    dengan Pengurus DKM</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one" value="Belum ada"
                                        id="question_one1"
                                        {{ old('question_one', $pillarOne->question_one) == 'Belum ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one2" value="Ada, hanya pelaporan dokumen"
                                        {{ old('question_one', $pillarOne->question_one) == 'Ada, hanya pelaporan dokumen' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one2">
                                        Ada, hanya pelaporan dokumen
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one3" value="Ada, rapat tidak rutin dan pelaporan dokumen"
                                        {{ old('question_one', $pillarOne->question_one) == 'Ada, rapat tidak rutin dan pelaporan dokumen' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one3">
                                        Ada, rapat tidak rutin dan pelaporan dokumen
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_one"
                                        id="question_one4" value="Ada, rapat rutin dan pelaporan dokumen"
                                        {{ old('question_one', $pillarOne->question_one) == 'Ada, rapat rutin dan pelaporan dokumen' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_one4">
                                        Ada, rapat rutin dan pelaporan dokumen
                                    </label>
                                </div>

                                @error('question_one')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarOne->file_question_one ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_one" class="form-label fw-medium">Dokumen Pendukung</label>
                                <input class="form-control" type="file" id="file_question_one"
                                    name="file_question_one">
                            </div>

                            @if ($pillarOne->file_question_one)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            {{-- Pertanyaan 2 --}}
                            <div class="mb-3">
                                <label for="question_two" class="form-label fw-medium">2. Kegiatan Bersama antara DKM
                                    dengan Manajemen Perusahaan</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two" value="Belum ada"
                                        id="question_two1"
                                        {{ old('question_two', $pillarOne->question_two) == 'Belum ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)"
                                        id="question_two2"
                                        {{ old('question_two', $pillarOne->question_two) == 'Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two2">
                                        Kegiatan yang melibatkan sebagian kecil karyawan (kurang dari 30%)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)"
                                        id="question_two3"
                                        {{ old('question_two', $pillarOne->question_two) == 'Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two3">
                                        Kegiatan yang melibatkan sebagian besar karyawan (lebih dari 70%)
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_two"
                                        value="Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat"
                                        id="question_two4"
                                        {{ old('question_two', $pillarOne->question_two) == 'Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_two4">
                                        Kegiatan yang melibatkan sebagian besar karyawan dan masyarakat
                                    </label>
                                </div>

                                @error('question_two')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarOne->file_question_two_one ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_two_one" class="form-label fw-medium">Dokumen SK
                                    kepengurusan
                                    DKM
                                    dari manajemen</label>
                                <input class="form-control" type="file" id="file_question_two_one"
                                    name="file_question_two_one">
                            </div>

                            @if ($pillarOne->file_question_two_one)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_one, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            <div class="{{ $pillarOne->file_question_two_two ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_two_two" class="form-label fw-medium">Dokumen program kerja
                                    dan anggaran yang sudah disetujui oleh manajemen</label>
                                <input class="form-control" type="file" id="file_question_two_two"
                                    name="file_question_two_two">
                            </div>

                            @if ($pillarOne->file_question_two_two)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_two, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            <div class="{{ $pillarOne->file_question_two_three ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_two_three" class="form-label fw-medium">Dokumen penunjang
                                    lainnya(foto & notulensi rapat,dll)</label>
                                <input class="form-control" type="file" id="file_question_two_three"
                                    name="file_question_two_three">
                            </div>

                            @if ($pillarOne->file_question_two_three)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_two_three, '/')) }}">
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
                            <h5 class="card-title fw-bold mb-3">Interaksi DKM dengan Jamaah</h5>

                            {{-- Pertanyaan 3 --}}
                            <div class="mb-3">
                                <label for="question_three" class="form-label fw-medium">3. Media Interaksi dan
                                    Komunikasi dengan Jamaah(mading atau medsos)</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Belum ada" id="question_three1"
                                        {{ old('question_three', $pillarOne->question_three) == 'Belum ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_three1">
                                        Belum ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per bulan" id="question_three2"
                                        {{ old('question_three', $pillarOne->question_three) == 'Ada, rutin update per bulan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_three2">
                                        Ada, rutin update per bulan
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per minggu" id="question_three3"
                                        {{ old('question_three', $pillarOne->question_three) == 'Ada, rutin update per minggu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_three3">
                                        Ada, rutin update per minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_three"
                                        value="Ada, rutin update per hari" id="question_three4"
                                        {{ old('question_three', $pillarOne->question_three) == 'Ada, rutin update per hari' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_three4">
                                        Ada, rutin update per hari
                                    </label>
                                </div>

                                @error('question_three')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarOne->file_question_three ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_three" class="form-label fw-medium">Dokumen
                                    Pendukung</label>
                                <input class="form-control" type="file" id="file_question_three"
                                    name="file_question_three">
                            </div>

                            @if ($pillarOne->file_question_three)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_three, '/')) }}">
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
                                        value="Update per minggu" id="question_four1"
                                        {{ old('question_four', $pillarOne->question_four) == 'Update per minggu' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four1">
                                        Update per minggu
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota kurang dari 10% karyawan muslim" id="question_four2"
                                        {{ old('question_four', $pillarOne->question_four) == 'Anggota kurang dari 10% karyawan muslim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four2">
                                        Anggota kurang dari 10% karyawan muslim
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota 10 sampai 30% karyawan muslim" id="question_four3"
                                        {{ old('question_four', $pillarOne->question_four) == 'Anggota 10 sampai 30% karyawan muslim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four3">
                                        Anggota 10 sampai 30% karyawan muslim
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_four"
                                        value="Anggota lebih dari 30% karyawan muslim" id="question_four4"
                                        {{ old('question_four', $pillarOne->question_four) == 'Anggota lebih dari 30% karyawan muslim' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_four4">
                                        Anggota lebih dari 30% karyawan muslim
                                    </label>
                                </div>

                                @error('question_four')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarOne->file_question_four ? 'mb-2' : 'mb-3' }}">
                                <label for="file_question_four" class="form-label fw-medium">Dokumen
                                    Pendukung</label>
                                <input class="form-control" type="file" id="file_question_four"
                                    name="file_question_four">
                            </div>

                            @if ($pillarOne->file_question_four)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_four, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

                            {{-- Pertanyaan 5 --}}
                            <div class="mb-3">
                                <label for="question_five" class="form-label fw-medium">5. Program Pembinaan Keagamaan
                                    Untuk Jamaah</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Tidak ada" id="question_five1"
                                        {{ old('question_five', $pillarOne->question_five) == 'Tidak ada' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five1">
                                        Tidak ada
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, tapi tidak rutin" id="question_five2"
                                        {{ old('question_five', $pillarOne->question_five) == 'Ada, tapi tidak rutin' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five2">
                                        Ada, tapi tidak rutin
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, sebulan sekali" id="question_five3"
                                        {{ old('question_five', $pillarOne->question_five) == 'Ada, sebulan sekali' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five3">
                                        Ada, sebulan sekali
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="question_five"
                                        value="Ada, seminggu sekali" id="question_five4"
                                        {{ old('question_five', $pillarOne->question_five) == 'Ada, seminggu sekali' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="question_five4">
                                        Ada, seminggu sekali
                                    </label>
                                </div>

                                @error('question_five')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="{{ $pillarOne->file_question_five ? 'mb-2' : 'mb-3 mb-md-4' }}">
                                <label for="file_question_five" class="form-label fw-medium">Dokumen
                                    Pendukung</label>
                                <input class="form-control" type="file" id="file_question_five"
                                    name="file_question_five">
                            </div>

                            @if ($pillarOne->file_question_five)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($pillarOne->file_question_five, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @endif

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
