<x-admin title="Edit Penilaian Awal {{ $user->mosque->name }}">
    {{-- Custom CSS --}}
    @prepend('styles')
        <style>
            #pageTitle:hover {
                cursor: pointer;
            }
        </style>
    @endprepend

    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex" id="pageTitle">
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Penilaian Awal
        {{ $user->mosque->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div style="margin-bottom: 2rem;">
                <h5 class="card-title fw-semibold mb-3">Lampiran Formulir Penilaian Panitia</h5>

                <p class="card-text mb-3">*) Silahkan tekan tombol <span class="fw-semibold">Lihat Dokumen</span> untuk
                    mendapatkan file formulir penilaian panitia.</p>

                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#formAssessmentModal" data-user-id="{{ $user->id }}"
                    data-url="{{ route('jury_assessment.formAssessment', ['user' => $user->id]) }}">
                    Lihat Dokumen
                </button>
            </div>

            <h5 class="card-title fw-semibold mb-3">Penilaian Awal</h5>

            <button type="button" style="margin-bottom: 2rem;" class="btn btn-dark" data-bs-toggle="modal"
                data-bs-target="#documentModal"
                data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                Lihat File Presentasi
            </button>

            <form action="{{ route('jury_assessment.assessmentAct', ['user' => $user->id]) }}" method="POST">
                @csrf

                <input type="hidden" name="id" value="{{ $startAssessment->id ?? '' }}">
                <input type="hidden" name="presentation_id" value="{{ $presentationId }}">

                {{-- Pillar 2 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_two" class="col-md-3 col-xl-2 col-form-label">Hubungan DKM
                        dengan YAA</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_file_pillar_two') is-invalid @enderror"
                            id="presentation_file_pillar_two" name="presentation_file_pillar_two">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment?->presentation_file_pillar_two) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment?->presentation_file_pillar_two) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment?->presentation_file_pillar_two) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_file_pillar_two', $user->mosque->presentation->startAssessment?->presentation_file_pillar_two) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_file_pillar_two')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 1 --}}
                <div class="row mb-3">
                    <label for="presentation_file_pillar_one" class="col-md-3 col-xl-2 col-form-label">Hubungan
                        Manajemen Perusahaan dengan DKM dan Jamaah</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_file_pillar_one') is-invalid @enderror"
                            id="presentation_file_pillar_one" name="presentation_file_pillar_one">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment?->presentation_file_pillar_one) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment?->presentation_file_pillar_one) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment?->presentation_file_pillar_one) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_file_pillar_one', $user->mosque->presentation->startAssessment?->presentation_file_pillar_one) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_file_pillar_one')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 3 --}}
                <div class="row mb-3">
                    <label for="presentation_file_pillar_three" class="col-md-3 col-xl-2 col-form-label">Program
                        Sosial</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_file_pillar_three') is-invalid @enderror"
                            id="presentation_file_pillar_three" name="presentation_file_pillar_three">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment?->presentation_file_pillar_three) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment?->presentation_file_pillar_three) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment?->presentation_file_pillar_three) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_file_pillar_three', $user->mosque->presentation->startAssessment?->presentation_file_pillar_three) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_file_pillar_three')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 4 --}}
                <div class="row mb-3">
                    <label for="presentation_file_pillar_four" class="col-md-3 col-xl-2 col-form-label">Administrasi
                        dan Keuangan</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_file_pillar_four') is-invalid @enderror"
                            id="presentation_file_pillar_four" name="presentation_file_pillar_four">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment?->presentation_file_pillar_four) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment?->presentation_file_pillar_four) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment?->presentation_file_pillar_four) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_file_pillar_four', $user->mosque->presentation->startAssessment?->presentation_file_pillar_four) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_file_pillar_four')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 5 --}}
                <div class="row mb-3">
                    <label for="presentation_file_pillar_five" class="col-md-3 col-xl-2 col-form-label">Peribadahan
                        dan Infrastruktur</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_file_pillar_five') is-invalid @enderror"
                            id="presentation_file_pillar_five" name="presentation_file_pillar_five">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment?->presentation_file_pillar_five) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment?->presentation_file_pillar_five) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment?->presentation_file_pillar_five) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_file_pillar_five', $user->mosque->presentation->startAssessment?->presentation_file_pillar_five) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_file_pillar_five')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-end">
                    @if (!$user->mosque->presentation->startAssessment)
                        <button type="submit" class="btn btn-success">Simpan Nilai</button>
                    @else
                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Form Assessment Modal --}}
    <div class="modal fade" id="formAssessmentModal" tabindex="-1" aria-labelledby="formAssessmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formAssessmentModalLabel">Formulir Penilaian Panitia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="loadingProgress" class="progress" role="progressbar"
                        aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0"
                        aria-valuemax="100" style="height: 22px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: 100%;">Loading...</div>
                    </div>

                    <div id="documentContent" class="d-none"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Document Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentModalLabel">File Presentasi</h1>
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
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('jury_assessment.index') }}";
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#formAssessmentModal').on('show.bs.modal', function(event) {
                    const modal = $(this);
                    const button = $(event.relatedTarget);
                    const url = button.data('url');
                    const userId = button.data('user-id');

                    let documentContent = modal.find('#documentContent');
                    let loadingProgress = modal.find('#loadingProgress');
                    let progressBar = loadingProgress.find('.progress-bar');

                    documentContent.html('');
                    loadingProgress.removeClass('d-none');
                    progressBar.css('width', '0%').attr('aria-valuenow', 0);

                    let progress = 0;
                    let interval = setInterval(function() {
                        if (progress < 100) {
                            progress += 10;
                            progressBar.css('width', progress + '%').attr('aria-valuenow', progress);
                        }
                    }, 500);

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(response) {
                            if (response.exists) {
                                clearInterval(interval);
                                progressBar.css('width', '100%').attr('aria-valuenow', 100);
                                loadingProgress.addClass('d-none');

                                const pdfUrl =
                                    `{{ url('/' . ltrim('storage/assessments/` + userId + `.pdf', '/')) }}`;

                                if (pdfUrl.match(/\.pdf$/i)) {
                                    documentContent.html('<embed src="' + pdfUrl +
                                        '" type="application/pdf" width="100%" height="500px" />'
                                    ).removeClass('d-none');
                                } else {
                                    documentContent.html('<p>Format file tidak didukung.</p>')
                                        .removeClass('d-none');
                                }
                            } else {
                                clearInterval(interval);
                                loadingProgress.addClass('d-none');
                                documentContent.html(
                                    '<p>Mohon maaf, ada kesalahan dalam mengambil data.</p>'
                                ).removeClass('d-none');
                            }
                        },
                        error: function() {
                            clearInterval(interval);
                            loadingProgress.addClass('d-none');
                            documentContent.html(
                                '<p>Mohon maaf, ada kesalahan pada server.</p>'
                            ).removeClass('d-none');
                        }
                    });
                });

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
                        documentContent.html('<p>Format file tidak didukung.</p>');
                    }
                });
            });
        </script>
    @endprepend
</x-admin>
