<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body style="background-color: #ECEEF1; padding: 2rem 20px; font-family: Arial, sans-serif;">
    <h1
        style="width: 100%; display: block; margin-bottom: 2rem; color: #333333; text-transform: uppercase; text-align: center;">
        Awards Amaliah</h1>

    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden;">
        <div style="padding: 1.5rem 3rem; background-color: #fff;">
            <h1 style="font-size: 24px; color: #333333; text-align: center;">Reset Password</h1>
            <p style="font-size: 16px; color: #333333; text-align: center;">Jika Anda kehilangan password atau ingin
                mengatur ulang password, gunakan tautan di bawah untuk memulai.</p>
            <div style="text-align: center;">
                <a href="{{ route('resetPassword', ['token' => $user->remember_token]) }}"
                    style="display: inline-block; padding: 10px 20px; margin-top: 10px; background-color: #212529; color: white; text-decoration: none; border-radius: 5px;">Reset
                    Password</a>
            </div>
            <p style="font-size: 16px; color: #333333; margin-top: 20px; text-align: center;">Jika Anda tidak meminta
                pengaturan ulang password, Anda dapat mengabaikan email ini dengan aman. Hanya orang yang memiliki akses
                ke email Anda yang
                dapat mengatur ulang password akun Anda.</p>
        </div>
    </div>
</body>

</html>
