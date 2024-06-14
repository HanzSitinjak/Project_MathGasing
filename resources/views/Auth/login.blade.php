<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <script>
        function showNotification(message, type) {
            var notification = document.getElementById('notification');
            notification.innerText = message;
            notification.style.display = 'block';
            notification.classList.add(type);
        }
    </script>
</head>
<body style="background-image: url('./images/BackgroundScreen.png'); background-size: 1200px 800px;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img class="logo-img" src="{{ asset('images/LoginIcon.png') }}" alt="Deskripsi Gambar">
                <div class="card-body">
                    <h1 style="text-align: center;margin-top:70px;margin-bottom:20px" class="form-header">Masuk</h1>
                    <!-- Notification area -->
                    <div id="notification" style="display: none;" class="alert {{ session('color') }}"></div>
                    <!-- Check for error message and display -->
                    @if(session('error'))
                        <script>
                            showNotification('{{ session('error') }}', '{{ session('color') }}');
                        </script>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="email">{{ __('Email') }}</label>
                            <input style="margin-bottom:20px" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:5px" for="password">{{ __('Password') }}</label>
                            <input style="margin-bottom:10px" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Tautan Lupa Password -->
                        <div class="form-group">
                            <a href="{{ route('validate.account') }}" style="font-size:0.85em;color:#1469B8; text-decoration:none;">Lupa password?</a>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary text-white">
                                {{ __('Login') }}
                            </button>
                            <p style="font-size:0.85em;color:#797979;margin-top:15px">Belum Punya akun admin?</p>
                            <a style="font-size:0.8em;color:#1469B8; text-decoration:none;margin-top:-13px" href="{{ route('register') }}">Daftar Disini</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/bootstrap.js') }}"></script>
@if(session('message'))
    <script>
        showNotification('{{ session('message') }}', '{{ session('error') ? 'alert-danger' : 'alert-success' }}');
    </script>
@endif

</body>
</html>
