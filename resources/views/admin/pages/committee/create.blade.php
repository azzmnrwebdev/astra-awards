<x-admin title="Tambah Panitia">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Tambah Panitia
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('committee.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-3 col-xl-2 col-form-label">Nama</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Nama Lengkap">

                        @error('name')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-3 col-xl-2 col-form-label">Email</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="example@gmail.com">

                        @error('email')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone_number" class="col-md-3 col-xl-2 col-form-label">Nomor Ponsel</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="phone_number" name="phone_number" id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number') }}" placeholder="081234567890">

                        @error('phone_number')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-3 col-xl-2 col-form-label">Password</label>

                    <div class="col-md-9 col-xl-10">
                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror">

                            <button class="btn btn-dark" type="button" id="generatePassword">Auto Generate</button>

                            @error('password')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password_confirmation" class="col-md-3 col-xl-2 col-form-label">
                        Konfirmasi Password
                    </label>

                    <div class="col-md-9 col-xl-10">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control">
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success">Simpan Baru</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            function generateRandomPassword(length) {
                let password = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+[]{}|;:,.<>?';

                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    password += characters[randomIndex];
                }

                return password;
            }

            document.getElementById('generatePassword').addEventListener('click', function() {
                const password = generateRandomPassword(16);
                document.getElementById('password').value = password;
                document.getElementById('password_confirmation').value = password;
            });

            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('committee.index') }}";
            });
        </script>
    @endprepend
</x-admin>
