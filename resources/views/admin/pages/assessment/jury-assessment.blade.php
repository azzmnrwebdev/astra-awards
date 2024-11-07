<x-admin title="Penilaian Juri">
    {{-- Main Content --}}
    <div class="alert alert-info mb-4" role="alert">
        Halaman ini digunakan untuk memberikan nilai pada file presentasi (tahap penilaian awal),<br />
        bagi peserta yang masuk 5 besar setiap kategori dan lolos dari penilaian formulir (pra-penilaian).
    </div>

    @foreach ($categories as $index => $category)
        <h4 class="fw-semibold d-inline-flex
            {{ $loop->first ? 'mt-0' : 'mt-4' }} mb-4">
            {{ $category['title'] }}
        </h4>

        <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
            <div class="card-body p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-secondary">
                            <tr>
                                @foreach ($theadName as $thead)
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
                                    <td class="text-center py-3">
                                        @if ($item->mosque->presentation->startAssessmentForJury(auth()->id())->exists())
                                            <span class="badge text-bg-success">Sudah Penilaian</span>
                                        @else
                                            <span class="badge text-bg-danger">Belum Penilaian</span>
                                        @endif
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('jury_assessment.assessment', ['user' => $item->id]) }}"
                                            class="text-dark align-middle"><i class="bi bi-pencil"></i>
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
            //
        </script>
    @endprepend
</x-admin>
