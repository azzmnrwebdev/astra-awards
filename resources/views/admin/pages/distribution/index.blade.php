<x-admin title="Pembagian DKM">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Pembagian DKM</h4>

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
                    <form action="{{ route('distribution.store') }}" method="POST">
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
                            @foreach ($theadName as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($committes as $item)
                            <tr>
                                <td class="text-center py-3">
                                    {{ $loop->index + $committes->firstItem() }}
                                </td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ count($item->distributionToCommitte) }}</td>
                                <td class="text-center py-3">
                                    <a href="{{ route('distribution.show', ['distribution' => $item->id]) }}"
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
                {{ $committes->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        {{--  --}}
    @endprepend
</x-admin>
