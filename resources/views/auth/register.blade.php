<x-guest title="Daftar">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-12 col-md-10">
            {{-- Timeline Kegiatan --}}
            <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h5 class="card-title mb-3" style="font-weight: 600;">Timeline Kegiatan</h5>

                    <div class="table-responsive">
                        <table class="table text-nowrap align-middle mb-0">
                            <tbody class="border">
                                <tr>
                                    <td class="py-3 fw-semibold">Pendaftaran</td>
                                    <td class="py-3 fw-semibold">:</td>
                                    <td class="py-3">
                                        @if ($timeline)
                                            @if ($timeline->start_registration && $timeline->end_registration)
                                                {{ \Carbon\Carbon::parse($timeline->start_registration)->locale('id')->translatedFormat('d F Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($timeline->end_registration)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->start_registration)
                                                {{ \Carbon\Carbon::parse($timeline->start_registration)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->end_registration)
                                                {{ \Carbon\Carbon::parse($timeline->end_registration)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        @else
                                            Belum di tentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 fw-semibold">Pengisian Formulir</td>
                                    <td class="py-3 fw-semibold">:</td>
                                    <td class="py-3">
                                        @if ($timeline)
                                            @if ($timeline->start_form && $timeline->end_form)
                                                {{ \Carbon\Carbon::parse($timeline->start_form)->locale('id')->translatedFormat('d F Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($timeline->end_form)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->start_form)
                                                {{ \Carbon\Carbon::parse($timeline->start_form)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->end_form)
                                                {{ \Carbon\Carbon::parse($timeline->end_form)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        @else
                                            Belum di tentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 fw-semibold">Seleksi</td>
                                    <td class="py-3 fw-semibold">:</td>
                                    <td class="py-3">
                                        @if ($timeline)
                                            @if ($timeline->start_selection && $timeline->end_selection)
                                                {{ \Carbon\Carbon::parse($timeline->start_selection)->locale('id')->translatedFormat('d F Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($timeline->end_selection)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->start_selection)
                                                {{ \Carbon\Carbon::parse($timeline->start_selection)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->end_selection)
                                                {{ \Carbon\Carbon::parse($timeline->end_selection)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        @else
                                            Belum di tentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 fw-semibold">Penilaian Awal</td>
                                    <td class="py-3 fw-semibold">:</td>
                                    <td class="py-3">
                                        @if ($timeline)
                                            @if ($timeline->start_initial_assessment && $timeline->end_initial_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->start_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($timeline->end_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->start_initial_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->start_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->end_initial_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->end_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        @else
                                            Belum di tentukan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 fw-semibold">Penilaian Akhir</td>
                                    <td class="py-3 fw-semibold">:</td>
                                    <td class="py-3">
                                        @if ($timeline)
                                            @if ($timeline->start_final_assessment && $timeline->end_final_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->start_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($timeline->end_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->start_final_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->start_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @elseif ($timeline->end_final_assessment)
                                                {{ \Carbon\Carbon::parse($timeline->end_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        @else
                                            Belum di tentukan
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Form Pendaftaran --}}
            <form id="registrationForm" action="{{ route('registerAct') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                {{-- PIC Amaliah Astra Awards --}}
                <div class="card border-0 shadow mb-4" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <h5 class="card-title mb-3" style="font-weight: 600;">PIC Amaliah Astra Awards</h5>

                        <div class="row g-4">
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

                            {{-- Konfirmasi Password --}}
                            <div class="col-lg-6">
                                <label for="password_confirmation" class="form-label fw-medium">Konfirmasi
                                    Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Masukan konfirmasi password">

                                    <span class="input-group-text">
                                        <i class="bi bi-eye" id="toggle-password-confirm"
                                            style="cursor: pointer;"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Umum --}}
                <div class="card border-0 shadow" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <h5 class="card-title mb-3" style="font-weight: 600;">Informasi Umum</h5>

                        <div class="row g-4">
                            {{-- Kategori Area --}}
                            <div class="col-12">
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

                            {{-- Kategori Masjid --}}
                            <div class="col-12">
                                <label for="category_mosque_id" class="form-label fw-medium">Kategori Masjid</label>

                                @foreach ($categoryMosques as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category_mosque_id"
                                            id="category_mosque_{{ $item->id }}" value="{{ $item->id }}"
                                            {{ old('category_mosque_id') == $item->id ? 'checked' : '' }}>

                                        <label class="form-check-label" for="category_mosque_{{ $item->id }}">
                                            {{ $item->name }}<br />
                                            <small>{{ $item->description }}</small>
                                        </label>
                                    </div>
                                @endforeach

                                @error('category_mosque_id')
                                    <small
                                        style="display: block; width: 100%; margin-top: .25rem; font-size: .875em; color: #dc3545;">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            {{-- Nama Masjid --}}
                            <div class="col-lg-6">
                                <label for="name_mosque" class="form-label fw-medium">Nama Masjid/Musala</label>
                                <input type="text" class="form-control @error('name_mosque') is-invalid @enderror"
                                    id="name_mosque" name="name_mosque" placeholder="Masukan nama masjid/Musala"
                                    value="{{ old('name_mosque') }}">

                                @error('name_mosque')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Kapasitas Jamaah Masjid/Musala --}}
                            <div class="col-lg-6">
                                <label for="capacity" class="form-label fw-medium">Kapasitas Jamaah
                                    Masjid/Musala</label>
                                <input type="number" min="10"
                                    class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                    name="capacity" placeholder="Masukan kapasitas tempat ibadah"
                                    value="{{ old('capacity') }}">

                                @error('capacity')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Logo Masjid --}}
                            <div class="col-12">
                                <label for="logo" class="form-label fw-medium">Logo Masjid/Musala</label>

                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo">

                                <div class="form-text">Hanya file bertipe jpg, png dan jpeg yang di
                                    izinkan.</div>

                                <button type="button" class="border-0 p-0 bg-transparent text-primary mt-2"
                                    data-bs-toggle="modal" data-bs-target="#logoModal">
                                    Petinjau Logo
                                </button>

                                @error('logo')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
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

                            {{-- No HP Ketua Pengurus DKM --}}
                            <div class="col-lg-6">
                                <label for="leader_phone" class="form-label fw-medium">No HP Ketua Pengurus
                                    DKM</label>
                                <input type="text"
                                    class="form-control @error('leader_phone') is-invalid @enderror"
                                    id="leader_phone" name="leader_phone" minlength="10" maxlength="13"
                                    placeholder="Masukan nomor ponsel pengurus DKM"
                                    value="{{ old('leader_phone') }}">

                                @error('leader_phone')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Email Ketua Pengurus DKM --}}
                            <div class="col-12">
                                <label for="leader_email" class="form-label fw-medium">Email Ketua Pengurus
                                    DKM</label>
                                <input type="email"
                                    class="form-control @error('leader_email') is-invalid @enderror"
                                    id="leader_email" name="leader_email"
                                    placeholder="Masukan alamat email pengurus DKM"
                                    value="{{ old('leader_email') }}">

                                @error('leader_email')
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
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('business_line_id')
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
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('parent_company_id')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Perusahaan --}}
                            <div class="col-12">
                                <label for="company_id" class="form-label fw-medium">Perusahaan</label>
                                <select class="form-select @error('company_id') is-invalid @enderror" id="company_id"
                                    name="company_id">
                                    <option value="">-- Pilih Perusahaan --</option>
                                </select>

                                <div class="form-text">Pilih Lini Bisnis dan Induk Perusahaan untuk mendapatkan nama
                                    perusahaan.</div>

                                @error('company_id')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            <input type="hidden" id="old_company_id" value="{{ old('company_id') }}">

                            {{-- Alamat --}}
                            <div class="col-12">
                                <label for="address" class="form-label fw-medium">Alamat</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5"
                                    placeholder="Masukan alamat">{{ old('address') }}</textarea>

                                @error('address')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Provinsi --}}
                            <div class="col-lg-6 mb-lg-4">
                                <label for="province_id" class="form-label fw-medium">Provinsi</label>
                                <select class="form-select @error('province_id') is-invalid @enderror"
                                    id="province_id" name="province_id">
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

                            {{-- Kota/Kabupaten --}}
                            <div class="col-lg-6">
                                <label for="city_id" class="form-label fw-medium">Kota/Kabupaten</label>
                                <select class="form-select @error('city_id') is-invalid @enderror" id="city_id"
                                    name="city_id">
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                </select>

                                @error('city_id')
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoModalLabel">Petinjau Logo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <img id="logoPreview" src="" alt="Logo Preview" class="img-fluid d-none" />
                    <p id="noLogoMessage">Anda belum menggunggah logo masjid/Musala</p>
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

                // Input Leader Phone
                const leaderPhoneInput = document.getElementById('leader_phone');

                if (leaderPhoneInput.value === '') {
                    leaderPhoneInput.value = '08';
                }

                leaderPhoneInput.addEventListener('input', function() {
                    let value = leaderPhoneInput.value;

                    if (value.startsWith('+62')) {
                        value = '08' + value.slice(3);
                    }

                    value = value.replace(/[^0-9]/g, '');

                    if (!value.startsWith('08')) {
                        value = '08';
                    }

                    leaderPhoneInput.value = value;
                });

                leaderPhoneInput.addEventListener('keydown', function(event) {
                    const value = leaderPhoneInput.value;

                    if (value === '08' && (event.key === 'Backspace' || event.key === 'Delete')) {
                        event.preventDefault();
                    }
                });

                // Input Password
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

                document.getElementById('toggle-password-confirm').addEventListener('click', function() {
                    togglePasswordVisibility('password_confirmation', this);
                });

                // Select Company
                document.getElementById('business_line_id').addEventListener('change', fetchCompanies);
                document.getElementById('parent_company_id').addEventListener('change', fetchCompanies);

                function fetchCompanies() {
                    const businessLineId = document.getElementById('business_line_id').value;
                    const parentCompanyId = document.getElementById('parent_company_id').value;
                    const oldCompanyId = document.getElementById('old_company_id').value;

                    if (businessLineId && parentCompanyId) {
                        fetch(`/api/companies?business_line_id=${businessLineId}&parent_company_id=${parentCompanyId}`)
                            .then(response => response.json())
                            .then(data => {
                                let companySelect = document.getElementById('company_id');
                                companySelect.innerHTML = '<option value="">-- Pilih Perusahaan --</option>';

                                data.forEach(company => {
                                    let option = document.createElement('option');
                                    option.value = company.id;
                                    option.text = company.name;

                                    if (company.id == oldCompanyId) {
                                        option.selected = true;
                                    }

                                    companySelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error:', error));
                    }
                }

                if ("{{ old('business_line_id') }}" && "{{ old('parent_company_id') }}") {
                    fetchCompanies();
                }

                // Select Kota/Kabupaten
                const oldCityId = "{{ old('city_id') }}";

                document.getElementById('province_id').addEventListener('change', function() {
                    const provinceId = this.value;

                    let citySelect = document.getElementById('city_id');
                    citySelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';

                    if (provinceId) {
                        fetch(`/api/cities/${provinceId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(city => {
                                    let option = document.createElement('option');
                                    option.value = city.id;
                                    option.text = city.name;

                                    if (city.id == oldCityId) {
                                        option.selected = true;
                                    }

                                    citySelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching cities:', error));
                    }
                });

                if ("{{ old('province_id') }}") {
                    document.getElementById('province_id').dispatchEvent(new Event('change'));
                }

                // Preview Logo
                document.getElementById('logo').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const logoPreview = document.getElementById('logoPreview');
                    const noLogoMessage = document.getElementById('noLogoMessage');

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            logoPreview.src = e.target.result;
                            logoPreview.classList.remove('d-none');
                            noLogoMessage.classList.add('d-none');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        logoPreview.classList.add('d-none');
                        noLogoMessage.classList.remove('d-none');
                    }
                });
            });
        </script>
    @endprepend
</x-guest>
