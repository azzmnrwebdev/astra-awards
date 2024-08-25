<x-user title="Formulir" name="Formulir">
    <div class="container py-4">
        {{-- Alert --}}
        <div class="alert alert-info mb-4" role="alert">
            Silahkan isi 5 formulir yang ada dibawah ini
        </div>

        {{-- List Form --}}
        <ul class="list-group list-group-numbered">
            <a href="{{ route('form.managementRelationship') }}"
                class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Formulir Hubungan Manajemen Perusahaan dengan DKM dan Jamaah
                </div>
            </a>

            <a href="{{ route('form.relationship') }}"
                class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Formulir Hubungan DKM dengan YAA
                </div>
            </a>

            <a href="{{ route('form.program') }}"
                class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Formulir Program Sosial
                </div>
            </a>

            <a href="{{ route('form.administration') }}"
                class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Formulir Administrasi dan Keuangan
                </div>
            </a>

            <a href="{{ route('form.infrastructure') }}"
                class="list-group-item mb-3 border rounded py-3 bg-dark text-white d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    Formulir Peribadahan dan Infrastruktur
                </div>
            </a>
        </ul>
    </div>
</x-user>
