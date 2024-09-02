<x-admin title="Profil Saya">
    {{-- Main Content --}}
    <h4 class="mb-4 fw-semibold d-inline-flex">Profil Saya</h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger fw-medium mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap align-middle mb-0">
                    <thead class="border-top border-start border-end">
                        <tr>
                            <th class="text-start py-3">Nama</th>
                            <th class="text-start py-3">Email</th>
                            <th class="text-center py-3">Nomor Ponsel</th>
                            <th class="text-center py-3">Peran</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-center py-3">Tanggal Bergabung</th>
                            <th class="text-center py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="border-start border-end">
                        <tr>
                            <td class="text-start py-3">{{ $user->name }}</td>
                            <td class="text-start py-3">{{ $user->email }}</td>
                            <td class="text-center py-3">{{ $user->phone_number }}</td>
                            <td class="text-center py-3">{{ $user->role === 'admin' ? 'Panitia' : '' }}</td>
                            <td class="text-center py-3">{{ $user->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td class="text-center py-3">
                                {{ \Carbon\Carbon::parse($user->created_at)->locale('id')->translatedFormat('d F Y') }}
                            </td>
                            <td class="text-center py-3">
                                <a href="{{ route('dashboard_profile.edit_pass') }}"
                                    class="text-dark align-middle me-3"><i class="bi bi-lock"></i></a>

                                <a href="{{ route('dashboard_profile.edit') }}" class="text-dark align-middle"><i
                                        class="bi bi-gear"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            //
        </script>
    @endprepend
</x-admin>
