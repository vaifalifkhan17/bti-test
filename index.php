<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Strategi Pemilihan Soal</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Strategi Pemilihan Soal UAS</h1>
    <form action="kombinasi.php" method="POST">
      <label>Total Poin Maksimal:</label>
      <input type="number" name="target" required min="1">

      <label>Jumlah Soal (maks 10):</label>
      <input type="number" name="jumlah" required min="1" max="10">

      <div id="soal-container"></div>

      <button type="button" onclick="generateSoal()">Buat Input Soal</button>
      <button type="submit">Cari Kombinasi</button>
    </form>
  </div>

  <script>
    function generateSoal() {
      const jumlah = document.querySelector('input[name="jumlah"]').value;
      const container = document.getElementById('soal-container');
      container.innerHTML = '';

      for (let i = 1; i <= jumlah; i++) {
        container.innerHTML += `
          <div class="soal-group">
            <label>Soal-${i} (Poin Maks):</label>
            <input type="text" name="soal[]" value="Soal-${i}" required>
            <input type="number" name="poin[]" required min="1">
          </div>
        `;
      }
    }
  </script>
</body>
</html>
