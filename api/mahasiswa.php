<?php

include(__DIR__ . "/../db.php");

// mengecek request method
$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);

switch ($method) {
    case "POST":
        if (isset($_GET["npm"])) {
            updateData();
            return;
        }

        tambahData();
        break;

    case "PUT":
        break;

    case "DELETE":
        hapusData();
        break;

    default:
        if (isset($_GET["npm"])) {
            getSingleDataByNPM();
            return;
        }
        
        getAllDataMahasiswa();
        break;
}


function getAllDataMahasiswa() {
    global $db;

    // Set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8');

    // Array kosong buat nampung semua data
    $array = array();

    // Query semua data mahasiswa
    $query = mysqli_query($db, "SELECT * FROM mahasiswa");

    while ($data = mysqli_fetch_object($query)) {
        array_push($array, $data);
    }

    echo json_encode($array);
    exit();
}


function tambahData() {
    global $db;

    // Menerima data dari request
    $npm = $_POST["npm"];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];
    $nohp = $_POST["nohp"];

    // Cek NPM mahasiswa
    $cek_npm = mysqli_query($db, "SELECT * FROM mahasiswa WHERE npm='". $npm ."'");

    if ($cek_npm->num_rows === 0) {
        mysqli_query($db, "INSERT INTO mahasiswa (npm,nama,kelas,jurusan,nohp) VALUES ('".$npm."','".$nama."','".$kelas."','".$jurusan."','".$nohp."')");

        header("Location: ". baseUrl(""));
        exit();
    } else {
        echo "<script>window.alert('Data sudah ada');window.location.href = '". baseUrl("/tambah.php") ."';</script>";
        exit();
    }
}


function hapusData() {
    global $db;

    $npm = $_GET["npm"];

    // Cek NPM mahasiswa
    $query = mysqli_query($db, "DELETE FROM mahasiswa WHERE npm='". $npm ."'");

    if ($query) {
        echo "<script>window.alert('Data berhasil di hapus!');window.location.href = '". baseUrl("") ."';</script>";
        exit();
    } else {
        echo "<script>window.alert('Data tidak ada');window.location.href = '". baseUrl("") ."';</script>";
        exit();
    }
}


function getSingleDataByNPM() {
    global $db;

    // set header content-type to application/json
    header('Content-Type: application/json; charset=utf-8');

    $npm = $_GET["npm"];

    $query = mysqli_query($db, "SELECT * FROM mahasiswa WHERE npm = '". $npm . "'");

    echo json_encode(mysqli_fetch_object($query));
    exit();
}


function updateData() {
    global $db;

    // Menerima data dari request
    $npm = $_POST["npm"];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $jurusan = $_POST["jurusan"];
    $nohp = $_POST["nohp"];

    // Cek NPM mahasiswa
    $cek_npm = mysqli_query($db, "SELECT * FROM mahasiswa WHERE npm='". $npm ."'");

    if ($cek_npm->num_rows === 0) {
        $query = mysqli_query($db, "UPDATE mahasiswa SET nama='". $nama ."',kelas='". $kelas ."',jurusan='". $jurusan ."',nohp='". $nohp ."' WHERE npm='". $npm ."'");

        if ($query) {
            echo "<script>window.alert('Data berhasil di update');window.location.href = '". baseUrl("") ."';</script>";
            exit();
        } else {
            echo "<script>window.alert('Data gagal di update');window.location.href = '". baseUrl("/edit.php?npm=". $npm) ."';</script>";
            exit();
        }
    } else {
        echo "<script>window.alert('Data tidak ada');window.location.href = '". baseUrl("/edit.php?npm=". $npm) ."';</script>";
        exit();
    }

    // echo json_encode([
    //     "npm" => $npm,
    //     "nama" => $nama,
    //     "kelas" => $kelas,
    //     "jurusan" => $jurusan,
    //     "nohp" => $nohp
    // ]);
    exit();
}

?>