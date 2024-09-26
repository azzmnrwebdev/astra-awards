<x-admin title="Panitia {{ $committee->name }}">
    {{-- Custom CSS --}}
    @prepend('styles')
        <style>
            #pageTitle:hover {
                cursor: pointer;
            }
        </style>
    @endprepend

    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex" id="pageTitle">
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Panitia
        {{ $committee->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <h5 class="card-title mb-4">Daftar Peserta yang akan di nilai</h5>

            <div class="table-responsive">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            @foreach ($theadName as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($users as $item)
                            <tr>
                                <td class="text-center py-3">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center py-3">
                                    <img src="{{ asset('storage/' . $item->mosque->logo) }}" alt="Logo"
                                        style="width: 150px;">
                                </td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('committee.index') }}";
            });
        </script>
    @endprepend
</x-admin>
