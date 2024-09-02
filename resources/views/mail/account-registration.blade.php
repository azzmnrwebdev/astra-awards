<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran Akun</title>
</head>

<body style="background-color: #ECEEF1; padding: 2rem 20px; font-family: Arial, sans-serif;">
    <h1
        style="width: 100%; display: block; margin-bottom: 2rem; color: #333333; text-transform: uppercase; text-align: center;">
        Awards Amaliah</h1>

    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden;">
        <div style="padding: 1.5rem 3rem; background-color: #fff;">
            <h1 style="font-size: 24px; color: #333333; text-align: center;">Pendaftaran Akun</h1>
            <p style="font-size: 16px; color: #333333; text-align: left;">Halo {{ $user->name }},</p>
            <p style="font-size: 16px; color: #333333; text-align: left;">Kami dengan senang hati memberitahukan Anda
                bahwa akun Anda telah berhasil dibuat di Awards Amaliah. Untuk menjaga keamanan akun Anda, kami meminta
                Anda untuk segera mengganti kata sandi dan melengkapi data akun Anda.
            </p>
            <p style="font-size: 16px; color: #333333; text-align: left;">
                Berikut adalah detail akun Anda:
            </p>
            <ul type="disc">
                <li style="font-size: 16px; color: #333333;">Name: <strong>{{ $user->name }}</strong></li>
                <li style="font-size: 16px; color: #333333;">Email: <strong>{{ $user->email }}</strong></li>
                <li style="font-size: 16px; color: #333333;">Peran:
                    <strong>
                        @if ($user->role === 'admin')
                            Panitia
                        @elseif ($user->role === 'jury')
                            Juri
                        @endif
                    </strong>
                </li>
            </ul>
            <p style="font-size: 16px; color: #333333; text-align: left;">Anda harus segera mengganti kata sandi dari
                penerimaan email ini.
            </p>
            <div style="text-align: center;">
                <a href="{{ route('resetPassword', ['token' => $user->remember_token]) }}"
                    style="display: inline-block; padding: 10px 20px; margin-top: 10px; background-color: #212529; color: white; text-decoration: none; border-radius: 5px;">Reset
                    Password</a>
            </div>
            <p style="font-size: 16px; color: #333333; margin-top: 20px; text-align: left;">Terima kasih atas
                perhatian Anda, dan selamat datang di Awards Amaliah
            </p>
            <p style="font-size: 16px; color: #333333; margin-top: 20px; text-align: left;">
                Salam hangat,<br>
                Awards Amaliah
            </p>
        </div>
    </div>
</body>

</html>
