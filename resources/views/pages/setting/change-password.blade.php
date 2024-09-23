<x-user title="Ganti Kata Sandi" name="Ganti Kata Sandi">
    <div class="container py-4">
        <div class="row row-cols-1 g-3">
            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('setting.changePasswordAct') }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Current Password --}}
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>

                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password"
                                        value="{{ old('current_password') }}" placeholder="Masukan password saat ini">

                                    <span class="input-group-text"><i class="bi bi-eye toggle-password"
                                            id="toggleCurrentPassword"></i></span>

                                    @error('current_password')
                                        <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Password Baru --}}
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>

                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password" name="new_password" value="{{ old('new_password') }}"
                                        placeholder="Masukan password baru">

                                    <span class="input-group-text"><i class="bi bi-eye toggle-password"
                                            id="toggleNewPassword"></i></span>

                                    @error('new_password')
                                        <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password
                                    Baru</label>

                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        id="new_password_confirmation" name="new_password_confirmation"
                                        placeholder="Masukan konfirmasi password baru">

                                    <span class="input-group-text"><i class="bi bi-eye toggle-password"
                                            id="toggleConfirmPassword"></i></span>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-warning">Ganti Kata Sandi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                $('#toggleCurrentPassword').on('click', function() {
                    let input = $('#current_password');
                    let icon = $(this);
                    togglePasswordVisibility(input, icon);
                });

                $('#toggleNewPassword').on('click', function() {
                    let input = $('#new_password');
                    let icon = $(this);
                    togglePasswordVisibility(input, icon);
                });

                $('#toggleConfirmPassword').on('click', function() {
                    let input = $('#new_password_confirmation');
                    let icon = $(this);
                    togglePasswordVisibility(input, icon);
                });

                function togglePasswordVisibility(input, icon) {
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        icon.removeClass('bi-eye').addClass('bi-eye-slash');
                    } else {
                        input.attr('type', 'password');
                        icon.removeClass('bi-eye-slash').addClass('bi-eye');
                    }
                }
            });
        </script>
    @endprepend
</x-user>
