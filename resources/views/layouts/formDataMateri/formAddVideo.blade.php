<div class="modal fade" id="formAddVideo" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Material Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="simpan-badge" action="{{ route('simpan-video.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_unit">Id_Unit</label>
                            <input id="id_unit" type="text" class="form-control" name="id_unit" value="{{ $id_unit }}" required autocomplete="id_unit" readonly>
                        </div>

                        <div class="form-group">
                            <label for="video_Url">URL Video</label>
                            <input id="video_Url" type="text" class="form-control" name="video_Url" required autocomplete="video_Url">
                        </div>

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" type="text" class="form-control" name="title" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation">Penjelasan</label>
                            <textarea id="explanation" class="form-control" name="explanation" rows="10" style="height: 250px;" required autocomplete="explanation"></textarea>
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