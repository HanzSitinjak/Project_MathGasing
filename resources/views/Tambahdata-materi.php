<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Tambah Topik Materi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">  </head>
<body>
  <div class="container mt-4">
    <h1>TAMBAH TOPIK MATERI</h1>
    <form action="#">
      <div class="mb-3">
        <label for="judul" class="form-label">Judul:</label>
        <input type="text" class="form-control" id="judul" name="judul" required>
      </div>
      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi:</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
      </div>
      <div class="mb-3">
        <label for="dibuat_oleh" class="form-label">Dibuat oleh:</label>
        <input type="text" class="form-control" id="dibuat_oleh" name="dibuat_oleh" required>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-success">Simpan</button>&nbsp;&nbsp;
        <button type="button" class="btn btn-danger delete">Batal</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/Jlnnk1wqlkH9sltmm5WFiw2I4kYrys5mcyQ8tACtR4yQhE6g4OxvZ7" crossorigin="anonymous"></script>
</body>
</html>
