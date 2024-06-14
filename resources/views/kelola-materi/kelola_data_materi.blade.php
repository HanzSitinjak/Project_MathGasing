@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')
@include('layouts.formDataMateri.formAddPosttest')
@include('layouts.formDataMateri.formAddPretest')
@include('layouts.formDataMateri.formAddVideo')

<div id="layoutSidenav">

    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/kelola-materi" style="text-decoration: none; color: inherit;">Kelola Materi /</a>
                        <span>Kelola Data posttest</span>
                    </div>
                </div>

                <div class="card-body" style="padding:10px; border: 4px ridge #caf0f8; border-radius: 6px;">
                    <div class="alert alert-danger" role="alert">
                        Harap Dibaca !!
                    </div>
                    <p>Pastikan Anda sudah mengisi semua datanya, karena jika tidak maka secara otomatis sistem menghapus data materi yang sudah anda buat sebelumnya.<br><br>Apa anda sudah mengisi datanya dengan baik?</p>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-warning" id="lanjutkanButton">Lanjutkan</a> &nbsp;&nbsp;
                        <a data-id="{{$id_unit}}" class="btn btn-danger delete" href="#">Batalkan Proses</a>
                    </div>
                </div>
                <br>

                <h2 class="pb-3">Kelola Data Pretest</h2>

@if(empty($pretest))
    <div id="pretestData" class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddPretest">Tambah Data Pretest</button>
    </div>
@else
    <div id="pretestData">
        <!-- Existing pretest data here -->
    </div>
@endif

<div class="card-body" style="padding:10px; border: 4px ridge #caf0f8; border-radius: 6px;">
    @if(!empty($pretest))
        <div class="alert alert-info" role="alert">Hanya dapat menampung satu data pretest</div>

        @foreach($pretest as $itempretest)
            <div class="row g-3">
                <div class="col-sm-10">
                    <h4>Merupakan Data Unit&nbsp;{{$itempretest['id_unit']}}</h4>
                    <p>{{$itempretest['deskripsi']}}</p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-warning edit-pretest" data-id="{{ $itempretest['id_pretest'] }}" data-bs-toggle="modal" data-bs-target="#editPretest{{ $itempretest['id_pretest'] }}">Ubah</button> &nbsp;&nbsp;
                    <button type="button" class="btn btn-danger delete-pretest" data-id="{{ $itempretest['id_pretest'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalPretest">Hapus</button> &nbsp;&nbsp;
                    @include('layouts.formDataMateri.editPretest', ['id_pretest' => $itempretest['id_pretest']])
                </div>
            </div>

            <hr style="margin-top: 20px; margin-bottom: 20px; border-top: 6px solid #3a0ca3; border-radius:10px">

            <h5 class="pb-3">Kelola Soal Pretest</h5>
            <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formPretestQuestion">Tambahkan Soal Pretest</button>
                @include('layouts.formDataMateri.QuestionPretest', ['id_pretest' => $itempretest['id_pretest']])
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
                        @foreach($pretest as $itempretest)
                            @if(isset($QuestionPretest[$itempretest['id_pretest']]) && count($QuestionPretest[$itempretest['id_pretest']]) > 0)
                                @foreach($QuestionPretest[$itempretest['id_pretest']] as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['question'] }}</td>
                                        <td>{{ $item['pretest_option_1'] }}</td>
                                        <td>{{ $item['pretest_option_2'] }}</td>
                                        <td>{{ $item['pretest_option_3'] }}</td>
                                        <td>{{ $item['pretest_option_4'] }}</td>
                                        <td>{{ $item['pretest_correct_index'] }}</td>
                                        <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-warning edit-question-pretest" data-id="{{ $item['id_question_pretest'] }}" data-bs-toggle="modal" data-bs-target="#editQuestionPretest{{ $item['id_question_pretest'] }}">Edit Pertanyaan</button> &nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger delete-question-pretest" data-id="{{ $item['id_question_pretest'] }}">Hapus Pertanyaan</button>
                                        </div>
                                        </td>
                                    </tr>
                                @include('layouts.formDataMateri.editSoalPretest', ['id_pretest' => $item['id_question_pretest']])
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada soal pretest untuk ID Pretest: {{ $itempretest['id_pretest'] }}</td>
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

                <h2 class="pb-3">Kelola Data Video Pembelajaran</h2>
                @if(empty($video))
                    <div id="videoData" class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddVideo">Tambahkan Materi Pembelajaran</button>
                    </div>
                @else
                    <div id="videoData">
                        <!-- Existing video data here -->
                    </div>
                @endif

                <div class="card-body" style="padding:10px; border: 4px ridge #caf0f8; border-radius: 6px;">
                    @if(!empty($video))
                        <div class="alert alert-info" role="alert">Hanya dapat menampung satu data Materi Pembelajaran</div>
                        @foreach($video as $index => $itemVideo)
                        <div class="row g-3">
                            <div class="col-sm-7.5">
                                <h5>Merupakan Data Unit&nbsp;{{$itemVideo['id_unit']}}</h5>
                                <p>Link Video :</p>
                                <p style="color: blue">{{$itemVideo['video_Url']}}</p>
                                <p>{{$itemVideo['title']}}</p>
                                <p>{{$itemVideo['explanation']}}</p>
                            </div>
                            <div class="col-sm">
                                <a href="#" class="btn btn-warning" data-id="{{ $itemVideo['id_material_video'] }}" data-bs-toggle="modal" data-bs-target="#editVideo{{ $itemVideo['id_material_video'] }}">Ubah</a> &nbsp;&nbsp;
                                <button type="button" class="btn btn-danger delete-MaterialVideo" data-id="{{ $itemVideo['id_material_video'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalVideoMaterial">Hapus</button> &nbsp;&nbsp;
                                @include('layouts.formDataMateri.editVideoMaterial',['id_material_video' => $itemVideo['id_material_video']])
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning" role="alert">
                            Data tidak ada/ Data Kosong
                        </div>
                    @endif

                </div>
                <br>
                <br>

                <h2 class="pb-3">Kelola Data Posttest</h2>

