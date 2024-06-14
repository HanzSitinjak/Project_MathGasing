<div class="modal fade" id="formEditUnit{{ $unit['id_unit'] }}" tabindex="-1" aria-labelledby="formEditUnitLabel{{ $unit['id_unit'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditUnitLabel{{ $unit['id_unit'] }}">Edit Data Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-unit-form-{{ $unit['id_unit'] }}" action="{{ route('kelola-unit.create') }}" data-url="https://mathgasing.cloud/api/editUnit/{{ $unit['id_unit'] }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title-{{ $unit['id_unit'] }}">Judul</label>
                            <input id="title-{{ $unit['id_unit'] }}" type="text" class="form-control" name="title" value="{{ $unit['title'] }}" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation-{{ $unit['id_unit'] }}">Penjelasan</label>
                            <input id="explanation-{{ $unit['id_unit'] }}" type="text" class="form-control" name="explanation" value="{{ $unit['explanation'] }}" required autocomplete="explanation">
                        </div>

                        <div class="form-group">
                            <label for="id_materi-{{ $unit['id_unit'] }}">Materi</label>
                            <select id="id_materi-{{ $unit['id_unit'] }}" class="form-control" name="id_materi" required>
                                <option value="">Pilih Materi</option>
                                @foreach ($allMateri as $item)
                                    <option value="{{ $item['id_materi'] }}" {{ $item['id_materi'] == $id_materi ? 'selected' : '' }}>
                                        {{ $item['id_materi'] }} - {{ $item['title'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditForm('{{ $unit['id_unit'] }}')">Lanjutkan</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitEditForm(idUnit) {
        const form = document.getElementById(`edit-unit-form-${idUnit}`);
        const formData = new FormData(form);

        const url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update unit');
            }
            return response.json();
        })
        .then(data => {
            console.log(data); 
            alert('Data unit berhasil diperbarui');
            location.reload(); 
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui data unit. Silakan coba lagi.');
        });
    }
</script>
