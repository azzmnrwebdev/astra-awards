<x-user title="" name="Informasi">
    <div class="container py-4">
        {{-- Jumbroton --}}
        <div class="p-5 mb-4 bg-dark rounded-3">
            <div class="container-fluid py-4">
                {{-- belum selesai --}}
                @if (auth()->check() && auth()->user()->hasRole('user'))
                    <h1 class="display-6 text-white fw-bold">Halo {{ auth()->user()->name }},</h1>
                    <p class="col-md-8 text-white fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Laudantium,
                        animi ea ut facere culpa recusandae doloremque fuga natus reiciendis fugiat nemo. Nostrum,
                        adipisci
                        numquam. Mollitia rem nam architecto aliquid.</p>

                    <a href="{{ route('form.index') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
                @endif

                {{-- belum selesai --}}
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <h1 class="display-6 text-white fw-bold">Halo Panitia,</h1>
                    <p class="col-md-8 text-white fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Laudantium,
                        animi ea ut facere culpa recusandae doloremque fuga natus reiciendis fugiat nemo. Nostrum,
                        adipisci
                        numquam. Mollitia rem nam architecto aliquid.</p>
                @endif

                {{-- belum selesai --}}
                @if (auth()->check() && auth()->user()->hasRole('jury'))
                    <h1 class="display-6 text-white fw-bold">Halo Juri,</h1>
                    <p class="col-md-8 text-white fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Laudantium,
                        animi ea ut facere culpa recusandae doloremque fuga natus reiciendis fugiat nemo. Nostrum,
                        adipisci
                        numquam. Mollitia rem nam architecto aliquid.</p>
                @endif
            </div>
        </div>

        @if (auth()->check() && auth()->user()->hasRole('user'))
            {{-- Information --}}
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Informasi Umum</h5>

                            <img src="{{ asset('storage/' . $mosque->logo) }}" alt="Logo" style="width: 200px; display: block; margin-left: auto; margin-right: auto;">

                            <p class="card-text mb-0 fw-bold mt-3">Nama Masjid/Mushala: {{ $mosque->name }}</p>
                            <p class="card-text mb-0 fw-bold">Kategori Masjid: {{ $mosque->categoryMosque->name }}</p>
                            <p class="card-text mb-0 fw-bold">Kategori Area: {{ $mosque->categoryArea->name }}</p>
                            <br/>
                            <p class="card-text mb-0"><span class="fw-medium">Alamat: </span>{{ $mosque->address }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Kota/Kabupaten:
                                </span>{{ $mosque->city->name }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Provinsi:
                                </span>{{ $mosque->city->province->name }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Kapasitas Jamaah:
                                </span>{{ $mosque->capacity }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Ketua Pengurus DKM:
                                </span>{{ $mosque->leader }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Perusahaan:
                                </span>{{ $mosque->company->name }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Induk Perusahaan:
                                </span>{{ $mosque->company->parentCompany->name }}</p>
                            <p class="card-text mb-0"><span class="fw-medium">Lini Bisnis:
                                </span>{{ $mosque->company->businessLine->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Pemenuhan Formulir & Presentasi</h5>

                            <div class="mb-2">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('form.relationship') }}">1. Hubungan DKM dan YAA</a></p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $pillarTwoCompletion }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $pillarTwoCompletion }}%;">
                                        {{ $pillarTwoCompletion }}%
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('form.managementRelationship') }}">2. Hubungan Manajemen
                                        Perusahaan
                                        dengan DKM dan Jamaah</a></p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $pillarOneCompletion }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $pillarOneCompletion }}%;">
                                        {{ $pillarOneCompletion }}%
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('form.program') }}">3. Program Sosial</a></p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $pillarThreeCompletion }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $pillarThreeCompletion }}%;">
                                        {{ $pillarThreeCompletion }}%
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('form.administration') }}">4. Administrasi & Keuangan</a>
                                </p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $pillarFourCompletion }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $pillarFourCompletion }}%;">
                                        {{ $pillarFourCompletion }}%
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('form.infrastructure') }}">5. Peribadahan dan
                                        Infrastruktur</a>
                                </p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $pillarFiveCompletion }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $pillarFiveCompletion }}%;">
                                        {{ $pillarFiveCompletion }}%
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <p class="card-text mb-2"><span class="fw-medium"><a class="nav-link" href="{{ route('presentation') }}">6. Presentasi</a></p>
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="{{ $presentationCompletion }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $presentationCompletion }}%;">
                                        {{ $presentationCompletion }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
</x-user>
