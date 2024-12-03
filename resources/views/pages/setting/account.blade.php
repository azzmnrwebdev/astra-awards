<x-user title="Informasi Akun" name="Informasi Akun">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('setting.index') }}"
                                    class="text-decoration-none">Pengaturan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Informasi Akun</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('setting.accountAct') }}" method="POST">
                            @csrf

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

                            @if (auth()->check() && auth()->user()->hasRole('user'))
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
                            @endif

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

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const phoneNumberInput = document.getElementById('phone_number');

                if (phoneNumberInput.value === '') {
                    phoneNumberInput.value = '08';
                }

                phoneNumberInput.addEventListener('input', function() {
                    let value = phoneNumberInput.value;

                    if (value.startsWith('+62')) {
                        value = '08' + value.slice(3);
                    }

                    value = value.replace(/[^0-9]/g, '');

                    if (!value.startsWith('08')) {
                        value = '08';
                    }

                    phoneNumberInput.value = value;
                });

                phoneNumberInput.addEventListener('keydown', function(event) {
                    const value = phoneNumberInput.value;

                    if (value === '08' && (event.key === 'Backspace' || event.key === 'Delete')) {
                        event.preventDefault();
                    }
                });
            });
        </script>
    @endprepend
</x-user>
