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

                <ul class="list-group mt-3">
                    <li class="list-group-item border-0 py-1">
                        {{ $user->mosque->presentation->startAssessment ? $user->mosque->presentation->startAssessment->jury->name : 'Belum ada' }}
                    </li>
                </ul>
            </div>

            <h5 class="card-title fw-semibold mb-3">Lampiran Penilaian Awal</h5>

            <button type="button" class="btn btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#documentModal"
                data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                Lihat File Presentasi
            </button>

            <div class="table-responsive mt-3">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-custom">
                        <tr>
                            <th class="text-center py-3">Pilar</th>
                            <th class="text-center py-3">Nilai</th>
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @if ($user->mosque->presentation->startAssessment)
                            <tr>
                                <td class="text-start py-3">
                                    Hubungan DKM dengan YAA (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_two }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_one }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Program Sosial (Bobot 20%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_three }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Administrasi dan Keuangan (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_four }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-3">
                                    Peribadahan dan Infrastruktur (Bobot 15%)
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_five }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center fw-semibold py-3">
                                    Total Nilai
                                </td>
                                <td class="text-center fw-semibold py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file_pillar_two +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_one +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_three +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_four +
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_five }}
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
                                        $user->mosque->presentation->startAssessment->presentation_file_pillar_two * 0.25 +
                                            $user->mosque->presentation->startAssessment->presentation_file_pillar_one * 0.25 +
                                            $user->mosque->presentation->startAssessment->presentation_file_pillar_three * 0.2 +
                                            $user->mosque->presentation->startAssessment->presentation_file_pillar_four * 0.15 +
                                            $user->mosque->presentation->startAssessment->presentation_file_pillar_five * 0.15,
                                    ) }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-danger py-3">Penilaian belum
                                    dilakukan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentModalLabel">File Presentasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div id="documentContent"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('start_assessment.index') }}";
            });

            document.addEventListener('DOMContentLoaded', function() {
                $('#documentModal').on('show.bs.modal', function(event) {
                    let button = $(event.relatedTarget);
                    let url = button.data('url');
                    let modal = $(this);
                    let documentContent = modal.find('#documentContent');

                    documentContent.html('');

                    if (url.match(/\.pdf$/i)) {
                        documentContent.html('<embed src="' + url +
                            '" type="application/pdf" width="100%" height="500px" />');
                    } else {
                        documentContent.html('<p>Format file tidak didukung.</p>');
                    }
                });
            });
        </script>
    @endprepend
</x-admin>
