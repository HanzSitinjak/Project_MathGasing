<div class="modal fade" id="formLevelBonusQuestion" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Soal LevelBonus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-xl form-box">
                    <form id="simpan-levelbonus-question" action="{{ route('tambah-levelBonus.question') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input id="question" type="text" class="form-control" name="question" required autocomplete="question">
                        </div>

                        <div class="form-group">
                            <label for="option_1">Option A</label>
                            <input id="option_1" type="text" class="form-control" name="option_1" required autocomplete="option_1">
                        </div>

                        <div class="form-group">
                            <label for="option_2">Option B</label>
                            <input id="option_2" type="text" class="form-control" name="option_2" required autocomplete="option_2">
                        </div>

                        <div class="form-group">
                            <label for="option_3">Option C</label>
                            <input id="option_3" type="text" class="form-control" name="option_3" required autocomplete="option_3">
                        </div>

                        <div class="form-group">
                            <label for="option_4">Option D</label>
                            <input id="option_4" type="text" class="form-control" name="option_4" required autocomplete="option_4">
                        </div>

                        <div class="form-group">
                            <label for="correct_index">Jawaban Yang Benar</label>
                            <select id="correct_index" class="form-control" name="correct_index" required>
                                <option>Pilih Jawaban</option>
                                <option value="0">Pilihan A</option>
                                <option value="1">Pilihan B</option>
                                <option value="2">Pilihan C</option>
                                <option value="3">Pilihan D</option>
                            </select>
                        </div>

                        <div class="form-group" hidden>
                            <label for="id_level_bonus">ID Level Bonus</label>
                            <input id="id_level_bonus" type="text" class="form-control" name="id_level_bonus" value="{{ $id_level_bonus }}" required autocomplete="id_level_bonus" readonly>
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
    // Fungsi untuk memperbarui nilai dropdown "Jawaban Yang Benar" berdasarkan inputan opsi yang diberikan
    function updateCorrectIndex() {
        var optionA = document.getElementById('option_1').value.trim();
        var optionB = document.getElementById('option_2').value.trim();
        var optionC = document.getElementById('option_3').value.trim();
        var optionD = document.getElementById('option_4').value.trim();

        var correctIndexSelect = document.getElementById('correct_index');
        var selectedIndex = correctIndexSelect.selectedIndex;

        correctIndexSelect.innerHTML = '';

        var optionArray = [optionA, optionB, optionC, optionD];

        for (var i = 0; i < optionArray.length; i++) {
            if (optionArray[i] !== '') {
                var option = document.createElement('option');
                option.text = 'Pilihan ' + String.fromCharCode(65 + i) + ' - ' + optionArray[i];
                option.value = optionArray[i];
                correctIndexSelect.add(option);
            } else {
                // Menyembunyikan opsi yang tidak diisi
                var hiddenOption = document.createElement('option');
                hiddenOption.value = ''; // Nilai kosong
                hiddenOption.text = ''; // Teks kosong
                hiddenOption.classList.add('hidden-option');
                correctIndexSelect.add(hiddenOption);
            }
        }

        // Mengatur nilai dropdown "Jawaban Yang Benar" ke optionArray
        correctIndexSelect.value = optionArray.join('|');

        // Mengembalikan opsi yang dipilih sebelumnya jika masih tersedia
        if (selectedIndex !== -1) {
            correctIndexSelect.selectedIndex = selectedIndex;
        }
    }

    // Panggil fungsi updateCorrectIndex() setiap kali ada perubahan pada inputan opsi
    document.getElementById('option_1').addEventListener('input', updateCorrectIndex);
    document.getElementById('option_2').addEventListener('input', updateCorrectIndex);
    document.getElementById('option_3').addEventListener('input', updateCorrectIndex);
    document.getElementById('option_4').addEventListener('input', updateCorrectIndex);
</script>

