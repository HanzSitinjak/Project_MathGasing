@extends('layouts.formBadge.lencana-main')

@section('content')

@include('layouts.top-navbar')

<div id="layoutSidenav">

    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4" data-id-materi="{{ $id }}">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi /</a>
                        <a href="/kelola-materi-bagian" style="text-decoration: none; color: inherit;">Penjumlahan</a>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Lencana</h2>

                <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddBadge">Tambah Lencana</button>
                </div>

                <div class="container-md flex-container badge-placement" style="width: 100%; padding: 10px;">
                    @if(count($badges) > 0)
                        @foreach ($badges as $badge)
                            <div class="card text-center mb-3 card-badge" style="width: 16rem; margin-right: 20px;">
                                <div class="card-body">
                                    <img class="logo-img" style="margin-bottom:20px; height: 150px; width:150px;" src="{{ $badge['imageUrl'] }}" alt="Deskripsi Gambar">
                                    <h5 class="card-text description" style="margin-bottom:15px;">{{ $badge['title'] }}</h5>
                                    <p class="card-text description" style="margin-bottom:15px;">Topik:&nbsp;{{ $badge['explanation'] }}</p>
                                    <div class="row">
                                        <div class="col-6 mx-auto">
                                            <button type="button" class="btn btn-success btn-edit btn-block" data-bs-toggle="modal" data-bs-target="#formEditBadge{{ $badge['id_bagde'] }}" data-badge-id="{{ $badge['id_bagde'] }}">Edit</button>
                                        </div>
                                        <div class="col-6 mx-auto">
                                            <button type="button" class="btn btn-danger btn-delete btn-block" data-bs-toggle="modal" data-bs-target="#deleteBadgeConfirm" data-badge-id="{{ $badge['id_bagde'] }}">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.formBadge.form-edit-badge', ['badgeId' => $badge['id_bagde']])
                        @endforeach
                    @else
                        <p>Tidak ada data lencana.</p>
                    @endif
                </div>
            </div>
            @include('layouts.formBadge.form-tambah-badge')
        </main>
        @include('layouts.footer')
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteBadgeConfirm" tabindex="-1" aria-labelledby="deleteBadgeConfirmLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBadgeConfirmLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus badge ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBadge">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var badgeIdToDelete = null;
        var idMateri = document.querySelector('.container-fluid').getAttribute('data-id-materi');

        document.querySelectorAll('.btn-delete').forEach(function (button) {
            button.addEventListener('click', function () {
                badgeIdToDelete = this.getAttribute('data-badge-id');
            });
        });

        document.getElementById('confirmDeleteBadge').addEventListener('click', function () {
            if (badgeIdToDelete) {
                fetch(`https://mathgasing.cloud/api/badges/${badgeIdToDelete}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = `/kelola-lencana/${idMateri}`;
                    } else {
                        alert('Gagal menghapus badge.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
</script>

@endsection
