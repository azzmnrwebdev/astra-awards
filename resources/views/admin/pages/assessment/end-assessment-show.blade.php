<x-admin title="Penilaian Akhir {{ $user->mosque->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Penilaian Akhir
        {{ $user->mosque->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-4">
                <h5 class="card-title fw-semibold">Pihak Penilai</h5>

                <ul class="list-group mt-3">
                    <li class="list-group-item border-0 py-1">
                        {{ $user->mosque->endAssessment->jury->name }}</li>
                </ul>
            </div>

            <div class="mb-0">
                <h5 class="card-title fw-semibold">Lampiran Penilaian Akhir</h5>

                <div class="table-responsive mt-4">
                    <table class="table table-hover text-nowrap align-middle mb-0">
                        <thead class="border-top border-start border-end table-custom">
                            <tr>
                                <th class="text-center py-3">Pilar</th>
                                <th class="text-center py-3">Nilai</th>
                            </tr>
                        </thead>

                        <tbody class="border-start border-end">
                            <tr>
                                <td class="text-start py-3">
                                    Hubungan DKM dengan YAA (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_two }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_one }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Program Sosial (Bobot 20%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_three }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Administrasi dan Keuangan (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_four }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Peribadahan dan Infrastruktur (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_five }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Total Nilai
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $user->mosque->endAssessment->presentation_value_pillar_two +
                                        $user->mosque->endAssessment->presentation_value_pillar_one +
                                        $user->mosque->endAssessment->presentation_value_pillar_three +
                                        $user->mosque->endAssessment->presentation_value_pillar_four +
                                        $user->mosque->endAssessment->presentation_value_pillar_five }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Rekap Nilai (Dikalikan Bobot)
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ str_replace(
                                        '.',
                                        ',',
                                        $user->mosque->endAssessment->presentation_value_pillar_two * 0.25 +
                                            $user->mosque->endAssessment->presentation_value_pillar_one * 0.25 +
                                            $user->mosque->endAssessment->presentation_value_pillar_three * 0.2 +
                                            $user->mosque->endAssessment->presentation_value_pillar_four * 0.15 +
                                            $user->mosque->endAssessment->presentation_value_pillar_five * 0.15,
                                    ) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('end_assessment.index') }}";
            });
        </script>
    @endprepend
</x-admin>
