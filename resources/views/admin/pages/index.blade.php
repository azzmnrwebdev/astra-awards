<x-admin title="Dashboard">
    {{-- Jumbroton --}}
    <div class="p-5 mb-4 bg-dark rounded-3">
        <div class="container-fluid py-4">
            <h1 class="display-6 text-white fw-bold">Halo {{ Auth::user()->name }}</h1>

            @if (auth()->check() && auth()->user()->hasRole('admin'))
                <p class="col-md-8 text-white fs-5">Selamat datang di acara Awards Amaliah! Dalam dashboard ini,
                    Anda dapat mengelola semua aspek acara, mulai dari pendaftaran peserta hingga penilaian formulir.
                    Kami percaya bahwa dengan bantuan Anda, acara ini akan menjadi sukses yang luar biasa.</p>

                <p class="col-md-8 text-white fs-5 mb-0">Terima kasih atas dedikasi dan kerja keras Anda!</p>
            @else
                <p class="col-md-8 text-white fs-5">Selamat datang di acara Awards Amaliah! Dalam dashboard ini,
                    Anda dapat mengakses informasi penting, melakukan penilaian, dan mengikuti proses acara. Kami
                    percaya bahwa dengan keahlian dan komitmen Anda, acara ini akan menjadi sangat berkesan.</p>

                <p class="col-md-8 text-white fs-5 mb-0">Terima kasih atas kontribusi Anda!</p>
            @endif
        </div>
    </div>

    {{-- Total Data --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 mb-4">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalDKM }}</h5>
                        <p class="card-text mb-0 lh-sm">Total Peserta DKM</p>
                    </div>
                    <i class="bi bi-people-fill fs-1" style="color: #0077B6;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPillarOne }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Formulir 1</p>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1" style="color: #28a745;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPillarTwo }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Formulir 2</p>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1" style="color: #0d6efd;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPillarThree }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Formulir 3</p>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1" style="color: #ffc107;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPillarFour }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Formulir 4</p>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1" style="color: #198754;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPillarFive }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Formulir 5</p>
                    </div>
                    <i class="bi bi-file-earmark-text-fill fs-1" style="color: #fd7e14;"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center px-4">
                    <div class="lh-base me-3">
                        <h5 class="card-title fw-semibold mb-1">{{ $totalPresentation }}</h5>
                        <p class="card-text mb-0 lh-sm">Total DKM Presentasi</p>
                    </div>
                    <i class="bi bi-easel-fill fs-1" style="color: #dc3545;"></i>
                </div>
            </div>
        </div>
    </div>

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

            {{-- belum selesai --}}
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
