<x-admin title="Pra Penilaian">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Pembagian Penilaian -
        Panitia {{ $committee->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Filter --}}
            <div class="row">
                <div class="col-12">
                    <input type="search" name="pencarian" id="pencarian" value="{{ $search }}"
                        class="form-control" placeholder="Cari peserta?">
                    <div class="form-text">Kata kunci berdasarkan nama masjid/musala.
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <form action="{{ route('committee.update_distribution', ['committee' => $committee->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        @foreach ($users as $user)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="users[]"
                                    value="{{ $user->id }}" id="user{{ $user->id }}"
                                    {{ $user->distributions->contains('committe_id', $committee->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user{{ $user->id }}">
                                    {{ $user->mosque->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('committee.index') }}";
            });

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
                    const url =
                        '{{ route('committee.edit', ['committee' => $committee->id, 'name' => 'edit-pembagian-penilaian']) }}';

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
