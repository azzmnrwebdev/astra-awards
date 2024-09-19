<x-admin title="Panitia">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Panitia</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fw-medium" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row align-items-center">
                <div class="col-sm-6 col-xl-8">
                    <a href="{{ route('committee.create') }}" class="btn btn-dark rounded-0">Tambah</a>
                </div>

                <div class="col-sm-6 col-xl-4 mt-3 mt-sm-0">
                    <form>
                        <input type="search" name="search" id="search" value="{{ $search }}"
                            class="form-control" placeholder="Cari panitia">
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end">
                        <tr>
                            @foreach ($theadNameOne as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($committees as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $committees->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-start py-3">{{ $item->email }}</td>
                                <td class="text-center py-3">{{ $item->phone_number ?? '-' }}</td>
                                <td class="text-center py-3">
                                    @if ($item->status === 1)
                                        <span class="badge text-bg-success">Aktif</span>
                                    @else
                                        <span class="badge text-bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center py-3">
                                    @if (Auth::user()->email !== $item->email)
                                        <a href="{{ route('committee.edit', ['committee' => $item->id]) }}"
                                            class="text-dark align-middle me-3"><i class="bi bi-pencil"></i></a>

                                        <button type="button"
                                            class="border-0 p-0 bg-transparent text-dark align-middle delete"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                                class="bi bi-trash3"></i></button>
                                    @else
                                        -
                                    @endif
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

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $committees->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <h4 class="mt-5 mb-4 fw-semibold d-inline-flex">Manajemen Pembagian Penilaian</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success_distribution'))
                <div class="alert alert-success fw-medium" role="alert">
                    {{ session('success_distribution') }}
                </div>
            @endif

            @if (session('error_distribution'))
                <div class="alert alert-danger fw-medium" role="alert">
                    {{ session('error_distribution') }}
                </div>
            @endif

            <div class="row">
                <div class="col-auto">
                    <form action="{{ route('committee.distribution') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-dark rounded-0">Pembagian</button>
                    </form>
                </div>
            </div>

            <p class="card-text text-muted mt-4 mb-1">Keterangan:</p>
            <p class="card-text text-muted mb-0">Tekan tombol Pembagian untuk sinkronisasi data.</p>

            <div class="table-responsive mt-2">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end">
                        <tr>
                            @foreach ($theadNametwo as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($distributions as $item)
                            <tr>
                                <td class="text-center py-3">
                                    {{ $loop->index + $distributions->firstItem() }}
                                </td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ count($item->distributionToCommitte) }}</td>
                                <td class="text-center py-3">
                                    <a href="{{ route('committee.show', ['committee' => $item->id]) }}"
                                        class="text-dark align-middle"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $distributions->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Konfirmasi Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="d-inline" id="deleteForm" action="" method="POST">
                        <div id="deleteModalMessage" class="alert alert-info" role="alert"></div>

                        <div class="mb-3"><input type="text" class="form-control" name="name_confirmation"
                                id="name_confirmation" placeholder="Masukan nama panitia" required /></div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger">Ya, saya yakin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#search').on('input keydown', function(e) {
                    if (e.which !== 13) {
                        clearTimeout(debounceTimeout);

                        debounceTimeout = setTimeout(function() {
                            filter();
                        }, 1000);
                    }
                });

                $('#search').on('keypress', function(e) {
                    if (e.which == 13) {
                        e.preventDefault();
                        filter();
                    }
                });

                function filter() {
                    const params = {};
                    const searchValue = $('#search').val();
                    const url = '{{ route('committee.index') }}';

                    if (searchValue.trim() !== '') {
                        params.search = searchValue.trim().replace(/ /g, '+');
                    }

                    const queryString = Object.keys(params).map(key => key + '=' + params[key]);

                    const finalUrl = url + '?' + queryString.join('&');
                    window.location.href = finalUrl;
                }

                // =============================================================================================

                // Handle click on delete button
                $('.delete').click(function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const deleteUrl = "{{ route('committee.destroy', ['committee' => ':id']) }}"
                        .replace(':id',
                            id);

                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteModalMessage').html(
                        `Menghapus akun panitia akan mengakibatkan hilangnya semua data yang terkait dengan akun, Setelah akun dihapus, data yang terkait tidak dapat dipulihkan.<br><br>
                        Untuk melanjutkan penghapusan akun, silakan ketik <b>'${name}'</b> di bawah ini sebagai bentuk konfirmasi hapus akun:`
                    );
                    $('#deleteModal').modal('show');
                });
            });
        </script>
    @endprepend
</x-admin>
