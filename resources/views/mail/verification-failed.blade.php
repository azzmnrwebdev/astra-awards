<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Akun Gagal</title>
</head>

<body style="background-color: #ECEEF1; padding: 2rem 20px; font-family: Arial, sans-serif;">
    <h1
        style="width: 100%; display: block; margin-bottom: 2rem; color: #333333; text-transform: uppercase; text-align: center;">
        Awards Amaliah</h1>

    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden;">
        <div style="padding: 1.5rem 3rem; background-color: #fff;">
            <h1 style="font-size: 24px; color: #333333; text-align: center;">Verifikasi Akun Gagal</h1>
            <p style="font-size: 16px; color: #333333; text-align: left;">Halo {{ $user->name }},</p>
            <p style="font-size: 16px; color: #333333; text-align: left;">Kami dengan berat hati ingin menginformasikan
                bahwa verifikasi akun Anda sebagai DKM tidak berhasil. Berikut adalah alasan mengapa akun Anda ditolak:
            </p>
            <p style="font-size: 16px; color: #333333; text-align: left;">
                {{ $reason }}
            </p>
            <p style="font-size: 16px; color: #333333; text-align: left;">
                Anda masih memiliki kesempatan untuk membuat akun baru jika Anda ingin mencoba lagi.
            </p>
            <p style="font-size: 16px; color: #333333; margin-top: 20px; text-align: left;">Terima kasih atas perhatian
                Anda, dan kami tetap berharap Anda akan terus berpartisipasi dalam program kami.
            </p>
            <p style="font-size: 16px; color: #333333; margin-top: 20px; text-align: left;">
                Salam hangat,<br>
                Awards Amaliah
            </p>
        </div>
    </div>
</body>

</html>
