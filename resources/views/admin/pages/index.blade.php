<x-admin title="Dashboard">
    @if (auth()->check() && auth()->user()->hasRole('admin'))
        <center>
            <h4 class="mb-5 fw-semibold d-inline-flex text-uppercase">Pendaftaran Amaliah Astra Award 2024</h4>
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
                            <i class="bi bi-people-fill fs-1" style="color: #0077B6;"></i>
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
                            <i class="bi bi-building fs-1" style="color: #0077B6;"></i>
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
                                <p class="card-text mb-0 lh-sm">Total Lini Bisnis</p>
                            </div>
                            <i class="bi bi-briefcase-fill fs-1" style="color: #0077B6;"></i>
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
                            <i class="bi bi-geo-alt-fill fs-1" style="color: #0077B6;"></i>
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
                                            {{ $count === 0 ? '-' : $count }}
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
                        Lini Bisnis
                    </h5>

                    <ul class="list-group overflow-x-hidden rounded-0 border-bottom rounded-bottom">
                        @foreach ($businessLines as $businessLine)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-top-0 border-bottom-0">
                                <div class="me-auto pe-4" style="flex: 1; min-width: 0;">
                                    <div style="overflow-wrap: break-word;">
                                        {{ $businessLine->name }}
                                    </div>
                                </div>

                                <span>{{ $businessLine->mosque_count === 0 ? '-' : $businessLine->mosque_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 bg-transparent">
                    <h5 class="card-header fw-medium py-3 text-bg-dark text-center">
                        Provinsi
                    </h5>

                    <ul class="list-group overflow-y-scroll overflow-x-hidden rounded-0 border-bottom rounded-bottom"
                        style="max-height: 365px;">
                        @foreach ($provinces as $province)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-top-0 border-bottom-0">
                                <div class="me-auto pe-4" style="flex: 1; min-width: 0;">
                                    <div style="overflow-wrap: break-word;">
                                        {{ $province->name }}
                                    </div>
                                </div>

                                <span>{{ $province->mosque_count === 0 ? '-' : $province->mosque_count }}</span>
                            </li>
                        @endforeach
                    </ul>
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

            <div class="table-responsive mt-3">
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

            @if (auth()->check() && auth()->user()->hasRole('admin'))
                {{-- form --}}
                <form action="{{ route('dashboardAct') }}" method="POST" class="mt-4">
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
            });
        </script>
    @endprepend
</x-admin>
