@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')

@include('layouts.formMateri.formAddMateri')

<div id="layoutSidenav">

    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi</a>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Materi</h2>

                <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddMateri">Tambah Materi</button>
                </div>

                <div class="card mb-4">

                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembuat Materi</th>
                                    <th>Judul Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['admin_name'] }}</td>
                                        <td>{{ $item['title'] }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('kelola-unit', ['id_materi' => $item['id_materi'], 'title' => $item['title']]) }}" class="btn btn-success">Buka</a> &nbsp;&nbsp;
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formEditMateri{{ $item['id_materi'] }}">Ubah</button> &nbsp;&nbsp;
                                                <form action="{{ route('destroy-materi', $item['id_materi']) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?')">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('layouts.formMateri.formEditMateri', ['item' => $item])
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

@endsection
