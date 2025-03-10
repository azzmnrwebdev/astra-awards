<x-user title="Formulir" name="Formulir">
    <div class="container py-4">
        @if (auth()->check() && auth()->user()->hasRole('user'))
            <div class="row row-cols-1 row-cols-lg-2 g-0">
                <div class="col-md-10 col-lg-8">
                    {{-- Alert --}}
                    <div class="alert alert-info mb-4" role="alert">
                        Silahkan isi 5 formulir yang ada dibawah ini.
                    </div>

                    {{-- List Form --}}
                    <ul class="list-group list-group-numbered">
                        <a href="{{ route('form.relationship') }}"
                            class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Hubungan DKM dengan YAA
                            </div>
                        </a>

                        <a href="{{ route('form.managementRelationship') }}"
                            class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Hubungan Manajemen Perusahaan dengan DKM dan Jamaah
                            </div>
                        </a>

                        <a href="{{ route('form.program') }}"
                            class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Program Sosial
                            </div>
                        </a>

                        <a href="{{ route('form.administration') }}"
                            class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Administrasi dan Keuangan
                            </div>
                        </a>

                        <a href="{{ route('form.infrastructure') }}"
                            class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Peribadahan dan Infrastruktur
                            </div>
                        </a>
                    </ul>
                </div>
            </div>
        @endif

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <div class="row row-cols-1 g-3">
                <div class="col mb-2">
                    <form>
                        <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                            class="form-control" placeholder="Cari peserta?">
                        <div class="form-text">Kata kunci berdasarkan nama masjid/musala atau perusahaan</div>
                    </form>
                </div>

                {{-- Formulir 1 --}}
                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Hubungan DKM dengan YAA</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-success">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Nama Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarTwos as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarTwos->firstItem() }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @php
                                                        $pillarTwo = $item->mosque->pillarTwo;
                                                        $assessmentPillarTwo = $pillarTwo->committeeAssessmnet;
                                                    @endphp

                                                    @if ($assessmentPillarTwo && $assessmentPillarTwo->pillar_two_id)
                                                        @if (
                                                            $assessmentPillarTwo->pillar_two_question_two &&
                                                                $assessmentPillarTwo->pillar_two_question_three &&
                                                                $assessmentPillarTwo->pillar_two_question_four &&
                                                                $assessmentPillarTwo->pillar_two_question_five)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-warning">
                                                                Sebagian
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.relationship', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan
                                                </td>
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
                            <h5 class="card-title fw-bold mb-4">Hubungan Manajemen Perusahaan dengan DKM dan
                                Jamaah</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-info">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarOnes as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarOnes->firstItem() }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @php
                                                        $pillarOne = $item->mosque->pillarOne;
                                                        $assessmentPillarOne = $pillarOne->committeeAssessmnet;
                                                    @endphp

                                                    @if ($assessmentPillarOne && $assessmentPillarOne->pillar_one_id)
                                                        @if (
                                                            $assessmentPillarOne->pillar_one_question_one &&
                                                                $assessmentPillarOne->pillar_one_question_two &&
                                                                $assessmentPillarOne->pillar_one_question_three &&
                                                                $assessmentPillarOne->pillar_one_question_four &&
                                                                $assessmentPillarOne->pillar_one_question_five &&
                                                                $assessmentPillarOne->pillar_one_question_six &&
                                                                $assessmentPillarOne->pillar_one_question_seven)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-warning">
                                                                Sebagian
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.managementRelationship', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan
                                                </td>
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
                            <h5 class="card-title fw-bold mb-4">Program Sosial</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-secondary">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarThrees as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarThrees->firstItem() }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @php
                                                        $pillarThree = $item->mosque->pillarThree;
                                                        $assessmentPillarThree = $pillarThree->committeeAssessmnet;
                                                    @endphp

                                                    @if ($assessmentPillarThree && $assessmentPillarThree->pillar_three_id)
                                                        @if (
                                                            $assessmentPillarThree->pillar_three_question_one &&
                                                                $assessmentPillarThree->pillar_three_question_two &&
                                                                $assessmentPillarThree->pillar_three_question_three &&
                                                                $assessmentPillarThree->pillar_three_question_four &&
                                                                $assessmentPillarThree->pillar_three_question_five &&
                                                                $assessmentPillarThree->pillar_three_question_six)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-warning">
                                                                Sebagian
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.program', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan
                                                </td>
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
                            <h5 class="card-title fw-bold mb-4">Administrasi dan Keuangan</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-warning">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFours as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFours->firstItem() }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @php
                                                        $pillarFour = $item->mosque->pillarFour;
                                                        $assessmentPillarFour = $pillarFour->committeeAssessmnet;
                                                    @endphp

                                                    @if ($assessmentPillarFour && $assessmentPillarFour->pillar_four_id)
                                                        @if (
                                                            $assessmentPillarFour->pillar_four_question_one &&
                                                                $assessmentPillarFour->pillar_four_question_two &&
                                                                $assessmentPillarFour->pillar_four_question_three &&
                                                                $assessmentPillarFour->pillar_four_question_four &&
                                                                $assessmentPillarFour->pillar_four_question_five)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-warning">
                                                                Sebagian
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.administration', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan
                                                </td>
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
                            <h5 class="card-title fw-bold mb-3">Peribadahan dan Infrastruktur</h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-primary">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFives as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFives->firstItem() }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @php
                                                        $pillarFive = $item->mosque->pillarFive;
                                                        $assessmentPillarFive = $pillarFive->committeeAssessmnet;
                                                    @endphp

                                                    @if ($assessmentPillarFive && $assessmentPillarFive->pillar_five_id)
                                                        @if (
                                                            $assessmentPillarFive->pillar_five_question_one &&
                                                                $assessmentPillarFive->pillar_five_question_two &&
                                                                $assessmentPillarFive->pillar_five_question_three &&
                                                                $assessmentPillarFive->pillar_five_question_four &&
                                                                $assessmentPillarFive->pillar_five_question_five)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-warning">
                                                                Sebagian
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('form.infrastructure', ['user' => $item->id, 'action' => 'penilaian']) }}"
                                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan
                                                </td>
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

    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#pencarian').on('input keydown change', function(e) {
                    if (e.which !== 13) {
                        clearTimeout(debounceTimeout);

                        debounceTimeout = setTimeout(function() {
                            filter();
                        }, 1000);
                    }
                });

                $('#pencarian').on('keypress', function(e) {
                    if (e.which == 13) {
                        e.preventDefault();
                        filter();
                    }
                });

                function filter() {
                    const params = {};
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('form.index') }}';

                    if (searchValue.trim() !== '') {
                        params.pencarian = searchValue.trim().replace(/ /g, '+');
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }
            });
        </script>
    @endprepend


</x-user>
