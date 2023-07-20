<?php
session_start();
include_once "utility/navbar.php";
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    INI ADALAH HALAMAN INPUT DATA SELESAI
</nav>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Harap input dengan benar</h1>
    <p class="mb-4">Pastikan semua data yang di-input sesaui dengan data lapangan yang selesai dikerjakan untuk validitas data</p>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">

            <!-- Form Inpt Data Selesai -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Input Data Selesai</h6>
                </div>

                <div class="card-body">
                    <?php
                    if (isset($_SESSION['status'])) {
                        if ($_SESSION['status'] == "True") {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Data berhasil disimpan ke database.</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        } else {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Data gagal disimpan ke database.</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        }
                        unset($_SESSION['status']);
                    }
                    ?>
                    
                    <form class="row g-3" action="prosesSimpanDataSelesai.php" method="POST">
                        <div class="col-md-4">
                            <label for="daerahPetugas" class="form-label">Daerah Pertugas</label>
                            <select id="daerahPetugas" class="form-select" name="daerahPetugas">
                                <option selected>Pilih Daerah</option>
                                <option>Kabupaten Magelang</option>
                                <option>Kota Magelang</option>
                                <option>Kabupaten Temanggung</option>
                                <option>Kabupaten Boyolali</option>
                                <option>Kota Surakarta</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="namaPetugas" class="form-label">Nama Pertugas</label>
                            <select id="namaPetugas" class="form-select" name="namaPetugas">
                                <option selected>Pilih Nama</option>
                                <option>Dika</option>
                                <option>Yoyok</option>
                                <option>Puji</option>
                                <option>Dwi</option>
                                <option>dkk</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputTanggal" class="form-label">Tanggal Setor</label>
                            <input type="date" class="form-control" id="inputTanggal" name="inputTanggal">
                        </div>
                        <div class="col-md-3">
                            <label for="inputDimiliki" class="form-label">Data Dimiliki</label>
                            <input type="number" class="form-control" id="inputDimiliki" name="inputDimiliki" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label for="inputDijual" class="form-label">Data Dijual</label>
                            <input type="number" class="form-control" id="inputDijual" name="inputDijual" placeholder="">
                        </div>
                        <div class="col-md-3">
                            <label for="inputRusak" class="form-label">Data Rusak</label>
                            <input type="number" class="form-control" id="inputRusak" name="inputRusak" placeholder="0">
                        </div>
                        <div class="col-md-3">
                            <label for="inputHilang" class="form-label">Data Hilang</label>
                            <input type="number" class="form-control" id="inputHilang" name="inputHilang" placeholder="0">
                        </div>
                        <div class="col-md-3">

                            <label for="inputMeninggal" class="form-label">Data Meninggal</label>
                            <input type="number" class="form-control" id="inputMeninggal" name="inputMeninggal" placeholder="0">
                        </div>
                        <div class="col-md-3">

                            <label for="inputPailit" class="form-label">Data Pailit</label>
                            <input type="number" class="form-control" id="inputPailit" name="inputPailit" placeholder="0">
                        </div>
                        <div class="col-md-3">

                            <label for="inputDicabutRegistrasinya" class="form-label">Data DicabutRegistrasinya</label>
                            <input type="number" class="form-control" id="inputDicabutRegistrasinya" name="inputDicabutRegistrasinya" placeholder="0">
                        </div>
                        <div class="col-md-3">

                            <label for="inputTidakDiketaui" class="form-label">Data TidakDiketaui</label>
                            <input type="number" class="form-control" id="inputTidakDiketaui" name="inputTidakDiketaui">
                        </div>
                        <div class="col-md-6">
                            <label for="petugasValidator" class="form-label">Petugas Validator</label>
                            <select id="petugasValidator" class="form-select" name="petugasValidator">
                                <option selected>Pilih Validator</option>
                                <option>Cantika</option>
                                <option>Putri</option>
                                <option>Annisa</option>

                            </select>
                        </div>
                        <div class="col-md-7">
                            <button id="simpanData" name="simpanData" type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>

</div>
<!-- End of Topbar -->
<?php

include "utility/footer.php";
?>