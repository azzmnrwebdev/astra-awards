<x-admin title="Penilaian Awal">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Penilaian Awal</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            {{-- Filter --}}
            <div class="row">
                <div class="col-12">
                    <div class="row g-2">
                        <div class="col-auto">
                            <a href="{{ route('start_assessment.list_download_excel', ['kategori_area' => $categoryAreaId, 'kategori_masjid' => $categoryMosqueId, 'juri' => $juryId, 'tahun' => request('tahun'), 'pencarian' => $search]) }}"
                                class="btn btn-success rounded-0"><i
                                    class="bi bi-file-earmark-spreadsheet-fill me-2 fs-5"></i>Laporan Penilaian</a>
                        </div>

                        <div class="col-auto">
                            @if (!$juryId)
                                <a href="{{ route('start_assessment.recap_download_excel', ['kategori_area' => $categoryAreaId, 'kategori_masjid' => $categoryMosqueId, 'tahun' => request('tahun'), 'pencarian' => $search]) }}"
                                    class="btn btn-success rounded-0"><i
                                        class="bi bi-file-earmark-spreadsheet-fill me-2 fs-5"></i>Rekapitulasi
                                    Penilaian</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <form class="row g-3">
                        <div class="col-sm-6">
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

                        <div class="col-sm-6">
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
                            <select name="tahun" id="tahun" class="form-select">
                                @php
                                    $currentYear = date('Y');
                                    $startYear = 2024;
                                @endphp

                                @for ($year = $startYear; $year <= $currentYear; $year++)
                                    <option value="{{ $year }}"
                                        {{ request('tahun', $currentYear) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
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

            <div class="table-responsive mt-4">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            @foreach ($theadName as $thead)
                                <th class="{{ $thead['class'] }} align-middle">{!! $thead['label'] !!}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @forelse ($paginatedUsers as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $paginatedUsers->firstItem() }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                @if (auth()->check() && auth()->user()->hasRole('jury'))
                                    <td class="text-center py-3">
                                        @php
                                            $assessment = $item->mosque->presentationWithCustomYear
                                                ->startAssessmentForJuryWithCustomYear(auth()->id())
                                                ->first();
                                        @endphp

                                        {!! $assessment
                                            ? str_replace(
                                                '.',
                                                ',',
                                                $assessment->presentation_file_pillar_two * 0.25 +
                                                    $assessment->presentation_file_pillar_one * 0.25 +
                                                    $assessment->presentation_file_pillar_three * 0.2 +
                                                    $assessment->presentation_file_pillar_four * 0.15 +
                                                    $assessment->presentation_file_pillar_five * 0.15,
                                            )
                                            : '<span class="badge text-bg-danger">Belum Tersedia</span>' !!}
                                    </td>
                                @endif
                                <td class="text-center py-3">
                                    {!! $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->count() > 0
                                        ? str_replace(
                                            '.',
                                            ',',
                                            $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->sum(function ($sumAssessment) {
                                                return $sumAssessment->presentation_file_pillar_two * 0.25 +
                                                    $sumAssessment->presentation_file_pillar_one * 0.25 +
                                                    $sumAssessment->presentation_file_pillar_three * 0.2 +
                                                    $sumAssessment->presentation_file_pillar_four * 0.15 +
                                                    $sumAssessment->presentation_file_pillar_five * 0.15;
                                            }),
                                        )
                                        : '<span class="badge text-bg-danger">Belum Tersedia</span>' !!}
                                </td>
                                <td class="text-center py-3">
                                    {!! $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->count() > 0
                                        ? str_replace(
                                            '.',
                                            ',',
                                            round(
                                                $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->sum(function ($sumAssessment) {
                                                    return $sumAssessment->presentation_file_pillar_two * 0.25 +
                                                        $sumAssessment->presentation_file_pillar_one * 0.25 +
                                                        $sumAssessment->presentation_file_pillar_three * 0.2 +
                                                        $sumAssessment->presentation_file_pillar_four * 0.15 +
                                                        $sumAssessment->presentation_file_pillar_five * 0.15;
                                                }) / $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->count(),
                                                2,
                                            ),
                                        )
                                        : '<span class="badge text-bg-danger">Belum Tersedia</span>' !!}
                                </td>
                                <td class="text-center py-3">
                                    <a href="{{ route('start_assessment.show', ['user' => $item->id, 'tahun' => request('tahun')]) }}"
                                        class="text-dark align-middle"><i class="bi bi-eye"></i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->check() && auth()->user()->hasRole('admin') ? '8' : '9' }}"
                                    class="text-center py-3">Data tidak ditemukan</td>
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

    {{-- Penentuan Penilaian Awal --}}
    @foreach ($categories as $category)
        <h4 class="mt-4 mb-4 fw-semibold d-inline-flex">{{ $category['title'] }}</h4>

        <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
            <div class="card-body p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-secondary">
                            <tr>
                                @foreach ($categoryTheadName as $thead)
                                    <th class="{{ $thead['class'] }}">{{ $thead['label'] }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            @forelse ($category['datas'] as $item)
                                <tr>
                                    <td class="text-center py-3">{{ $loop->index + 1 }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                    <td class="text-center py-3">
                                        {{ $item->getAttribute('name') . ' (' . $item->getAttribute('phone_number') . ')' }}
                                    </td>
                                    <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                    <td class="text-center py-3">{{ $item->mosque->city->province->name }}</td>
                                    <td class="text-center py-3">
                                        {{ str_replace(
                                            '.',
                                            ',',
                                            round(
                                                $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->sum(function ($sumAssessment) {
                                                    return $sumAssessment->presentation_file_pillar_two * 0.25 +
                                                        $sumAssessment->presentation_file_pillar_one * 0.25 +
                                                        $sumAssessment->presentation_file_pillar_three * 0.2 +
                                                        $sumAssessment->presentation_file_pillar_four * 0.15 +
                                                        $sumAssessment->presentation_file_pillar_five * 0.15;
                                                }) / $item->mosque->presentationWithCustomYear->startAssessmentWithCustomYear->count(),
                                                2,
                                            ),
                                        ) }}
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('start_assessment.show', ['user' => $item->id, 'tahun' => request('tahun')]) }}"
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
            </div>
        </div>
    @endforeach

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            $(document).ready(function() {
                let debounceTimeout;

                $('#kategori, #juri, #tahun, #pencarian').on('input keydown change', function(e) {
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
                    const year = $('#tahun').val();
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('start_assessment.index') }}';

                    if (categoryId !== '') {
                        const [categoryAreaId, categoryMosqueId] = categoryId.split('-');

                        params.kategori_area = categoryAreaId;
                        params.kategori_masjid = categoryMosqueId;
                    }

                    if (juryId !== '') {
                        params.juri = juryId;
                    }

                    if (year !== '') {
                        params.tahun = year;
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
