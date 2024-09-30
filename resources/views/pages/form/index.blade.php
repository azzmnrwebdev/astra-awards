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
        @endif

        @if (auth()->check() && auth()->user()->hasRole('admin'))
        <form action="{{ route('form.index') }}" method="GET">
            <div class="row row-cols-1 g-3">
                <div class="col-sm-6 col-xl-12 mt-3 mt-sm-0">
                    <form class="mt-3">
                        <input type="search" name="search" id="search" class="form-control mt-2" placeholder="Cari...">
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
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarTwos as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarTwos->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarTwo->committeeAssessmnet->pillar_two_id ?? '')
                                                        @if (
                                                            $item->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_two &&
                                                                $item->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_three &&
                                                                $item->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_four &&
                                                                $item->mosque->pillarTwo->committeeAssessmnet->pillar_two_question_five)
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
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarOnes as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarOnes->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarOne->committeeAssessmnet->pillar_one_id ?? '')
                                                        @if (
                                                            $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_one &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_two &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_three &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_four &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_five &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_six &&
                                                                $item->mosque->pillarOne->committeeAssessmnet->pillar_one_question_seven)
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
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarThrees as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarThrees->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarThree->committeeAssessmnet->pillar_three_id ?? '')
                                                        @if (
                                                            $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_one &&
                                                                $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_two &&
                                                                $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_three &&
                                                                $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_four &&
                                                                $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_five &&
                                                                $item->mosque->pillarThree->committeeAssessmnet->pillar_three_question_six)
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
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFours as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFours->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFour->committeeAssessmnet->pillar_four_id ?? '')
                                                        @if (
                                                            $item->mosque->pillarFour->committeeAssessmnet->pillar_four_question_one &&
                                                                $item->mosque->pillarFour->committeeAssessmnet->pillar_four_question_two &&
                                                                $item->mosque->pillarFour->committeeAssessmnet->pillar_four_question_three &&
                                                                $item->mosque->pillarFour->committeeAssessmnet->pillar_four_question_four &&
                                                                $item->mosque->pillarFour->committeeAssessmnet->pillar_four_question_five)
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
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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
                                            <th class="text-start py-3">Nama</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Masjid/Musala</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($pillarFives as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + $pillarFives->firstItem() }}</td>
                                                <td class="text-start py-3">{{ $item->name }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->pillarFive->committeeAssessmnet->pillar_five_id ?? '')
                                                        @if (
                                                            $item->mosque->pillarFive->committeeAssessmnet->pillar_five_question_one &&
                                                                $item->mosque->pillarFive->committeeAssessmnet->pillar_five_question_two &&
                                                                $item->mosque->pillarFive->committeeAssessmnet->pillar_five_question_three &&
                                                                $item->mosque->pillarFive->committeeAssessmnet->pillar_five_question_four &&
                                                                $item->mosque->pillarFive->committeeAssessmnet->pillar_five_question_five)
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
                                                <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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
        </form>
        @endif
    </div>

    @prepend('scripts')
    <script>
        $(document).ready(function() {
            let debounceTimeout;
    
            // Event listener for input and keydown events on the search field
            $('#search').on('input keydown', function(e) {
                if (e.which !== 13) {
                    clearTimeout(debounceTimeout);
    
                    debounceTimeout = setTimeout(function() {
                        filter(); // Call the filter function after a debounce period
                    }, 1000);
                }
            });
    
            // Event listener for keypress event specifically for Enter key
            $('#search').on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault(); // Prevent the default action
                    filter(); // Call the filter function immediately
                }
            });
    
            // Filter function to handle search query
            function filter() {
                const params = {};
                const searchValue = $('#search').val(); // Get the value from the search input
                const url = '{{ route('form.index') }}'; // Adjust to your route

                // Handle cases where the search input is empty
                if (searchValue.trim() !== '') {
                    params.search = searchValue.trim().replace(/ /g, '+'); // Replace spaces with '+'
                }

                const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                // If no search term, redirect to the base URL
                const finalUrl = params.search ? url + '?' + queryString.join('&') : url;
                window.location.href = finalUrl; // Redirect to the final URL
            }

        });
    </script>
    @endprepend
    

</x-user>
