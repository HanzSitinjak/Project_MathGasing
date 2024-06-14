@extends('layouts.main')

@section('content')
    @include('layouts.top-navbar')

    <div id="layoutSidenav">
        @include('layouts.side-navbar')

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA(0,0,0,0)">
                        <div class="item px-3">
                            <i class="fas fa-home pt-1"></i>&nbsp;Beranda
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $hari_ini = date('Y-m-d');
                        @endphp
                        <div class="d-flex justify-content-start mb-2 mt-1 text-secondary">
                            <h2 class="text-secondary">{{ hari_ini() . dateIndonesia($hari_ini) . ',' }}</h2> &nbsp; &nbsp;
                            <h2 class="text-secondary">
                                <div id="clock"> &nbsp;</div>
                            </h2>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-user fa-6x"></i>
                                        </div>
                                        <div class="col-md-6 pt-3">
                                            <h3>30 Siswa Terdaftar</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-user-shield fa-6x"></i>
                                        </div>
                                        <div class="col-md-6 pt-3">
                                            <h3>30 Admin Terdaftar</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-book-bookmark fa-6x"></i>
                                        </div>
                                        <div class="col-md-6 pt-3">
                                            <h3>30 Topik Materi</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Statistik Perkembangan Siswa
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Statistik Perkembangan Siswa
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-red">
                    <h5 class="modal-title" id="alertModalLabel">Perhatian!</h5>
                </div>
                <div class="modal-body">
                    <p>{{ session('modalMessage') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="modalRedirectButton">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    @if(Session::has('success'))
        <script type="text/javascript">
            swal({
                title: 'Berhasil',
                text: "{{ Session::get('success') }}",
                timer: 2000,
                icon: "success",
                type: 'success'
            }).then((value) => {
                //location.reload();
            }).catch(swal.noop);
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('alertModal'));
            myModal.show();

            document.getElementById('modalRedirectButton').addEventListener('click', function() {
                window.location.href = "{{ session('modalRedirect') }}";
            });
        });

        function updateClock() {
            var d = new Date();
            var currentHours = d.getHours();
            var currentMinutes = d.getMinutes();
            var currentSeconds = d.getSeconds();

            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

            var timeOfDay = (currentHours < 12) ? "AM" : "PM";
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            currentHours = (currentHours == 0) ? 12 : currentHours;

            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            document.getElementById("clock").firstChild.nodeValue = currentTimeString;
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>

    @php
        function dateIndonesia($date)
        {
            if ($date != '0000-00-00') {
                $date = explode('-', $date);

                $data = $date[2] . ' ' . bulan($date[1]) . ' ' . $date[0];
            } else {
                $data = 'Format tanggal salah';
            }

            return $data;
        }

        function bulan($bln)
        {
            $bulan = $bln;

            switch ($bulan) {
                case 1:
                    $bulan = "Januari";
                    break;
                case 2:
                    $bulan = "Februari";
                    break;
                case 3:
                    $bulan = "Maret";
                    break;
                case 4:
                    $bulan = "April";
                    break;
                case 5:
                    $bulan = "Mei";
                    break;
                case 6:
                    $bulan = "Juni";
                    break;
                case 7:
                    $bulan = "Juli";
                    break;
                case 8:
                    $bulan = "Agustus";
                    break;
                case 9:
                    $bulan = "September";
                    break;
                case 10:
                    $bulan = "Oktober";
                    break;
                case 11:
                    $bulan = "November";
                    break;
                case 12:
                    $bulan = "Desember";
                    break;
            }
            return $bulan;
        }

        function hari_ini()
        {
            $hari = date("D");

            switch ($hari) {
                case 'Sun':
                    $hari_ini = "Minggu";
                    break;

                case 'Mon':
                    $hari_ini = "Senin";
                    break;

                case 'Tue':
                    $hari_ini = "Selasa";
                    break;

                case 'Wed':
                    $hari_ini = "Rabu";
                    break;

                case 'Thu':
                    $hari_ini = "Kamis";
                    break;

                case 'Fri':
                    $hari_ini = "Jumat";
                    break;

                case 'Sat':
                    $hari_ini = "Sabtu";
                    break;

                default:
                    $hari_ini = "Tidak di ketahui";
                    break;
            }

            return $hari_ini . ', ';
        }
    @endphp
@endsection
