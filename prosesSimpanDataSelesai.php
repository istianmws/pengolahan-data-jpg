<?php
include "dbconnect.php";
session_start();

if(isset($_POST['simpanData'])) {
    // Ambil data dari form
    $daerahPetugas = $_POST['daerahPetugas'];
    $namaPetugas = $_POST['namaPetugas'];
    $tanggalSetor = $_POST['inputTanggal'];
    $dataDimiliki = $_POST['inputDimiliki'];
    $dataDijual = $_POST['inputDijual'];
    $dataRusak = $_POST['inputRusak'];
    $dataHilang = $_POST['inputHilang'];
    $dataMeninggal = $_POST['inputMeninggal'];
    $dataPailit = $_POST['inputPailit'];
    $dataDicabutRegistrasinya = $_POST['inputDicabutRegistrasinya'];
    $dataTidakDiketahui = $_POST['inputTidakDiketaui'];
    $petugasValidator = $_POST['petugasValidator'];

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO dataselesai VALUES ('$daerahPetugas', '$namaPetugas', '$tanggalSetor', '$dataDimiliki', '$dataDijual', '$dataRusak', '$dataHilang', '$dataMeninggal', '$dataPailit', '$dataDicabutRegistrasinya', '$dataTidakDiketahui', '$petugasValidator', '')";

    // Eksekusi query
    if(mysqli_query($conn, $query)) {
        echo "Data berhasil disimpan ke database.";
        $_SESSION['status'] = "True";
        header("Location: inputDataSelesai.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        $_SESSION['status'] = "False";
        header("Location: inputDataSelesai.php");
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
