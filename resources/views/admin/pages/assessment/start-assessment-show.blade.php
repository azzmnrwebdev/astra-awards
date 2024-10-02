<x-admin title="Penilaian Awal {{ $user->name }}">
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
        {{ $user->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            <h5 class="card-title fw-semibold">File Presentasi</h5>

            <div class="table-responsive mt-3">
                <table class="table table-hover text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end table-success">
                        <tr>
                            <th class="text-center py-3">Pertanyaan</th>
                            <th class="text-center py-3">File Presentasi</th>
                            <th class="text-center py-3">Nilai</th>
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        @if ($user->mosque->presentation->startAssessment)
                            <tr>
                                <td class="text-start py-3">
                                    Silahkan untuk mengunggah file presentasi yang memuat keseluruhan pilar penilaian
                                    (Pilar 1, 2, 3, 4, dan 5)
                                </td>
                                <td class="text-center py-3">
                                    <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                        data-bs-toggle="modal" data-bs-target="#documentModal"
                                        data-url="{{ url('/' . ltrim($user->mosque->presentation->file, '/')) }}">
                                        Lihat File
                                    </button>
                                </td>
                                <td class="text-center py-3">
                                    {{ $user->mosque->presentation->startAssessment->presentation_file }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3" class="text-center text-danger py-3">Penilaian belum
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
                    <h1 class="modal-title fs-5" id="documentModalLabel">File Presentasi - {{ $user->name }}</h1>
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
                        documentContent.html('<p>File format tidak didukung.</p>');
                    }
                });
            });
        </script>
    @endprepend
</x-admin>
