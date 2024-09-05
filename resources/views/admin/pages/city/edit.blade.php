<x-admin title="Edit Kota/Kabupaten">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit Kota/Kabupaten
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('city.update', ['city' => $city->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="province_id" class="col-md-3 col-xl-2 col-form-label">Pilih Provinsi</label>

                    <div class="col-md-9 col-xl-10">
                        <select name="province_id" id="province_id"
                            class="form-select @error('province_id') is-invalid @enderror">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}"
                                    {{ (old('province_id') ?? $city->province_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('province_id')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-md-3 col-xl-2 col-form-label">Nama Kota/Kabupaten</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') ?? $city->name }}">

                        @error('name')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('city.index') }}";
            });
        </script>
    @endprepend
</x-admin>
