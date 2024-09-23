<x-admin title="Peserta">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Peserta</h4>

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

            <div class="row">
                {{-- <div class="col-12">
                    <a href="#" class="btn btn-danger rounded-0">Unduh PDF</a>
                </div> --}}

                <div class="col-12">
                    <form class="row g-3">
                        <div class="col-sm-6">
                            <select name="perusahaan" id="perusahaan" class="form-select">
                                <option value="">Semua Perusahaan</option>
                                @foreach ($companies as $item)
                                    <option value="{{ $item->id }}" {{ $companyId == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua Status Akun</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                    Tidak Aktif
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                                class="form-control" placeholder="Cari peserta?">
                            <div class="form-text">Kata kunci bisa berdasarkan nama, nomor ponsel atau perusahaan.</div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-primary">
                        <tr>
                            @foreach ($theadName as $index => $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($users as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $users->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
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
                                    @if ($item->status !== 1)
                                        <a href="{{ route('user.edit_status', ['user' => $item->id]) }}"
                                            class="text-dark align-middle me-3"><i class="bi bi-patch-check"></i></a>
                                    @endif

                                    <a href="{{ route('user.edit', ['user' => $item->id]) }}"
                                        class="text-dark align-middle me-3"><i class="bi bi-pencil"></i></a>

                                    <a href="{{ route('user.show', ['user' => $item->id]) }}"
                                        class="text-dark align-middle me-3"><i class="bi bi-eye"></i></a>

                                    <button type="button"
                                        class="border-0 p-0 bg-transparent text-dark align-middle delete"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                            class="bi bi-trash3"></i></button>
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
                {{ $users->appends(request()->query())->links() }}
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
                                id="name_confirmation" placeholder="Masukan nama peserta" required /></div>

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

                $('#perusahaan, #pencarian, #status').on('input keydown change', function(e) {
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
                    const companyValue = $('#perusahaan').val();
                    const statusValue = $('#status').val();
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('user.index') }}';

                    if (companyValue !== '') {
                        params.perusahaan = companyValue;
                    }

                    if (statusValue !== '') {
                        params.status = statusValue;
                    }

                    if (searchValue.trim() !== '') {
                        params.pencarian = searchValue.trim().replace(/ /g, '+');
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
                    const deleteUrl = "{{ route('user.destroy', ['user' => ':id']) }}"
                        .replace(':id',
                            id);

                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteModalMessage').html(
                        `Menghapus akun peserta akan mengakibatkan hilangnya semua data yang terkait dengan akun, Setelah akun dihapus, data yang terkait tidak dapat dipulihkan.<br><br>
                        Untuk melanjutkan penghapusan akun, silakan ketik <b>'${name}'</b> di bawah ini sebagai bentuk konfirmasi hapus akun:`
                    );
                    $('#deleteModal').modal('show');
                });
            });
        </script>
    @endprepend
</x-admin>
