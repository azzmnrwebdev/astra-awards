<x-user title="Formulir" name="Formulir">
    <div class="container py-4">
        @if (auth()->check() && auth()->user()->hasRole('user'))
            {{-- Alert --}}
            <div class="alert alert-info mb-4" role="alert">
                Silahkan isi 5 formulir yang ada dibawah ini
            </div>

            {{-- List Form --}}
            <ul class="list-group list-group-numbered">
                <a href="{{ route('form.relationship') }}"
                    class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Formulir Hubungan DKM dengan YAA
                    </div>
                </a>

                <a href="{{ route('form.managementRelationship') }}"
                    class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah
                    </div>
                </a>

                <a href="{{ route('form.program') }}"
                    class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Formulir Program Sosial
                    </div>
                </a>

                <a href="{{ route('form.administration') }}"
                    class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Formulir Administrasi dan Keuangan
                    </div>
                </a>

                <a href="{{ route('form.infrastructure') }}"
                    class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        Formulir Peribadahan dan Infrastruktur
                    </div>
                </a>
            </ul>
        @endif

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <div class="row row-cols-1 g-3">
                {{-- Formulir 1 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Formulir Hubungan DKM dengan YAA</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-success">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-start py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian Sistem</th>
                                            <th class="text-center py-3">Penilaian Panitia</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarTwos as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarTwos->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-start py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarTwo->systemAssessment)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarTwo->committeeAssessmnet)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.relationship', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $pillarTwos->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulir 2 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Formulir Hubungan Manajemen Perusahaan dengan DKM dan
                                Jamaah</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-info">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-start py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian Sistem</th>
                                            <th class="text-center py-3">Penilaian Panitia</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarOnes as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarOnes->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-start py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarOne->systemAssessment)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarOne->committeeAssessmnet)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.managementRelationship', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $pillarOnes->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulir 3 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Formulir Program Sosial</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-dark">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-start py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian Sistem</th>
                                            <th class="text-center py-3">Penilaian Panitia</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarThrees as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarThrees->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-start py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarThree->systemAssessment)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarThree->committeeAssessmnet)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.program', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $pillarThrees->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulir 4 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Formulir Administrasi dan Keuangan</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-warning">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-start py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian Sistem</th>
                                            <th class="text-center py-3">Penilaian Panitia</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFours as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFours->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-start py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFour->systemAssessment)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFour->committeeAssessmnet)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.administration', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $pillarFours->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulir 5 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">Formulir Peribadahan dan Infrastruktur</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-primary">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-start py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian Sistem</th>
                                            <th class="text-center py-3">Penilaian Panitia</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFives as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFives->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-start py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFive->systemAssessment)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFive->committeeAssessmnet)
                                                        <span class="badge rounded-pill text-bg-success">Sudah
                                                            dilakukan</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">Belum
                                                            dilakukan</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.infrastructure', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $pillarFives->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-user>
