<x-user title="" name="Informasi">
    <div class="container py-4">
        {{-- Jumbroton --}}
        <div class="p-5 mb-4 bg-dark rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-6 text-white fw-bold">Selamat datang</h1>
                <p class="col-md-8 text-white fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium,
                    animi ea ut facere culpa recusandae doloremque fuga natus reiciendis fugiat nemo. Nostrum, adipisci
                    numquam. Mollitia rem nam architecto aliquid.</p>

                <a href="{{ route('form.index') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
            </div>
        </div>

        {{-- Information --}}
        <div class="row row-cols-1 row-cols-md-2 g-3">
            <div class="col">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">Informasi Umum</h5>

                        <p class="card-text mb-0"><span class="fw-medium">Nama Masjid/Mushala:
                            </span>{{ $information->name }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Alamat: </span>{{ $information->address }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Kota/Kabupaten:
                            </span>{{ $information->city }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Provinsi:
                            </span>{{ $information->province->name }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Kapasitas Jamaah:
                            </span>{{ $information->capacity }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Kategori Area:
                            </span>{{ $information->categoryArea->name }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Ketua Pengurus DKM:
                            </span>{{ $information->leader }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Perusahaan:
                            </span>{{ $information->company->name }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Induk Perusahaan:
                            </span>{{ $information->company->parentCompany->name }}</p>
                        <p class="card-text mb-0"><span class="fw-medium">Lini Bisnis:
                            </span>{{ $information->company->businessLine->name }}</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 border-0 shadow rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-3">Formulir</h5>

                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
</x-user>
