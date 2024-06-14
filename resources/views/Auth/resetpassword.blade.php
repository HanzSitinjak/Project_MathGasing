<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-image: url('{{ asset('images/BackgroundScreen.png') }}');
            background-size: 1200px 800px;
        }

        .container {
            margin-top: 5%;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            padding-top: 0px;
            padding-bottom: 20px;
        }

        .form-header {
            text-align: center;
            margin-top: 70px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body style="background-image: url('./images/BackgroundScreen.png'); background-size: 1200px 800px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="form-header">Reset Password</h1>

                        <!-- Notification area -->
                        <div id="notification" style="display: none;" class="alert {{ session('color') }}"></div>
                        @if(session('error'))
                            <script>
                                var notification = document.getElementById('notification');
                                notification.innerText = '{{ session('error') }}';
                                notification.style.display = 'block';
                                notification.classList.add('alert-danger');
                            </script>
                        @endif

                        <form method="POST" action="{{ route('password.reset') }}" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">Reset Password</button>
                            <div class="form-footer">
                                <a href="{{ route('login') }}" style="font-size: 0.8em; color: #1469B8; text-decoration: none;">Kembali ke laman Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
