<x-guest title="Daftar">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-10 my-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h3 style="margin-bottom: 1.5rem; font-weight: 700;">Daftar</h3>
                    <h5 class="card-title mb-3" style="font-weight: 600;">PIC Amaliah Astra Awards</h5>

                    <form id="registrationForm" class="row g-3" action="{{ route('registerAct') }}" method="POST">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="col-lg-6">
                            <label for="name" class="form-label fw-medium">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Masukan nama lengkap"
                                value="{{ old('name') }}">

                            @error('name')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="col-lg-6">
                            <label for="position" class="form-label fw-medium">Jabatan di DKM</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                id="position" name="position" placeholder="Masukan jabatan di DKM"
                                value="{{ old('position') }}">

                            @error('position')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Nomor Ponsel --}}
                        <div class="col-lg-6">
                            <label for="phone_number" class="form-label fw-medium">No HP (Aktif WhatsApp)</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="phone_number" name="phone_number" minlength="10" maxlength="13"
                                placeholder="Masukan nomor HP (Aktif WhatsApp)" value="{{ old('phone_number') }}">

                            @error('phone_number')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-lg-6">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Masukan alamat email"
                                value="{{ old('email') }}">

                            @error('email')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="col-lg-6">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Masukan password">

                            @error('password')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="col-lg-6">
                            <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Masukan konfirmasi password">
                        </div>

                        {{-- Informasi Umum --}}
                        <h5 class="card-title mb-3 mt-5" style="font-weight: 600;">Informasi Umum</h5>

                        {{-- Kategori Area --}}
                        <div class="col-12 mt-0">
                            <label for="category_area_id" class="form-label fw-medium">Kategori Area</label>
                            <select class="form-select @error('category_area_id') is-invalid @enderror"
                                id="category_area_id" name="category_area_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categoryAreas as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('category_area_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('category_area_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Nama Masjid --}}
                        <div class="col-lg-6">
                            <label for="name_mosque" class="form-label fw-medium">Nama Masjid/Mushala</label>
                            <input type="text" class="form-control @error('name_mosque') is-invalid @enderror"
                                id="name_mosque" name="name_mosque" placeholder="Masukan nama masjid/mushala"
                                value="{{ old('name_mosque') }}">

                            @error('name_mosque')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Kapasitas Jamaah Masjid/Mushala --}}
                        <div class="col-lg-6">
                            <label for="capacity" class="form-label fw-medium">Kapasitas Jamaah Masjid/Mushala</label>
                            <input type="number" min="10"
                                class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                name="capacity" placeholder="Masukan kapasitas tempat ibadah"
                                value="{{ old('capacity') }}">

                            @error('capacity')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        <div class="col-12">
                            <p class="card-text mb-0 fw-medium">Keterangan: </p>
                            <p class="card-text mb-0 fw-medium">Masjid Besar - Kapasitas lebih dari 500 jamaah.</p>
                            <p class="card-text mb-0 fw-medium">Masjid Sedang - Kapasitas antara 100 hingga 500 jamaah.
                            </p>
                            <p class="card-text mb-0 fw-medium">Mushala - Kapasitas kurang dari 50 jamaah.</p>
                        </div>

                        {{-- Nama Ketua Pengurus DKM --}}
                        <div class="col-lg-6">
                            <label for="leader" class="form-label fw-medium">Nama Ketua Pengurus DKM</label>
                            <input type="text" class="form-control @error('leader') is-invalid @enderror"
                                id="leader" name="leader" placeholder="Masukan nama pengurus DKM"
                                value="{{ old('leader') }}">

                            @error('leader')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Perusahaan --}}
                        <div class="col-lg-6">
                            <label for="company_id" class="form-label fw-medium">Perusahaan</label>
                            <select class="form-select @error('company_id') is-invalid @enderror" id="company_id"
                                name="company_id">
                                <option value="">-- Pilih Perusahaan --</option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('company_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                                <option value="another" {{ old('company_id') == 'another' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>

                            @error('company_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Perusahaan Lain --}}
                        <div class="col-12 {{ old('company_id') == 'another' ? '' : 'd-none' }} otherCompany">
                            <label for="otherCompany" class="form-label fw-medium">Perusahaan Lainnya</label>
                            <input type="text" class="form-control @error('otherCompany') is-invalid @enderror"
                                id="otherCompany" name="otherCompany" placeholder="Masukan nama perusahaan"
                                value="{{ old('otherCompany') }}">

                            @error('otherCompany')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Induk Perusahaan --}}
                        <div class="col-lg-6">
                            <label for="parent_company_id" class="form-label fw-medium">Induk Perusahaan</label>
                            <select class="form-select @error('parent_company_id') is-invalid @enderror"
                                id="parent_company_id" name="parent_company_id">
                                <option value="">-- Pilih Induk Perusahaan --</option>
                                @foreach ($parentCompanies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('parent_company_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                                <option value="another" {{ old('parent_company_id') == 'another' ? 'selected' : '' }}>
                                    Lainnya</option>
                            </select>

                            @error('parent_company_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Lini Bisnis --}}
                        <div class="col-lg-6">
                            <label for="business_line_id" class="form-label fw-medium">Lini Bisnis</label>
                            <select class="form-select @error('business_line_id') is-invalid @enderror"
                                id="business_line_id" name="business_line_id">
                                <option value="">-- Pilih Lini Bisnis --</option>
                                @foreach ($businessLines as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('business_line_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('business_line_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Induk Perusahaan Lain --}}
                        <div
                            class="col-12 {{ old('parent_company_id') == 'another' ? '' : 'd-none' }} otherParentCompany">
                            <label for="otherParentCompany" class="form-label fw-medium">Induk Perusahaan
                                Lainnya</label>
                            <input type="text"
                                class="form-control @error('otherParentCompany') is-invalid @enderror"
                                id="otherParentCompany" name="otherParentCompany"
                                placeholder="Masukan nama induk perusahaan" value="{{ old('otherParentCompany') }}">

                            @error('otherParentCompany')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12">
                            <label for="address" class="form-label fw-medium">Alamat</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5"
                                placeholder="Masukan alamat">{{ old('address') }}</textarea>

                            @error('address')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Kota/Kabupaten --}}
                        <div class="col-lg-6">
                            <label for="city" class="form-label fw-medium">Kota/Kabupaten</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                id="city" name="city" placeholder="Masukan kota/kabupaten"
                                value="{{ old('city') }}">

                            @error('city')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Provinsi --}}
                        <div class="col-lg-6 mb-lg-4">
                            <label for="province_id" class="form-label fw-medium">Provinsi</label>
                            <select class="form-select @error('province_id') is-invalid @enderror" id="province_id"
                                name="province_id">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('province_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>

                            @error('province_id')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>

                        {{-- Lupa Password --}}
                        <div class="col-lg-6">
                            Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-decoration-none text-primary" style="font-weight: 500;">Masuk</a>
                        </div>

                        {{-- Button --}}
                        <div class="col-lg-6 text-lg-end">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('registrationForm');

                form.addEventListener('submit', function(event) {
                    const allInputsFilled = Array.from(form.querySelectorAll('input, select, textarea')).every(
                        input => {
                            return input.value.trim() !== '' || (input.type === 'checkbox' && input
                                .checked);
                        });

                    if (allInputsFilled) {
                        const confirmed = confirm("Apakah anda yakin data telah terisi dengan benar ?");
                        if (!confirmed) {
                            event.preventDefault();
                        }
                    }
                });

                // Input Phone Number
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

                // Select Company
                const companySelect = document.getElementById('company_id');
                const otherCompanyDiv = document.querySelector('div.otherCompany');
                const parentCompanySelect = document.getElementById('parent_company_id');
                const otherParentCompanyDiv = document.querySelector('div.otherParentCompany');

                function toggleOtherCompanyInput() {
                    if (companySelect.value === 'another') {
                        otherCompanyDiv.classList.remove('d-none');
                    } else {
                        otherCompanyDiv.classList.add('d-none');
                    }
                }

                function toggleOtherParentCompanyInput() {
                    if (parentCompanySelect.value === 'another') {
                        otherParentCompanyDiv.classList.remove('d-none');
                    } else {
                        otherParentCompanyDiv.classList.add('d-none');
                    }
                }

                companySelect.addEventListener('change', toggleOtherCompanyInput);
                parentCompanySelect.addEventListener('change', toggleOtherParentCompanyInput);

                toggleOtherCompanyInput();
                toggleOtherParentCompanyInput();
            });
        </script>
    @endprepend
</x-guest>
