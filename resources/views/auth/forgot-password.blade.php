<x-guest title="Lupa Password">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h5 class="card-title mb-3" style="font-weight: 600;">Masukan email Anda</h5>

                    {{-- Alert Error --}}
                    @if (Session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session('error') }}
                        </div>
                    @endif

                    <form class="row g-3" action="{{ route('forgotPasswordAct') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="col-12">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Masukan alamat email"
                                value="{{ old('email') }}">

                            @error('email')
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
