<div class="modal fade" id="editPretest{{ $itempretest['id_pretest'] }}" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pretest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-pretest-form-{{ $itempretest['id_pretest'] }}" data-url="https://mathgasing.cloud/api/editPretest/{{ $itempretest['id_pretest'] }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="id_pretest" name="id_pretest" value="{{ $itempretest['id_pretest'] }}">

                        <div class="form-group">
                            <label for="id_unit">Id_Unit</label>
                            <input id="id_unit-{{ $itempretest['id_pretest'] }}" type="text" class="form-control" name="id_unit" value="{{ $itempretest['id_unit'] }}" required autocomplete="id_unit" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi-{{ $itempretest['id_pretest'] }}" type="text" class="form-control" name="deskripsi" value="{{ $itempretest['deskripsi'] }}" required autocomplete="deskripsi">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditPretest('{{ $itempretest['id_pretest'] }}')">Kirim</button>
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
        const editButtons = document.querySelectorAll('.edit-pretest');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id_pretest = this.getAttribute('data-id');
                const modal = document.getElementById(`editPretest${id_pretest}`);
                const modalInstance = new bootstrap.Modal(modal);
                const form = document.getElementById(`edit-pretest-form-${id_pretest}`);

                form.setAttribute('data-url', `https://mathgasing.cloud/api/editPretest/${id_pretest}`);
                document.getElementById(`id_pretest`).value = id_pretest;

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/editPretest/${id_pretest}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.getElementById(`id_unit-${id_pretest}`).value = data.data.id_unit;
                            document.getElementById(`deskripsi-${id_pretest}`).value = data.data.deskripsi;
                        }
                    })
                    .catch(error => console.error('Error fetching pretest data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditPretest(id_pretest) {
        const form = document.getElementById(`edit-pretest-form-${id_pretest}`);
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
                throw new Error('Failed to update pretest data');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert('Data pretest berhasil diperbarui');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui data pretest. Silakan coba lagi.');
        });
    }
</script>
