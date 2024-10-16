<x-admin title="Penilaian Akhir {{ $user->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Penilaian Akhir
        {{ $user->mosque->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-3">
                <h5 class="card-title fw-semibold">Juri Menilai File Presentasi</h5>

                <ul class="list-group mt-3">
                    <li class="list-group-item border-0 py-1">
                        {{ $user->mosque->presentation->startAssessment->jury->name }}</li>
                </ul>
            </div>

            <div class="mb-5">
                <h5 class="card-title fw-semibold">File Presentasi</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-custom">
                            <tr>
                                <th class="text-center py-3">Pertanyaan</th>
                                <th class="text-center py-3">File Presentasi</th>
                                <th class="text-center py-3">Nilai</th>
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            @if ($user->mosque->presentation->startAssessment)
                                <tr>
                                    <td class="text-start py-3">
                                        Silahkan untuk mengunggah file presentasi yang memuat keseluruhan pilar
                                        penilaian
                                        (Pilar 1, 2, 3, 4, dan 5)
                                    </td>
                                    <td class="text-center py-3">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                            data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                                            Lihat File
                                        </button>
                                    </td>
                                    <td class="text-center py-3">
                                        {{ $user->mosque->presentation->startAssessment->presentation_file }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="3" class="text-center text-danger py-3">Penilaian belum
                                        dilakukan</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <form action="{{ route('end_assessment.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="mosque_id" value="{{ $user->mosque->id }}">

                <div class="row mb-3">
                    <label for="presentation_value" class="col-md-3 col-xl-2 col-form-label">Nilai Akhir</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value') is-invalid @enderror"
                            id="presentation_value" name="presentation_value">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value', $user->mosque->endAssessment?->presentation_value) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value', $user->mosque->endAssessment?->presentation_value) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value', $user->mosque->endAssessment?->presentation_value) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value', $user->mosque->endAssessment?->presentation_value) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-end">
                    @if (!$user->mosque->endAssessment)
                        <button type="submit" class="btn btn-success">Simpan Nilai</button>
                    @else
                        <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
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
                window.location.href = "{{ route('end_assessment.index') }}";
            });

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
</x-admin>
