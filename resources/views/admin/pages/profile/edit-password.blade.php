<x-admin title="Edit Password">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Password
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('dashboard_profile.update_pass') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="current_password" class="col-md-3 col-xl-2 col-form-label">Password Saat Ini</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="password" name="current_password" id="current_password"
                            class="form-control @error('current_password') is-invalid @enderror">

                        @error('current_password')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password" class="col-md-3 col-xl-2 col-form-label">Password Baru</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="password" name="new_password" id="new_password"
                            class="form-control @error('new_password') is-invalid @enderror">

                        @error('new_password')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="new_password_confirmation" class="col-md-3 col-xl-2 col-form-label">Konfirmasi Password
                        Baru</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="form-control">
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
                window.location.href = "{{ route('dashboard_profile.index') }}";
            });
        </script>
    @endprepend
</x-admin>
