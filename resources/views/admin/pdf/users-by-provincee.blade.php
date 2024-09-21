<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Daftar Peserta Provinsi {{ $province->name }}</title>

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
            font-weight: 500;
            src: url('{{ public_path('fonts/Inter_18pt-Medium.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 700;
            src: url('{{ public_path('fonts/Inter_18pt-Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: "Inter", system-ui;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            color: #f8fafc;
            background-color: #004ea2;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        tr {
            page-break-inside: avoid;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h1 style="font-weight: 700; text-align: center; margin-bottom: -16px;">
        AMALIAH ASTRA AWARDS 2024
    </h1>

    <h2 style="font-weight: 500; text-align: center; margin-bottom: 0;line-height: 20px;">
        <span style="display: block;">Laporan Peserta Terdaftar Berdasarkan Provinsi</span>
        {{ $province->name }}
    </h2>

    <hr />

    <div>
        <p>Berikut daftar nama kota dan peserta: </p>

        <ol>
            @foreach ($province->city as $item)
                <li>{{ $item->name }} ({{ count($item->mosque) }})</li>
            @endforeach
        </ol>

        <table style="margin-top: 2rem;">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama Peserta</th>
                    <th style="text-align: center;">Perusahaan</th>
                    <th style="text-align: center;">Nama Masjid/Musala</th>
                    <th style="text-align: center;">Kota/Kabupaten</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($mosques as $item)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">{{ $item->user->name }}</td>
                        <td style="text-align: center;">{{ $item->company->name }}</td>
                        <td style="text-align: center;">{{ $item->name }}</td>
                        <td style="text-align: center;">{{ $item->city->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
