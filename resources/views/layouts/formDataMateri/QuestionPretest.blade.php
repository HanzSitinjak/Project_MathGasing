<div class="modal fade" id="formPretestQuestion" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Soal Pretest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="simpan-badge" action="{{ route('tambah-pretest.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input id="question" type="text" class="form-control" name="question" required autocomplete="question">
                        </div>

                        <div class="form-group">
                            <label for="pretest_option_1">Option A</label>
                            <input id="pretest_option_1" type="text" class="form-control option-input" name="pretest_option_1" required autocomplete="pretest_option_1">
                        </div>

                        <div class="form-group">
                            <label for="pretest_option_2">Option B</label>
                            <input id="pretest_option_2" type="text" class="form-control option-input" name="pretest_option_2" required autocomplete="pretest_option_2">
                        </div>

                        <div class="form-group">
                            <label for="pretest_option_3">Option C</label>
                            <input id="pretest_option_3" type="text" class="form-control option-input" name="pretest_option_3" required autocomplete="pretest_option_3">
                        </div>

                        <div class="form-group">
                            <label for="pretest_option_4">Option D</label>
                            <input id="pretest_option_4" type="text" class="form-control option-input" name="pretest_option_4" required autocomplete="pretest_option_4">
                        </div>

                        <div class="form-group">
                            <label for="pretest_correct_index">Jawaban Yang Benar</label>
                            <select id="pretest_correct_index" class="form-control" name="pretest_correct_index" required>
                                <option value="" disabled selected>Pilih Jawaban</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label for="id_pretest">ID Pretest</label>
                            <input id="id_pretest" type="text" class="form-control" name="id_pretest" value="{{ $id_pretest }}" required autocomplete="id_pretest" readonly>
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
    // Function to update the correct answer dropdown based on input options for Pretest
    function updateCorrectIndexPretest() {
        var optionA = document.getElementById('pretest_option_1').value.trim();
        var optionB = document.getElementById('pretest_option_2').value.trim();
        var optionC = document.getElementById('pretest_option_3').value.trim();
        var optionD = document.getElementById('pretest_option_4').value.trim();

        var correctIndexSelect = document.getElementById('pretest_correct_index');
        
        // Clear previous options
        correctIndexSelect.innerHTML = '<option value="" disabled selected>Pilih Jawaban</option>';
        
        // Add options for each input value
        if (optionA !== '') {
            var option = document.createElement('option');
            option.text = optionA;
            option.value = optionA;
            correctIndexSelect.add(option);
        }
        if (optionB !== '') {
            var option = document.createElement('option');
            option.text = optionB;
            option.value = optionB;
            correctIndexSelect.add(option);
        }
        if (optionC !== '') {
            var option = document.createElement('option');
            option.text = optionC;
            option.value = optionC;
            correctIndexSelect.add(option);
        }
        if (optionD !== '') {
            var option = document.createElement('option');
            option.text = optionD;
            option.value = optionD;
            correctIndexSelect.add(option);
        }
    }

    // Add event listeners to update the correct answer dropdown when options are changed
    document.getElementById('pretest_option_1').addEventListener('input', updateCorrectIndexPretest);
    document.getElementById('pretest_option_2').addEventListener('input', updateCorrectIndexPretest);
    document.getElementById('pretest_option_3').addEventListener('input', updateCorrectIndexPretest);
    document.getElementById('pretest_option_4').addEventListener('input', updateCorrectIndexPretest);
</script>
