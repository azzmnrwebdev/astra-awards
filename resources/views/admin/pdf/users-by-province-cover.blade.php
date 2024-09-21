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
            font-weight: 800;
            src: url('{{ public_path('fonts/Inter_18pt-ExtraBold.ttf') }}') format('truetype');
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #004ea2;
            font-family: "Inter", system-ui;
        }
    </style>
</head>

<body>
    <div style="padding: 80px;">
        <h3 style="font-weight: 800; text-transform: uppercase;">Yayasan Amaliah Astra</h3>

        <h1
            style="font-weight: 800; text-transform: uppercase; margin-top: 4rem; margin-bottom: -18px; line-height: 30px;">
            <span style="display: block;">Laporan <span style="color: #f0c916;">Peserta</span></span>
            Berdasarkan Provinsi
        </h1>

        <h2 style="font-weight: 800; text-transform: uppercase;">2024</h2>

        <div style="height: 4px; border-radius: 10px; width: 410px; background-color: #f0c916;"></div>
    </div>
</body>

</html>
