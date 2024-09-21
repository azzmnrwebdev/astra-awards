<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Daftar Peserta Lini Bisnis {{ $businessLine->name }}</title>

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
                    Laporan Peserta Yang Sudah Terdaftar Di Sistem Berdasarkan Lini Bisnis {{ $businessLine->name }}
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
        <span style="display: block;">Laporan Peserta Yang Sudah Terdaftar Di Sistem Berdasarkan</span>
        Lini Bisnis {{ $businessLine->name }}
    </h3>

    <table id="table">
        <thead>
            <tr>
                <th style="text-align: center;">Perusahaan</th>
                <th style="text-align: center;">Jumlah</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($businessLine->company as $item)
                <tr>
                    <td style="text-align: center;">{{ $item->name }}</td>
                    <td style="text-align: center;">{{ count($item->mosque) }}</td>
                </tr>
            @endforeach

            @php
                $totalMosques = $businessLine->company->sum(function ($company) {
                    return count($company->mosque);
                });
            @endphp

            <tr>
                <td style="text-align: center; font-weight: 700;">Total</td>
                <td style="text-align: center;"><strong>{{ $totalMosques }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table id="table" style="margin-top: 2rem;">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Logo</th>
                <th style="text-align: center;">Nama Peserta</th>
                <th style="text-align: center;">Nama Masjid/Musala</th>
                <th style="text-align: center;">Induk Perusahaan</th>
                <th style="text-align: center;">Perusahaan</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mosques as $item)
                @php
                    $imagePath = storage_path('app/public/' . $item->logo);
                    $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
                    $mimeType = mime_content_type($imagePath);
                @endphp

                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">
                        @if ($imageData)
                            <img src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Logo Masjid"
                                style="width: 100px;">
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $item->user->name }}</td>
                    <td style="text-align: center;">{{ $item->name }}</td>
                    <td style="text-align: center;">{{ $item->company->parentCompany->name }}</td>
                    <td style="text-align: center;">{{ $item->company->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
