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
                        <a href="//pencapaian-siswa" style="text-decoration: none; color: inherit;">Pencapaian Siswa</a>
                    </div>
                </div>

                <h2 class="pb-3">Pencapaian Siswa</h2>



                <div class="card mb-4">

                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Total Posttest</th>
                                    <th>Total Lencana</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach($dataLeaderboard as $index => $unit)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $unit['name'] }}</td>
                                    <td>{{ $unit['total_score_posttest'] }}</td>
                                    <td>{{ $unit['total_badges'] }}</td>
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

@endsection