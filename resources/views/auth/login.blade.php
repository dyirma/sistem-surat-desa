<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SURAJA - Desa Jangglengan</title>
    
    @php
        $pengaturan = \App\Models\Pengaturan::first();
        $favicon = ($pengaturan && $pengaturan->logo_path) ? asset($pengaturan->logo_path) : asset('assets/img/logo-suraja-warna.png');
    @endphp
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-suraja-warna.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        body {
            background-color: var(--bg-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        
        .login-container {
            background: #FFFFFF;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-color);
            margin: 0 0 5px 0;
        }

        .login-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin: 0 0 30px 0;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
        }
        
        .alert-error {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Menggunakan Logo SURAJA -->
        <img src="{{ asset('assets/img/logo-suraja-warna.png') }}" alt="Logo SURAJA" class="login-logo">
        
        <h1 class="login-title">Selamat Datang</h1>
        <p class="login-subtitle">Sistem Pelayanan Administrasi Desa</p>

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email..." value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi..." required>
            </div>
            
            <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: -5px; margin-bottom: 25px;">
                <input type="checkbox" id="remember" name="remember" style="width: 16px; height: 16px; accent-color: var(--primary-color); cursor: pointer;">
                <label for="remember" style="margin: 0; cursor: pointer; font-weight: 400; color: #6c757d;">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk ke Sistem</button>
        </form>
    </div>

</body>
</html>
