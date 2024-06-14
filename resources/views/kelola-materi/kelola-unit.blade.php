@extends('layouts.main')

@section('content')
    @include('layouts.top-navbar')
    @include('layouts.formUnit.formAddUnit')

    <div id="layoutSidenav">
        @include('layouts.side-navbar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                        <div class="item px-3">
                            <i class="fas fa-home pt-1"></i>&nbsp;
                            <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                            <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi /</a>
                            <span>Kelola Unit</span>
                        </div>
                    </div>

                    <h2 class="pb-3">Kelola Unit</h2>
                    
                    <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                        <button style="margin-right:10px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddUnit" data-id-materi="{{ $id_materi }}">Tambah Unit</button>
                        <a href="{{ route('level-bonus.unit',['id_materi' => $id_materi]) }}" class="btn btn-secondary">Kelola Level Bonus</a>
                    </div>
                    

                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Unit</th>
                                        <th>Penjelasan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($units as $index => $unit)
                                    <tr id="unit-{{ $unit['id_unit'] }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $unit['title'] }}</td>
                                        <td>{{ $unit['explanation'] }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('data-materi', ['id_unit' => $unit['id_unit'],'id_materi' => $unit['id_materi']]) }}" class="btn btn-success">Buka</a> &nbsp;&nbsp;
                                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-id="{{ $unit['id_unit'] }}" data-bs-target="#formEditUnit{{ $unit['id_unit'] }}">Ubah</a> &nbsp;&nbsp;
                                                <button class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-unit-id="{{ $unit['id_unit'] }}" data-id="{{ $unit['id_unit'] }}">Hapus</button> &nbsp;&nbsp;
                                            </div>
                                        </td>
                                    </tr>
                                    @include('layouts.formUnit.formEditUnit', ['unit' => $unit])
                                    
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

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus unit ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let deleteId; 

        const deleteButtons = document.querySelectorAll('.delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.getAttribute('data-unit-id'); // Mengambil data-unit-id untuk id_unit yang akan dihapus
            });
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteId) {
                fetch(`https://mathgasing.cloud/api/deleteUnit/${deleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert('Unit berhasil dihapus');
                        location.reload(); 
                    } else {
                        return response.json().then(data => {
                            alert('Gagal menghapus unit: ' + (data.message || 'Unknown error'));
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        });
    });
    </script>
@endsection
