<div class="modal fade" id="editQuestionposttest{{ $item['id_question_posttest'] }}" tabindex="-1" aria-labelledby="formEditMateriLabel{{ $item['id_question_posttest'] }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditMateriLabel{{ $item['id_question_posttest'] }}">Edit Pertanyaan posttest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="edit-posttest-form-{{ $item['id_question_posttest'] }}" data-url="https://mathgasing.cloud/api/editQuestionPosttest/{{ $item['id_question_posttest'] }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input id="question" type="text" class="form-control" name="question" value="{{ $item['question'] }}" required autocomplete="question">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_1">Option A</label>
                            <input id="posttest_option_1" type="text" class="form-control" name="posttest_option_1" value="{{ $item['posttest_option_1'] }}" required autocomplete="posttest_option_1">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_2">Option B</label>
                            <input id="posttest_option_2" type="text" class="form-control" name="posttest_option_2" value="{{ $item['posttest_option_2'] }}" required autocomplete="posttest_option_2">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_3">Option C</label>
                            <input id="posttest_option_3" type="text" class="form-control" name="posttest_option_3" value="{{ $item['posttest_option_3'] }}" required autocomplete="posttest_option_3">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_4">Option D</label>
                            <input id="posttest_option_4" type="text" class="form-control" name="posttest_option_4" value="{{ $item['posttest_option_4'] }}" required autocomplete="posttest_option_4">
                        </div>

                        <div class="form-group">
                            <label for="posttest_correct_index">Jawaban Yang Benar</label>
                            <select id="posttest_correct_index" class="form-control" name="posttest_correct_index" required>
                                <option value="{{ $item['posttest_option_1'] }}" {{ $item['posttest_correct_index'] == $item['posttest_option_1'] ? 'selected' : '' }}>Pilihan A</option>
                                <option value="{{ $item['posttest_option_2'] }}" {{ $item['posttest_correct_index'] == $item['posttest_option_2'] ? 'selected' : '' }}>Pilihan B</option>
                                <option value="{{ $item['posttest_option_3'] }}" {{ $item['posttest_correct_index'] == $item['posttest_option_3'] ? 'selected' : '' }}>Pilihan C</option>
                                <option value="{{ $item['posttest_option_4'] }}" {{ $item['posttest_correct_index'] == $item['posttest_option_4'] ? 'selected' : '' }}>Pilihan D</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label for="id_posttest">ID posttest</label>
                            <input id="id_posttest" type="text" class="form-control" name="id_posttest" value="{{ $item['id_posttest'] }}" required autocomplete="id_posttest" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" onclick="submitEditQuestionposttest('{{ $item['id_question_posttest'] }}')">Kirim</button>
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
        const editButtons = document.querySelectorAll('.edit-question-posttest');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modal = document.getElementById(`editQuestionposttest${id}`);
                const modalInstance = new bootstrap.Modal(modal);

                // Fetch the existing data to fill the form
                fetch(`https://mathgasing.cloud/api/QuestionPosttestByID/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch question data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.data && data.data.length > 0) {
                            const questionData = data.data[0];
                            const form = document.getElementById(`edit-posttest-form-${id}`);
                            const selectCorrectIndex = form.querySelector('#posttest_correct_index');

                            form.question.value = questionData.question;
                            form.posttest_option_1.value = questionData.posttest_option_1;
                            form.posttest_option_2.value = questionData.posttest_option_2;
                            form.posttest_option_3.value = questionData.posttest_option_3;
                            form.posttest_option_4.value = questionData.posttest_option_4;

                            // Clear previous options
                            selectCorrectIndex.innerHTML = '';

                            // Add options for each input value
                            [1, 2, 3, 4].forEach(optionNumber => {
                                const optionValue = questionData[`posttest_option_${optionNumber}`];
                                if (optionValue !== '') {
                                    const option = document.createElement('option');
                                    option.text = optionValue;
                                    option.value = optionValue;
                                    selectCorrectIndex.appendChild(option);
                                }
                            });

                            // Set selected option in dropdown
                            selectCorrectIndex.value = questionData.posttest_correct_index;
                        }
                    })
                    .catch(error => console.error('Error fetching question data:', error));

                modalInstance.show();
            });
        });
    });

    function submitEditQuestionposttest(idQuestionPosttest) {
        const form = document.getElementById(`edit-posttest-form-${idQuestionPosttest}`);
        const formData = new FormData(form);

        // Fetch API to submit edited question data
        fetch(`https://mathgasing.cloud/api/editQuestionPosttest/${idQuestionPosttest}`, {
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
            const modal = document.getElementById(`editQuestionposttest${idQuestionPosttest}`);
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            // Show success alert
            alert('Soal Posttest berhasil diupdate');
            // Reload the page after a short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        })
        .catch(error => {
            console.error('Error editing question:', error);
            // Show error alert
            alert('Gagal memperbarui soal Posttest');
        });
    }
</script>
