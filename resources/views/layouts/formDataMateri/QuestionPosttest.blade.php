<div class="modal fade" id="formPosttestQuestion" tabindex="-1" aria-labelledby="approvalPosttestQuestionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Soal Posttest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="formPosttest" action="{{ route('tambah-posttest.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input id="question" type="text" class="form-control" name="question" required autocomplete="question">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_1">Option A</label>
                            <input id="posttest_option_1" type="text" class="form-control option-input" name="posttest_option_1" required autocomplete="posttest_option_1">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_2">Option B</label>
                            <input id="posttest_option_2" type="text" class="form-control option-input" name="posttest_option_2" required autocomplete="posttest_option_2">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_3">Option C</label>
                            <input id="posttest_option_3" type="text" class="form-control option-input" name="posttest_option_3" required autocomplete="posttest_option_3">
                        </div>

                        <div class="form-group">
                            <label for="posttest_option_4">Option D</label>
                            <input id="posttest_option_4" type="text" class="form-control option-input" name="posttest_option_4" required autocomplete="posttest_option_4">
                        </div>

                        <div class="form-group">
                            <label for="posttest_correct_index">Jawaban Yang Benar</label>
                            <select id="posttest_correct_index" class="form-control" name="posttest_correct_index" required>
                                <option value="" disabled selected>Pilih Jawaban</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label for="id_posttest">ID Posttest</label>
                            <input id="id_posttest" type="text" class="form-control" name="id_posttest" value="{{ $id_posttest }}" required autocomplete="id_posttest" readonly>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batalkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to update the correct answer dropdown based on input options for Posttest
    function updateCorrectIndexPosttest() {
        var optionA = document.getElementById('posttest_option_1').value.trim();
        var optionB = document.getElementById('posttest_option_2').value.trim();
        var optionC = document.getElementById('posttest_option_3').value.trim();
        var optionD = document.getElementById('posttest_option_4').value.trim();

        var correctIndexSelect = document.getElementById('posttest_correct_index');
        var selectedValue = correctIndexSelect.value;

        // Clear the dropdown
        correctIndexSelect.innerHTML = '<option value="" disabled selected>Pilih Jawaban</option>';

        var optionArray = [optionA, optionB, optionC, optionD];

        // Add new options
        for (var i = 0; i < optionArray.length; i++) {
            if (optionArray[i] !== '') {
                var option = document.createElement('option');
                option.text = optionArray[i];
                option.value = optionArray[i];
                correctIndexSelect.add(option);
            }
        }

        // Set previously selected value if still valid
        if (selectedValue) {
            correctIndexSelect.value = selectedValue;
        }
    }

    // Add event listeners to update the correct answer dropdown when options are changed
    document.getElementById('posttest_option_1').addEventListener('input', updateCorrectIndexPosttest);
    document.getElementById('posttest_option_2').addEventListener('input', updateCorrectIndexPosttest);
    document.getElementById('posttest_option_3').addEventListener('input', updateCorrectIndexPosttest);
    document.getElementById('posttest_option_4').addEventListener('input', updateCorrectIndexPosttest);
</script>
