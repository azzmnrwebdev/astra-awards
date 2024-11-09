<x-admin title="Penilaian Awal {{ $user->mosque->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Penilaian Awal
        {{ $user->mosque->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <div class="mb-4">
                <h5 class="card-title fw-semibold">Pihak Penilai</h5>

                @if ($user->mosque->presentation->startAssessment && $user->mosque->presentation->startAssessment->isNotEmpty())
                    <ol class="list-group list-group-numbered mt-3">
                        @foreach ($user->mosque->presentation->startAssessment as $item)
                            <li class="list-group-item border-0 py-1">{{ $item->jury->name }}</li>
                        @endforeach
                    </ol>
                @else
                    <ul class="list-group mt-3">
                        <li class="list-group-item border-0 py-1">
                            Belum ada
                        </li>
                    </ul>
                @endif
            </div>

            <h5 class="card-title fw-semibold mb-4">Lampiran Penilaian Awal</h5>

            <embed src="{{ asset($user->mosque->presentation->file) }}" type="application/pdf" width="100%"
                height="500px" />

            <div class="table-responsive mt-3">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            <th class="text-center py-3">Pilar</th>
                            @if (auth()->check() && auth()->user()->hasRole('admin'))
                                <th class="text-center py-3">Nilai Keseluruhan Juri</th>
                            @else
                                <th class="text-center py-3">Nilai</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @php
                            $assessment = $user->mosque->presentation->startAssessmentForJury(auth()->id())->first();
                        @endphp

                        <tr>
                            <td class="text-start py-3">
                                Hubungan DKM dengan YAA (Bobot 25%)
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_two;
                                    }) }}
                                @else
                                    {{ $assessment->presentation_file_pillar_two ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_one;
                                    }) }}
                                @else
                                    {{ $assessment->presentation_file_pillar_one ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Program Sosial (Bobot 20%)
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_three;
                                    }) }}
                                @else
                                    {{ $assessment->presentation_file_pillar_three ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Administrasi dan Keuangan (Bobot 15%)
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_four;
                                    }) }}
                                @else
                                    {{ $assessment->presentation_file_pillar_four ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="text-start py-3">
                                Peribadahan dan Infrastruktur (Bobot 15%)
                            </td>
                            <td class="text-center py-3">
                                @if (auth()->check() && auth()->user()->hasRole('admin'))
                                    {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_five;
                                    }) }}
                                @else
                                    {{ $assessment->presentation_file_pillar_five ?? '-' }}
                                @endif
                            </td>
                        </tr>

                        @if (auth()->check() && auth()->user()->hasRole('jury'))
                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Total Nilai
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $assessment
                                        ? $assessment->presentation_file_pillar_two +
                                            $assessment->presentation_file_pillar_one +
                                            $assessment->presentation_file_pillar_three +
                                            $assessment->presentation_file_pillar_four +
                                            $assessment->presentation_file_pillar_five
                                        : '-' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Rekap Nilai (Dikalikan Bobot)
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $assessment
                                        ? str_replace(
                                            '.',
                                            ',',
                                            $assessment->presentation_file_pillar_two * 0.25 +
                                                $assessment->presentation_file_pillar_one * 0.25 +
                                                $assessment->presentation_file_pillar_three * 0.2 +
                                                $assessment->presentation_file_pillar_four * 0.15 +
                                                $assessment->presentation_file_pillar_five * 0.15,
                                        )
                                        : '-' }}
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Total Nilai Berdasarkan Seluruh Juri Yang Menilai
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                    return $sumAssessment->presentation_file_pillar_two +
                                        $sumAssessment->presentation_file_pillar_one +
                                        $sumAssessment->presentation_file_pillar_three +
                                        $sumAssessment->presentation_file_pillar_four +
                                        $sumAssessment->presentation_file_pillar_five;
                                }) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="text-center fw-semibold py-3">
                                Rekap Nilai Berdasarkan Seluruh Juri Yang Menilai (Dikalikan Bobot)
                            </td>
                            <td class="text-center fw-semibold py-3">
                                {{ str_replace(
                                    '.',
                                    ',',
                                    $user->mosque->presentation->startAssessment->sum(function ($sumAssessment) {
                                        return $sumAssessment->presentation_file_pillar_two * 0.25 +
                                            $sumAssessment->presentation_file_pillar_one * 0.25 +
                                            $sumAssessment->presentation_file_pillar_three * 0.2 +
                                            $sumAssessment->presentation_file_pillar_four * 0.15 +
                                            $sumAssessment->presentation_file_pillar_five * 0.15;
                                    }),
                                ) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('start_assessment.index') }}";
            });
        </script>
    @endprepend
</x-admin>