@if(empty($posttest))
    <div id="posttestData" class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formAddPosttest">Tambah Data posttest</button>
    </div>
@else
    <div id="posttestData">
        <!-- Existing posttest data here -->
    </div>
@endif

<div class="card-body" style="padding:10px; border: 4px ridge #caf0f8; border-radius: 6px;">
    @if(!empty($posttest))
        <div class="alert alert-info" role="alert">Hanya dapat menampung satu data posttest</div>

        @foreach($posttest as $itemposttest)
            <div class="row g-3">
                <div class="col-sm-10">
                    <h4>Merupakan Data Unit&nbsp;{{$itemposttest['id_unit']}}</h4>
                    <p>{{$itemposttest['deskripsi']}}</p>
                </div>
                <div class="col-sm">
                    <button type="button" class="btn btn-warning edit-posttest" data-id="{{ $itemposttest['id_posttest'] }}" data-bs-toggle="modal" data-bs-target="#editPosttest{{ $itemposttest['id_posttest'] }}">Ubah</button> &nbsp;&nbsp;
                    <button type="button" class="btn btn-danger delete-posttests" data-id="{{ $itemposttest['id_posttest'] }}" data-bs-toggle="modal" data-bs-target="#deleteConfirmModalPosttests">Hapus</button> &nbsp;&nbsp;
                    @include('layouts.formDataMateri.editPosttest',['id_posttest' => $itemposttest['id_posttest']])
                </div>
            </div>

            <hr style="margin-top: 20px; margin-bottom: 20px; border-top: 6px solid #3a0ca3; border-radius:10px">

            <h5 class="pb-3">Kelola Soal posttest</h5>
            <div class="d-flex mb-3 mt-2 fw-bold mx-1 mb-3 mt-1 justify-content-start">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formPosttestQuestion">Tambahkan Soal posttest</button>
                @include('layouts.formDataMateri.QuestionPosttest', ['id_posttest' => $itemposttest['id_posttest']])
            </div>
        @endforeach

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple2" class="table">
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
                        @foreach($posttest as $itemposttest)
                            @if(isset($QuestionPosttest[$itemposttest['id_posttest']]) && count($QuestionPosttest[$itemposttest['id_posttest']]) > 0)
                                @foreach($QuestionPosttest[$itemposttest['id_posttest']] as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item['question'] }}</td>
                                        <td>{{ $item['posttest_option_1'] }}</td>
                                        <td>{{ $item['posttest_option_2'] }}</td>
                                        <td>{{ $item['posttest_option_3'] }}</td>
                                        <td>{{ $item['posttest_option_4'] }}</td>
                                        <td>{{ $item['posttest_correct_index'] }}</td>
                                        <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-warning edit-question-posttest" data-id="{{ $item['id_question_posttest'] }}" data-bs-toggle="modal" data-bs-target="#editQuestionPosttest{{ $item['id_question_posttest'] }}">Edit Pertanyaan</button> &nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger delete-question-posttest" data-id="{{ $item['id_question_posttest'] }}">Hapus Pertanyaan</button>
                                        </div>
                                        </td>
                                    </tr>
                                @include('layouts.formDataMateri.editSoalPosttest', ['id_posttest' => $item['id_question_posttest']])
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada soal posttest untuk ID posttest: {{ $itemposttest['id_posttest'] }}</td>
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

            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalLabel">Data Tidak Lengkap</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data Anda belum lengkap. Apa yang ingin Anda lakukan?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Lanjutkan Pengisian</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal kelola pretest -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus soal pretest terkait?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal kelola posttest -->
