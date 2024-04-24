<?php
// Panggil file konfigurasi database
require_once "config.php";

// Ambil metode permintaan HTTP
$request_method = $_SERVER["REQUEST_METHOD"];

// Proses permintaan sesuai metode
switch ($request_method) {
    case 'GET':
        // Handler untuk permintaan GET
        if (!empty($_GET["nim"])) {
            $nim = $_GET["nim"];
            if (!empty($_GET["kode_mk"])) {
                $kode_mk = $_GET["kode_mk"];
                get_nilai_mahasiswa($nim, $kode_mk);
            } else {
                get_nilai_mahasiswa_by_nim($nim);
            }
        } else {
            get_detail_perkuliahan();
        }
        break;
    case 'POST':
        // Handler untuk permintaan POST
        insert_nilai();
        break;
    case 'PUT':
        // Handler untuk permintaan PUT
        update_nilai();
        break;
    case 'DELETE':
        // Handler untuk permintaan DELETE
        delete_nilai();
        break;
    default:
        // Metode permintaan tidak valid
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

// Fungsi untuk mendapatkan detail perkuliahan (mahasiswa dan nilainya)
function get_detail_perkuliahan()
{
    global $mysqli;
    $query = "SELECT * FROM detail_perkuliahan";
    $data = array();
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Get Detail Perkuliahan Successfully.',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fungsi untuk mendapatkan nilai mahasiswa berdasarkan NIM
function get_nilai_mahasiswa_by_nim($nim)
{
    global $mysqli;
    $query = "SELECT * FROM detail_perkuliahan WHERE nim='$nim'";
    $data = array();
    $result = $mysqli->query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    $response = array(
        'status' => 1,
        'message' => 'Get Nilai Mahasiswa Successfully.',
        'data' => $data
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fungsi untuk mendapatkan nilai mahasiswa berdasarkan NIM dan kode_mk
function get_nilai_mahasiswa($nim, $kode_mk)
{
    global $mysqli;
    $query = "SELECT * FROM detail_perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";
    $data = array();
    $result = $mysqli->query($query);
    if ($row = mysqli_fetch_assoc($result)) {
        $response = array(
            'status' => 1,
            'message' => 'Get Nilai Mahasiswa Successfully.',
            'data' => $row
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Nilai Mahasiswa not found.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fungsi untuk memasukkan nilai baru untuk mahasiswa tertentu
function insert_nilai()
{
    global $mysqli;
    $data = json_decode(file_get_contents('php://input'), true);
    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];
    $nilai = $data['nilai'];

    if (!empty($nim) && !empty($kode_mk) && isset($nilai)) {
        $query = "INSERT INTO perkuliahan (nim, kode_mk, nilai) VALUES ('$nim', '$kode_mk', $nilai)";
        if ($mysqli->query($query)) {
            $response = array(
                'status' => 1,
                'message' => 'Nilai Added Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Nilai Addition Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fungsi untuk mengupdate nilai berdasarkan NIM dan kode_mk
function update_nilai()
{
    global $mysqli;
    $data = json_decode(file_get_contents('php://input'), true);
    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];
    $nilai = $data['nilai'];

    if (!empty($nim) && !empty($kode_mk) && isset($nilai)) {
        $query = "UPDATE perkuliahan SET nilai=$nilai WHERE nim='$nim' AND kode_mk='$kode_mk'";
        if ($mysqli->query($query)) {
            $response = array(
                'status' => 1,
                'message' => 'Nilai Updated Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Nilai Updation Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Fungsi untuk menghapus nilai berdasarkan NIM dan kode_mk
function delete_nilai()
{
    global $mysqli;
    $data = json_decode(file_get_contents('php://input'), true);
    $nim = $data['nim'];
    $kode_mk = $data['kode_mk'];

    if (!empty($nim) && !empty($kode_mk)) {
        $query = "DELETE FROM perkuliahan WHERE nim='$nim' AND kode_mk='$kode_mk'";
        if ($mysqli->query($query)) {
            $response = array(
                'status' => 1,
                'message' => 'Nilai Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Nilai Deletion Failed.'
            );
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Parameter Do Not Match'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
