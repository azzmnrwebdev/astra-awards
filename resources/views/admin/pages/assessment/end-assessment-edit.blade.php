<x-admin title="Edit Penilaian Akhir {{ $user->mosque->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Penilaian Akhir
        {{ $user->mosque->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-5">
                <h5 class="card-title fw-semibold mb-3">Penilaian Akhir</h5>

                <form action="{{ route('end_assessment.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $endAssessment?->id ?? '' }}">
                    <input type="hidden" name="mosque_id" value="{{ $user->mosque->id }}">

                    {{-- Pillar 2 --}}
                    <div class="row mb-3">
                        <label for="presentation_value_pillar_two" class="col-md-3 col-xl-2 col-form-label">Hubungan DKM
                            dengan YAA <span class="text-danger fw-semibold">*</span></label>

                        <div class="col-md-9 col-xl-10">
                            <select class="form-select @error('presentation_value_pillar_two') is-invalid @enderror"
                                id="presentation_value_pillar_two" name="presentation_value_pillar_two">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_value_pillar_two', $endAssessment?->presentation_value_pillar_two) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_value_pillar_two', $endAssessment?->presentation_value_pillar_two) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_value_pillar_two', $endAssessment?->presentation_value_pillar_two) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_value_pillar_two', $endAssessment?->presentation_value_pillar_two) == 9 ? 'selected' : '' }}>
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
                            Manajemen Perusahaan dengan DKM dan Jamaah <span
                                class="text-danger fw-semibold">*</span></label>

                        <div class="col-md-9 col-xl-10">
                            <select class="form-select @error('presentation_value_pillar_one') is-invalid @enderror"
                                id="presentation_value_pillar_one" name="presentation_value_pillar_one">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_value_pillar_one', $endAssessment?->presentation_value_pillar_one) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_value_pillar_one', $endAssessment?->presentation_value_pillar_one) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_value_pillar_one', $endAssessment?->presentation_value_pillar_one) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_value_pillar_one', $endAssessment?->presentation_value_pillar_one) == 9 ? 'selected' : '' }}>
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
                            Sosial <span class="text-danger fw-semibold">*</span></label>

                        <div class="col-md-9 col-xl-10">
                            <select class="form-select @error('presentation_value_pillar_three') is-invalid @enderror"
                                id="presentation_value_pillar_three" name="presentation_value_pillar_three">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_value_pillar_three', $endAssessment?->presentation_value_pillar_three) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_value_pillar_three', $endAssessment?->presentation_value_pillar_three) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_value_pillar_three', $endAssessment?->presentation_value_pillar_three) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_value_pillar_three', $endAssessment?->presentation_value_pillar_three) == 9 ? 'selected' : '' }}>
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
                        <label for="presentation_value_pillar_four"
                            class="col-md-3 col-xl-2 col-form-label">Administrasi
                            dan Keuangan <span class="text-danger fw-semibold">*</span></label>

                        <div class="col-md-9 col-xl-10">
                            <select class="form-select @error('presentation_value_pillar_four') is-invalid @enderror"
                                id="presentation_value_pillar_four" name="presentation_value_pillar_four">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_value_pillar_four', $endAssessment?->presentation_value_pillar_four) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_value_pillar_four', $endAssessment?->presentation_value_pillar_four) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_value_pillar_four', $endAssessment?->presentation_value_pillar_four) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_value_pillar_four', $endAssessment?->presentation_value_pillar_four) == 9 ? 'selected' : '' }}>
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
                            dan Infrastruktur <span class="text-danger fw-semibold">*</span></label>

                        <div class="col-md-9 col-xl-10">
                            <select class="form-select @error('presentation_value_pillar_five') is-invalid @enderror"
                                id="presentation_value_pillar_five" name="presentation_value_pillar_five">
                                <option value="">-- Pilih Nilai Akhir --</option>
                                <option value="1"
                                    {{ old('presentation_value_pillar_five', $endAssessment?->presentation_value_pillar_five) == 1 ? 'selected' : '' }}>
                                    1
                                </option>
                                <option value="3"
                                    {{ old('presentation_value_pillar_five', $endAssessment?->presentation_value_pillar_five) == 3 ? 'selected' : '' }}>
                                    3
                                </option>
                                <option value="7"
                                    {{ old('presentation_value_pillar_five', $endAssessment?->presentation_value_pillar_five) == 7 ? 'selected' : '' }}>
                                    7
                                </option>
                                <option value="9"
                                    {{ old('presentation_value_pillar_five', $endAssessment?->presentation_value_pillar_five) == 9 ? 'selected' : '' }}>
                                    9
                                </option>
                            </select>

                            @error('presentation_value_pillar_five')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        @if (!$endAssessment)
                            <button type="submit" class="btn btn-success">Simpan Nilai</button>
                        @else
                            <button type="submit" class="btn btn-warning">Ubah Nilai</button>
                        @endif
                    </div>
                </form>
            </div>

            <div class="mb-4">
                <h5 class="card-title fw-semibold">Juri Penilaian Awal</h5>

                <ol class="list-group list-group-numbered mt-3">
                    @foreach ($user->mosque->presentation->startAssessment as $item)
                        <li class="list-group-item border-0 py-1">{{ $item->jury->name }}</li>
                    @endforeach
                </ol>
            </div>

            <h5 class="card-title fw-semibold mb-3">Lampiran Penilaian Awal</h5>

            <embed src="{{ asset($user->mosque->presentation->file) }}" type="application/pdf" width="100%"
                height="500px" />

            <div class="table-responsive mt-3">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            <th class="text-center py-3">Pilar</th>
                            <th class="text-center py-3">Nilai</th>
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @php
                            $assessment = $user->mosque->presentation->startAssessmentForJury(auth()->id())->first();
                        @endphp

                        <tr>
                            <td class="text-start py-3">
                                Hubungan DKM dengan YAA (Bobot 25%)
                            </td>
                            <td class="text-center py-3">
                                {{ $assessment->presentation_file_pillar_two }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)
                            </td>
                            <td class="text-center py-3">
                                {{ $assessment->presentation_file_pillar_one }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Program Sosial (Bobot 20%)
                            </td>
                            <td class="text-center py-3">
                                {{ $assessment->presentation_file_pillar_three }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Administrasi dan Keuangan (Bobot 15%)
                            </td>
                            <td class="text-center py-3">
                                {{ $assessment->presentation_file_pillar_four }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Peribadahan dan Infrastruktur (Bobot 15%)
                            </td>
                            <td class="text-center py-3">
                                {{ $assessment->presentation_file_pillar_five }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Total Nilai
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ $assessment->presentation_file_pillar_two +
                                    $assessment->presentation_file_pillar_one +
                                    $assessment->presentation_file_pillar_three +
                                    $assessment->presentation_file_pillar_four +
                                    $assessment->presentation_file_pillar_five }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Rekap Nilai (Dikalikan Bobot)
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ str_replace(
                                    '.',
                                    ',',
                                    $assessment->presentation_file_pillar_two * 0.25 +
                                        $assessment->presentation_file_pillar_one * 0.25 +
                                        $assessment->presentation_file_pillar_three * 0.2 +
                                        $assessment->presentation_file_pillar_four * 0.15 +
                                        $assessment->presentation_file_pillar_five * 0.15,
                                ) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Total Nilai Berdasarkan Seluruh Juri Yang Menilai
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                    return $sumAssessment->presentation_file_pillar_two +
                                        $sumAssessment->presentation_file_pillar_one +
                                        $sumAssessment->presentation_file_pillar_three +
                                        $sumAssessment->presentation_file_pillar_four +
                                        $sumAssessment->presentation_file_pillar_five;
                                }) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Rekap Nilai Berdasarkan Seluruh Juri Yang Menilai (Dikalikan Bobot)
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ str_replace(
                                    '.',
                                    ',',
                                    $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_two * 0.25 +
                                            $sumAssessment->presentation_file_pillar_one * 0.25 +
                                            $sumAssessment->presentation_file_pillar_three * 0.2 +
                                            $sumAssessment->presentation_file_pillar_four * 0.15 +
                                            $sumAssessment->presentation_file_pillar_five * 0.15;
                                    }),
                                ) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('end_assessment.index') }}";
            });
        </script>
    @endprepend
</x-admin>
