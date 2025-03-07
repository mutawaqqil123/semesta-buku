<!DOCTYPE html>
<html>
<head>
    <title>Pemberitahuan: Akun Premium Expired</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #d9534f;
        }
        a {
            color: #0275d8;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo, {{ $user->name }}</h2>
        <p>Akun premium Anda sudah expired. Silakan perbarui langganan Anda untuk terus menikmati fitur premium.</p>
        <p><a href="{{ route('subscribe.index') }}">Klik di sini untuk memperbarui langganan</a></p>
        <p>Terima kasih telah menggunakan layanan kami.</p>
    </div>
</body>
</html>
