<x-user title="Profile" name="Profile">
    <div class="container py-4">
        <div class="row row-cols-1 g-3">
            @if (Session('success'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-success mb-2" role="alert">
                        {{ Session('success') }}
                    </div>
                </div>
            @endif

            @if (Session('error'))
                <div class="col-md-10 col-lg-8">
                    <div class="alert alert-danger mb-2" role="alert">
                        {{ Session('error') }}
                    </div>
                </div>
            @endif

            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">Informasi Akun</h5>

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $userLogin->name) }}"
                                    placeholder="Masukan nama lengkap">

                                @error('name')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Position --}}
                            <div class="mb-3">
                                <label for="position" class="form-label">Jabatan di DKM</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    id="position" name="position" value="{{ old('position', $userLogin->position) }}"
                                    placeholder="Masukan posisi di DKM">

                                @error('position')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $userLogin->email) }}"
                                    placeholder="Masukan alamat email">

                                @error('email')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Phone Number --}}
                            <div class="mb-3 mb-md-4">
                                <label for="phone_number" class="form-label">Nomor Ponsel</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    value="{{ old('phone_number', $userLogin->phone_number) }}"
                                    placeholder="Masukan nomor ponsel">

                                @error('phone_number')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">Atur Ulang Password</h5>

                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Current Password --}}
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" value="{{ old('current_password') }}"
                                    placeholder="Masukan password saat ini">

                                @error('current_password')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" value="{{ old('new_password') }}"
                                    placeholder="Masukan password baru">

                                @error('new_password')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password
                                    Baru</label>
                                <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" name="new_password_confirmation"
                                    placeholder="Masukan konfirmasi password baru">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">Atur Ulang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user>
