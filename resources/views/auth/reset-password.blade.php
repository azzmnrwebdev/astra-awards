<x-guest title="Reset Password">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h5 class="card-title mb-3" style="font-weight: 600;">Masukan password baru Anda</h5>

                    <form class="row g-3" action="{{ route('resetPasswordAct') }}" method="POST">
                        @csrf

                        {{-- Token --}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        {{-- Password --}}
                        <div class="col-12">
                            <label for="password" class="form-label fw-medium">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukan password baru"
                                value="{{ old('password') }}">

                            @error('password')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Button --}}
                        <div class="col-12 text-lg-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            //
        </script>
    @endprepend
</x-guest>
