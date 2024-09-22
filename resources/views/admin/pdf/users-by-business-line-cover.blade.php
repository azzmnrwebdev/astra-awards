<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Daftar Peserta Lini Bisnis, Yayasan & Koperasi, Head Office : {{ $businessLine->name }}</title>

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
            font-weight: 600;
            src: url('{{ public_path('fonts/Inter_18pt-SemiBold.ttf') }}') format('truetype');
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
            position: relative;
            font-family: "Inter", system-ui;
        }

        .svg-background {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: auto;
            z-index: -1;
        }
    </style>
</head>

<body>
    <div style="padding: 80px;">
        <h3 style="font-weight: 800; text-transform: uppercase;">Amaliah Astra Awards</h3>

        <h1
            style="font-weight: 800; text-transform: uppercase; margin-top: 4rem; margin-bottom: -18px; line-height: 30px;">
            <span style="display: block;">Laporan <span style="color: #f0c916;">Peserta</span></span>
            <span style="display: block;">Berdasarkan Lini Bisnis</span>
            <span style="display: block;">Yayasan & Koperasi</span>
            Head Office
        </h1>

        <h2 style="font-weight: 800; text-transform: uppercase;">2024</h2>

        <div style="height: 4px; border-radius: 10px; width: 428px; background-color: #f0c916;"></div>

        <div style="position: absolute; bottom: 230px; right: 80px; text-align: right; z-index: 2;">
            <a href="https://awards.amaliah.id/" style="font-size: 12px; font-weight: 600;">
                https://awards.amaliah.id/
            </a>
        </div>
    </div>

    @php
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#004ea2" fill-opacity="1"
                d="M0,96L40,122.7C80,149,160,203,240,208C320,213,400,171,480,138.7C560,107,640,85,720,64C800,43,880,21,960,64C1040,107,1120,213,1200,229.3C1280,245,1360,171,1400,133.3L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z" style="">
            </path>
        </svg>';
    @endphp

    <div class="svg-background">
        <img src="data:image/svg+xml;base64,{{ base64_encode($svg) }}" width="100%" />
    </div>
</body>

</html>
