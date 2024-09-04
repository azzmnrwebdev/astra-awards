<x-guest title="Daftar">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10">
            <div class="card border-0 shadow-lg text-bg-warning" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h3 class="card-title">Pendaftaran Belum Dibuka</h3>
                    <p class="card-text">Maaf, pendaftaran belum dibuka. Silakan periksa lagi nanti.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            //
        </script>
    @endprepend
</x-guest>
