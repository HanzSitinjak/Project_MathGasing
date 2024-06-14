<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Level Akhir</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Tambah Level Akhir</h1>
    <p>Ikuti aturan yang telah ditetapkan</p>
    <form action="#">
      <div class="form-group">
        <label for="soal">Soal Level Akhir:</label>
        <input type="text" class="form-control" id="soal" name="soal" required>
      </div>
      <div class="form-group">
        <label for="pilihan1">Pilihan 1:</label>
        <input type="text" class="form-control" id="pilihan1" name="pilihan1" required>
      </div>
      <div class="form-group">
        <label for="pilihan2">Pilihan 2:</label>
        <input type="text" class="form-control" id="pilihan2" name="pilihan2" required>
      </div>
      <div class="form-group">
        <label for="pilihan3">Pilihan 3:</label>
        <input type="text" class="form-control" id="pilihan3" name="pilihan3" required>
      </div>
      <div class="form-group">
        <label for="pilihan4">Pilihan 4:</label>
        <input type="text" class="form-control" id="pilihan4" name="pilihan4" required>
      </div>
      <div class="form-group">
        <label for="jawaban">Jawaban:</label>
        <select class="form-control" id="jawaban" name="jawaban" required>
          <option value="pilihan1">Pilihan 1</option>
          <option value="pilihan2">Pilihan 2</option>
          <option value="pilihan3">Pilihan 3</option>
          <option value="pilihan4">Pilihan 4</option>
        </select>
      </div>
      <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-secondary me-2">Tambah Soal +</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/Jlnnk1wqlkH9sltmm5WFiw2I4kYrys5mcyQ8tACtR4yQhE6g4OxvZ7" crossorigin="anonymous"></script>
</body>
</html>
