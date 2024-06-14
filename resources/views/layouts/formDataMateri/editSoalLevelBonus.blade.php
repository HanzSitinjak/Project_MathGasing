<div class="modal fade" id="editQuestionLevelbonus{{ $item['id_question_level_bonus'] }}" tabindex="-1" aria-labelledby="formQuestionBonusLabel{{ $item['id_question_level_bonus'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formQuestionBonusLabel{{ $item['id_question_level_bonus'] }}">Edit Data Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-levelbonus-form-{{ $item['id_question_level_bonus'] }}" data-url="https://mathgasing.cloud/api/editQuestionLevelBonus/{{ $item['id_question_level_bonus'] }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input id="question" type="text" class="form-control" name="question" value="{{ $item['question'] }}" required autocomplete="question">
                        </div>

                        <div class="form-group">
                            <label for="option_1">Option A</label>
                            <input id="option_1" type="text" class="form-control" name="option_1" value="{{ $item['option_1'] }}" required autocomplete="option_1">
                        </div>

                        <div class="form-group">
                            <label for="option_2">Option B</label>
                            <input id="option_2" type="text" class="form-control" name="option_2" value="{{ $item['option_2'] }}" required autocomplete="option_2">
                        </div>

                        <div class="form-group">
                            <label for="option_3">Option C</label>
                            <input id="option_3" type="text" class="form-control" name="option_3" value="{{ $item['option_3'] }}" required autocomplete="option_3">
                        </div>

                        <div class="form-group">
                            <label for="option_4">Option D</label>
                            <input id="option_4" type="text" class="form-control" name="option_4" value="{{ $item['option_4'] }}" required autocomplete="option_4">
                        </div>

                        <div class="form-group">
                            <label for="correct_index">Jawaban Yang Benar</label>
                            <select id="correct_index" class="form-control" name="correct_index" required>
                                <option value="{{ $item['option_1'] }}" {{ $item['correct_index'] == $item['option_1'] ? 'selected' : '' }}>Pilihan A</option>
                                <option value="{{ $item['option_2'] }}" {{ $item['correct_index'] == $item['option_2'] ? 'selected' : '' }}>Pilihan B</option>
                                <option value="{{ $item['option_3'] }}" {{ $item['correct_index'] == $item['option_3'] ? 'selected' : '' }}>Pilihan C</option>
                                <option value="{{ $item['option_4'] }}" {{ $item['correct_index'] == $item['option_4'] ? 'selected' : '' }}>Pilihan D</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label for="id_level_bonus">ID Level Bonus</label>
                            <input id="id_level_bonus" type="text" class="form-control" name="id_level_bonus" value="{{ $item['id_level_bonus'] }}" required autocomplete="id_level_bonus" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditQuestionLevelBonus('{{ $item['id_question_level_bonus'] }}')">Kirim</button>
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
        const editButtonsLevelbonus = document.querySelectorAll('.edit-question-levelbonus');

        editButtonsLevelbonus.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`editQuestionLevelbonus${id}`);
                const modalInstance = new bootstrap.Modal(modal);

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/getQuestionLevelBonus/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch question data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.data && data.data.length > 0) {
                            const questionData = data.data[0];
                            const form = document.getElementById(`edit-levelbonus-form-${id}`);
                            const selectCorrectIndex = form.querySelector('#correct_index');

                            form.question.value = questionData.question;
                            form.option_1.value = questionData.option_1;
                            form.option_2.value = questionData.option_2;
                            form.option_3.value = questionData.option_3;
                            form.option_4.value = questionData.option_4;

                            // Clear previous options
                            selectCorrectIndex.innerHTML = '';

                            // Add options for each input value
                            [1, 2, 3, 4].forEach(optionNumber => {
                                const optionValue = questionData[`option_${optionNumber}`];
                                if (optionValue !== '') {
                                    const option = document.createElement('option');
                                    option.text = optionValue;
                                    option.value = optionValue;
                                    selectCorrectIndex.appendChild(option);
                                }
                            });

                            // Set selected option in dropdown
                            selectCorrectIndex.value = questionData.correct_index;
                        }
                    })
                    .catch(error => console.error('Error fetching question data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditQuestionLevelBonus(idQuestionLevelBonus) {
        const form = document.getElementById(`edit-levelbonus-form-${idQuestionLevelBonus}`);
        const formData = new FormData(form);

        // Fetch API to submit edited question data
        fetch(`https://mathgasing.cloud/api/editQuestionLevelBonus/${idQuestionLevelBonus}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to edit question');
            }
            return response.json();
        })
        .then(data => {
            // Handle response data here
            console.log(data);
            // Close modal after submission
            const modal = document.getElementById(`editQuestionLevelbonus${idQuestionLevelBonus}`);
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            // Show success alert
            alert('Soal Level Bonus berhasil diupdate');
            // Reload the page after a short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        })
        .catch(error => {
            console.error('Error editing question:', error);
            // Show error alert
            alert('Gagal memperbarui soal Level Bonus');
        });
    }
</script>
