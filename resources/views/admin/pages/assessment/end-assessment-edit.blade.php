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
        {{ $user->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

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

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('end_assessment.index') }}";
            });
        </script>
    @endprepend
</x-admin>
