<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi User</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .card {
            position: relative;
            overflow: hidden;
            padding-top: 50px; /* Sesuaikan sesuai kebutuhan */
            padding-bottom: 50px; /* Sesuaikan sesuai kebutuhan */
            border-radius: 15px; /* Bentuk lingkaran */
        }

        .card-body {
            z-index: 1;
        }
    </style>
</head>
<body style="background-image: url('./images/BackgroundScreen.png'); background-size: 1200px 800px;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 style="text-align: center; margin-top: 50px; margin-bottom: 20px;" class="form-header">Validasi User</h1>
                    <!-- Notification area -->
                    <div id="notification" style="display: none;" class="alert"></div>

                    <form id="validationForm" method="POST" action="{{ route('validate.user') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Confirm Account</button>
                        <div class="form-group text-center">
                            <a href="{{ route('login') }}" style="font-size: 0.8em; color: #1469B8; text-decoration: none;">Saya Sudah mengingatnya!</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.js') }}"></script>

<script>
    document.getElementById('validationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('{{ route("validate.user") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.valid) {
                window.location.href = '{{ route("reset.password") }}';
            } else {
                showNotification('Email dengan Username tidak cocok!!', 'alert-danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

</body>
</html>
