<x-admin title="Perusahaan">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Perusahaan</h4>

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
                <div class="col-12">
                    <a href="{{ route('company.create') }}" class="btn btn-dark rounded-0">Tambah</a>
                </div>

                <div class="col-12 mt-3">
                    <form class="row g-3">
                        <div class="col-sm-6">
                            <select name="lini_bisnis" id="lini_bisnis" class="form-select">
                                <option value="">Semua Lini Bisnis</option>
                                @foreach ($businessLines as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $businessLineId == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <select name="induk_perusahaan" id="induk_perusahaan" class="form-select">
                                <option value="">Semua Induk Perusahaan</option>
                                @foreach ($parentCompanies as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $parentCompanyId == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                                class="form-control" placeholder="Cari perusahaan?">
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            @foreach ($theadName as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($companies as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $companies->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-start py-3">{{ $item->parentCompany->name }}</td>
                                <td class="text-start py-3">{{ $item->businessLine->name }}</td>
                                <td class="text-center py-3">
                                    <a href="{{ route('company.edit', ['company' => $item->id]) }}"
                                        class="text-dark align-middle @if (empty(count($item->mosque))) me-3 @endif"><i
                                            class="bi bi-pencil"></i></a>

                                    @if (empty(count($item->mosque)))
                                        <button type="button"
                                            class="border-0 p-0 bg-transparent text-dark align-middle delete"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                                class="bi bi-trash3"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $companies->appends(request()->query())->links() }}
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
                    <div id="deleteModalMessage" class="alert alert-info" role="alert"></div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        <form class="d-inline" id="deleteForm" action="" method="POST">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger">Ya, saya yakin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#lini_bisnis, #induk_perusahaan, #pencarian').on('input keydown change', function(e) {
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
                    const businessLineId = $('#lini_bisnis').val();
                    const parentCompanyId = $('#induk_perusahaan').val();
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('company.index') }}';

                    if (businessLineId !== '') {
                        params.lini_bisnis = businessLineId;
                    }

                    if (parentCompanyId !== '') {
                        params.induk_perusahaan = parentCompanyId;
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
                    const deleteUrl = "{{ route('company.destroy', ['company' => ':id']) }}"
                        .replace(':id',
                            id);

                    $('#deleteForm').attr('action', deleteUrl);
                    $('#deleteModalMessage').html(
                        `Apakah anda yakin ingin menghapus data <b>'${name}'</b> ?`
                    );
                    $('#deleteModal').modal('show');
                });
            });
        </script>
    @endprepend
</x-admin>
