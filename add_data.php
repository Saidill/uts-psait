<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_url = "http://localhost/uts%20psait/api.php";
    $data = array(
        "nim" => $_POST["nim"],
        "kode_mk" => $_POST["kode_mk"],
        "nilai" => $_POST["nilai"]
    );
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($api_url, false, $context);
    
    // Cek apakah data berhasil ditambahkan
    $result_array = json_decode($result, true);
    if ($result_array['status'] == 1) {
        // Redirect kembali ke halaman utama jika data berhasil ditambahkan
        header("Location: selectDetail_perkuliahan.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam menambahkan data, tampilkan pesan kesalahan
        echo "Gagal menambahkan data: " . $result_array['message'];
    }
} else {
    header("HTTP/1.0 405 Method Not Allowed");
}
?>
