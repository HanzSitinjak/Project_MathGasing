@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')
@include('layouts.formDataMateri.formLevelBonus')

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
                        <span>Kelola Data Level Bonus</span>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Data Level Bonus</h2>

                @if(empty($levelbonus))
                    <div id="levelbonusData" class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddLevelBonus">Tambah Data Level Bonus</button>
                    </div>
                @else
                    <div id="levelbonusData">
                        <!-- Existing level bonus data here -->
                    </div>
                @endif

                <div class="card-body" style="padding:10px; border: 4px ridge #caf0f8; border-radius: 6px;">
                    @if(!empty($levelbonus))
                        <div class="alert alert-info" role="alert">Hanya dapat menampung satu data part level bonus</div>

                        @foreach($levelbonus as $itemlevelbonus)
                            <div class="row g-3">
                                <div class="col-sm-10">
                                    <h4>Merupakan Data Unit_LevelBonus&nbsp;{{$itemlevelbonus['id_level_bonus']}}</h4>
                                    <p>{{$itemlevelbonus['deskripsi']}}</p>
                                </div>
                                <div class="col-sm">
                                    <button type="button" class="btn btn-warning edit-levelbonus" data-id="{{ $itemlevelbonus['id_level_bonus'] }}" data-bs-toggle="modal" data-bs-target="#editLevelBonus{{ $itemlevelbonus['id_level_bonus'] }}">Ubah</button> &nbsp;&nbsp;
                                    <button type="button" class="btn btn-danger delete-levelbonus" data-id="{{ $itemlevelbonus['id_level_bonus'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalLevelbonus">Hapus</button> &nbsp;&nbsp;
                                    @include('layouts.formDataMateri.editLevelBonus', ['id_level_bonus' => $itemlevelbonus['id_level_bonus']])
                                </div>
                            </div>

                            <hr style="margin-top: 20px; margin-bottom: 20px; border-top: 6px solid #3a0ca3; border-radius:10px">

                            <h5 class="pb-3">Kelola Soal Level Bonus</h5>
                            <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formLevelBonusQuestion">Tambahkan Soal LevelBonus</button>
                                @include('layouts.formDataMateri.QuestionLevelBonus', ['id_level_bonus' => $itemlevelbonus['id_level_bonus']])
                            </div>
                        @endforeach

                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Soal</th>
                                            <th>Option A</th>
                                            <th>Option B</th>
                                            <th>Option C</th>
                                            <th>Option D</th>
                                            <th>Correct_Index</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($levelbonus as $itemlevelbonus)
                                            @if(isset($QuestionLevelBonus[$itemlevelbonus['id_level_bonus']]) && count($QuestionLevelBonus[$itemlevelbonus['id_level_bonus']]) > 0)
                                                @foreach($QuestionLevelBonus[$itemlevelbonus['id_level_bonus']] as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $item['question'] }}</td>
                                                        <td>{{ $item['option_1'] }}</td>
                                                        <td>{{ $item['option_2'] }}</td>
                                                        <td>{{ $item['option_3'] }}</td>
                                                        <td>{{ $item['option_4'] }}</td>
                                                        <td>{{ $item['correct_index'] }}</td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="btn btn-warning edit-question-levelbonus" data-id="{{ $item['id_question_level_bonus'] }}" data-bs-toggle="modal" data-bs-target="#editQuestionLevelbonus{{ $item['id_question_level_bonus'] }}">Edit Pertanyaan</button> &nbsp;&nbsp;
                                                                <button type="button" class="btn btn-danger delete-question-levelbonus" data-id="{{ $item['id_question_level_bonus'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalSoalLevelBonus">Hapus Pertanyaan</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('layouts.formDataMateri.editSoalLevelBonus', ['id_level_bonus' => $item['id_question_level_bonus']])
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada soal untuk ID Level Bonus: {{ $itemlevelbonus['id_level_bonus'] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            Data tidak ada/ Data Kosong
                        </div>
                    @endif
                </div>
                <br>
                <br>
            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

<!-- Modal Konfirmasi Hapus LevelBonus -->
<div class="modal fade" id="deleteConfirmModalLevelbonus" tabindex="-1" aria-labelledby="deleteConfirmModalLevelbonusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLevelbonusLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data level bonus terkait?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnLevelbonus">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Soal LevelBonus -->
<div class="modal fade" id="deleteConfirmModalSoalLevelBonus" tabindex="-1" aria-labelledby="deleteConfirmModalSoalLevelBonusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalSoalLevelBonusLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data Soal LevelBonus terkait?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnSoalLevelBonus">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
    // Hapus Level Bonus
    document.addEventListener('DOMContentLoaded', function() {
        let deleteIdLevelbonus;

        const deleteButtonsLevelbonus = document.querySelectorAll('.delete-levelbonus');
        deleteButtonsLevelbonus.forEach(button => {
            button.addEventListener('click', function() {
                deleteIdLevelbonus = this.getAttribute('data-id');
                const deleteModalLevelbonus = new bootstrap.Modal(document.getElementById('deleteConfirmModalLevelbonus'));
                deleteModalLevelbonus.show();
            });
        });

        document.getElementById('confirmDeleteBtnLevelbonus').addEventListener('click', function() {
            if (deleteIdLevelbonus) {
                var route = `https://mathgasing.cloud/api/levelbonus/${deleteIdLevelbonus}`;

                fetch(route, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(function(response) {
                    if (response.ok) {
                        alert('Data Levelbonus berhasil dihapus.');
                        window.location.reload();
                    } else {
                        response.json().then(data => {
                            alert('Gagal menghapus levelbonus: ' + (data.message || 'Unknown error'));
                        });
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    alert('Gagal menghapus levelbonus.');
                });
            }
        });
    });

    // Hapus Soal LevelBonus
    document.addEventListener('DOMContentLoaded', function() {
        let deleteSoalLevelBonus;

        const deleteButtonsSoalLevelBonus = document.querySelectorAll('.delete-question-levelbonus');
        deleteButtonsSoalLevelBonus.forEach(button => {
            button.addEventListener('click', function() {
                deleteSoalLevelBonus = this.getAttribute('data-id');
                const deleteModalSoalLevelBonus = new bootstrap.Modal(document.getElementById('deleteConfirmModalSoalLevelBonus'));
                deleteModalSoalLevelBonus.show();
            });
        });

        document.getElementById('confirmDeleteBtnSoalLevelBonus').addEventListener('click', function() {
            if (deleteSoalLevelBonus) {
                var route = `https://mathgasing.cloud/api/deleteQuestionLevelBonus/${deleteSoalLevelBonus}`;

                fetch(route, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(function(response) {
                    if (response.ok) {
                        alert('Data Soal LevelBonus berhasil dihapus.');
                        window.location.reload();
                    } else {
                        response.json().then(data => {
                            alert('Gagal menghapus Soal LevelBonus: ' + (data.message || 'Unknown error'));
                        });
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    alert('Gagal menghapus Soal LevelBonus.');
                });
            }
        });
    });
</script>

@endsection
