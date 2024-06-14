<div class="modal fade" id="editPosttest{{ $itemposttest['id_posttest'] }}" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Posttest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-posttest-form-{{ $itemposttest['id_posttest'] }}" data-url="https://mathgasing.cloud/api/editPosttest/{{ $itemposttest['id_posttest'] }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="id_posttest" name="id_posttest" value="{{ $itemposttest['id_posttest'] }}">

                        <div class="form-group">
                            <label for="id_unit">Id_Unit</label>
                            <input id="id_unit-{{ $itemposttest['id_posttest'] }}" type="text" class="form-control" name="id_unit" value="{{ $itemposttest['id_unit'] }}" required autocomplete="id_unit" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi-{{ $itemposttest['id_posttest'] }}" type="text" class="form-control" name="deskripsi" value="{{ $itemposttest['deskripsi'] }}" required autocomplete="deskripsi">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditPosttest('{{ $itemposttest['id_posttest'] }}')">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-posttest');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id_posttest = this.getAttribute('data-id');
                const modal = document.getElementById(`editPosttest${id_posttest}`);
                const modalInstance = new bootstrap.Modal(modal);
                const form = document.getElementById(`edit-posttest-form-${id_posttest}`);

                form.setAttribute('data-url', `https://mathgasing.cloud/api/editPosttest/${id_posttest}`);
                document.getElementById(`id_posttest`).value = id_posttest;

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/editPosttest/${id_posttest}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.getElementById(`id_unit-${id_posttest}`).value = data.data.id_unit;
                            document.getElementById(`deskripsi-${id_posttest}`).value = data.data.deskripsi;
                        }
                    })
                    .catch(error => console.error('Error fetching posttest data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditPosttest(id_posttest) {
        const form = document.getElementById(`edit-posttest-form-${id_posttest}`);
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
                throw new Error('Failed to update posttest data');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert('Data posttest berhasil diperbarui');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui data posttest. Silakan coba lagi.');
        });
    }
</script>
