<x-admin title="Peserta {{ $user->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Peserta {{ $user->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (session('success'))
                <div class="alert alert-success fw-medium" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $user->mosque->logo) }}" alt="Logo" class="img-fluid">
                </div>

                <div class="col-md-8">
                    <h5 class="card-title fw-semibold">Informasi Peserta</h5>

                    <div class="table-responsive">
                        <table class="table table-borderless text-nowrap">
                            <tbody>
                                <tr>
                                    <td class="px-0 py-1">Nama Lengkap</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Alamat Email</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Nomor Ponsel</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Jabatan</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->position }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Status Akun</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">
                                        @if ($user->status === 1)
                                            <span class="badge text-bg-success">Aktif</span>
                                        @else
                                            <span class="badge text-bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Nama Masjid/Musala</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Kategori Masjid/Musala</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->categoryMosque->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Kapasitas Jama'ah</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->capacity }} Jama'ah</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Ketua Pengurus</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->leader }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Email Ketua</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->leader_email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Nomor Ponsel Ketua</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->leader_phone }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Kategori Area</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->categoryArea->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Perusahaan</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->company->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Induk Perusahaan</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->company->parentCompany->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Lini Bisnis</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->company->businessLine->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Provinsi</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->city->province->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Kota/Kabupaten</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->city->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0 py-1">Alamat</td>
                                    <td class="px-1 py-1">:</td>
                                    <td class="px-0 py-1">{{ $user->mosque->address }}</td>
                                </tr>
                                <tr>
                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                        <thead class="border-top border-start border-end table-custom">
                                            <tr>
                                                <th class="border border-gray-300 px-4 py-2">Formulir</th>
                                                <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-start border-end">
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">Formulir Hubungan DKM dengan YAA</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                @if ($pillarOneStatus === 'sudah')
                                                    <span class="badge text-bg-success">Sudah</span>
                                                @elseif ($pillarOneStatus === 'sebagian')
                                                    <span class="badge text-bg-warning">Sebagian</span>
                                                @else
                                                    <span class="badge text-bg-danger">Belum</span>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">Formulir Manajemen Perusahaan dengan DKM dan Jamaah</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                @if ($pillarTwoStatus === 'sudah')
                                                    <span class="badge text-bg-success">Sudah</span>
                                                @elseif ($pillarTwoStatus === 'sebagian')
                                                    <span class="badge text-bg-warning">Sebagian</span>
                                                @else
                                                    <span class="badge text-bg-danger">Belum</span>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">Formulir Program Sosial</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                @if ($pillarThreeStatus === 'sudah')
                                                    <span class="badge text-bg-success">Sudah</span>
                                                @elseif ($pillarThreeStatus === 'sebagian')
                                                    <span class="badge text-bg-warning">Sebagian</span>
                                                @else
                                                    <span class="badge text-bg-danger">Belum</span>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">Formulir Administrasi dan Keuangan</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                @if ($pillarFourStatus === 'sudah')
                                                    <span class="badge text-bg-success">Sudah</span>
                                                @elseif ($pillarFourStatus === 'sebagian')
                                                    <span class="badge text-bg-warning">Sebagian</span>
                                                @else
                                                    <span class="badge text-bg-danger">Belum</span>
                                                @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-300 px-4 py-2">Formulir Peribadahan dan Infrastruktur</td>
                                                <td class="border border-gray-300 px-4 py-2 text-center">
                                                @if ($pillarFiveStatus === 'sudah')
                                                    <span class="badge text-bg-success">Sudah</span>
                                                @elseif ($pillarFiveStatus === 'sebagian')
                                                    <span class="badge text-bg-warning">Sebagian</span>
                                                @else
                                                    <span class="badge text-bg-danger">Belum</span>
                                                @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
