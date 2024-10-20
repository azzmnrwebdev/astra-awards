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

            <div class="mb-4">
                <h5 class="card-title fw-semibold">Juri Menilai File Presentasi</h5>

                <ul class="list-group mt-3">
                    <li class="list-group-item border-0 py-1">
                        {{ $user->mosque->presentation->startAssessment->jury->name }}</li>
                </ul>
            </div>

            <div class="mb-5">
                <h5 class="card-title fw-semibold mb-3">File Presentasi</h5>

                <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal"
                    data-bs-target="#documentModal"
                    data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                    Lihat File
                </button>

                <div class="table-responsive mt-3">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-custom">
                            <tr>
                                <th class="text-center py-3">Pilar</th>
                                <th class="text-center py-3">Nilai</th>
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            <tr>
                                <td class="text-start py-3">
                                    Hubungan DKM dengan YAA (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_two }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_one }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Program Sosial (Bobot 20%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_three }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Administrasi dan Keuangan (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_four }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Peribadahan dan Infrastruktur (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_five }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Total Nilai
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_two +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_one +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_three +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_four +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_five }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Rekap Nilai (Dikalikan Bobot)
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_two * 0.25 +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_one * 0.25 +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_three * 0.2 +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_four * 0.15 +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_five * 0.15 }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <h5 class="card-title fw-semibold mb-3">Penilaian Akhir</h5>

            <form action="{{ route('end_assessment.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="mosque_id" value="{{ $user->mosque->id }}">

                {{-- Pillar 2 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_two" class="col-md-3 col-xl-2 col-form-label">Hubungan DKM
                        dengan YAA</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value_pillar_two') is-invalid @enderror"
                            id="presentation_value_pillar_two" name="presentation_value_pillar_two">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value_pillar_two', $user->mosque->endAssessment?->presentation_value_pillar_two) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value_pillar_two', $user->mosque->endAssessment?->presentation_value_pillar_two) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value_pillar_two', $user->mosque->endAssessment?->presentation_value_pillar_two) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value_pillar_two', $user->mosque->endAssessment?->presentation_value_pillar_two) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value_pillar_two')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 1 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_one" class="col-md-3 col-xl-2 col-form-label">Hubungan
                        Manajemen Perusahaan dengan DKM dan Jamaah</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value_pillar_one') is-invalid @enderror"
                            id="presentation_value_pillar_one" name="presentation_value_pillar_one">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value_pillar_one', $user->mosque->endAssessment?->presentation_value_pillar_one) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value_pillar_one', $user->mosque->endAssessment?->presentation_value_pillar_one) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value_pillar_one', $user->mosque->endAssessment?->presentation_value_pillar_one) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value_pillar_one', $user->mosque->endAssessment?->presentation_value_pillar_one) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value_pillar_one')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 3 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_three" class="col-md-3 col-xl-2 col-form-label">Program
                        Sosial</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value_pillar_three') is-invalid @enderror"
                            id="presentation_value_pillar_three" name="presentation_value_pillar_three">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value_pillar_three', $user->mosque->endAssessment?->presentation_value_pillar_three) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value_pillar_three', $user->mosque->endAssessment?->presentation_value_pillar_three) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value_pillar_three', $user->mosque->endAssessment?->presentation_value_pillar_three) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value_pillar_three', $user->mosque->endAssessment?->presentation_value_pillar_three) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value_pillar_three')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 4 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_four" class="col-md-3 col-xl-2 col-form-label">Administrasi
                        dan Keuangan</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value_pillar_four') is-invalid @enderror"
                            id="presentation_value_pillar_four" name="presentation_value_pillar_four">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value_pillar_four', $user->mosque->endAssessment?->presentation_value_pillar_four) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value_pillar_four', $user->mosque->endAssessment?->presentation_value_pillar_four) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value_pillar_four', $user->mosque->endAssessment?->presentation_value_pillar_four) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value_pillar_four', $user->mosque->endAssessment?->presentation_value_pillar_four) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value_pillar_four')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                {{-- Pillar 5 --}}
                <div class="row mb-3">
                    <label for="presentation_value_pillar_five" class="col-md-3 col-xl-2 col-form-label">Peribadahan
                        dan Infrastruktur</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('presentation_value_pillar_five') is-invalid @enderror"
                            id="presentation_value_pillar_five" name="presentation_value_pillar_five">
                            <option value="">-- Pilih Nilai Akhir --</option>
                            <option value="1"
                                {{ old('presentation_value_pillar_five', $user->mosque->endAssessment?->presentation_value_pillar_five) == 1 ? 'selected' : '' }}>
                                1
                            </option>
                            <option value="3"
                                {{ old('presentation_value_pillar_five', $user->mosque->endAssessment?->presentation_value_pillar_five) == 3 ? 'selected' : '' }}>
                                3
                            </option>
                            <option value="7"
                                {{ old('presentation_value_pillar_five', $user->mosque->endAssessment?->presentation_value_pillar_five) == 7 ? 'selected' : '' }}>
                                7
                            </option>
                            <option value="9"
                                {{ old('presentation_value_pillar_five', $user->mosque->endAssessment?->presentation_value_pillar_five) == 9 ? 'selected' : '' }}>
                                9
                            </option>
                        </select>

                        @error('presentation_value_pillar_five')
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
