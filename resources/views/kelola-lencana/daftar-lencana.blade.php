@extends('layouts.formBadge.lencana-main')

@section('content')

@include('layouts.top-navbar')

<div id="layoutSidenav">

    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75);">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi /</a>
                        <a href="/kelola-materi-bagian" style="text-decoration: none; color: inherit;">Penjumlahan</a>
                    </div>
                </div>

                <h2 class="pb-3">Daftar Lencana Pengguna</h2>

                <div class="row">
                    @foreach ($materiData as $materi)
                        <div class="col-md-6 mb-4">
                            <div class="card" style="background-image: url('{{ $materi['imageCardAdmin'] }}'); background-size: cover; background-position: center; height: 200px;">
                                <div class="card-body d-flex flex-column bg-light bg-opacity-25">
                                    <div style="color: white;">
                                        <h3 class="card-title">{{ $materi['title'] }}</h3>
                                    </div>
                                    <div class="mt-auto d-flex justify-content-end">
                                    <a href="{{ route('kelola-lencana', ['id_materi' => $materi['id_materi']]) }}" class="btn btn-primary">Lihat Lencana</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

@endsection
