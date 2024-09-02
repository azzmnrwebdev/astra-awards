<x-admin title="Juri">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Juri</h4>

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
                <div class="col-auto">
                    <a href="{{ route('jury.create') }}" class="btn btn-dark rounded-0">Tambah</a>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end">
                        <tr>
                            @foreach ($theadName as $index => $thead)
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                                @else
                                    @if ($index < count($theadName) - 1)
                                        <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($juries as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $juries->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-start py-3">{{ $item->email }}</td>
                                <td class="text-center py-3">{{ $item->phone_number ?? '-' }}</td>
                                <td class="text-center py-3">{{ $item->status ? 'Aktif' : 'Tidal Aktif' }}</td>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <td class="text-center py-3">
                                        @if (Auth::user()->email !== $item->email)
                                            <a href="{{ route('jury.edit', ['jury' => $item->id]) }}"
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
                                @endif
                            </tr>
                        @empty
                            <tr>
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                                @else
                                    <td colspan="5" class="text-center py-3">Data tidak ditemukan</td>
                                @endif
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $juries->appends(request()->query())->links() }}
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
                $('.delete').click(function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const deleteUrl = "{{ route('jury.destroy', ['jury' => ':id']) }}"
                        .replace(':id',
                            id);

                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteModalMessage').html(
                        `Menghapus akun juri akan mengakibatkan hilangnya semua data yang terkait dengan akun, Setelah akun dihapus, data yang terkait tidak dapat dipulihkan.<br><br>
                        Untuk melanjutkan penghapusan akun, silakan ketik <b>'${name}'</b> di bawah ini sebagai bentuk konfirmasi hapus akun:`
                    );
                    $('#deleteModal').modal('show');
                });
            });
        </script>
    @endprepend
</x-admin>
