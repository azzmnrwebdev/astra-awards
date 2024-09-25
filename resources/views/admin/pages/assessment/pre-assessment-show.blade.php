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
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    @foreach ($committees as $key => $item)
                        <div class="accordion-item {{ $loop->last ? 'mb-0' : 'mb-2' }} border-0 rounded">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-top" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapse{{ $key }}" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapse{{ $key }}">
                                    {{ $item->name }}
                                </button>
                            </h2>

                            <div id="panelsStayOpen-collapse{{ $key }}" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    @if (isset($assessments[$item->id]) && $assessments[$item->id]->isNotEmpty())
                                        @php
                                            $pillarOnes = [];
                                            $pillarTwos = [];
                                            $pillarThrees = [];
                                            $pillarFours = [];
                                            $pillarFives = [];

                                            foreach ($assessments[$item->id] as $assessment) {
                                                $position = $assessment->position;

                                                if (strpos($position, 'Hubungan DKM dengan YAA') !== false) {
                                                    $pillarTwos[] = $assessment;
                                                } elseif (
                                                    strpos(
                                                        $position,
                                                        'Hubungan Manajemen Perusahaan dengan DKM dan Jamaah',
                                                    ) !== false
                                                ) {
                                                    $pillarOnes[] = $assessment;
                                                } elseif (strpos($position, 'Program Sosial') !== false) {
                                                    $pillarThrees[] = $assessment;
                                                } elseif (strpos($position, 'Administrasi dan Keuangan') !== false) {
                                                    $pillarFours[] = $assessment;
                                                } elseif (
                                                    strpos($position, 'Peribadahan dan Infrastruktur') !== false
                                                ) {
                                                    $pillarFives[] = $assessment;
                                                }
                                            }
                                        @endphp

                                        {{-- Formulir 1 --}}
                                        <div class="mb-3">
                                            <h5 class="card-title">Formulir Hubungan DKM dengan YAA</h5>

                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="border-top border-start border-end table-success">
                                                        <tr>
                                                            <th class="text-center py-3">Pertanyaan</th>
                                                            <th class="text-center py-3">Nilai</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="border-start border-end">
                                                        @if (!empty($pillarTwos))
                                                            @foreach ($pillarTwos as $pillarTwo)
                                                                <tr>
                                                                    <td class="text-start py-3">1. Divisi Sosial Religi
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarTwo->committeeAssessment->pillar_two_question_two }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">2. Divisi Layanan Amal
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarTwo->committeeAssessment->pillar_two_question_three }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">3. Divisi Kemitraan</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarTwo->committeeAssessment->pillar_two_question_four }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">4. Divisi Administrasi &
                                                                        Keuangan</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarTwo->committeeAssessment->pillar_two_question_five }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="2" class="text-center py-3">Tidak ada
                                                                    penilaian</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (!empty($pillarTwos))
                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                                        <thead class="border-top border-start border-end table-success">
                                                            <tr>
                                                                <th class="text-center py-3">Riwayat Penilaian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="border-start border-end">
                                                            @foreach ($pillarTwos as $pillarTwo)
                                                                <tr>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarTwo->position }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Formulir 2 --}}
                                        <div class="mb-3">
                                            <h5 class="card-title">Formulir Hubungan Manajemen Perusahaan dengan DKM dan
                                                Jamaah</h5>

                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="border-top border-start border-end table-info">
                                                        <tr>
                                                            <th class="text-center py-3">Pertanyaan</th>
                                                            <th class="text-center py-3">Nilai</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="border-start border-end">
                                                        @if (!empty($pillarOnes))
                                                            @foreach ($pillarOnes as $pillarOne)
                                                                <tr>
                                                                    <td class="text-start py-3">1. Koordinasi Manajemen
                                                                        dengan Pengurus DKM
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_one }}
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
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_two }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">3. Dokumen SK
                                                                        kepengurusan
                                                                        DKM
                                                                        dari manajemen</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_three }}
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
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_four }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">5. Media Interaksi dan
                                                                        Komunikasi dengan Jamaah
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_five }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">6. Memiliki Grup
                                                                        WhatsApp
                                                                        Jamaah
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_six }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">7. Program Pembinaan
                                                                        Keagamaan
                                                                        Untuk Jamaah
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->committeeAssessment->pillar_one_question_seven }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="2" class="text-center py-3">Tidak ada
                                                                    penilaian</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (!empty($pillarOnes))
                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                                        <thead class="border-top border-start border-end table-info">
                                                            <tr>
                                                                <th class="text-center py-3">Riwayat Penilaian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="border-start border-end">
                                                            @foreach ($pillarOnes as $pillarOne)
                                                                <tr>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarOne->position }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Formulir 3 --}}
                                        <div class="mb-3">
                                            <h5 class="card-title">Formulir Program Sosial</h5>

                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="border-top border-start border-end table-secondary">
                                                        <tr>
                                                            <th class="text-center py-3">Pertanyaan</th>
                                                            <th class="text-center py-3">Nilai</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="border-start border-end">
                                                        @if (!empty($pillarThrees))
                                                            @foreach ($pillarThrees as $pillarThree)
                                                                <tr>
                                                                    <td class="text-start py-3">1. Bentuk Program Sosial
                                                                        yang Dikelola
                                                                        oleh
                                                                        DKM
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_one }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">2. Penerima Manfaat
                                                                        Program
                                                                        Sosial
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_two }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">3. Jumlah Penerima
                                                                        Manfaat</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_three }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">4. Sumber Pembiayaan
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_four }}
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
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_five }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">6. Program yang terkait
                                                                        keberlanjutan
                                                                        (sustainability)
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->committeeAssessment->pillar_three_question_six }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="2" class="text-center py-3">Tidak ada
                                                                    penilaian</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (!empty($pillarThrees))
                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                                        <thead
                                                            class="border-top border-start border-end table-secondary">
                                                            <tr>
                                                                <th class="text-center py-3">Riwayat Penilaian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="border-start border-end">
                                                            @foreach ($pillarThrees as $pillarThree)
                                                                <tr>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarThree->position }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Formulir 4 --}}
                                        <div class="mb-3">
                                            <h5 class="card-title">Formulir Administrasi dan Keuangan</h5>

                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="border-top border-start border-end table-warning">
                                                        <tr>
                                                            <th class="text-center py-3">Pertanyaan</th>
                                                            <th class="text-center py-3">Nilai</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="border-start border-end">
                                                        @if (!empty($pillarFours))
                                                            @foreach ($pillarFours as $pillarFour)
                                                                <tr>
                                                                    <td class="text-start py-3">1. Yayasan Amaliah
                                                                        Astra
                                                                        sudah
                                                                        membuat sistem keuangan masjid online, Apakah
                                                                        DKM
                                                                        sudah menggunakan sistem ini?
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->committeeAssessment->pillar_four_question_one }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">2. Laporan Keuangan
                                                                        Masjid/Musala
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->committeeAssessment->pillar_four_question_four }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">3. DKM memiliki
                                                                        pengurus
                                                                        masjid
                                                                        dibawah umur 30 tahun?</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->committeeAssessment->pillar_four_question_two }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">4. Berapa persen jumlah
                                                                        pengurus masjid dibawah umur 30 tahun dari total
                                                                        pengurus DKM
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->committeeAssessment->pillar_four_question_three }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">5. Laporan Kegiatan
                                                                        dan
                                                                        keuangan Tahunan
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->committeeAssessment->pillar_four_question_five }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="2" class="text-center py-3">Tidak ada
                                                                    penilaian</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (!empty($pillarFours))
                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                                        <thead
                                                            class="border-top border-start border-end table-warning">
                                                            <tr>
                                                                <th class="text-center py-3">Riwayat Penilaian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="border-start border-end">
                                                            @foreach ($pillarFours as $pillarFour)
                                                                <tr>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFour->position }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Formulir 5 --}}
                                        <div class="mb-0">
                                            <h5 class="card-title">Formulir Peribadahan dan Infrastruktur</h5>

                                            <div class="table-responsive mt-3">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="border-top border-start border-end table-primary">
                                                        <tr>
                                                            <th class="text-center py-3">Pertanyaan</th>
                                                            <th class="text-center py-3">Nilai</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody class="border-start border-end">
                                                        @if (!empty($pillarFives))
                                                            @foreach ($pillarFives as $pillarFive)
                                                                <tr>
                                                                    <td class="text-start py-3">1. Pelaksanaan kegiatan
                                                                        shalat
                                                                        wajib
                                                                        5 waktu berjamaah yang dikelola oleh DKM
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->committeeAssessment->pillar_five_question_one }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">2. Ada kelompok
                                                                        ekstrakulikuler
                                                                        di bawah Masjid/Musala
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->committeeAssessment->pillar_five_question_two }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">3. Apakah ada petugas
                                                                        khusus
                                                                        yang rutin melakukan pekerjaan kebersihan</td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->committeeAssessment->pillar_five_question_three }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">4. Rutinitas kegiatan
                                                                        kebersihan Masjid/Musala
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->committeeAssessment->pillar_five_question_four }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start py-3">5. Monitoring pekerjaan
                                                                        kebersihan Masjid/Musala secara berkala
                                                                    </td>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->committeeAssessment->pillar_five_question_five }}
                                                                        Poin
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="2" class="text-center py-3">Tidak ada
                                                                    penilaian</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (!empty($pillarFives))
                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover text-nowrap align-middle mb-0">
                                                        <thead
                                                            class="border-top border-start border-end table-primary">
                                                            <tr>
                                                                <th class="text-center py-3">Riwayat Penilaian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="border-start border-end">
                                                            @foreach ($pillarFives as $pillarFive)
                                                                <tr>
                                                                    <td class="text-center py-3">
                                                                        {{ $pillarFive->position }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <p class="card-text">Tidak ada kegiatan penilaian untuk panitia ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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
