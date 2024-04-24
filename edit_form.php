<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Edit Nilai Mahasiswa</h1>
        <?php
        // Ambil nim dan kode_mk dari parameter URL
        $nim = $_GET['nim'];
        $kode_mk = $_GET['kode_mk'];

        // Ambil data mahasiswa dari API
        $data = file_get_contents('http://localhost/uts%20psait/api.php?nim=' . $nim . '&kode_mk=' . $kode_mk);
        $data = json_decode($data, true);

        // Cek apakah data berhasil diambil
        if ($data['status'] == 1) {
            $nilai = $data['data']['nilai'];
            ?>
            <form action="updatedata.php" method="POST">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="kode_mk">Kode Matakuliah</label>
                    <input type="text" class="form-control" id="kode_mk" name="kode_mk" value="<?php echo $kode_mk; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input type="text" class="form-control" id="nilai" name="nilai" value="<?php echo $nilai; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update Nilai</button>
            </form>
        <?php
        } else {
            echo '<p>Gagal mengambil data: ' . $data['message'] . '</p>';
        }
        ?>
    </div>
</body>
</html>
