<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/register.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image: url('./public/assets/BackgroundScreen.png'); background-size: 1200px 800px;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="margin-top:80px" class="card">
                <img class="logo-img" src="{{ asset('public/images/LoginIcon.svg') }}" alt="Deskripsi Gambar">
                <div class="card-body">
                    <div class=text style="text-align: center;">
                        <h1 style="text-align: center;margin-bottom:10px" class="form-header">Senang melihat anda disini!</h1>
                        <p style="font-size:0.85em;color:#797979;">Mari siapkan akun Anda hanya dalam<br>beberapa langkah.</p>
                    </div>
                    <form id="registerForm" method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="nama">{{ __('Nama') }}</label>
                            <input style="margin-bottom:20px"id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="email">{{ __('Email') }}</label>
                            <input style="margin-bottom:20px" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="kontak">{{ __('Kontak') }}</label>
                            <input style="margin-bottom:20px"id="kontak" type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" required autocomplete="new-kontak">
                            @error('kontak')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="password">{{ __('Password') }}</label>
                            <input style="margin-bottom:20px"id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <p style="font-size:0.85em;color:#797979;margin-top:15px">Daftar Sekarang</p>
                            <button type="submit" class="btn btn-primary text-white" style="background-color:#E6900F">
                                {{ __('Register') }}
                            </button>
                            <p style="font-size:0.85em;color:#797979;margin-top:15px">Sudah punya akun?</p>  
                            <button style="font-size:0.8em;color:#ff006e;margin-top:5px" class="btn btn-primary text-white">
                                <a href="{{ route('login') }}" style="text-decoration:none;color:inherit;">Masuk</a>
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Load Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
