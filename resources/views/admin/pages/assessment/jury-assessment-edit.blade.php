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

            <h5 class="card-title fw-semibold mb-3">Penilaian Juri</h5>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <embed src="{{ asset($user->mosque->presentation->file) }}" type="application/pdf" width="100%"
                        height="500px" />
                </div>

                <div class="col">
                    <form action="{{ route('jury_assessment.assessmentAct', ['user' => $user->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $startAssessment?->id ?? '' }}">
                        <input type="hidden" name="presentation_id" value="{{ $presentationId }}">

                        {{-- Pillar 2 --}}
                        <div class="mb-3">
                            <label for="presentation_value_pillar_two" class="form-label">Hubungan DKM
                                dengan YAA <span class="text-danger fw-semibold">*</span></label>

                            <select class="form-select @error('presentation_file_pillar_two') is-invalid @enderror"
                                id="presentation_file_pillar_two" name="presentation_file_pillar_two">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_file_pillar_two', $startAssessment?->presentation_file_pillar_two) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_file_pillar_two', $startAssessment?->presentation_file_pillar_two) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_file_pillar_two', $startAssessment?->presentation_file_pillar_two) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_file_pillar_two', $startAssessment?->presentation_file_pillar_two) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_file_pillar_two')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Pillar 1 --}}
                        <div class="mb-3">
                            <label for="presentation_file_pillar_one" class="form-label">Hubungan
                                Manajemen Perusahaan dengan DKM dan Jamaah <span
                                    class="text-danger fw-semibold">*</span></label>

                            <select class="form-select @error('presentation_file_pillar_one') is-invalid @enderror"
                                id="presentation_file_pillar_one" name="presentation_file_pillar_one">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_file_pillar_one', $startAssessment?->presentation_file_pillar_one) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_file_pillar_one', $startAssessment?->presentation_file_pillar_one) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_file_pillar_one', $startAssessment?->presentation_file_pillar_one) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_file_pillar_one', $startAssessment?->presentation_file_pillar_one) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_file_pillar_one')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Pillar 3 --}}
                        <div class="mb-3">
                            <label for="presentation_file_pillar_three" class="form-label">Program
                                Sosial <span class="text-danger fw-semibold">*</span></label>

                            <select class="form-select @error('presentation_file_pillar_three') is-invalid @enderror"
                                id="presentation_file_pillar_three" name="presentation_file_pillar_three">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_file_pillar_three', $startAssessment?->presentation_file_pillar_three) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_file_pillar_three', $startAssessment?->presentation_file_pillar_three) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_file_pillar_three', $startAssessment?->presentation_file_pillar_three) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_file_pillar_three', $startAssessment?->presentation_file_pillar_three) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_file_pillar_three')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Pillar 4 --}}
                        <div class="mb-3">
                            <label for="presentation_file_pillar_four" class="form-label">Administrasi
                                dan Keuangan <span class="text-danger fw-semibold">*</span></label>

                            <select class="form-select @error('presentation_file_pillar_four') is-invalid @enderror"
                                id="presentation_file_pillar_four" name="presentation_file_pillar_four">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_file_pillar_four', $startAssessment?->presentation_file_pillar_four) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_file_pillar_four', $startAssessment?->presentation_file_pillar_four) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_file_pillar_four', $startAssessment?->presentation_file_pillar_four) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_file_pillar_four', $startAssessment?->presentation_file_pillar_four) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_file_pillar_four')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Pillar 5 --}}
                        <div class="mb-3">
                            <label for="presentation_file_pillar_five" class="form-label">Peribadahan
                                dan Infrastruktur <span class="text-danger fw-semibold">*</span></label>

                            <select class="form-select @error('presentation_file_pillar_five') is-invalid @enderror"
                                id="presentation_file_pillar_five" name="presentation_file_pillar_five">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_file_pillar_five', $startAssessment?->presentation_file_pillar_five) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_file_pillar_five', $startAssessment?->presentation_file_pillar_five) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_file_pillar_five', $startAssessment?->presentation_file_pillar_five) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_file_pillar_five', $startAssessment?->presentation_file_pillar_five) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_file_pillar_five')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            @if (!$startAssessment)
                                <button type="submit" class="btn btn-success">Simpan Nilai</button>
                            @else
                                <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
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
            });
        </script>
    @endprepend
</x-admin>
