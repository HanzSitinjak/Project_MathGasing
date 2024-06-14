<div class="modal fade" id="editVideo{{ $itemVideo['id_material_video'] }}" tabindex="-1" aria-labelledby="editVideoLabel{{ $itemVideo['id_material_video'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVideoLabel{{ $itemVideo['id_material_video'] }}">Ubah Video Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-video-form-{{ $itemVideo['id_material_video'] }}" data-url="https://mathgasing.cloud/api/editMaterialVideo/{{ $itemVideo['id_material_video'] }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_unit">Id_Unit</label>
                            <input id="id_unit-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" name="id_unit" value="{{ $id_unit }}" required autocomplete="id_unit" readonly>
                        </div>

                        <div class="form-group">
                            <label for="video_Url">URL Video</label>
                            <input id="video_Url-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" value="{{ $itemVideo['video_Url'] }}" name="video_Url" required autocomplete="video_Url">
                        </div>

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" value="{{ $itemVideo['title'] }}" name="title" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation">Penjelasan</label>
                            <textarea id="explanation-{{ $itemVideo['id_material_video'] }}" class="form-control" name="explanation" rows="10" style="height: 250px;" required autocomplete="explanation">{{ $itemVideo['explanation'] }}</textarea>
                        </div>

                        <input type="hidden" id="id_material_video-{{ $itemVideo['id_material_video'] }}" name="id_material_video">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditVideo('{{ $itemVideo['id_material_video'] }}')">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-video-material');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`editVideo${id}`);
                const modalInstance = new bootstrap.Modal(modal);

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/editMaterialVideo/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.querySelector(`#edit-video-form-${id} #video_Url-${id}`).value = data.data.video_Url;
                            document.querySelector(`#edit-video-form-${id} #title-${id}`).value = data.data.title;
                            document.querySelector(`#edit-video-form-${id} #explanation-${id}`).value = data.data.explanation;
                        }
                    })
                    .catch(error => console.error('Error fetching video data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditVideo(idMaterialVideo) {
        const form = document.getElementById(`edit-video-form-${idMaterialVideo}`);
        const formData = new FormData(form);

        const url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update video material');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); 
            alert('Data video materi berhasil diperbarui');
            location.reload(); 
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui video materi. Silakan coba lagi.');
        });
    }
</script>
<div class="modal fade" id="editVideo{{ $itemVideo['id_material_video'] }}" tabindex="-1" aria-labelledby="editVideoLabel{{ $itemVideo['id_material_video'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVideoLabel{{ $itemVideo['id_material_video'] }}">Ubah Data Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-video-form-{{ $itemVideo['id_material_video'] }}" data-url="https://mathgasing.cloud/api/editMaterialVideo/{{ $itemVideo['id_material_video'] }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_unit">Id_Unit</label>
                            <input id="id_unit-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" name="id_unit" value="{{ $id_unit }}" required autocomplete="id_unit" readonly>
                        </div>

                        <div class="form-group">
                            <label for="video_Url">URL Video</label>
                            <input id="video_Url-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" value="{{ $itemVideo['video_Url'] }}" name="video_Url" required autocomplete="video_Url">
                        </div>

                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input id="title-{{ $itemVideo['id_material_video'] }}" type="text" class="form-control" value="{{ $itemVideo['title'] }}" name="title" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation">Penjelasan</label>
                            <textarea id="explanation-{{ $itemVideo['id_material_video'] }}" class="form-control" name="explanation" rows="10" style="height: 250px;" required autocomplete="explanation">{{ $itemVideo['explanation'] }}</textarea>
                        </div>

                        <input type="hidden" id="id_material_video-{{ $itemVideo['id_material_video'] }}" name="id_material_video">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditVideo('{{ $itemVideo['id_material_video'] }}')">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-video-material');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`editVideo${id}`);
                const modalInstance = new bootstrap.Modal(modal);

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/editMaterialVideo/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.querySelector(`#edit-video-form-${id} #video_Url-${id}`).value = data.data.video_Url;
                            document.querySelector(`#edit-video-form-${id} #title-${id}`).value = data.data.title;
                            document.querySelector(`#edit-video-form-${id} #explanation-${id}`).value = data.data.explanation;
                        }
                    })
                    .catch(error => console.error('Error fetching video data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditVideo(idMaterialVideo) {
        const form = document.getElementById(`edit-video-form-${idMaterialVideo}`);
        const formData = new FormData(form);

        const url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update video material');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); 
            alert('Data video materi berhasil diperbarui');
            location.reload(); 
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui video materi. Silakan coba lagi.');
        });
    }
</script>
