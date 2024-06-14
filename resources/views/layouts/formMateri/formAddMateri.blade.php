<div class="modal fade" id="formAddMateri" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                <form action="{{ route('add-materi.post') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="id_penggunaWeb">ID Pengguna Web</label>
        <input id="id_penggunaWeb" type="text" class="form-control" name="id_penggunaWeb" value="{{ session('loginResponse')['id_user'] }}" required autocomplete="id_penggunaWeb" autofocus readonly>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" type="text" class="form-control" name="title" required autocomplete="title">
    </div>

    <div class="form-group">
        <label for="imageCard">Image Card</label>
        <input id="imageCard" type="file" class="form-control" name="imageCard" required>
    </div>

    <div class="form-group">
        <label for="imageBackground">Image Background</label>
        <input id="imageBackground" type="file" class="form-control" name="imageBackground" required>
    </div>

    <div class="form-group">
        <label for="imageCardAdmin">Image Card Admin</label>
        <input id="imageCardAdmin" type="file" class="form-control" name="imageCardAdmin" required>
    </div>

    <div class="form-group">
        <label for="imageStatistic">Image Statistic</label>
        <input id="imageStatistic" type="file" class="form-control" name="imageStatistic" required>
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
