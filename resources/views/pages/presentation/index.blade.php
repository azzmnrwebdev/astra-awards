<x-user title="Presentasi" name="Presentasi">
    <div class="container py-4">
        @if (auth()->check() && auth()->user()->hasRole('user'))
            <form action="{{ route('presentationAct') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $presentation->id ?? '' }}">

                <div class="row row-cols-1 g-3">
                    @if (Session('success'))
                        <div class="col-md-10 col-lg-8">
                            <div class="alert alert-success mb-2" role="alert">
                                {{ Session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (Session('error'))
                        <div class="col-md-10 col-lg-8">
                            <div class="alert alert-danger mb-2" role="alert">
                                {{ Session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-10 col-lg-8">
                        <div class="card h-100 border-0 shadow rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Mengunggah File Presentasi</h5>

                                {{-- Pertanyaan 1 --}}
                                <div class="{{ $presentation && $presentation->file ? 'mb-2' : 'mb-0' }}">
                                    <label for="file" class="form-label fw-medium">Silahkan untuk mengunggah file
                                        presentasi yang memuat keseluruhan pilar penilaian (Pilar 1, 2, 3, 4, dan
                                        5)</label>
                                    <input class="form-control" type="file" id="file" name="file">

                                    <div class="form-text">Hanya file bertipe pdf yang di izinkan.</div>
                                </div>

                                @error('file')
                                    <div class="text-danger mt-1"><strong>{{ $message }}</strong></div>
                                @enderror

                                @if ($presentation && $presentation->file)
                                    <div class="mb-0">
                                        <button type="button" class="border-0 p-0 bg-transparent text-primary"
                                            data-bs-toggle="modal" data-bs-target="#documentModal"
                                            data-url="{{ url('/' . ltrim($presentation->file, '/')) }}">
                                            Lihat Dokumen
                                        </button>
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif

        @if (auth()->check() && auth()->user()->hasRole('jury'))
            <div class="row row-cols-1 g-3">
                <div class="col mb-2">
                    <form>
                        <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                            class="form-control" placeholder="Cari peserta?">
                        <div class="form-text">Kata kunci berdasarkan nama masjid/musala atau perusahaan</div>
                    </form>
                </div>

                <div class="col">
                    <div class="card h-100 border-0 shadow rounded-4">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-4">Seluruh Peserta dari 5 Terbesar Berdasarkan Kategori
                            </h5>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap align-middle mb-0">
                                    <thead class="border-top border-start border-end table-primary">
                                        <tr>
                                            <th class="text-center py-3">No</th>
                                            <th class="text-center py-3">Kategori Area</th>
                                            <th class="text-center py-3">Kategori</th>
                                            <th class="text-center py-3">Masjid/Musala</th>
                                            <th class="text-center py-3">Perusahaan</th>
                                            <th class="text-center py-3">Penilaian</th>
                                            <th class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="border-start border-end">
                                        @forelse ($allUsers as $item)
                                            <tr>
                                                <td class="text-center py-3">
                                                    {{ $loop->index + 1 }}</td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryArea->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->categoryMosque->name }}
                                                </td>
                                                <td class="text-center py-3">{{ $item->mosque->name }}</td>
                                                <td class="text-center py-3">
                                                    {{ $item->mosque->company->name }}
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->mosque->presentation->startAssessment->presentation_id ?? '')
                                                        @if ($item->mosque->presentation->startAssessment->presentation_file_pillar_one)
                                                            <span class="badge rounded-pill text-bg-success">
                                                                Sudah
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">
                                                            Belum
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <a href="{{ route('presentation.assessment', ['user' => $item->id]) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if (auth()->check() && auth()->user()->hasRole('user'))
        {{-- Modal --}}
        <div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="documentModalLabel">Lihat Dokumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div id="documentContent"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->check() && auth()->user()->hasRole('user'))
        {{-- Custom Javascript --}}
        @prepend('scripts')
            <script>
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
    @endif

    @if (auth()->check() && auth()->user()->hasRole('jury'))
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
                        const url = '{{ route('presentation.index') }}';

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
    @endif
</x-user>
