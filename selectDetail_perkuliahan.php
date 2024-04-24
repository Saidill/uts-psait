<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Perkuliahan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Kode Matakuliah</th>
                    <th>Nama Matakuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Ambil data dari API
                $data = file_get_contents('http://localhost/uts%20psait/api.php');
                $data = json_decode($data, true);

                // Cek apakah data berhasil diambil
                if ($data['status'] == 1) {
                    foreach ($data['data'] as $item) {
                        echo '<tr>';
                        echo '<td>' . $item['nim'] . '</td>';
                        echo '<td>' . $item['nama_mahasiswa'] . '</td>';
                        echo '<td>' . $item['alamat'] . '</td>';
                        echo '<td>' . $item['tanggal_lahir'] . '</td>';
                        echo '<td>' . $item['kode_mk'] . '</td>';
                        echo '<td>' . $item['nama_mk'] . '</td>';
                        echo '<td>' . $item['sks'] . '</td>';
                        echo '<td>' . $item['nilai'] . '</td>';
                        echo '<td>';
                        echo '<a class="btn btn-primary btn-sm" href="edit_form.php?nim=' . $item['nim'] . '&kode_mk=' . $item['kode_mk'] . '">Edit</a>';
                        echo "<td><a href='delete.php?nim=".$row['nim']."&kode_mk=".$row['kode_mk']."' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="9">Gagal mengambil data: ' . $data['message'] . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="add-button">
            <a class="btn btn-success" href="add_form.php">Add Nilai</a>
        </div>
    </div>

</body>
</html>
