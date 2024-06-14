<div class="modal fade" id="formEditBadge{{ $badge['id_bagde'] }}" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Badge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-badge-form-{{ $badge['id_bagde'] }}" data-url="https://mathgasing.cloud/api/badges/{{ $badge['id_bagde'] }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id_penggunaWeb-{{ $badge['id_bagde'] }}">ID Pengguna Web</label>
                            <input id="id_penggunaWeb-{{ $badge['id_bagde'] }}" type="text" class="form-control" name="id_penggunaWeb" value="{{ old('id_penggunaWeb', $badge['id_penggunaWeb'] ?? '') }}" required autocomplete="id_penggunaWeb" autofocus readonly>
                        </div>

                        <div class="form-group">
                            <label for="image-{{ $badge['id_bagde'] }}">Image</label>
                            <input id="image-{{ $badge['id_bagde'] }}" type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="title-{{ $badge['id_bagde'] }}">Judul</label>
                            <input id="title-{{ $badge['id_bagde'] }}" type="text" class="form-control" name="title" value="{{ old('title', $badge['title'] ?? '') }}" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation-{{ $badge['id_bagde'] }}">Explanation</label>
                            <input id="explanation-{{ $badge['id_bagde'] }}" type="text" class="form-control" name="explanation" value="{{ old('explanation', $badge['explanation'] ?? '') }}" required autocomplete="explanation">
                        </div>

                        <div class="form-group">
                            <label for="id_materi-{{ $badge['id_bagde'] }}">Materi</label>
                            <select id="id_materi-{{ $badge['id_bagde'] }}" class="form-control" name="id_materi" required>
                                <option value="">Pilih Materi</option>
                                @foreach($materiData as $materi)
                                    <option value="{{ $materi['id_materi'] }}" {{ $materi['id_materi'] == old('id_materi', $badge['id_materi'] ?? '') ? 'selected' : '' }}>
                                        {{ $materi['id_materi'] }} - {{ $materi['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_posttest-{{ $badge['id_bagde'] }}">ID Posttest</label>
                            <select id="id_posttest-{{ $badge['id_bagde'] }}" class="form-control" name="id_posttest" required>
                                <option value="">Pilih ID Posttest</option>
                                @foreach($posttestData as $posttest)
                                    <option value="{{ $posttest['id_posttest'] }}" {{ $posttest['id_posttest'] == old('id_posttest', $badge['id_posttest'] ?? '') ? 'selected' : '' }}>
                                        {{ $posttest['id_posttest'] }} - {{ $posttest['deskripsi'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="updateBadge('{{ $badge['id_bagde'] }}')">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateBadge(id) {
        var form = document.getElementById('edit-badge-form-' + id);
        var formData = new FormData(form);

        var csrfToken = form.querySelector('input[name="_token"]').value;
        var url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error && data.error === 'data ini sudah ada sebelumnya') {
                alert(data.error);
            } else {
                var idMateri = document.getElementById('id_materi-' + id).value;
                window.location.href = '/kelola-lencana/' + idMateri;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengupdate badge. Silakan coba lagi.');
        });
    }
</script>
