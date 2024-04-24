<?php
if(isset($_REQUEST['nim']) && isset($_REQUEST['kode_mk'])) {
    $nim = $_REQUEST['nim'];
    $kode_mk = $_REQUEST['kode_mk'];

    $api_url = 'http://localhost/uts%20psait/api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;
    $response = file_get_contents($api_url);
    $result = json_decode($response, true);

    if($result['status'] == 1) {
        // Menggunakan metode DELETE untuk menghapus data
        $delete_url = 'http://localhost/uts%20psait/api.php?nim=' . $nim . '&kode_mk=' . $kode_mk;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $delete_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // Periksa apakah penghapusan berhasil
        $delete_result = json_decode($result, true);
        if($delete_result['status'] == 1) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan');</script>";
    }

    echo "<script>window.location='selectDetail_perkuliahan.php';</script>";
} else {
    echo "<script>window.location='selectDetail_perkuliahan.phpp';</script>";
}

?>
