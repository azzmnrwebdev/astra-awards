<x-admin title="Penilaian Awal">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Penilaian Awal</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            {{-- Filter --}}
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-success rounded-0">Unduh Excel</a>
                </div>

                <div class="col-12 mt-3">
                    <form class="row g-3">
                        <div class="col-12">
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach ($combinedData as $data)
                                    @php
                                        [$areaId, $mosqueId] = explode('-', $data['value']);
                                        $isSelected =
                                            old('kategori') == $data['value'] ||
                                            ($categoryAreaId == $areaId && $categoryMosqueId == $mosqueId);
                                    @endphp

                                    <option value="{{ $data['value'] }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $data['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                                class="form-control" placeholder="Cari peserta?">
                            <div class="form-text">Kata kunci bisa berdasarkan peserta, perusahaan atau masjid/musala.
                            </div>
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
                        @forelse ($paginatedUsers as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $paginatedUsers->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">
                                    @if ($item->mosque->presentation->startAssessment)
                                        <span class="badge text-bg-success">Sudah Penilaian</span>
                                    @else
                                        <span class="badge text-bg-danger">Belum Penilaian</span>
                                    @endif
                                </td>

                                <td class="text-center py-3">
                                    @if ($item->mosque->presentation->startAssessment)
                                        {{ $item->mosque->presentation->startAssessment->presentation_file }} Poin
                                    @else
                                        <span class="badge text-bg-danger">Belum Tersedia</span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    <a href="{{ route('start_assessment.show', ['user' => $item->id]) }}"
                                        class="text-dark align-middle"><i class="bi bi-eye"></i>
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
                {{ $paginatedUsers->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
        <h4 class="mt-4 mb-4 fw-semibold d-inline-flex">{{ $category['title'] }}</h4>

        <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
            <div class="card-body p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-secondary">
                            <tr>
                                @foreach ($otherTheadName as $thead)
                                    <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            @forelse ($category['datas'] as $item)
                                <tr>
                                    <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                                    <td class="text-start py-3">{{ $item->name }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                    <td class="text-center py-3">{{ $item->totalNilai }} Poin</td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('start_assessment.show', ['user' => $item->id]) }}"
                                            class="text-dark align-middle"><i class="bi bi-eye"></i>
                                    </td>
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
    @endforeach

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#kategori, #pencarian').on('input keydown change', function(e) {
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
                    const categoryId = $('#kategori').val();
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('start_assessment.index') }}';

                    if (categoryId !== '') {
                        const [categoryAreaId, categoryMosqueId] = categoryId.split('-');

                        params.kategori_area = categoryAreaId;
                        params.kategori_masjid = categoryMosqueId;
                    }

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
</x-admin>
