<x-user title="Penilaian File Presentasi" name="Penilaian File Presentasi">
    <div class="container py-4">
        <form action="{{ route('jury_assessment.presentation', ['user' => $user->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $startAssessment->id ?? '' }}">
            <input type="hidden" name="presentation_id" value="{{ $presentationId }}">

            <div class="row row-cols-1 g-0">
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-light" role="alert">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('presentation.index') }}"
                                        class="text-decoration-none">Presentasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Penilaian File Presentasi
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

                <div class="col-md-10 col-lg-8 mb-3">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Formulir Penilaian</h5>

                            <p class="card-text mb-3">*) Silahkan tekan tombol <span class="fw-semibold">Hasilkan
                                    Nilai</span> untuk mendapatkan file formulir penilaian.</p>

                            <a href="{{ route('jury_assessment.presentation_generate_value', ['user' => $user->id]) }}"
                                class="btn btn-danger mb-4">Hasilkan Nilai</a>

                            @php
                                $fileName = $user->id . '.pdf';
                                $filePath = 'storage/assessments/' . $fileName;
                            @endphp

                            @if (file_exists(public_path($filePath)))
                                <button type="button" class="d-block border-0 p-0 bg-transparent text-primary"
                                    data-bs-toggle="modal" data-bs-target="#documentModal"
                                    data-url="{{ url('/' . ltrim($filePath, '/')) }}" data-title="Formulir Penilaian">
                                    Lihat Dokumen
                                </button>
                            @else
                                <p class="card-text text-danger mb-0">File formulir penilaian belum tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">File Presentasi</h5>

                            @if ($user->mosque->presentation && $user->mosque->presentation->file)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}"
                                        data-title="File Presentasi">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @else
                                <div class="mb-3">
                                    <p class="text-danger">*) Peserta tidak mengunggah file presentasi</p>
                                </div>
                            @endif

                            @if ($user->mosque->presentation && $user->mosque->presentation->file)
                                {{-- Pillar 2 --}}
                                <div class="row mb-3">
                                    <label for="presentation_file_pillar_two"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Hubungan DKM dengan
                                        YAA:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file_pillar_two" id="presentation_file_pillar_two"
                                            class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->startAssessment ||
                                                    !$user->mosque->presentation->startAssessment->presentation_file_pillar_two)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment->presentation_file_pillar_two ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment->presentation_file_pillar_two ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment->presentation_file_pillar_two ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment->presentation_file_pillar_two ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>

                                        @error('presentation_file_pillar_two')
                                            <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pillar 1 --}}
                                <div class="row mb-3">
                                    <label for="presentation_file_pillar_one"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Hubungan Manajemen Perusahaan
                                        dengan DKM dan Jamaah:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file_pillar_one" id="presentation_file_pillar_one"
                                            class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->startAssessment ||
                                                    !$user->mosque->presentation->startAssessment->presentation_file_pillar_one)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment->presentation_file_pillar_one ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment->presentation_file_pillar_one ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment->presentation_file_pillar_one ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment->presentation_file_pillar_one ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>

                                        @error('presentation_file_pillar_one')
                                            <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pillar 3 --}}
                                <div class="row mb-3">
                                    <label for="presentation_file_pillar_three"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Program Sosial:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file_pillar_three"
                                            id="presentation_file_pillar_three" class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->startAssessment ||
                                                    !$user->mosque->presentation->startAssessment->presentation_file_pillar_three)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment->presentation_file_pillar_three ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment->presentation_file_pillar_three ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment->presentation_file_pillar_three ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment->presentation_file_pillar_three ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>

                                        @error('presentation_file_pillar_three')
                                            <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pillar 4 --}}
                                <div class="row mb-3">
                                    <label for="presentation_file_pillar_four"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Administrasi dan
                                        Keuangan:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file_pillar_four" id="presentation_file_pillar_four"
                                            class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->startAssessment ||
                                                    !$user->mosque->presentation->startAssessment->presentation_file_pillar_four)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment->presentation_file_pillar_four ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment->presentation_file_pillar_four ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment->presentation_file_pillar_four ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment->presentation_file_pillar_four ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>

                                        @error('presentation_file_pillar_four')
                                            <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Pillar 5 --}}
                                <div class="row mb-3">
                                    <label for="presentation_file_pillar_five"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Peribadahan dan
                                        Infrastruktur:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file_pillar_five"
                                            id="presentation_file_pillar_five" class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->startAssessment ||
                                                    !$user->mosque->presentation->startAssessment->presentation_file_pillar_five)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment->presentation_file_pillar_five ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment->presentation_file_pillar_five ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment->presentation_file_pillar_five ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment->presentation_file_pillar_five ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>

                                        @error('presentation_file_pillar_five')
                                            <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-warning">Simpan Nilai</button>
                                </div>
                            @endif
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
                    <h1 class="modal-title fs-5" id="documentModalLabel"></h1>
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
                    let title = button.data('title');
                    let modal = $(this);
                    let documentContent = modal.find('#documentContent');
                    let documentModalLabel = modal.find('#documentModalLabel');

                    documentContent.html('');
                    documentModalLabel.text('');
                    documentModalLabel.text(title);

                    if (url.match(/\.pdf$/i)) {
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
