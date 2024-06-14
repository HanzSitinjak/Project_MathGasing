@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')

<div id="layoutSidenav">

    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">

                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/akun-siswa" style="text-decoration: none; color: inherit;">Kelola Akun Siswa</a>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Akun Siswa</h2>

                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email Pengguna</th>
                                    <th>Is_Accept</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('update-status-siswa', ['id' => $user['id_user']]) }}" id="status-form-{{ $index }}">
                                            @csrf
                                            @method('POST') 
                                            @if($user['is_active'] == 1)
                                                <input type="hidden" name="status" value="2">
                                            @else
                                                <input type="hidden" name="status" value="1">
                                            @endif
                                            <div class="custom-control custom-switch text-center pt-2">
                                                <input type="checkbox" class="custom-control-input" id="toggle-switch{{ $index }}" name="status_checkbox" @if($user['is_active'] == 1) checked @endif onchange="confirmUpdateStatus({{ $index }})">
                                                <label class="custom-control-label" for="toggle-switch{{ $index }}">On/Off</label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('detail-siswa', ['id' => $user['id_user']]) }}" class="btn btn-primary btn-sm">Detail</a>
                                        
                                        <button type="button" class="btn btn-warning btn-sm" onclick="createReport({{ $user['id_user'] }})">Buat Laporan</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Perubahan Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin mengubah status mahasiswa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Ya</button>
            </div>
        </div>
    </div>
</div>

<script>
    let formIndex;

    function confirmUpdateStatus(index) {
        formIndex = index;
        $('#confirmModal').modal('show');
    }

    document.getElementById('confirmButton').addEventListener('click', function () {
        document.getElementById('status-form-' + formIndex).submit();
    });

    $('#confirmModal').on('hidden.bs.modal', function () {
        document.getElementById('toggle-switch' + formIndex).checked = !document.getElementById('toggle-switch' + formIndex).checked;
    });

    function sendEmail(email) {
        var subject = 'Subject of your email';
        var body = 'Body of your email';

        var mailtoLink = 'mailto:' + email + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);

        window.location.href = mailtoLink;
    }

    function createReport(userId) {
        var url = '/create-report/' + userId;

        fetch(url, {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.status === 404) {
                return response.json().then(data => {
                    if (data.message === 'Data not found') {
                        alert('Siswa belum memiliki nilai');
                    }
                });
            } else {
                // Buka laporan PDF di tab baru atau jendela baru
                var win = window.open(url, '_blank');
                if (win) {
                    // Fokus pada jendela baru
                    win.focus();
                } else {
                    // Jika popup diblokir, beri tahu pengguna
                    alert('Harap izinkan pop-up untuk membuka laporan.');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

@endsection
