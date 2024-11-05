<x-admin title="Penilaian Akhir">
    {{-- Penilaian Akhir --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Penilaian Akhir</h4>

    {{-- Filter --}}
    <div class="card border-0 mb-4" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('end_assessment.download_excel', ['kategori_area' => $categoryAreaId, 'kategori_masjid' => $categoryMosqueId, 'juri' => $juryId, 'pencarian' => $search]) }}"
                        class="btn btn-success rounded-0">Unduh Excel
                    </a>
                </div>

                <div class="col-12 mt-3">
                    <form class="row g-3">
                        <div class="col-12">
                            <select name="kategori" id="kategori" class="form-select">
                                <option value="">-- Semua Kategori --</option>
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
                            <select name="juri" id="juri" class="form-select">
                                <option value="">-- Semua Juri --</option>
                                @foreach ($juries as $jury)
                                    <option value="{{ $jury->id }}" {{ $juryId == $jury->id ? 'selected' : '' }}>
                                        {{ $jury->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                                class="form-control" placeholder="Cari peserta?">
                            <div class="form-text">Kata kunci bisa berdasarkan nama masjid/musala atau
                                perusahaan.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            @foreach ($endAssessmentTheadNames as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($endAssessmentAllUsers as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $endAssessmentAllUsers->firstItem() }}
                                </td>
                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                <td class="text-center py-3">{{ str_replace('.', ',', $item->totalNilai) }}
                                </td>
                                <td class="text-center py-3">
                                    <a href="{{ route('end_assessment.show', ['user' => $item->id]) }}"
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

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $endAssessmentAllUsers->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Penilaian Awal --}}
    <h4 class="mt-4 mb-4 fw-semibold d-inline-flex">Peserta Lolos Penilaian Awal</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            @foreach ($startAssessmentTheadNames as $thead)
                                <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($usersInStartAssessment as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $usersInStartAssessment->firstItem() }}
                                </td>
                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                <td class="text-center py-3">
                                    @if ($item->mosque->endAssessment)
                                        <span class="badge text-bg-success">Sudah Penilaian</span>
                                    @else
                                        <span class="badge text-bg-danger">Belum Penilaian</span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    @if (auth()->check() && auth()->user()->hasRole('jury'))
                                        <a href="{{ route('end_assessment.edit', ['user' => $item->id]) }}"
                                            class="text-dark align-middle"><i class="bi bi-pencil"></i></a>
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
                {{ $usersInStartAssessment->appends(request()->query())->links() }}
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
                                @foreach ($categoryTheadNames as $thead)
                                    <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            @forelse ($category['datas'] as $item)
                                <tr>
                                    <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->city->province->name }}</td>
                                    <td class="text-center py-3">{{ str_replace('.', ',', $item->totalNilai) }}
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('end_assessment.show', ['user' => $item->id]) }}"
                                            class="text-dark align-middle"><i class="bi bi-eye"></i></a>
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

                $('#kategori, #juri, #pencarian').on('input keydown change', function(e) {
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
                    const juryId = $('#juri').val();
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('end_assessment.index') }}';

                    if (categoryId !== '') {
                        const [categoryAreaId, categoryMosqueId] = categoryId.split('-');

                        params.kategori_area = categoryAreaId;
                        params.kategori_masjid = categoryMosqueId;
                    }

                    if (juryId !== '') {
                        params.juri = juryId;
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
