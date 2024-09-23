<x-user title="Informasi Akun" name="Informasi Akun">
    <div class="container py-4">
        <div class="row row-cols-1 g-3">
            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('setting.accountAct') }}" method="POST">
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
                                    id="position" name="position"
                                    value="{{ old('position', $userLogin->mosque->position) }}"
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
                                <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user>
