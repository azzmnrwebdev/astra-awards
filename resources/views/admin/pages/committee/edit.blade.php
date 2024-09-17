<x-admin title="Edit {{ $committee->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Edit {{ $committee->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('committee.update', ['committee' => $committee->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="name" class="col-md-3 col-xl-2 col-form-label">Nama</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $committee->name) }}" placeholder="Nama Lengkap">

                        @error('name')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-3 col-xl-2 col-form-label">Email</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $committee->email) }}" placeholder="example@gmail.com">

                        @error('email')
                            <small class="invalid-feedback"><strong>{{ $message }}</strong></small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone_number" class="col-md-3 col-xl-2 col-form-label">Nomor Ponsel</label>

                    <div class="col-md-9 col-xl-10">
                        <input type="phone_number" name="phone_number" id="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{ old('phone_number', $committee->phone_number) }}" placeholder="081234567890">

                        @error('phone_number')
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
                window.location.href = "{{ route('committee.index') }}";
            });
        </script>
    @endprepend
</x-admin>
