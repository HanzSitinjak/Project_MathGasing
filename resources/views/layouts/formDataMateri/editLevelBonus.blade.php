<div class="modal fade" id="editLevelBonus{{ $itemlevelbonus['id_level_bonus'] }}" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Level Bonus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-levelbonus-form-{{ $itemlevelbonus['id_level_bonus'] }}" data-url="https://mathgasing.cloud/api/levelbonus/editLevelBonus/{{ $itemlevelbonus['id_level_bonus'] }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="id_level_bonus" name="id_level_bonus" value="{{ $itemlevelbonus['id_level_bonus'] }}">

                        <div class="form-group">
                            <label for="id_unit_Bonus">Id_Unit_Bonus</label>
                            <input id="id_unit_Bonus" type="text" class="form-control" name="id_unit_Bonus" value="{{ $itemlevelbonus['id_unit_Bonus'] }}" required autocomplete="id_unit_Bonus" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="{{ $itemlevelbonus['deskripsi'] }}" required autocomplete="deskripsi">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditLevelBonus('{{ $itemlevelbonus['id_level_bonus'] }}')">Submit</button>
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
        const editButtons = document.querySelectorAll('.edit-levelbonus');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id_level_bonus = this.getAttribute('data-id');
                const modal = document.getElementById(`editLevelBonus${id_level_bonus}`);
                const modalInstance = new bootstrap.Modal(modal);
                const form = document.getElementById(`edit-levelbonus-form-${id_level_bonus}`);

                form.setAttribute('data-url', `https://mathgasing.cloud/api/levelbonus/editLevelBonus/${id_level_bonus}`);
                document.getElementById(`id_level_bonus`).value = id_level_bonus;

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/levelbonus/${id_level_bonus}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.getElementById(`id_unit_Bonus`).value = data.data.id_unit_Bonus;
                            document.getElementById(`deskripsi`).value = data.data.deskripsi;
                        }
                    })
                    .catch(error => console.error('Error fetching level bonus data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditLevelBonus(id_level_bonus) {
        const form = document.getElementById(`edit-levelbonus-form-${id_level_bonus}`);
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
                throw new Error('Failed to update level bonus data');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert('Data level bonus berhasil diperbarui');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui data level bonus. Silakan coba lagi.');
        });
    }
</script>
