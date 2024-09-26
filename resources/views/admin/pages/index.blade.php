<x-admin title="Dashboard">
    @if (auth()->check() && auth()->user()->hasRole('admin'))
        <center>
            <h4 class="mb-5 fw-semibold d-inline-flex text-uppercase">Rekapitulasi Amaliah Astra Award 2024</h4>
        </center>
    @else
        {{-- Jumbroton --}}
        <div class="p-5 mb-4 bg-dark rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-6 text-white fw-bold">Halo {{ Auth::user()->name }}</h1>
                <p class="col-md-8 text-white fs-5">Selamat datang di acara Amaliah Astra Awards! Dalam dashboard ini,
                    Anda dapat mengakses informasi penting, melakukan penilaian, dan mengikuti proses acara. Kami
                    percaya bahwa dengan keahlian dan komitmen Anda, acara ini akan menjadi sangat berkesan.</p>

                <p class="col-md-8 text-white fs-5 mb-0">Terima kasih atas kontribusi Anda!</p>
            </div>
        </div>
    @endif

    @if (auth()->check() && auth()->user()->hasRole('admin'))
        {{-- Total Data --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 mb-4">
            <div class="col">
                <a href="{{ route('user.index') }}">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center px-4">
                            <div class="lh-base me-3">
                                <h5 class="card-title fw-semibold mb-1">{{ $totalDKM }}</h5>
                                <p class="card-text mb-0 lh-sm">Total Peserta</p>
                            </div>
                            <i class="bi bi-people-fill fs-1" style="color: #004ea2;"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('company.index') }}">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center px-4">
                            <div class="lh-base me-3">
                                <h5 class="card-title fw-semibold mb-1">{{ $totalCompany }}</h5>
                                <p class="card-text mb-0 lh-sm">Total Perusahaan</p>
                            </div>
                            <i class="bi bi-building fs-1" style="color: #004ea2;"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('business_line.index') }}">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center px-4">
                            <div class="lh-base me-3">
                                <h5 class="card-title fw-semibold mb-1">{{ $totalBusinessLine }}</h5>
                                <p class="card-text mb-0 lh-sm">Total Lini Bisnis, Yayasan & Koperasi, Head Office</p>
                            </div>
                            <i class="bi bi-briefcase-fill fs-1" style="color: #004ea2;"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('province.index') }}">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body d-flex justify-content-between align-items-center px-4">
                            <div class="lh-base me-3">
                                <h5 class="card-title fw-semibold mb-1">{{ $totalProvince }}</h5>
                                <p class="card-text mb-0 lh-sm">Total Provinsi</p>
                            </div>
                            <i class="bi bi-geo-alt-fill fs-1" style="color: #004ea2;"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-7 col-xl-8">
                {{-- Category --}}
                <div class="table-responsive mb-3">
                    <table class="table text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-dark">
                            <tr>
                                <th class="text-center py-3">Kategori</th>
                                @foreach ($categoryMosques as $mosque)
                                    <th class="text-center py-3">{{ $mosque->name }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            @php
                                $totalPerMosque = [];
                                foreach ($categoryMosques as $mosque) {
                                    $totalPerMosque[$mosque->id] = 0;
                                }
                            @endphp

                            @foreach ($categoryAreas as $area)
                                <tr>
                                    <td class="text-center py-3">{{ $area->name }}</td>
                                    @foreach ($categoryMosques as $mosque)
                                        @php
                                            $count = $mosqueCounts[$area->id][$mosque->id] ?? 0;
                                            $totalPerMosque[$mosque->id] += $count;
                                        @endphp

                                        <td class="text-center py-3">
                                            @if ($count === 0)
                                                -
                                            @else
                                                <button type="button" class="border-0 p-0 bg-transparent"
                                                    data-bs-toggle="modal" data-bs-target="#userByCategoryModal"
                                                    data-category-area-id="{{ $area->id }}"
                                                    data-category-mosque-id="{{ $mosque->id }}"
                                                    data-category-area-name="{{ $area->name }}"
                                                    data-category-mosque-name="{{ $mosque->name }}">{{ $count }}</button>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                            <tr>
                                <td class="text-center py-3 fw-bold">Total</td>
                                @foreach ($categoryMosques as $mosque)
                                    <td class="text-center py-3 fw-bold">
                                        {{ $totalPerMosque[$mosque->id] }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Lini Bisnis --}}
                <div class="card border-0 bg-transparent">
                    <h5 class="card-header fw-medium py-3 text-bg-dark text-center">
                        Lini Bisnis, Yayasan & Koperasi, Head Office
                    </h5>

                    <div class="list-group overflow-x-hidden rounded-0 border-bottom rounded-bottom">
                        @foreach ($businessLines as $businessLine)
                            <button type="button"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-top-0 border-bottom-0"
                                data-bs-toggle="modal" data-bs-target="#userByBusinessLineModal"
                                data-business-line-id="{{ $businessLine->id }}"
                                data-business-line-name="{{ $businessLine->name }}">
                                <div class="me-auto pe-4" style="flex: 1; min-width: 0;">
                                    <div style="overflow-wrap: break-word;">
                                        {{ $businessLine->name }}
                                    </div>
                                </div>

                                <span>{{ $businessLine->mosque_count === 0 ? '-' : $businessLine->mosque_count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 bg-transparent">
                    <h5 class="card-header fw-medium py-3 text-bg-dark text-center">
                        Provinsi
                    </h5>

                    <div class="list-group overflow-y-scroll overflow-x-hidden rounded-0 border-bottom rounded-bottom"
                        style="max-height: 365px;">
                        @foreach ($provinces as $province)
                            <button type="button"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-top-0 border-bottom-0"
                                data-bs-toggle="modal" data-bs-target="#userByProvinceModal"
                                data-province-id="{{ $province->id }}" data-province-name="{{ $province->name }}">
                                <div class="me-auto pe-4" style="flex: 1; min-width: 0;">
                                    <div style="overflow-wrap: break-word;">
                                        {{ $province->name }}
                                    </div>
                                </div>

                                <span>{{ $province->mosque_count === 0 ? '-' : $province->mosque_count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Timeline --}}
    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <h4 class="fw-semibold d-inline-flex">Timeline Kegiatan</h4>

            @if (session('success'))
                <div class="alert alert-success fw-medium mb-4 mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4 mt-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <img src="{{ asset('images/timeline/timeline.png') }}" alt="Timeline" class="img-fluid my-3">

            @if (auth()->check() && auth()->user()->hasRole('admin'))
                {{-- form --}}
                <form action="{{ route('dashboardAct') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $timeline->id ?? '' }}">

                    {{-- Pendaftaran --}}
                    @php
                        $registrationValue = '';

                        if ($timeline) {
                            if (!is_null($timeline->start_registration) && !is_null($timeline->end_registration)) {
                                $registrationValue =
                                    $timeline->start_registration . ' - ' . $timeline->end_registration;
                            }
                        }
                    @endphp

                    <div class="row mb-3">
                        <label for="registration" class="col-md-3 col-xl-2 col-form-label">Pendaftaran</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="text" name="registration" id="registration"
                                class="form-control daterange  @error('registration') is-invalid @enderror"
                                value="{{ old('registration', $registrationValue) }}"
                                placeholder="Tentukan tanggal pendaftaran">

                            <input type="text" name="start_registration" id="start_registration"
                                class="form-control"
                                value="{{ old('start_registration', $timeline->start_registration ?? '') }}" hidden>
                            <input type="text" name="end_registration" id="end_registration" class="form-control"
                                value="{{ old('end_registration', $timeline->end_registration ?? '') }}" hidden>

                            @error('registration')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Pengisian Formulir --}}
                    @php
                        $formFillingValue = '';

                        if ($timeline) {
                            if (!is_null($timeline->start_form) && !is_null($timeline->end_form)) {
                                $formFillingValue = $timeline->start_form . ' - ' . $timeline->end_form;
                            }
                        }
                    @endphp

                    <div class="row mb-3">
                        <label for="form_filling" class="col-md-3 col-xl-2 col-form-label">Pengisian Formulir</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="text" name="form_filling" id="form_filling"
                                class="form-control daterange  @error('form_filling') is-invalid @enderror"
                                value="{{ old('form_filling', $formFillingValue) }}"
                                placeholder="Tentukan tanggal pengisian formulir">

                            <input type="text" name="start_form" id="start_form" class="form-control"
                                value="{{ old('start_form', $timeline->start_form ?? '') }}" hidden>
                            <input type="text" name="end_form" id="end_form" class="form-control"
                                value="{{ old('end_form', $timeline->end_form ?? '') }}" hidden>

                            @error('form_filling')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Seleksi --}}
                    @php
                        $selectionValue = '';

                        if ($timeline) {
                            if (!is_null($timeline->start_selection) && !is_null($timeline->end_selection)) {
                                $selectionValue = $timeline->start_selection . ' - ' . $timeline->end_selection;
                            }
                        }
                    @endphp

                    <div class="row mb-3">
                        <label for="selection" class="col-md-3 col-xl-2 col-form-label">Seleksi</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="text" name="selection" id="selection"
                                class="form-control daterange  @error('selection') is-invalid @enderror"
                                value="{{ old('selection', $selectionValue) }}"
                                placeholder="Tentukan tanggal seleksi">

                            <input type="text" name="start_selection" id="start_selection" class="form-control"
                                value="{{ old('start_selection', $timeline->start_selection ?? '') }}" hidden>
                            <input type="text" name="end_selection" id="end_selection" class="form-control"
                                value="{{ old('end_selection', $timeline->end_selection ?? '') }}" hidden>

                            @error('selection')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Penilaian Awal --}}
                    @php
                        $initalAssessmentValue = '';

                        if ($timeline) {
                            if (
                                !is_null($timeline->start_initial_assessment) &&
                                !is_null($timeline->end_initial_assessment)
                            ) {
                                $initalAssessmentValue =
                                    $timeline->start_initial_assessment . ' - ' . $timeline->end_initial_assessment;
                            }
                        }
                    @endphp

                    <div class="row mb-3">
                        <label for="initial_assessment" class="col-md-3 col-xl-2 col-form-label">Penilaian
                            Awal</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="text" name="initial_assessment" id="initial_assessment"
                                class="form-control daterange  @error('initial_assessment') is-invalid @enderror"
                                value="{{ old('initial_assessment', $initalAssessmentValue) }}"
                                placeholder="Tentukan tanggal penilaian awal">

                            <input type="text" name="start_initial_assessment" id="start_initial_assessment"
                                class="form-control"
                                value="{{ old('start_initial_assessment', $timeline->start_initial_assessment ?? '') }}"
                                hidden>
                            <input type="text" name="end_initial_assessment" id="end_initial_assessment"
                                class="form-control"
                                value="{{ old('end_initial_assessment', $timeline->end_initial_assessment ?? '') }}"
                                hidden>

                            @error('initial_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Penilaian Akhir --}}
                    @php
                        $finalAssessmentValue = '';

                        if ($timeline) {
                            if (
                                !is_null($timeline->start_final_assessment) &&
                                !is_null($timeline->end_final_assessment)
                            ) {
                                $finalAssessmentValue =
                                    $timeline->start_final_assessment . ' - ' . $timeline->end_final_assessment;
                            }
                        }
                    @endphp

                    <div class="row mb-3">
                        <label for="final_assessment" class="col-md-3 col-xl-2 col-form-label">Penilaian
                            Akhir</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="text" name="final_assessment" id="final_assessment"
                                class="form-control daterange  @error('final_assessment') is-invalid @enderror"
                                value="{{ old('final_assessment', $finalAssessmentValue) }}"
                                placeholder="Tentukan tanggal penilaian akhir">

                            <input type="text" name="start_final_assessment" id="start_final_assessment"
                                class="form-control"
                                value="{{ old('start_final_assessment', $timeline->start_final_assessment ?? '') }}"
                                hidden>
                            <input type="text" name="end_final_assessment" id="end_final_assessment"
                                class="form-control"
                                value="{{ old('end_final_assessment', $timeline->end_final_assessment ?? '') }}"
                                hidden>

                            @error('final_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    @if ($timeline)
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        </div>
                    @else
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    @endif
                </form>
            @endif
        </div>
    </div>

    {{-- Modal DKM By Category Area & Category Mosque --}}
    <div class="modal fade" id="userByCategoryModal" tabindex="-1" aria-labelledby="userByCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userByCategoryModalLabel">
                        Daftar Peserta Berdasarkan Kategori Area dan Masjid
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Modal body will be filled by AJAX -->
                </div>
            </div>
        </div>
    </div>

    {{-- Modal DKM By Business Line --}}
    <div class="modal fade" id="userByBusinessLineModal" tabindex="-1"
        aria-labelledby="userByBusinessLineModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userByBusinessLineModalLabel">
                        Daftar Peserta Berdasarkan Lini Bisnis, Yayasan & Koperasi, Head Office
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Modal body will be filled by AJAX -->
                </div>
            </div>
        </div>
    </div>

    {{-- Modal DKM By Province --}}
    <div class="modal fade" id="userByProvinceModal" tabindex="-1" aria-labelledby="userByProvinceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userByProvinceModalLabel">
                        Daftar Peserta Berdasarkan Provinsi
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Modal body will be filled by AJAX -->
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script type="text/javascript">
            $(function() {
                // Pendaftaran
                $('input[name="registration"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    pickstart = start.format('YYYY-MM-DD');
                    pickend = end.format('YYYY-MM-DD');

                    $('#start_registration').val(pickstart);
                    $('#end_registration').val(pickend);

                    $('input[name="registration"]').val(pickstart + ' - ' + pickend);
                });

                $('input[name="registration"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="registration"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // Formulir
                $('input[name="form_filling"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    pickstart = start.format('YYYY-MM-DD');
                    pickend = end.format('YYYY-MM-DD');

                    $('#start_form').val(pickstart);
                    $('#end_form').val(pickend);

                    $('input[name="form_filling"]').val(pickstart + ' - ' + pickend);
                });

                $('input[name="form_filling"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="form_filling"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // Seleksi
                $('input[name="selection"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    pickstart = start.format('YYYY-MM-DD');
                    pickend = end.format('YYYY-MM-DD');

                    $('#start_selection').val(pickstart);
                    $('#end_selection').val(pickend);

                    $('input[name="selection"]').val(pickstart + ' - ' + pickend);
                });

                $('input[name="selection"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="selection"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // Penilaian Awal
                $('input[name="initial_assessment"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    pickstart = start.format('YYYY-MM-DD');
                    pickend = end.format('YYYY-MM-DD');

                    $('#start_initial_assessment').val(pickstart);
                    $('#end_initial_assessment').val(pickend);

                    $('input[name="initial_assessment"]').val(pickstart + ' - ' + pickend);
                });

                $('input[name="initial_assessment"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="initial_assessment"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // Penilaian Akhir
                $('input[name="final_assessment"]').daterangepicker({
                    autoUpdateInput: false,
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function(start, end, label) {
                    pickstart = start.format('YYYY-MM-DD');
                    pickend = end.format('YYYY-MM-DD');

                    $('#start_final_assessment').val(pickstart);
                    $('#end_final_assessment').val(pickend);

                    $('input[name="final_assessment"]').val(pickstart + ' - ' + pickend);
                });

                $('input[name="final_assessment"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                        'YYYY-MM-DD'));
                });

                $('input[name="final_assessment"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });

                // =============================================================================================

                $('#userByCategoryModal').on('show.bs.modal', function(event) {
                    const modal = $(this);
                    const button = $(event.relatedTarget);
                    const categoryAreaId = button.data('category-area-id');
                    const categoryAreaName = button.data('category-area-name');
                    const categoryMosqueId = button.data('category-mosque-id');
                    const categoryMosqueName = button.data('category-mosque-name');
                    const modalBody = modal.find('.modal-body');
                    let originalData = [];

                    modalBody.empty();
                    modalBody.html('<div id="loading" class="text-center py-4 fs-5">Memuat data...</div>');

                    $.ajax({
                        url: '/api/users-by-category/' + categoryAreaId + '/' + categoryMosqueId,
                        method: 'GET',
                        success: function(data) {
                            originalData = data;
                            modalBody.empty();

                            const pdfUrl =
                                "{{ route('download_pdf.get_users_by_category', ['categoryAreaId' => 'PLACEHOLDER', 'categoryMosqueId' => 'PLACEHOLDER2']) }}"
                                .replace('PLACEHOLDER', categoryAreaId)
                                .replace('PLACEHOLDER2', categoryMosqueId);

                            const excelUrl =
                                "{{ route('download_excel.get_users_by_category', ['categoryAreaId' => 'PLACEHOLDER', 'categoryMosqueId' => 'PLACEHOLDER2']) }}"
                                .replace('PLACEHOLDER', categoryAreaId)
                                .replace('PLACEHOLDER2', categoryMosqueId);

                            const table = `
                                <h5 class="card-title fw-semibold mb-1">${categoryAreaName} - ${categoryMosqueName}</h5>
                                <p class="card-text">Total Keseluruhan Sekitar ${data.length} Peserta</p>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-xl-8">
                                        <a href="${pdfUrl}" class="btn btn-danger rounded-0">Unduh PDF</a>
                                        <a href="${excelUrl}" class="btn btn-success rounded-0">Unduh Excel</a>
                                    </div>

                                    <div class="col-lg-6 col-xl-4 mt-3 mt-lg-0">
                                        <form>
                                            <input type="search" name="search" id="searchCategory" value=""
                                                class="form-control" placeholder="Cari peserta/masjid?">
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                        <thead class="border-top border-start border-end table-custom">
                                            <tr>
                                                <th class="text-center py-3">Logo</th>
                                                <th class="text-start py-3">Nama Peserta</th>
                                                <th class="text-center py-3">Perusahaan</th>
                                                <th class="text-center py-3">Nama Masjid/Musala</th>
                                                <th class="text-center py-3">Kategori Area</th>
                                                <th class="text-center py-3">Kategori Masjid</th>
                                            </tr>
                                        </thead>

                                        <tbody class="border-start border-end"></tbody>
                                    </table>
                                </div>
                            `;

                            modalBody.append(table);

                            function renderTable(dataToRender) {
                                const tbody = modalBody.find('tbody');
                                tbody.empty();

                                if (dataToRender.length > 0) {
                                    $.each(dataToRender, function(index, mosqueData) {
                                        const user = mosqueData.user;
                                        const logoPath = `/storage/${mosqueData.logo}`;

                                        tbody.append(`
                                            <tr>
                                                <td class="text-center py-3">
                                                    <img src="${logoPath}" alt="Logo" style="width: 100px;">
                                                </td>
                                                <td class="text-start py-3">${user.name}</td>
                                                <td class="text-center py-3">${mosqueData.company.name}</td>
                                                <td class="text-center py-3">${mosqueData.name}</td>
                                                <td class="text-center py-3">${mosqueData.category_area.name}</td>
                                                <td class="text-center py-3">${mosqueData.category_mosque.name}</td>
                                            </tr>
                                        `);
                                    });
                                } else {
                                    tbody.append(`
                                        <tr>
                                            <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                                        </tr>
                                    `);
                                }
                            }

                            renderTable(originalData);

                            $('#searchCategory').on('input', function() {
                                const searchValue = $(this).val().toLowerCase();
                                const filteredData = originalData.filter(mosqueData =>
                                    mosqueData.user.name.toLowerCase().includes(
                                        searchValue) ||
                                    mosqueData.name.toLowerCase().includes(searchValue)
                                );

                                renderTable(filteredData);
                            });
                        },
                        error: function() {
                            modalBody.html(
                                '<div class="text-center text-danger py-4">Mohon maaf, ada kesalahan dalam mengambil data</div>'
                            );
                        }
                    });
                });

                // =============================================================================================

                $('#userByBusinessLineModal').on('show.bs.modal', function(event) {
                    const modal = $(this);
                    const button = $(event.relatedTarget);
                    const businessLineId = button.data('business-line-id');
                    const businessLineName = button.data('business-line-name');
                    const modalBody = modal.find('.modal-body');
                    let originalData = [];
                    let keyword = '';

                    modalBody.empty();
                    modalBody.html('<div id="loading" class="text-center py-4 fs-5">Memuat data...</div>');

                    $.ajax({
                        url: '/api/users-by-business-line/' + businessLineId,
                        method: 'GET',
                        success: function(data) {
                            originalData = data;
                            modalBody.empty();

                            function updateDownloadUrls() {
                                const pdfUrl =
                                    "{{ route('download_pdf.get_users_by_business_line', ['businessLineId' => 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', businessLineId)+ '?search=' +
                                    encodeURIComponent(keyword);

                                const excelUrl =
                                    "{{ route('download_excel.get_users_by_business_line', ['businessLineId' => 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', businessLineId)+ '?search=' +
                                    encodeURIComponent(keyword);
                                
                                $('#downloadPdfButtonBusinessLine').attr('href', pdfUrl);
                                $('#downloadExcelButtonBusinessLine').attr('href', excelUrl);
                            }

                            const table = `
                                <h5 class="card-title fw-semibold mb-1">${businessLineName}</h5>
                                <p class="card-text">Total Keseluruhan Sekitar ${data.length} Peserta</p>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-xl-8">
                                        <a href="#" id="downloadPdfButtonBusinessLine" class="btn btn-danger rounded-0">Unduh PDF</a>
                                        <a href="#" id="downloadExcelButtonBusinessLine" class="btn btn-success rounded-0">Unduh Excel</a>
                                    </div>

                                    <div class="col-lg-6 col-xl-4 mt-3 mt-lg-0">
                                        <form>
                                            <input type="search" name="search" id="searchBusinessLine" value=""
                                                class="form-control" placeholder="Cari peserta/masjid?">
                                            <div class="form-text">Kata kunci bisa berdasarkan semuanya.</div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                        <thead class="border-top border-start border-end table-custom">
                                            <tr>
                                                <th class="text-center py-3">Logo</th>
                                                <th class="text-start py-3">Nama Peserta</th>
                                                <th class="text-center py-3">Nama Masjid/Musala</th>
                                                <th class="text-center py-3">Induk Perusahaan</th>
                                                <th class="text-center py-3">Perusahaan</th>
                                            </tr>
                                        </thead>

                                        <tbody class="border-start border-end"></tbody>
                                    </table>
                                </div>
                            `;

                            modalBody.append(table);

                            function renderTable(dataToRender) {
                                const tbody = modalBody.find('tbody');
                                tbody.empty();

                                if (dataToRender.length > 0) {
                                    $.each(dataToRender, function(index, mosqueData) {
                                        const user = mosqueData.user;
                                        const logoPath = `/storage/${mosqueData.logo}`;

                                        tbody.append(`
                                            <tr>
                                                <td class="text-center py-3">
                                                    <img src="${logoPath}" alt="Logo" style="width: 100px;">
                                                </td>
                                                <td class="text-start py-3">${user.name}</td>
                                                <td class="text-center py-3">${mosqueData.name}</td>
                                                <td class="text-center py-3">${mosqueData.company.parent_company.name}</td>
                                                <td class="text-center py-3">${mosqueData.company.name}</td>
                                            </tr>
                                        `);
                                    });
                                } else {
                                    tbody.append(`
                                        <tr>
                                            <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                                        </tr>
                                    `);
                                }
                            }

                            renderTable(originalData);
                            updateDownloadUrls();

                            let searchTimeout;

                            function debounceSearch(searchValue) {
                                clearTimeout(searchTimeout);

                                searchTimeout = setTimeout(function() {
                                    $.ajax({
                                        url: '/api/users-by-business-line/' + businessLineId,
                                        method: 'GET',
                                        data: {
                                            search: searchValue
                                        },
                                        success: function(data) {
                                            originalData = data;
                                            renderTable(originalData);
                                            $('#searchBusinessLine').val(
                                                searchValue);
                                            updateDownloadUrls();
                                        },
                                        error: function() {
                                            modalBody.html(
                                                '<div class="text-center text-danger py-4">Mohon maaf, ada kesalahan dalam mengambil data</div>'
                                            );
                                        }
                                    });
                                }, 1000);
                            }

                            $('#searchBusinessLine').on('input', function() {
                                const searchValue = $(this).val().toLowerCase();
                                keyword = searchValue;
                                debounceSearch(searchValue);
                            });

                            $('#downloadPdfButtonBusinessLine, #downloadExcelButtonBusinessLine').on(
                                'click', 
                                function(event) {
                                    const modal = $('#userByBusinessLineModal');

                                    if (originalData.length === 0) {
                                        modal.modal('hide');
                                        alert(
                                            'Data tidak tersedia. Unduh tidak dapat dilakukan.'
                                        );
                                        return false;
                                    }

                                    modal.modal('hide');
                            });
                        },
                        error: function() {
                            modalBody.html(
                                '<div class="text-center text-danger py-4">Mohon maaf, ada kesalahan dalam mengambil data</div>'
                            );
                        }
                    });
                });

                // =============================================================================================

                $('#userByProvinceModal').on('show.bs.modal', function(event) {
                    const modal = $(this);
                    const button = $(event.relatedTarget);
                    const provinceId = button.data('province-id');
                    const provinceName = button.data('province-name');
                    const modalBody = modal.find('.modal-body');
                    let originalData = [];
                    let keyword = '';

                    modalBody.empty();
                    modalBody.html('<div id="loading" class="text-center py-4 fs-5">Memuat data...</div>');

                    $.ajax({
                        url: '/api/users-by-province/' + provinceId,
                        method: 'GET',
                        success: function(data) {
                            originalData = data;
                            modalBody.empty();

                            function updateDownloadUrls() {
                                const pdfUrl =
                                    "{{ route('download_pdf.get_users_by_province', ['provinceId' => 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', provinceId) + '?search=' +
                                    encodeURIComponent(keyword);

                                const excelUrl =
                                    "{{ route('download_excel.get_users_by_province', ['provinceId' => 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', provinceId) + '?search=' +
                                    encodeURIComponent(keyword);

                                $('#downloadPdfButtonProvince').attr('href', pdfUrl);
                                $('#downloadExcelButtonProvince').attr('href', excelUrl);
                            }

                            const table = `
                                <h5 class="card-title fw-semibold mb-1">Provinsi ${provinceName}</h5>
                                <p class="card-text">Total Keseluruhan Sekitar ${data.length} Peserta</p>

                                <div class="row">
                                    <div class="col-lg-6 col-xl-8">
                                        <a href="#" id="downloadPdfButtonProvince" class="btn btn-danger rounded-0">Unduh PDF</a>
                                        <a href="#" id="downloadExcelButtonProvince" class="btn btn-success rounded-0">Unduh Excel</a>
                                    </div>

                                    <div class="col-lg-6 col-xl-4 mt-3 mt-lg-0">
                                        <form>
                                            <input type="search" name="search" id="searchProvince" value=""
                                                class="form-control" placeholder="Cari peserta?">
                                            <div class="form-text">Kata kunci bisa berdasarkan semuanya.</div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive mt-4">
                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                        <thead class="border-top border-start border-end table-custom">
                                            <tr>
                                                <th class="text-center py-3">Logo</th>
                                                <th class="text-start py-3">Nama Peserta</th>
                                                <th class="text-center py-3">Perusahaan</th>
                                                <th class="text-center py-3">Nama Masjid/Musala</th>
                                                <th class="text-center py-3">Kota/Kabupaten</th>
                                            </tr>
                                        </thead>

                                        <tbody class="border-start border-end"></tbody>
                                    </table>
                                </div>
                            `;

                            modalBody.append(table);

                            function renderTable(dataToRender) {
                                const tbody = modalBody.find('tbody');
                                tbody.empty();

                                if (dataToRender.length > 0) {
                                    $.each(dataToRender, function(index, mosqueData) {
                                        const user = mosqueData.user;
                                        const logoPath = `/storage/${mosqueData.logo}`;

                                        tbody.append(`
                                            <tr>
                                                <td class="text-center py-3">
                                                    <img src="${logoPath}" alt="Logo" style="width: 100px;">
                                                </td>
                                                <td class="text-start py-3">${user.name}</td>
                                                <td class="text-center py-3">${mosqueData.company.name}</td>
                                                <td class="text-center py-3">${mosqueData.name}</td>
                                                <td class="text-center py-3">${mosqueData.city.name}</td>
                                            </tr>
                                        `);
                                    });
                                } else {
                                    tbody.append(`
                                        <tr>
                                            <td colspan="5" class="text-center py-3">Data tidak ditemukan</td>
                                        </tr>
                                    `);
                                }
                            }

                            renderTable(originalData);
                            updateDownloadUrls();

                            let searchTimeout;

                            function debounceSearch(searchValue) {
                                clearTimeout(searchTimeout);

                                searchTimeout = setTimeout(function() {
                                    $.ajax({
                                        url: '/api/users-by-province/' + provinceId,
                                        method: 'GET',
                                        data: {
                                            search: searchValue
                                        },
                                        success: function(data) {
                                            originalData = data;
                                            renderTable(originalData);
                                            $('#searchProvince').val(
                                                searchValue);
                                            updateDownloadUrls();
                                        },
                                        error: function() {
                                            modalBody.html(
                                                '<div class="text-center text-danger py-4">Mohon maaf, ada kesalahan dalam mengambil data</div>'
                                            );
                                        }
                                    });
                                }, 1000);
                            }

                            $('#searchProvince').on('input', function() {
                                const searchValue = $(this).val().toLowerCase();
                                keyword = searchValue;
                                debounceSearch(searchValue);
                            });

                            $('#downloadPdfButtonProvince, #downloadExcelButtonProvince').on(
                                'click',
                                function(event) {
                                    const modal = $('#userByProvinceModal');

                                    if (originalData.length === 0) {
                                        modal.modal('hide');
                                        alert(
                                            'Data tidak tersedia. Unduh tidak dapat dilakukan.'
                                        );
                                        return false;
                                    }

                                    modal.modal('hide');
                                });
                        },
                        error: function() {
                            modalBody.html(
                                '<div class="text-center text-danger py-4">Mohon maaf, ada kesalahan dalam mengambil data</div>'
                            );
                        }
                    });
                });
            });
        </script>
    @endprepend
</x-admin>
