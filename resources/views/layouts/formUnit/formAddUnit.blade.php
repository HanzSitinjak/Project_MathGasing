<div class="modal fade" id="formAddUnit" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="simpan-unit" action="{{ route('kelola-unit.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title" type="text" class="form-control" name="title" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation">Penjelasan</label>
                            <input id="explanation" type="text" class="form-control" name="explanation" required autocomplete="explanation">
                        </div>

                        <div class="form-group">
                            <label for="id_materi">Materi</label>
                            <input id="id_materi" type="hidden" class="form-control" value="{{ $id_materi }}" name="id_materi" required autocomplete="id_materi" readonly>
                            <input id="materi_tampil" type="text" class="form-control" value="{{ $materi['id_materi'] }} - {{ $materi['title'] }}" name="materi_tampil" required autocomplete="materi_tampil" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addUnitButtons = document.querySelectorAll('[data-bs-target="#formAddUnit"]');
        addUnitButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var idMateri = button.getAttribute("data-id-materi");
                document.getElementById("id_materi").value = idMateri;
            });
        });
    });
</script>