<div class="modal fade" id="deleteConfirmModalPosttest" tabindex="-1" aria-labelledby="deleteConfirmModalPosttestLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalPosttestLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus soal posttest terkait?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnPosttest">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus Pretest-->
<div class="modal fade" id="deleteConfirmModalPretest" tabindex="-1" aria-labelledby="deleteConfirmModalPretestLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalPretestLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pretest terkait?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnPretest">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Posttest-->
<div class="modal fade" id="deleteConfirmModalPosttests" tabindex="-1" aria-labelledby="deleteConfirmModalPosttestsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalPosttestsLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data posttest terkait?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnPosttests">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Video Material-->
<div class="modal fade" id="deleteConfirmModalVideoMaterial" tabindex="-1" aria-labelledby="deleteConfirmModalVideoMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalVideoMaterialLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data MaterialVideo terkait?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtnVideoMaterial">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var posttestData = @json($posttest);
        var posttestData = @json($posttest);
        var videoData = @json($video);

        document.querySelectorAll('.delete').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                var id_unit = this.getAttribute('data-id');
                var id_materi = getUrlParameter('id_materi');
                var route = "https://mathgasing.cloud/api/deleteUnit/" + id_unit;

                if (confirm('Apakah Anda yakin ingin menghapus unit?')) {
                    fetch(route, {
                        method: 'DELETE'
                    }).then(function (response) {
                        if (response.ok) {
                            alert('Unit berhasil dihapus.');
                            window.location.href = '/kelola-unit/' + id_materi;
                        } else {
                            alert('Gagal menghapus unit.');
                        }
                    }).catch(function (error) {
                        console.error('Error:', error);
                        alert('Gagal menghapus unit.');
                    });
                }
            });
        });

        document.getElementById('lanjutkanButton').addEventListener('click', function (event) {
            event.preventDefault();

            // Periksa apakah data posttest, posttest, dan video sudah ada
            if (posttestData.length > 0 && posttestData.length > 0 && videoData.length > 0) {
                var id_materi = getUrlParameter('id_materi');
                window.location.href = '/kelola-unit/' + id_materi;
            } else {
                var validationModal = new bootstrap.Modal(document.getElementById('validationModal'), {});
                validationModal.show();
            }
        });

        document.getElementById('cancelProcessButton').addEventListener('click', function () {
            var id_unit = document.querySelector('.delete').getAttribute('data-id');
            var id_materi = getUrlParameter('id_materi');
            var route = "https://mathgasing.cloud/api/deleteUnit/" + id_unit;

            fetch(route, {
                method: 'DELETE'
            }).then(function (response) {
                if (response.ok) {
                    alert('Unit berhasil dihapus.');
                    window.location.href = '/kelola-unit/' + id_materi;
                } else {
                    alert('Gagal menghapus unit.');
                }
            }).catch(function (error) {
                console.error('Error:', error);
                alert('Gagal menghapus unit.');
            });
        });
    });

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    //kelola pertanyaan pretest
    document.addEventListener('DOMContentLoaded', function() {
    let deleteId; 

    const deleteButtons = document.querySelectorAll('.delete-question-pretest');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            deleteId = this.getAttribute('data-id');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
        });
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteId) {
            var route = `https://mathgasing.cloud/api/deleteQuestionPretest/${deleteId}`;

            fetch(route, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                if (response.ok) {
                    alert('Soal Pretest berhasil dihapus.');
                    window.location.reload();
                } else {
                    alert('Soal Posttest berhasil dihapus.');
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('Gagal menghapus soal posttest.');
            });
        }
    });
});

