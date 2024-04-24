<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Nilai Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Add Nilai Mahasiswa</h1>
        <form action="add_data.php" method="POST">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label for="kode_mk">Kode Matakuliah:</label>
                <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" class="form-control" id="nilai" name="nilai" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
