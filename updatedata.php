<?php
// Pastikan ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nim = $_POST["nim"];
    $kode_mk = $_POST["kode_mk"];
    $nilai = $_POST["nilai"];

    // Buat payload untuk dikirimkan ke API
    $data = array(
        "nim" => $nim,
        "kode_mk" => $kode_mk,
        "nilai" => $nilai
    );

    // Konversi data menjadi format JSON
    $payload = json_encode($data);

    // Konfigurasi curl untuk mengirim data ke API
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost/uts%20psait/api.php?nim=" . $nim . "&kode_mk=" . $kode_mk,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Content-Length: " . strlen($payload)
        )
    ));

    // Eksekusi curl dan simpan respon
    $response = curl_exec($curl);

    // Tutup curl
    curl_close($curl);

    // Konversi respon menjadi array
    $result = json_decode($response, true);

    // Redirect kembali ke halaman utama setelah pembaruan data
    if ($result["status"] == 1) {
        header("Location: selectDetail_perkuliahan.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $result["message"];
    }
} else {
    echo "Metode HTTP tidak didukung!";
}
?>
