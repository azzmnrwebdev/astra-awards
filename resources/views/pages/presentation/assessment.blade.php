<x-user title="Penilaian File Presentasi" name="Penilaian File Presentasi">
    <div class="container py-4">
        <form action="{{ route('jury_assessment.presentation', ['user' => $user->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $juryAssessment->id ?? '' }}">
            <input type="hidden" name="presentation_id" value="{{ $presentationId }}">

            <div class="row row-cols-1 g-0">
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-light" role="alert">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('presentation') }}"
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

                @if (Session('error'))
                    <div class="col-md-10 col-lg-8">
                        <div class="alert alert-danger mb-4" role="alert">
                            {{ Session('error') }}
                        </div>
                    </div>
                @endif

                <div class="col-md-10 col-lg-8">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Mengunggah File Presentasi</h5>

                            {{-- Pertanyaan 1 --}}
                            <div class="mb-3
                                <label for="file"
                                class="form-label fw-medium">Silahkan untuk mengunggah file
                                presentasi yang memuat keseluruhan pilar penilaian (Pilar 1, 2, 3, 4, dan
                                5)</label>
                            </div>

                            @error('file')
                                <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                            @enderror

                            @if ($user->mosque->presentation && $user->mosque->presentation->file)
                                <div class="mb-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @else
                                <div class="mb-3">
                                    <p class="text-danger">*) Peserta tidak mengunggah file presentasi</p>
                                </div>
                            @endif

                            @if ($user->mosque->presentation && $user->mosque->presentation->file)
                                <div class="row">
                                    <label for="presentation_file"
                                        class="col-md-4 col-xl-3 col-form-label fw-medium">Penilaian
                                        Juri:</label>

                                    <div class="col-md-8 col-xl-9">
                                        <select name="presentation_file" id="presentation_file" class="form-select">
                                            @if (
                                                !$user->mosque->presentation ||
                                                    !$user->mosque->presentation->juryAssessment ||
                                                    !$user->mosque->presentation->juryAssessment->presentation_file)
                                                <option value="">-- Pilih Nilai --</option>
                                            @endif

                                            <option value="1"
                                                {{ old('presentation_file', $user->mosque->presentation->juryAssessment->presentation_file ?? '') == 1 ? 'selected' : '' }}>
                                                1</option>
                                            <option value="3"
                                                {{ old('presentation_file', $user->mosque->presentation->juryAssessment->presentation_file ?? '') == 3 ? 'selected' : '' }}>
                                                3</option>
                                            <option value="7"
                                                {{ old('presentation_file', $user->mosque->presentation->juryAssessment->presentation_file ?? '') == 7 ? 'selected' : '' }}>
                                                7</option>
                                            <option value="9"
                                                {{ old('presentation_file', $user->mosque->presentation->juryAssessment->presentation_file ?? '') == 9 ? 'selected' : '' }}>
                                                9</option>
                                        </select>
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
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
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
