<x-user title="Pengaturan" name="Pengaturan">
    <div class="container py-4">
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
                <ul class="list-group">
                    <a href="{{ route('setting.account') }}"
                        class="list-group-item mb-3 border rounded py-3 text-bg-dark d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Informasi Akun
                        </div>
                    </a>

                    @if (auth()->check() && auth()->user()->hasRole('user'))
                        <a href="{{ route('setting.general') }}"
                            class="list-group-item mb-3 border rounded py-3 text-bg-dark d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                Informasi Umum
                            </div>
                        </a>
                    @endif

                    <a href="{{ route('setting.changePassword') }}"
                        class="list-group-item mb-3 border rounded py-3 text-bg-dark d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            Ganti Kata Sandi
                        </div>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</x-user>
