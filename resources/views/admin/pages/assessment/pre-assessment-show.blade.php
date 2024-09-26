<x-admin title="Pra Penilaian {{ $user->name }}">
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
        <i class="bi bi-arrow-left-short" style="-webkit-text-stroke: 1px;"></i>&nbsp;&nbsp;Pra Penilaian
        {{ $user->name }}
    </h4>

    <div class="card border-0" style="box-shadow: rgba(13, 38, 76, 0.19) 0px 9px 20px">
        <div class="card-body p-lg-4">
            @if (count($committees) > 0)
                {{-- Header --}}
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Pihak Penilai</h5>

                    <ol class="list-group list-group-numbered mt-3">
                        @foreach ($committees as $item)
                            <li class="list-group-item border-0 py-1">{{ $item->name }}</li>
                        @endforeach
                    </ol>
                </div>

                {{-- Main --}}
                {{-- Formulir 1 --}}
                <div class="mb-3">
                    <h5 class="card-title fw-semibold">Formulir Hubungan DKM dengan YAA</h5>

                    <div class="mt-3">
                        @foreach ($committees as $committee)
                            <h6 class="card-subtitle mb-1">{{ $committee->name }}</h6>

                            <div class="{{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                @if (isset($historyAssessmentPillarTwos[$committee->id]))
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($historyAssessmentPillarTwos[$committee->id] as $position)
                                            <li class="list-group-item border-0 py-1">{{ $position }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 py-1">Tidak ada riwayat penilaian</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap align-middle mb-0">
                            <thead class="border-top border-start border-end table-success">
                                <tr>
                                    <th class="text-center py-3">Pertanyaan</th>
                                    <th class="text-center py-3">Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="border-start border-end">
                                @if ($pillarTwo)
                                    <tr>
                                        <td class="text-start py-3">1. Divisi Sosial Religi
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarTwo->pillar_two_question_two }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">2. Divisi Layanan Amal
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarTwo->pillar_two_question_three }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">3. Divisi Kemitraan</td>
                                        <td class="text-center py-3">
                                            {{ $pillarTwo->pillar_two_question_four }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">4. Divisi Administrasi &
                                            Keuangan</td>
                                        <td class="text-center py-3">
                                            {{ $pillarTwo->pillar_two_question_five }}
                                            Poin
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada
                                            penilaian</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Formulir 2 --}}
                <div class="mb-3">
                    <h5 class="card-title fw-semibold">Formulir Hubungan Manajemen Perusahaan dengan DKM dan
                        Jamaah</h5>

                    <div class="mt-3">
                        @foreach ($committees as $committee)
                            <h6 class="card-subtitle mb-1">{{ $committee->name }}</h6>

                            <div class="{{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                @if (isset($historyAssessmentPillarOnes[$committee->id]))
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($historyAssessmentPillarOnes[$committee->id] as $position)
                                            <li class="list-group-item border-0 py-1">{{ $position }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 py-1">Tidak ada riwayat penilaian</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap align-middle mb-0">
                            <thead class="border-top border-start border-end table-info">
                                <tr>
                                    <th class="text-center py-3">Pertanyaan</th>
                                    <th class="text-center py-3">Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="border-start border-end">
                                @if ($pillarOne)
                                    <tr>
                                        <td class="text-start py-3">1. Koordinasi Manajemen
                                            dengan Pengurus DKM
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_one }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">2. Kegiatan Bersama
                                            antara
                                            DKM
                                            dengan Manajemen Perusahaan
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_two }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">3. Dokumen SK
                                            kepengurusan
                                            DKM
                                            dari manajemen</td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_three }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">4. Dokumen
                                            program
                                            kerja
                                            dan anggaran yang sudah disetujui oleh manajemen
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_four }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">5. Media Interaksi dan
                                            Komunikasi dengan Jamaah
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_five }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">6. Memiliki Grup
                                            WhatsApp
                                            Jamaah
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_six }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">7. Program Pembinaan
                                            Keagamaan
                                            Untuk Jamaah
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarOne->pillar_one_question_seven }}
                                            Poin
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada
                                            penilaian</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Formulir 3 --}}
                <div class="mb-3">
                    <h5 class="card-title fw-semibold">Formulir Program Sosial</h5>

                    <div class="mt-3">
                        @foreach ($committees as $committee)
                            <h6 class="card-subtitle mb-1">{{ $committee->name }}</h6>

                            <div class="{{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                @if (isset($historyAssessmentPillarThrees[$committee->id]))
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($historyAssessmentPillarThrees[$committee->id] as $position)
                                            <li class="list-group-item border-0 py-1">{{ $position }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 py-1">Tidak ada riwayat penilaian</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap align-middle mb-0">
                            <thead class="border-top border-start border-end table-secondary">
                                <tr>
                                    <th class="text-center py-3">Pertanyaan</th>
                                    <th class="text-center py-3">Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="border-start border-end">
                                @if ($pillarThree)
                                    <tr>
                                        <td class="text-start py-3">1. Bentuk Program Sosial
                                            yang Dikelola
                                            oleh
                                            DKM
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_one }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">2. Penerima Manfaat
                                            Program
                                            Sosial
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_two }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">3. Jumlah Penerima
                                            Manfaat</td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_three }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">4. Sumber Pembiayaan
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_four }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">5. Program Keberlanjutan
                                            (Sustainability)
                                            di
                                            DKM
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_five }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">6. Program yang terkait
                                            keberlanjutan
                                            (sustainability)
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarThree->pillar_three_question_six }}
                                            Poin
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada
                                            penilaian</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Formulir 4 --}}
                <div class="mb-3">
                    <h5 class="card-title fw-semibold">Formulir Administrasi dan Keuangan</h5>

                    <div class="mt-3">
                        @foreach ($committees as $committee)
                            <h6 class="card-subtitle mb-1">{{ $committee->name }}</h6>

                            <div class="{{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                @if (isset($historyAssessmentPillarFours[$committee->id]))
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($historyAssessmentPillarFours[$committee->id] as $position)
                                            <li class="list-group-item border-0 py-1">{{ $position }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 py-1">Tidak ada riwayat penilaian</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap align-middle mb-0">
                            <thead class="border-top border-start border-end table-warning">
                                <tr>
                                    <th class="text-center py-3">Pertanyaan</th>
                                    <th class="text-center py-3">Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="border-start border-end">
                                @if ($pillarFour)
                                    <tr>
                                        <td class="text-start py-3">1. Yayasan Amaliah
                                            Astra
                                            sudah
                                            membuat sistem keuangan masjid online, Apakah
                                            DKM
                                            sudah menggunakan sistem ini?
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFour->pillar_four_question_one }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">2. Laporan Keuangan
                                            Masjid/Musala
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFour->pillar_four_question_four }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">3. DKM memiliki
                                            pengurus
                                            masjid
                                            dibawah umur 30 tahun?</td>
                                        <td class="text-center py-3">
                                            {{ $pillarFour->pillar_four_question_two }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">4. Berapa persen jumlah
                                            pengurus masjid dibawah umur 30 tahun dari total
                                            pengurus DKM
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFour->pillar_four_question_three }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">5. Laporan Kegiatan
                                            dan
                                            keuangan Tahunan
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFour->pillar_four_question_five }}
                                            Poin
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada
                                            penilaian</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Formulir 5 --}}
                <div class="mb-0">
                    <h5 class="card-title fw-semibold">Formulir Peribadahan dan Infrastruktur</h5>

                    <div class="mt-3">
                        @foreach ($committees as $committee)
                            <h6 class="card-subtitle mb-1">{{ $committee->name }}</h6>

                            <div class="{{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                @if (isset($historyAssessmentPillarFives[$committee->id]))
                                    <ol class="list-group list-group-numbered">
                                        @foreach ($historyAssessmentPillarFives[$committee->id] as $position)
                                            <li class="list-group-item border-0 py-1">{{ $position }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 py-1">Tidak ada riwayat penilaian</li>
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap align-middle mb-0">
                            <thead class="border-top border-start border-end table-primary">
                                <tr>
                                    <th class="text-center py-3">Pertanyaan</th>
                                    <th class="text-center py-3">Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="border-start border-end">
                                @if ($pillarFive)
                                    <tr>
                                        <td class="text-start py-3">1. Pelaksanaan kegiatan
                                            shalat
                                            wajib
                                            5 waktu berjamaah yang dikelola oleh DKM
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFive->pillar_five_question_one }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">2. Ada kelompok
                                            ekstrakulikuler
                                            di bawah Masjid/Musala
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFive->pillar_five_question_two }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">3. Apakah ada petugas
                                            khusus
                                            yang rutin melakukan pekerjaan kebersihan</td>
                                        <td class="text-center py-3">
                                            {{ $pillarFive->pillar_five_question_three }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">4. Rutinitas kegiatan
                                            kebersihan Masjid/Musala
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFive->pillar_five_question_four }}
                                            Poin
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-start py-3">5. Monitoring pekerjaan
                                            kebersihan Masjid/Musala secara berkala
                                        </td>
                                        <td class="text-center py-3">
                                            {{ $pillarFive->pillar_five_question_five }}
                                            Poin
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-center py-3">Tidak ada
                                            penilaian</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Footer --}}
            @else
                <div class="alert alert-warning mb-0 fw-medium" role="alert">
                    Belum mendapatkan pembagian panitia
                </div>
            @endif
        </div>
    </div>

    {{-- Custom Javascript --}}
    @prepend('scripts')
        <script>
            document.getElementById('pageTitle').addEventListener('click', function() {
                window.location.href = "{{ route('pre_assessment.index') }}";
            });
        </script>
    @endprepend
</x-admin>
