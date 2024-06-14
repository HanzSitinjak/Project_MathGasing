@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')

@include('layouts.formUnit.formAddLevelBonus')

<div id="layoutSidenav">
    @include('layouts.side-navbar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgba">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi /</a>
                        <span>Kelola Unit</span>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Unit Level Bonus</h2>

                <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddLevelBonus">Tambah Unit Level Bonus</button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

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
                            @foreach($unitBonus as $index => $unit)
                                <tr id="unit-{{ $unit['id_unit_Bonus'] }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $unit['title'] }}</td>
                                    <td>{{ $unit['explanation'] }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('data-levelbonus', ['id_unit_Bonus' => $unit['id_unit_Bonus'],'id_materi' => $unit['id_materi']]) }}" class="btn btn-success">Buka</a> &nbsp;&nbsp;
                                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formEditUnitLevelBonus{{ $unit['id_unit_Bonus'] }}" data-id="{{ $unit['id_unit_Bonus'] }}">Ubah</a> &nbsp;&nbsp;
                                            <button class="btn btn-danger delete" data-unit-id="{{ $unit['id_unit_Bonus'] }}" data-id="{{ $unit['id_unit_Bonus'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">Hapus</button> &nbsp;&nbsp;
                                        </div>
                                    </td>
                                </tr>
                                @include('layouts.formUnit.formEditUnitLevelBonus', ['id_unit_Bonus' => $unit])
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
            <form id="deleteForm" method="POST" action="{{ route('unit.delete') }}">
                @csrf
                <input type="hidden" name="unit_id" id="unit_id">
                <input type="hidden" name="id_materi" value="{{ $id_materi }}">
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus unit ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const unitId = this.getAttribute('data-unit-id');
                document.getElementById('unit_id').value = unitId;
            });
        });
    });
</script>

@endsection
