<x-user title="Informasi Umum" name="Informasi Umum">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-lg-2 g-0">
            <div class="col-md-10 col-lg-8">
                <div class="alert alert-light" role="alert">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('setting.index') }}"
                                    class="text-decoration-none">Pengaturan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Informasi Umum</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-md-10 col-lg-8">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <form action="{{ route('setting.generalAct') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Category Area --}}
                            <div class="mb-3">
                                <label for="category_area" class="form-label">Kategori Area</label>
                                <select name="category_area" id="category_area" class="form-select">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categoryAreas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_area', $mosque->category_area_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_area')
                                    <small
                                        style="display: block; width: 100%; margin-top: .25rem; font-size: .875em; color: #dc3545;">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            {{-- Category Masjid --}}
                            <div class="mb-3">
                                <label for="category_mosque" class="form-label">Kategori Masjid</label>

                                @foreach ($categoryMosques as $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="category_mosque"
                                            id="category_mosque_{{ $item->id }}" value="{{ $item->id }}"
                                            {{ old('category_mosque', $mosque->category_mosque_id) == $item->id ? 'checked' : '' }}>

                                        <label class="form-check-label" for="category_mosque_{{ $item->id }}">
                                            {{ $item->name }}<br />
                                            <small>{{ $item->description }}</small>
                                        </label>
                                    </div>
                                @endforeach

                                @error('category_mosque')
                                    <small
                                        style="display: block; width: 100%; margin-top: .25rem; font-size: .875em; color: #dc3545;">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                            {{-- Mosque Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Masjid/Musala</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukan nama masjid/musala"
                                    value="{{ old('name', $mosque->name) }}">

                                @error('name')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Capacity --}}
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Kapasitas Jamaah
                                    Masjid/Musala Saat Sholat Jum’at</label>
                                <input type="number" min="10"
                                    class="form-control @error('capacity') is-invalid @enderror" id="capacity"
                                    name="capacity" placeholder="Masukan kapasitas tempat ibadah"
                                    value="{{ old('capacity', $mosque->capacity) }}">

                                @error('capacity')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Logo --}}
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>

                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo">

                                <div class="form-text">Hanya file bertipe jpg, png dan jpeg yang di
                                    izinkan.</div>

                                <button type="button" class="border-0 p-0 bg-transparent text-primary mt-2"
                                    data-bs-toggle="modal" data-bs-target="#logoModal">
                                    Pratinjau Logo
                                </button>

                                @error('logo')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Leader Name --}}
                            <div class="mb-3">
                                <label for="leader" class="form-label">Nama Ketua Pengurus DKM</label>
                                <input type="text" class="form-control @error('leader') is-invalid @enderror"
                                    id="leader" name="leader" placeholder="Masukan nama pengurus DKM"
                                    value="{{ old('leader', $mosque->leader) }}">

                                @error('leader')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Leader Phone --}}
                            <div class="mb-3">
                                <label for="leader_phone" class="form-label">No HP Ketua Pengurus
                                    DKM</label>
                                <input type="text" class="form-control @error('leader_phone') is-invalid @enderror"
                                    id="leader_phone" name="leader_phone" minlength="10" maxlength="13"
                                    placeholder="Masukan nomor ponsel pengurus DKM"
                                    value="{{ old('leader_phone', $mosque->leader_phone) }}">

                                @error('leader_phone')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Leader Email --}}
                            <div class="mb-3">
                                <label for="leader_email" class="form-label">Email Ketua Pengurus
                                    DKM</label>
                                <input type="email" class="form-control @error('leader_email') is-invalid @enderror"
                                    id="leader_email" name="leader_email"
                                    placeholder="Masukan alamat email pengurus DKM"
                                    value="{{ old('leader_email', $mosque->leader_email) }}">

                                @error('leader_email')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Business Line --}}
                            <div class="mb-3">
                                <label for="business_line" class="form-label">Lini Bisnis, Yayasan &
                                    Koperasi, Head Office</label>
                                <select class="form-select @error('business_line') is-invalid @enderror"
                                    id="business_line" name="business_line">
                                    <option value="">-- Pilih Lini Bisnis, Yayasan & Koperasi, Head Office --
                                    </option>
                                    @foreach ($businessLines as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('business_line', $mosque->company->businessLine->id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('business_line')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Parent Company --}}
                            <div class="mb-3">
                                <label for="parent_company" class="form-label">Induk Perusahaan</label>
                                <select class="form-select @error('parent_company') is-invalid @enderror"
                                    id="parent_company" name="parent_company">
                                    <option value="">-- Pilih Induk Perusahaan --</option>
                                    @foreach ($parentCompanies as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('parent_company', $mosque->company->parentCompany->id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('parent_company')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Company --}}
                            <div class="mb-3">
                                <label for="company" class="form-label">Perusahaan</label>
                                <select class="form-select @error('company') is-invalid @enderror" id="company"
                                    name="company">
                                    <option value="">-- Pilih Perusahaan --</option>
                                </select>

                                <div class="form-text">Pilih Lini Bisnis dan Induk Perusahaan untuk mendapatkan nama
                                    perusahaan.</div>

                                @error('company')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            <input type="hidden" id="old_company_id"
                                value="{{ old('company', $mosque->company->id) }}">

                            {{-- Address --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="5"
                                    placeholder="Masukan alamat">{{ old('address', $mosque->address) }}</textarea>

                                @error('address')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- Province --}}
                            <div class="mb-3">
                                <label for="province" class="form-label">Provinsi</label>
                                <select class="form-select @error('province') is-invalid @enderror" id="province"
                                    name="province">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('province', $mosque->city->province->id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('province')
                                    <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                                @enderror
                            </div>

                            {{-- City --}}
                            <div class="mb-3 mb-md-4">
                                <label for="city" class="form-label">Kota/Kabupaten</label>
                                <select class="form-select @error('city') is-invalid @enderror" id="city"
                                    name="city">
                                    <option value="">-- Pilih Kota/Kabupaten --</option>
                                </select>

                                @error('city')
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

    {{-- Modal --}}
    <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoModalLabel">Pratinjau Logo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @if (!empty($mosque->logo))
                        <img id="logoPreview" src="{{ asset('storage/' . $mosque->logo) }}" alt="Logo Preview"
                            class="img-fluid" />
                    @else
                        <img id="logoPreview" src="" alt="Logo Preview" class="img-fluid d-none" />
                        <p id="noLogoMessage">Anda belum menggunggah logo masjid/musala</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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

                // ===========================================================================

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

                // ===============================================================================

                const oldCityId = "{{ old('city', $mosque->city->id ?? '') }}";
                const oldProvinceId = "{{ old('province', $mosque->city->province->id ?? '') }}";

                function loadCities(provinceId, selectedCityId = null) {
                    const citySelect = document.getElementById('city');
                    citySelect.innerHTML = '<option value="">-- Pilih Kota/Kabupaten --</option>';

                    if (provinceId) {
                        fetch(`/api/cities/${provinceId}`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(city => {
                                    let option = document.createElement('option');
                                    option.value = city.id;
                                    option.text = city.name;

                                    if (city.id == selectedCityId) {
                                        option.selected = true;
                                    }

                                    citySelect.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching cities:', error));
                    }
                }

                document.getElementById('province').addEventListener('change', function() {
                    const provinceId = this.value;
                    loadCities(provinceId);
                });

                if (oldProvinceId) {
                    loadCities(oldProvinceId, oldCityId);
                }

                // ===============================================================================

                document.getElementById('business_line').addEventListener('change', fetchCompanies);
                document.getElementById('parent_company').addEventListener('change', fetchCompanies);

                function fetchCompanies() {
                    const businessLineId = document.getElementById('business_line').value;
                    const parentCompanyId = document.getElementById('parent_company').value;
                    const oldCompanyId = document.getElementById('old_company_id').value;

                    const companySelect = document.getElementById('company');
                    companySelect.innerHTML = '<option value="">-- Pilih Perusahaan --</option>';

                    if (businessLineId && parentCompanyId) {
                        fetch(`/api/companies?business_line_id=${businessLineId}&parent_company_id=${parentCompanyId}`)
                            .then(response => response.json())
                            .then(data => {
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
                            .catch(error => console.error('Error fetching companies:', error));
                    }
                }

                const initialBusinessLineId = "{{ old('business_line', $mosque->company->businessLine->id ?? '') }}";
                const initialParentCompanyId = "{{ old('parent_company', $mosque->company->parentCompany->id ?? '') }}";

                if (initialBusinessLineId && initialParentCompanyId) {
                    document.getElementById('business_line').value = initialBusinessLineId;
                    document.getElementById('parent_company').value = initialParentCompanyId;
                    fetchCompanies();
                }
            });
        </script>
    @endprepend
</x-user>
