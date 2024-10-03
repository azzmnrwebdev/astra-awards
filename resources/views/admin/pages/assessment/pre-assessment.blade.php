<x-admin title="Pra Penilaian">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Manajemen Pra Penilaian</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            {{-- Filter --}}
            <div class="row">
                <div class="col-12">
                    <form class="row g-3">
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
                        @forelse ($users as $item)
                            <tr>
                                <td class="text-center py-3">{{ $loop->index + $users->firstItem() }}</td>
                                <td class="text-start py-3">{{ $item->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->company->name }}</td>
                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                <td class="text-center py-3">
                                    @php
                                        $pillarOne = $item->mosque->pillarOne;
                                        $pillarTwo = $item->mosque->pillarTwo;
                                        $pillarThree = $item->mosque->pillarThree;
                                        $pillarFour = $item->mosque->pillarFour;
                                        $pillarFive = $item->mosque->pillarFive;

                                        $filledPillars = 0;

                                        if ($pillarOne && $pillarOne->committeeAssessmnet?->pillar_one_id) {
                                            $pillarOneAssessment = $pillarOne->committeeAssessmnet;
                                            if (
                                                $pillarOneAssessment->pillar_one_question_one ||
                                                $pillarOneAssessment->pillar_one_question_two ||
                                                $pillarOneAssessment->pillar_one_question_three ||
                                                $pillarOneAssessment->pillar_one_question_four ||
                                                $pillarOneAssessment->pillar_one_question_five ||
                                                $pillarOneAssessment->pillar_one_question_six ||
                                                $pillarOneAssessment->pillar_one_question_seven
                                            ) {
                                                $filledPillars++;
                                            }
                                        }

                                        if ($pillarTwo && $pillarTwo->committeeAssessmnet?->pillar_two_id) {
                                            $pillarTwoAssessment = $pillarTwo->committeeAssessmnet;
                                            if (
                                                $pillarTwoAssessment->pillar_two_question_two ||
                                                $pillarTwoAssessment->pillar_two_question_three ||
                                                $pillarTwoAssessment->pillar_two_question_four ||
                                                $pillarTwoAssessment->pillar_two_question_five
                                            ) {
                                                $filledPillars++;
                                            }
                                        }

                                        if ($pillarThree && $pillarThree->committeeAssessmnet?->pillar_three_id) {
                                            $pillarThreeAssessment = $pillarThree->committeeAssessmnet;
                                            if (
                                                $pillarThreeAssessment->pillar_three_question_one ||
                                                $pillarThreeAssessment->pillar_three_question_two ||
                                                $pillarThreeAssessment->pillar_three_question_three ||
                                                $pillarThreeAssessment->pillar_three_question_four ||
                                                $pillarThreeAssessment->pillar_three_question_five ||
                                                $pillarThreeAssessment->pillar_three_question_six
                                            ) {
                                                $filledPillars++;
                                            }
                                        }

                                        if ($pillarFour && $pillarFour->committeeAssessmnet?->pillar_four_id) {
                                            $pillarFourAssessment = $pillarFour->committeeAssessmnet;
                                            if (
                                                $pillarFourAssessment->pillar_four_question_one ||
                                                $pillarFourAssessment->pillar_four_question_two ||
                                                $pillarFourAssessment->pillar_four_question_three ||
                                                $pillarFourAssessment->pillar_four_question_four ||
                                                $pillarFourAssessment->pillar_four_question_five
                                            ) {
                                                $filledPillars++;
                                            }
                                        }

                                        if ($pillarFive && $pillarFive->committeeAssessmnet?->pillar_five_id) {
                                            $pillarFiveAssessment = $pillarFive->committeeAssessmnet;
                                            if (
                                                $pillarFiveAssessment->pillar_five_question_one ||
                                                $pillarFiveAssessment->pillar_five_question_two ||
                                                $pillarFiveAssessment->pillar_five_question_three ||
                                                $pillarFiveAssessment->pillar_five_question_four ||
                                                $pillarFiveAssessment->pillar_five_question_five
                                            ) {
                                                $filledPillars++;
                                            }
                                        }

                                        if ($filledPillars === 5) {
                                            $status = 'Semua Formulir';
                                            $badgeClass = 'text-bg-success';
                                        } elseif ($filledPillars > 0 && $filledPillars < 5) {
                                            $status = 'Sebagian Formulir';
                                            $badgeClass = 'text-bg-warning';
                                        } else {
                                            $status = 'Belum Penilaian';
                                            $badgeClass = 'text-bg-danger';
                                        }
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                </td>

                                <td class="text-center py-3">
                                    @if ($item->mosque->total_pillar_value !== 0)
                                        {{ $item->mosque->total_pillar_value }}
                                    @else
                                        <span class="badge text-bg-danger">Belum Tersedia</span>
                                    @endif
                                </td>
                                <td class="text-center py-3">
                                    <a href="{{ route('pre_assessment.show', ['user' => $item->id]) }}"
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
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    {{-- Main Content --}}
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
                let debounceTimeout;

                $('#pencarian').on('input keydown change', function(e) {
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
                    const searchValue = $('#pencarian').val();
                    const url = '{{ route('pre_assessment.index') }}';

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
