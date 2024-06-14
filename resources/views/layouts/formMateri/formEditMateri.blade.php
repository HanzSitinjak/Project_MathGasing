<div class="modal fade" id="formEditMateri{{ $item['id_materi'] }}" tabindex="-1" aria-labelledby="formEditMateriLabel{{ $item['id_materi'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditMateriLabel{{ $item['id_materi'] }}">Edit Data Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-materi-form-{{ $item['id_materi'] }}" data-url="https://mathgasing.cloud/api/editMateri/{{ $item['id_materi'] }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_penggunaWeb">ID Pengguna Web</label>
                            <input id="id_penggunaWeb" type="text" class="form-control" name="id_penggunaWeb" value="{{ session('loginResponse')['id_user'] }}" required autocomplete="id_penggunaWeb" autofocus readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" class="form-control" name="title" required autocomplete="title" value="{{ $item['title'] }}">
                        </div>

                        <div class="form-group">
                            <label for="imageCard">Image Card</label>
                            <input id="imageCard" type="file" class="form-control" name="imageCard">
                        </div>

                        <div class="form-group">
                            <label for="imageBackground">Image Background</label>
                            <input id="imageBackground" type="file" class="form-control" name="imageBackground">
                        </div>

                        <div class="form-group">
                            <label for="imageCardAdmin">Image Card Admin</label>
                            <input id="imageCardAdmin" type="file" class="form-control" name="imageCardAdmin">
                        </div>

                        <div class="form-group">
                            <label for="imageStatistic">Image Statistic</label>
                            <input id="imageStatistic" type="file" class="form-control" name="imageStatistic">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditForm('{{ $item['id_materi'] }}')">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitEditForm(idMateri) {
        const form = document.getElementById(`edit-materi-form-${idMateri}`);
        const formData = new FormData(form);

        const url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update materi');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); 
            alert('Data materi berhasil diperbarui');
            location.reload(); 
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui data materi. Silakan coba lagi.');
        });
    }
</script>
