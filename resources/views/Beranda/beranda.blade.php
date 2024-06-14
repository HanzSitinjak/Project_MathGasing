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
                        <i class="fas fa-home pt-1"></i>&nbsp;Beranda
                    </div>
                </div>

                <div class="row">
                    <?php $hari_ini = date('Y-m-d'); ?>
                    <div class="d-flex justify-content-start mb-2 mt-1 text-secondary">
                        <h2 class="text-secondary"><?= hari_ini() . dateIndonesia($hari_ini) . ',' ?></h2> &nbsp; &nbsp;
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
                                        <h3 id="totalSiswa">Loading...</h3>
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
                                        <h3 id="totalAdmin">Loading...</h3>
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
                                        <h3 id="totalTopik">Loading...</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                                                <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Statistik Perkembangan Siswa
                            </div>
                            <div class="card-body">
                                <canvas id="myAreaChart" width="100%" height="20"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('layouts.footer')
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

<!-- GET CURRENT DATE AND TIME INDONESIA -->

<?php
function dateIndonesia($date) {
    if ($date != '0000-00-00') {
        $date = explode('-', $date);
        $data = $date[2] . ' ' . bulan($date[1]) . ' ' . $date[0];
    } else {
        $data = 'Format tanggal salah';
    }
    return $data;
}

function bulan($bln) {
    $bulan = $bln;
    switch ($bulan) {
        case 1: $bulan = "Januari"; break;
        case 2: $bulan = "Februari"; break;
        case 3: $bulan = "Maret"; break;
        case 4: $bulan = "April"; break;
        case 5: $bulan = "Mei"; break;
        case 6: $bulan = "Juni"; break;
        case 7: $bulan = "Juli"; break;
        case 8: $bulan = "Agustus"; break;
        case 9: $bulan = "September"; break;
        case 10: $bulan = "Oktober"; break;
        case 11: $bulan = "November"; break;
        case 12: $bulan = "Desember"; break;
    }
    return $bulan;
}

function hari_ini() {
    $hari = date("D");
    switch ($hari) {
        case 'Sun': $hari_ini = "Minggu"; break;
        case 'Mon': $hari_ini = "Senin"; break;
        case 'Tue': $hari_ini = "Selasa"; break;
        case 'Wed': $hari_ini = "Rabu"; break;
        case 'Thu': $hari_ini = "Kamis"; break;
        case 'Fri': $hari_ini = "Jumat"; break;
        case 'Sat': $hari_ini = "Sabtu"; break;
        default: $hari_ini = "Tidak di ketahui"; break;
    }
    return $hari_ini . ', ';
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function fetchData(endpoint, elementId, entityName) {
            fetch(endpoint)
                .then(response => response.json())
                .then(data => {
                    const count = data[entityName].length;
                    document.getElementById(elementId).innerText = `${count} ${entityName.replace('dataManagers', 'Admin Terdaftar').replace('data', 'Topik Materi').replace('users', 'Siswa Terdaftar')}`;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        fetchData('https://mathgasing.cloud/api/getUsers', 'totalSiswa', 'users');
        fetchData('https://mathgasing.cloud/api/data-managers', 'totalAdmin', 'dataManagers');
        fetchData('https://mathgasing.cloud/api/getMateri', 'totalTopik', 'data');

        var d = new Date(<?php echo time() * 1000 ?>);
        function updateClock() {
            d.setTime(d.getTime() + 1000);
            var currentHours = d.getHours();
            var currentMinutes = d.getMinutes();
            var currentSeconds = d.getSeconds();
            currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
            currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
            var timeOfDay = (currentHours < 12) ? "am" : "pm";
            currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
            currentHours = (currentHours == 0) ? 12 : currentHours;
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;
            document.getElementById("clock").firstChild.nodeValue = currentTimeString;
        }
        window.onload = function() {
            updateClock();
            setInterval('updateClock()', 1000);
        }

        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Function to fetch data from both endpoints and update the chart
        function fetchDataAndUpdateChart() {
            // URLs for pre-test and post-test data
            const pretestUrl = 'https://mathgasing.cloud/api/averageScoresPretestByMateri';
            const posttestUrl = 'https://mathgasing.cloud/api/averageScoresPosttestByMateri';

            // Perform AJAX requests to both endpoints
            $.when(
                $.ajax({ url: pretestUrl, method: 'GET' }),
                $.ajax({ url: posttestUrl, method: 'GET' })
            ).done(function(pretestResponse, posttestResponse) {
                const pretestData = pretestResponse[0];
                const posttestData = posttestResponse[0];

                // Prepare data for the chart
                var labels = [];
                var pretestScores = [];
                var posttestScores = [];

                // Create a map for post-test scores
                var posttestMap = {};
                posttestData.forEach(function(item) {
                    posttestMap[item.title] = parseFloat(item.average_score);
                });

                // Iterate over pre-test data and prepare labels and scores
                pretestData.forEach(function(item) {
                    labels.push(item.title);
                    pretestScores.push(parseFloat(item.average_score));
                    posttestScores.push(posttestMap[item.title] || 0);
                });

                // Update chart data
                myLineChart.data.labels = labels;
                myLineChart.data.datasets[0].data = pretestScores;
                myLineChart.data.datasets[1].data = posttestScores;

                // Update chart
                myLineChart.update();
            }).fail(function(error) {
                console.error('Error fetching data:', error);
            });
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: "PRE-TEST",
                        lineTension: 0.3,
                        backgroundColor: "rgba(255, 99, 132, 0.2)", // Adjust color as needed
                        borderColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(255, 99, 132, 1)", // Adjust color as needed
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: [] // Will be updated after fetching data
                    },
                    {
                        label: "POST-TEST",
                        lineTension: 0.3,
                        backgroundColor: "rgba(54, 162, 235, 0.2)", // Adjust color as needed
                        borderColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(54, 162, 235, 1)", // Adjust color as needed
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: [] // Will be updated after fetching data
                    }
                ],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 100,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        // Fetch data and update chart on page load
        fetchDataAndUpdateChart();
    });
</script>

@endsection
