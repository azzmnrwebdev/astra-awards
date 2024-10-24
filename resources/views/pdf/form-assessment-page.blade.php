<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Formulir Penilaian</title>

    <style>
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url('{{ public_path('fonts/Inter_18pt-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            src: url('{{ public_path('fonts/Inter_18pt-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 800;
            src: url('{{ public_path('fonts/Inter_18pt-ExtraBold.ttf') }}') format('truetype');
        }

        body {
            font-family: "Inter", system-ui;
        }

        #table {
            width: 100%;
            border-collapse: collapse;
        }

        #table thead {
            color: #ffffff;
            background-color: #004ea2;
        }

        #table,
        #table thead tr th,
        #table tbody tr td {
            border: 1px solid black;
        }

        #table thead tr th,
        #table tbody tr td {
            padding-left: 8px;
            padding-right: 8px;
        }

        #table tr {
            page-break-inside: avoid;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <table style="width: 100%; table-layout: fixed;">
        <tbody>
            <tr>
                <td style="width: 69%; vertical-align: top; text-align: right; font-size: 12px; padding: 0;">LAMPIRAN
                </td>
                <td style="width: 1%; vertical-align: top;font-size: 12px; padding: 0;">:</td>
                <td style="width: 30%; vertical-align: top; text-transform: uppercase; padding: 0; font-size: 12px;">
                    Laporan Formulir Penilaian Pilar 1 Sampai Dengan Pilar 5 Dari Masjid/Musala {{ $user->mosque->name }}
                </td>
            </tr>
            <tr>
                <td style="width: 69%; vertical-align: top; text-align: right; font-size: 12px; padding: 0;">TANGGAL</td>
                <td style="width: 1%; vertical-align: top; font-size: 12px; padding: 0;">:</td>
                <td style="width: 30%; vertical-align: top; text-transform: uppercase; padding: 0; font-size: 12px;">
                    {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }}
                </td>
            </tr>
        </tbody>
    </table>

    <h3 style="font-weight: 800; text-align: center; line-height: 20px;">
        <span style="display: block;">Laporan Formulir Penilaian Pilar 1 Sampai Dengan Pilar 5</span>
        Dari MasjidMusala {{ $user->mosque->name }}
    </h3>

    <table id="table">
        <thead>
            <tr>
                <th style="text-align: center;">Pilar</th>
                <th style="text-align: center;">Nilai</th>
            </tr>
        </thead>

        <tbody>
            {{-- Pillar 2 --}}
            <tr>
                <td style="text-align: left;">Hubungan DKM dengan YAA (Bobot 25%)</td>
                <td style="text-align: right;">{{ $pillarTwoValue }}</td>
            </tr>

            {{-- Pillar 1 --}}
            <tr>
                <td style="text-align: left;">Hubungan Manajemen Perusahaan dengan DKM dan Jamaah (Bobot 25%)</td>
                <td style="text-align: right;">{{ $pillarOneValue }}</td>
            </tr>

            {{-- Pillar 3 --}}
            <tr>
                <td style="text-align: left;">Program Sosial (Bobot 20%)</td>
                <td style="text-align: right;">{{ $pillarThreeValue }}</td>
            </tr>

            {{-- Pillar 4 --}}
            <tr>
                <td style="text-align: left;">Administrasi dan Keuangan (Bobot 15%)</td>
                <td style="text-align: right;">{{ $pillarFourValue }}</td>
            </tr>

            {{-- Pillar 5 --}}
            <tr>
                <td style="text-align: left;">Peribadahan dan Infrastruktur (Bobot 15%)</td>
                <td style="text-align: right;">{{ $pillarFiveValue }}</td>
            </tr>

            <tr>
                <td style="text-align: center;"><strong>Total Nilai</strong></td>
                <td style="text-align: right;"><strong>{{ $totalValue }}</strong></td>
            </tr>

            <tr>
                <td style="text-align: center;"><strong>Rekap Nilai (Dikalikan Bobot)</strong></td>
                <td style="text-align: right;"><strong>{{ $valueSummary }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
