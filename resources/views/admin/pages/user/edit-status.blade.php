<x-admin title="Edit Status DKM">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Status DKM
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('user.update_status', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="status" class="col-md-3 col-xl-2 col-form-label">Status Akun</label>

                    <div class="col-md-9 col-xl-10">
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">-- Pilih Status Akun --</option>
                            <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>
                                Proses Verifikasi
                            </option>
                            <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>
                                Di Setujui
                            </option>
                            <option value="2" {{ old('status', $user->status) == 2 ? 'selected' : '' }}>
                                Di Tolak
                            </option>
                        </select>

                        @error('status')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 d-none" id="reason">
                    <label for="rejection_reason" class="col-md-3 col-xl-2 col-form-label">Alasan Penolakan</label>

                    <div class="col-md-9 col-xl-10">
                        <textarea class="form-control @error('rejection_reason') is-invalid @enderror" id="rejection_reason"
                            name="rejection_reason" rows="5">{{ old('rejection_reason') }}</textarea>

                        @error('rejection_reason')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('user.index') }}";
            });

            document.getElementById('status').addEventListener('change', function() {
                let reasonField = document.getElementById('reason');

                if (this.value == '2') {
                    reasonField.classList.remove('d-none');
                } else {
                    reasonField.classList.add('d-none');
                }
            });

            document.getElementById('status').dispatchEvent(new Event('change'));
        </script>
    @endprepend
</x-admin>