//kelola pertanyaan posttest
document.addEventListener('DOMContentLoaded', function() {
    let deleteIdPosttest; 

    const deleteButtonsPosttest = document.querySelectorAll('.delete-question-posttest');
    deleteButtonsPosttest.forEach(button => {
        button.addEventListener('click', function() {
            deleteIdPosttest = this.getAttribute('data-id');
            const deleteModalPosttest = new bootstrap.Modal(document.getElementById('deleteConfirmModalPosttest'));
            deleteModalPosttest.show();
        });
    });

    document.getElementById('confirmDeleteBtnPosttest').addEventListener('click', function() {
        if (deleteIdPosttest) {
            var route = `https://mathgasing.cloud/api/deleteQuestionPosttest/${deleteIdPosttest}`;

            fetch(route, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                if (response.ok) {
                    alert('Soal Posttest berhasil dihapus.');
                    window.location.reload();
                } else {
                    response.json().then(data => {
                        alert('Gagal menghapus soal posttest: ' + (data.message || 'Unknown error'));
                    });
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('Gagal menghapus soal posttest.');
            });
        }
    });
});

//Hapus Pretest
document.addEventListener('DOMContentLoaded', function() {
    let deleteIdPretest; 

    const deleteButtonsPretest = document.querySelectorAll('.delete-pretest');
    deleteButtonsPretest.forEach(button => {
        button.addEventListener('click', function() {
            deleteIdPretest = this.getAttribute('data-id');
            const deleteModalPretest = new bootstrap.Modal(document.getElementById('deleteConfirmModalPretest'));
            deleteModalPretest.show();
        });
    });

    document.getElementById('confirmDeleteBtnPretest').addEventListener('click', function() {
        if (deleteIdPretest) {
            var route = `https://mathgasing.cloud/api/deletePretest/${deleteIdPretest}`;

            fetch(route, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                if (response.ok) {
                    alert('Data Pretest berhasil dihapus.');
                    window.location.reload();
                } else {
                    response.json().then(data => {
                        alert('Gagal menghapus pretest: ' + (data.message || 'Unknown error'));
                    });
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('Gagal menghapus pretest.');
            });
        }
    });
});

//Hapus Posttest
document.addEventListener('DOMContentLoaded', function() {
    let deleteIdPosttest; 

    const deleteButtonsPosttest = document.querySelectorAll('.delete-posttests');
    deleteButtonsPosttest.forEach(button => {
        button.addEventListener('click', function() {
            deleteIdPosttest = this.getAttribute('data-id');
            const deleteModalPosttest = new bootstrap.Modal(document.getElementById('deleteConfirmModalPosttests'));
            deleteModalPosttest.show();
        });
    });

    document.getElementById('confirmDeleteBtnPosttests').addEventListener('click', function() {
        if (deleteIdPosttest) {
            var route = `https://mathgasing.cloud/api/deletePosttest/${deleteIdPosttest}`;

            fetch(route, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                if (response.ok) {
                    alert('Data Posttest berhasil dihapus.');
                    window.location.reload();
                } else {
                    response.json().then(data => {
                        alert('Gagal menghapus posttest: ' + (data.message || 'Unknown error'));
                    });
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('Gagal menghapus posttest.');
            });
        }
    });
});

//Hapus Material Video
document.addEventListener('DOMContentLoaded', function() {
    let deleteIdMaterialVideo; 

    const deleteButtonsMaterialVideo = document.querySelectorAll('.delete-MaterialVideo');
    deleteButtonsMaterialVideo.forEach(button => {
        button.addEventListener('click', function() {
            deleteIdMaterialVideo = this.getAttribute('data-id');
            const deleteModalMaterialVideo = new bootstrap.Modal(document.getElementById('deleteConfirmModalVideoMaterial'));
            deleteModalMaterialVideo.show();
        });
    });

    document.getElementById('confirmDeleteBtnVideoMaterial').addEventListener('click', function() {
        if (deleteIdMaterialVideo) {
            var route = `https://mathgasing.cloud/api/deleteMaterialVideo/${deleteIdMaterialVideo}`;

            fetch(route, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function(response) {
                if (response.ok) {
                    alert('Material Video berhasil dihapus.');
                    window.location.reload();
                } else {
                    response.json().then(data => {
                        alert('Gagal menghapus Material Video: ' + (data.message || 'Unknown error'));
                    });
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
                alert('Gagal menghapus Material Video.');
            });
        }
    });
});

</script>
@endsection
