<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pencapaian Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-style: italic;
        }
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
        .content {
            text-align: left;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Laporan Pencapaian Siswa GASING</h2>
            <p>Belajar matematika asik dan menyenangkan</p>
        </div>
        <hr>
        <div class="content">
            <p>Kami dengan senang hati menyampaikan laporan pencapaian siswa untuk periode ini. Laporan ini mencerminkan kemajuan belajar mereka dalam mata pelajaran matematika. Data yang disajikan adalah hasil dari berbagai evaluasi dan penilaian yang telah dilakukan.</p>
            <p>Laporan ini diharapkan dapat memberikan gambaran yang jelas mengenai perkembangan dan pencapaian setiap siswa dalam memahami konsep-konsep matematika. Kami berharap hasil ini dapat menjadi motivasi bagi siswa untuk terus meningkatkan prestasi akademis mereka di masa depan.</p>
            <p>Nama: {{ $user['name'] }}</p>
            <p>Email: {{ $user['email'] }}</p>
            <p>Gender: {{ $user['gender'] }}</p>
            <p>Status: {{ $user['is_active'] == '2' ? 'Inactive' : 'Active' }}</p>
            <p>Dibuat pada: {{ \Carbon\Carbon::parse($user['created_at'])->format('d-m-Y H:i') }}</p>
            <p>Diupdate pada: {{ \Carbon\Carbon::parse($user['updated_at'])->format('d-m-Y H:i') }}</p>
            
            @isset($scorePengguna)
                @php
                    // Mengelompokkan data berdasarkan id_materi
                    $groupedScores = [];
                    foreach ($scorePengguna as $item) {
                        $groupedScores[$item['id_materi']][] = $item;
                    }
                @endphp
                
                  <p><strong>Kesimpulan:</strong> Berikut adalah pencapaian siswa dalam belajar matematika berdasarkan data yang telah tercatat.</p>

                @foreach ($groupedScores as $id_materi => $scores)
                    <h3>Materi: {{ $scores[0]['materi_title'] }}</h3>
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
        <hr>
    </div>
</body>
</html>
