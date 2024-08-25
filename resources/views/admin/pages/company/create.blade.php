<x-admin title="Tambah Perusahaan">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Tambah Perusahaan
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('company.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama Perusahaan</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">

                        @error('name')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="parent_company_id" class="col-sm-2 col-form-label">Induk Perusahaan</label>

                    <div class="col-sm-10">
                        <select name="parent_company_id" id="parent_company_id"
                            class="form-select @error('parent_company_id') is-invalid @enderror">
                            <option value="">-- Pilih Induk Perusahaan --</option>
                            @foreach ($parentCompanies as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('parent_company_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                            <option value="another" {{ old('parent_company_id') == 'another' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>

                        @error('parent_company_id')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 {{ old('parent_company_id') == 'another' ? '' : 'd-none' }} otherParentCompany">
                    <label for="otherParentCompany" class="col-sm-2 col-form-label">Induk Perusahaan Lainnya</label>

                    <div class="col-sm-10">
                        <input type="text" name="otherParentCompany" id="otherParentCompany"
                            class="form-control @error('otherParentCompany') is-invalid @enderror"
                            value="{{ old('otherParentCompany') }}">

                        @error('otherParentCompany')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="business_line_id" class="col-sm-2 col-form-label">Lini Bisnis</label>

                    <div class="col-sm-10">
                        <select name="business_line_id" id="business_line_id"
                            class="form-select @error('business_line_id') is-invalid @enderror">
                            <option value="">-- Pilih Lini Bisnis --</option>
                            @foreach ($businessLines as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('business_line_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                </option>
                            @endforeach
                            <option value="another" {{ old('business_line_id') == 'another' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>

                        @error('business_line_id')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 {{ old('business_line_id') == 'another' ? '' : 'd-none' }} otherBusinessLine">
                    <label for="otherBusinessLine" class="col-sm-2 col-form-label">Lini Bisnis Lainnya</label>

                    <div class="col-sm-10">
                        <input type="text" name="otherBusinessLine" id="otherBusinessLine"
                            class="form-control @error('otherBusinessLine') is-invalid @enderror"
                            value="{{ old('otherBusinessLine') }}">

                        @error('otherBusinessLine')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
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
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('company.index') }}";
            });

            document.addEventListener('DOMContentLoaded', function() {
                const parentCompanySelect = document.getElementById('parent_company_id');
                const businessLineSelect = document.getElementById('business_line_id');

                const otherParentCompanyDiv = document.querySelector('div.otherParentCompany');
                const otherBusinessLineDiv = document.querySelector('div.otherBusinessLine');

                function toggleOtherParentCompanyInput() {
                    if (parentCompanySelect.value === 'another') {
                        otherParentCompanyDiv.classList.remove('d-none');
                    } else {
                        otherParentCompanyDiv.classList.add('d-none');
                    }
                }

                function toggleOtherBusinessLineInput() {
                    if (businessLineSelect.value === 'another') {
                        otherBusinessLineDiv.classList.remove('d-none');
                    } else {
                        otherBusinessLineDiv.classList.add('d-none');
                    }
                }

                parentCompanySelect.addEventListener('change', toggleOtherParentCompanyInput);
                businessLineSelect.addEventListener('change', toggleOtherBusinessLineInput);

                toggleOtherParentCompanyInput();
                toggleOtherBusinessLineInput();
            });
        </script>
    @endprepend
</x-admin>
