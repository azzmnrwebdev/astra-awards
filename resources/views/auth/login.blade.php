<x-guest title="Masuk">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="card border-0 shadow" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h2 style="margin-bottom: 1.5rem; font-weight: 700;">Masuk</h2>
                    <h5 class="card-title mb-3" style="font-weight: 600;">Assalamu'alaikum Wr Wb 👋</h5>

                    {{-- Alert Success --}}
                    @if (Session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session('success') }}
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if (Session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session('error') }}
                        </div>
                    @endif

                    <form class="row g-3" action="{{ route('loginAct') }}" method="POST">
                        @csrf

                        {{-- email --}}
                        <div class="col-12">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Masukan alamat email"
                                value="{{ old('email') }}">

                            @error('email')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-12 mb-lg-4">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukan password">

                                <span class="input-group-text">
                                    <i class="bi bi-eye" id="toggle-password" style="cursor: pointer;"></i>
                                </span>

                                @error('password')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>
                        </div>

                        {{-- Lupa Password --}}
                        <div class="col-lg-6">
                            <a href="{{ route('forgotPassword') }}" class="text-decoration-none text-primary"
                                style="font-weight: 500;">Lupa
                                password?</a>
                        </div>

                        {{-- Button --}}
                        <div class="col-lg-6 text-lg-end">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>

                        {{-- Register Link --}}
                        <div class="col-12 text-center mt-5">
                            Belum punya akun? <a href="{{ route('register') }}"
                                class="text-decoration-none text-primary" style="font-weight: 500;">Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            function togglePasswordVisibility(inputId, iconElement) {
                let passwordInput = document.getElementById(inputId);
                let icon = iconElement;

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }

            document.getElementById('toggle-password').addEventListener('click', function() {
                togglePasswordVisibility('password', this);
            });
        </script>
    @endprepend
</x-guest>
