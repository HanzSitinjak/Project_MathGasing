@if (session('alert'))
    <script>
        alert("{{ session('alert') }}");
    </script>
@endif

<div class="modal fade" id="formAddBadge" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Badge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="simpan-badge" action="{{ route('simpan-badge.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_penggunaWeb">ID Pengguna Web</label>
                            <input id="id_penggunaWeb" type="text" class="form-control" name="id_penggunaWeb" value="{{ session('loginResponse')['id_user'] }}" required autocomplete="id_penggunaWeb" autofocus readonly>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="image" type="file" class="form-control" name="image" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" type="text" class="form-control" name="title" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation">Explanation</label>
                            <input id="explanation" type="text" class="form-control" name="explanation" required autocomplete="explanation">
                        </div>

                        <div class="form-group">
                            <label for="id_materi">Materi</label>
                            <select id="id_materi" class="form-control" name="id_materi" required>
                                <option value="">Pilih Materi</option>
                                @foreach($materiData as $materi)
                                    <option value="{{ $materi['id_materi'] }}">{{ $materi['id_materi'] }} - {{ $materi['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_posttest">ID Posttest</label>
                            <select id="id_posttest" class="form-control" name="id_posttest" required>
                                <option value="">Pilih ID Posttest</option>
                                @foreach($posttestData as $posttest)
                                    <option value="{{ $posttest['id_posttest'] }}">{{ $posttest['id_posttest'] }} - {{$posttest['deskripsi']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
