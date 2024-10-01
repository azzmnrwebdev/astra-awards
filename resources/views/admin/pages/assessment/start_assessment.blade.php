<x-admin title="Penilaian Awal">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Penilaian Awal</h4>

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
                        @forelse ($paginatedUsers as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $paginatedUsers->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">
                                    @if ($item->mosque->presentation)
                                        @if ($item->mosque->presentation->startAssessment)
                                            <span class="badge text-bg-success">Sudah Penilaian</span>
                                        @else
                                            <span class="badge text-bg-danger">Belum Penilaian</span>
                                        @endif
                                    @else
                                        <span class="badge text-bg-danger">Belum Tersedia</span>
                                    @endif
                                </td>

                                <td class="text-center py-3">
                                    @if ($item->mosque->presentation)
                                        @if ($item->mosque->presentation->startAssessment)
                                            {{ $item->mosque->presentation->startAssessment->presentation_file }} Poin
                                        @else
                                            <span class="badge text-bg-danger">Belum Tersedia</span>
                                        @endif
                                    @else
                                        <span class="badge text-bg-danger">Belum Tersedia</span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    <a href="#" class="text-dark align-middle"><i class="bi bi-eye"></i>

                                        {{-- <a href="{{ route('start_assessment.show', ['user' => $item->id]) }}"
                                        class="text-dark align-middle"><i class="bi bi-eye"></i> --}}
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
        <h4 class="mt-5 mb-4 fw-semibold d-inline-flex">{{ $category['title'] }}</h4>

        <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
            <div class="card-body p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end">
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
                                        <a href="{{ route('pre_assessment.show', ['user' => $item->id]) }}"
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
                //
            });
        </script>
    @endprepend
</x-admin>
