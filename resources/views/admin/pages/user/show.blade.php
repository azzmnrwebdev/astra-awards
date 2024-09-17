<x-admin title="Peserta DKM {{ $user->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Peserta DKM {{ $user->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <h5 class="card-title fw-semibold">Informasi Akun</h5>

            <p class="card-text mb-0"><span class="fw-medium">Nama Pengguna:
                </span>{{ $user->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Alamat Email:
                </span>{{ $user->email }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Nomor Ponsel:
                </span>{{ $user->phone_number }}</p>
            <p class="card-text"><span class="fw-medium">Status Pengguna:
                </span>{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</p>

            <h5 class="card-title fw-semibold">Informasi Umum</h5>

            <p class="card-text mb-0"><span class="fw-medium">Nama Masjid/Musala:
                </span>{{ $user->mosque->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Kategori Masjid:
                </span>{{ $user->mosque->categoryMosque->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Alamat: </span>{{ $user->mosque->address }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Kota/Kabupaten:
                </span>{{ $user->mosque->city->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Provinsi:
                </span>{{ $user->mosque->city->province->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Kapasitas Jamaah:
                </span>{{ $user->mosque->capacity }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Kategori Area:
                </span>{{ $user->mosque->categoryArea->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Ketua Pengurus DKM:
                </span>{{ $user->mosque->leader }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Perusahaan:
                </span>{{ $user->mosque->company->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Induk Perusahaan:
                </span>{{ $user->mosque->company->parentCompany->name }}</p>
            <p class="card-text mb-0"><span class="fw-medium">Lini Bisnis:
                </span>{{ $user->mosque->company->businessLine->name }}</p>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('user.index') }}";
            });
        </script>
    @endprepend
</x-admin>
