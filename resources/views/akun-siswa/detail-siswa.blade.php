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

                <h2 class="pb-3">Detail Data Siswa</h2>
                @if ($siswa)
                <div class="biodataPengguna">
                    <h5 class="pb-3">Biodata Pengguna</h5>
                    <ul>
                        <li>Nama              : {{ $siswa['name'] }}</li>
                        <li>Email             : {{ $siswa['email'] }}</li>
                        <li>Jenis Kelamin     : {{ $siswa['gender'] }}</li>
                        <li>Tanggal Bergabung : {{ \Carbon\Carbon::parse($siswa['created_at'])->format('d F Y') }}</li>
                    </ul>
                </div>
                @else
                <p>Data siswa tidak ditemukan.</p>
                @endif

                <div class="Lencana Siswa">
                    <h5 class="pb-3">Lencana Siswa</h5>
                    <div class="container-md flex-container badge-placement" style="width: 100%; padding: 10px;display: flex; flex-wrap: wrap;">                
                        @isset($lencanaPengguna)
                            @foreach ($lencanaPengguna as $lencana)
                                @php
                                    $responseBadge = Http::get("https://mathgasing.cloud/api/badges/{$lencana['id_bagde']}");
                                    if ($responseBadge->successful()) {
                                        $badge = $responseBadge->json()['data'] ?? null;
                                    } else {
                                        // Penanganan kesalahan jika permintaan ke API gagal
                                        $badge = null;
                                        // Anda dapat mencetak atau melakukan logging pesan kesalahan di sini
                                    }
                                @endphp
                                @if ($badge)
                                    <div class="card text-center mb-3 card-badge" style="width: 16rem; margin-right: 20px;height: 20rem">
                                        <div class="card-body">
                                            <img class="logo-img" style="margin-bottom:20px; height: 150px; width:150px;" src="{{ $badge['imageUrl'] }}" alt="Deskripsi Gambar">
                                            <h5 class="card-text description" style="margin-bottom:15px;">{{ $badge['title'] }}</h5>
                                            <p class="card-text description" style="margin-bottom:15px;">Topik:&nbsp;{{ $badge['explanation'] }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>Data lencana pengguna tidak ditemukan.</p>
                        @endisset
                    </div>
                </div>

                <div class="Pencapaian Siswa">
    <h5 class="pb-3">Pencapaian Siswa</h5>
    @isset($scorePengguna)
        @php
            // Mengelompokkan data berdasarkan id_materi
            $groupedScores = [];
            foreach ($scorePengguna as $item) {
                $groupedScores[$item['id_materi']][] = $item;
            }
        @endphp

        @foreach ($groupedScores as $id_materi => $scores)
            <h6 class="pb-2">Materi: {{ $scores[0]['materi_title'] }}</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Unit</th>
                        <th scope="col">Skor Pretest</th>
                        <th scope="col">Skor Posttest</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $score)
                        <tr>
                            <td>{{ $score['id_unit'] }}</td>
                            <td>{{ $score['score_pretest'] }}</td>
                            <td>{{ $score['score_posttest'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @else
        <p>Tidak ada data pencapaian yang tersedia.</p>
    @endisset
</div>

            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

@endsection
