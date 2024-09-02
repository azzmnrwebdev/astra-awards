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

            <div class="table-responsive mt-3">
                <table class="table text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end">
                        <tr>
                            <th class="text-center py-3">Pendaftaran</th>
                            <th class="text-center py-3">Seleksi</th>
                            <th class="text-center py-3">Penilaian Awal</th>
                            <th class="text-center py-3">Penilaian Akhir</th>
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        <tr>
                            @if ($timeline)
                                <td class="text-center py-3">
                                    @if ($timeline->start_registration && $timeline->end_registration)
                                        {{ \Carbon\Carbon::parse($timeline->start_registration)->locale('id')->translatedFormat('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($timeline->end_registration)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->start_registration)
                                        {{ \Carbon\Carbon::parse($timeline->start_registration)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->end_registration)
                                        {{ \Carbon\Carbon::parse($timeline->end_registration)->locale('id')->translatedFormat('d F Y') }}
                                    @endif
                                </td>

                                <td class="text-center py-3">
                                    @if ($timeline->start_selection && $timeline->end_selection)
                                        {{ \Carbon\Carbon::parse($timeline->start_selection)->locale('id')->translatedFormat('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($timeline->end_selection)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->start_selection)
                                        {{ \Carbon\Carbon::parse($timeline->start_selection)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->end_selection)
                                        {{ \Carbon\Carbon::parse($timeline->end_selection)->locale('id')->translatedFormat('d F Y') }}
                                    @endif
                                </td>

                                <td class="text-center py-3">
                                    @if ($timeline->start_initial_assessment && $timeline->end_initial_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->start_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($timeline->end_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->start_initial_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->start_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->end_initial_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->end_initial_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @endif
                                </td>

                                <td class="text-center py-3">
                                    @if ($timeline->start_final_assessment && $timeline->end_final_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->start_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($timeline->end_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->start_final_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->start_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @elseif ($timeline->end_final_assessment)
                                        {{ \Carbon\Carbon::parse($timeline->end_final_assessment)->locale('id')->translatedFormat('d F Y') }}
                                    @endif
                                </td>
                            @else
                                <td colspan="4" class="text-center py-3">Timeline kegiatan belum di tentukan</td>
                            @endif
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
                    <div class="row mb-3">
                        <label for="start_registration" class="col-md-3 col-xl-2 col-form-label">Mulai
                            Pendaftaran</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="start_registration" id="start_registration"
                                class="form-control @error('start_registration') is-invalid @enderror"
                                value="{{ old('start_registration', $timeline->start_registration ?? '') }}">

                            @error('start_registration')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="end_registration" class="col-md-3 col-xl-2 col-form-label">Selesai
                            Pendaftaran</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="end_registration" id="end_registration"
                                class="form-control @error('end_registration') is-invalid @enderror"
                                value="{{ old('end_registration', $timeline->end_registration ?? '') }}">

                            @error('end_registration')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Seleksi --}}
                    <div class="row mb-3">
                        <label for="start_selection" class="col-md-3 col-xl-2 col-form-label">Mulai Seleksi</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="start_selection" id="start_selection"
                                class="form-control @error('start_selection') is-invalid @enderror"
                                value="{{ old('start_selection', $timeline->start_selection ?? '') }}">

                            @error('start_selection')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="end_selection" class="col-md-3 col-xl-2 col-form-label">Selesai Seleksi</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="end_selection" id="end_selection"
                                class="form-control @error('end_selection') is-invalid @enderror"
                                value="{{ old('end_selection', $timeline->end_selection ?? '') }}">

                            @error('end_selection')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    {{-- Penilaian --}}
                    <div class="row mb-3">
                        <label for="start_initial_assessment" class="col-md-3 col-xl-2 col-form-label">Mulai Penilaian
                            Awal</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="start_initial_assessment" id="start_initial_assessment"
                                class="form-control @error('start_initial_assessment') is-invalid @enderror"
                                value="{{ old('start_initial_assessment', $timeline->start_initial_assessment ?? '') }}">

                            @error('start_initial_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="end_initial_assessment" class="col-md-3 col-xl-2 col-form-label">Selesai Penilaian
                            Awal</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="end_initial_assessment" id="end_initial_assessment"
                                class="form-control @error('end_initial_assessment') is-invalid @enderror"
                                value="{{ old('end_initial_assessment', $timeline->end_initial_assessment ?? '') }}">

                            @error('end_initial_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="start_final_assessment" class="col-md-3 col-xl-2 col-form-label">Mulai Penilaian
                            Akhir</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="start_final_assessment" id="start_final_assessment"
                                class="form-control @error('start_final_assessment') is-invalid @enderror"
                                value="{{ old('start_final_assessment', $timeline->start_final_assessment ?? '') }}">

                            @error('start_final_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="end_final_assessment" class="col-md-3 col-xl-2 col-form-label">Selesai Penilaian
                            Akhir</label>

                        <div class="col-md-9 col-xl-10">
                            <input type="date" name="end_final_assessment" id="end_final_assessment"
                                class="form-control @error('end_final_assessment') is-invalid @enderror"
                                value="{{ old('end_final_assessment', $timeline->end_final_assessment ?? '') }}">

                            @error('end_final_assessment')
                                <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-admin>
