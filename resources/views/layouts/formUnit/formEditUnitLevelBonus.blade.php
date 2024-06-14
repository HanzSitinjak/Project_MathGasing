<div class="modal fade" id="formEditUnitLevelBonus{{ $unit['id_unit_Bonus'] }}" tabindex="-1" aria-labelledby="formEditUnitLevelBonusLabel{{ $unit['id_unit_Bonus'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditUnitLevelBonusLabel{{ $unit['id_unit_Bonus'] }}">Edit Data Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-unit-form-{{ $unit['id_unit_Bonus'] }}" data-url="https://mathgasing.cloud/api/unitbonus/editUnitBonus/{{ $unit['id_unit_Bonus'] }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" id="id_unit_Bonus" name="id_unit_Bonus" value="{{ $unit['id_unit_Bonus'] }}">

                        <div class="form-group">
                            <label for="title-{{ $unit['id_unit_Bonus'] }}">Judul</label>
                            <input id="title-{{ $unit['id_unit_Bonus'] }}" type="text" class="form-control" name="title" value="{{ $unit['title'] }}" required autocomplete="title">
                        </div>

                        <div class="form-group">
                            <label for="explanation-{{ $unit['id_unit_Bonus'] }}">Penjelasan</label>
                            <input id="explanation-{{ $unit['id_unit_Bonus'] }}" type="text" class="form-control" name="explanation" value="{{ $unit['explanation'] }}" required autocomplete="explanation">
                        </div>

                        <div class="form-group">
                            <label for="id_materi-{{ $unit['id_unit_Bonus'] }}">Materi</label>
                            <input id="id_materi-{{ $unit['id_unit_Bonus'] }}" type="text" class="form-control" name="id_materi" value="{{ $unit['id_materi'] }}" required autocomplete="id_materi" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditUnit('{{ $unit['id_unit_Bonus'] }}')">Lanjutkan</button>
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
        const editUnitButtons = document.querySelectorAll('.edit-unit');

        editUnitButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id_unit_Bonus = this.getAttribute('data-id');
                const modal = document.getElementById(`formEditUnitLevelBonus${id_unit_Bonus}`);
                const modalInstance = new bootstrap.Modal(modal);
                const form = document.getElementById(`edit-unit-form-${id_unit_Bonus}`);

                form.setAttribute('data-url', `https://mathgasing.cloud/api/unitbonus/editUnitBonus/${id_unit_Bonus}`);
                document.getElementById(`id_unit_Bonus`).value = id_unit_Bonus;

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/unitbonus/editUnitBonus/${id_unit_Bonus}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            document.getElementById(`title-${id_unit_Bonus}`).value = data.data.title;
                            document.getElementById(`explanation-${id_unit_Bonus}`).value = data.data.explanation;
                            document.getElementById(`id_materi-${id_unit_Bonus}`).value = data.data.id_materi;
                        }
                    })
                    .catch(error => console.error('Error fetching unit data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditUnit(id_unit_Bonus) {
        const form = document.getElementById(`edit-unit-form-${id_unit_Bonus}`);
        const formData = new FormData(form);
        const url = form.getAttribute('data-url');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update unit data');
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
