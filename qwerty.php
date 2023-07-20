<?php include "dbconnect.php";
include "navbar.php";

if (isset($_POST['cariData'])) {
    // Ambil data dari form
    $daerahPetugas = $_POST['daerahPetugas'];
    $namaPetugas = $_POST['namaPetugas'];

    if ($daerahPetugas == "Pilih Daerah") {
        $querycari = "WHERE namapetugas = '$namaPetugas'";
    } elseif ($namaPetugas == "Pilih Nama") {
        $querycari = "WHERE daerahpetugas = '$daerahPetugas'";
    } else {
        $querycari = "WHERE namapetugas = '$namaPetugas' AND daerahpetugas = '$daerahPetugas'";
    }
} else {
    $querycari = "";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="style.css">

    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script defer src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script defer src="scrip.js"></script>
</head>

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table</h6>
        </div>
        <div class="card-body">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Minimum date:</td>
                        <td><input type="text" id="min" name="min"></td>
                    </tr>
                    <tr>
                        <td>Maximum date:</td>
                        <td><input type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            <form class="row g-3 mb-3" action="qwerty.php" method="POST">
                <div class="col-md-4">
                    <!-- <label for="daerahPetugas" class="form-label">Daerah Pertugas</label> -->
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
                    <!-- <label for="namaPetugas" class="form-label">Nama Pertugas</label> -->
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
                    <button id="cariData" name="cariData" type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tgl</th>
                            <th>DM</th>
                            <th>DJ</th>
                            <th>RB</th>
                            <th>HI</th>
                            <th>MD</th>
                            <th>MU</th>
                            <th>DR</th>
                            <th>TDA</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Jumlah</th>
                            <?php
                            $query = "SELECT SUM(dimiliki) AS totalDataDimiliki, 
                            SUM(dijual) AS totalDataDijual, 
                            SUM(rusak) AS totalDataRusak, 
                            SUM(hilang) AS totalDataHilang, 
                            SUM(meninggal) AS totalDataMeninggal, 
                            SUM(pailit) AS totalDataPailit, 
                            SUM(dicabut) AS totalDataDicabutRegistrasinya, 
                            SUM(tidakdiketahu) AS totalDataTidakDiketahui FROM dataselesai $querycari";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);

                            $totalDataDimiliki = $row['totalDataDimiliki'];
                            $totalDataDijual = $row['totalDataDijual'];
                            $totalDataRusak = $row['totalDataRusak'];
                            $totalDataHilang = $row['totalDataHilang'];
                            $totalDataMeninggal = $row['totalDataMeninggal'];
                            $totalDataPailit = $row['totalDataPailit'];
                            $totalDataDicabutRegistrasinya = $row['totalDataDicabutRegistrasinya'];
                            $totalDataTidakDiketahui = $row['totalDataTidakDiketahui'];
                            ?>

                            <th><?php echo $totalDataDimiliki; ?></th>
                            <th><?php echo $totalDataDijual; ?></th>
                            <th><?php echo $totalDataRusak; ?></th>
                            <th><?php echo $totalDataHilang; ?></th>
                            <th><?php echo $totalDataMeninggal; ?></th>
                            <th><?php echo $totalDataPailit; ?></th>
                            <th><?php echo $totalDataDicabutRegistrasinya; ?></th>
                            <th><?php echo $totalDataTidakDiketahui; ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM dataselesai $querycari";
                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['namapetugas'] . "</td>";
                            echo "<td>" . $row['tanggalsetor'] . "</td>";
                            echo "<td>" . $row['dimiliki'] . "</td>";
                            echo "<td>" . $row['dijual'] . "</td>";
                            echo "<td>" . $row['rusak'] . "</td>";
                            echo "<td>" . $row['hilang'] . "</td>";
                            echo "<td>" . $row['meninggal'] . "</td>";
                            echo "<td>" . $row['pailit'] . "</td>";
                            echo "<td>" . $row['dicabut'] . "</td>";
                            echo "<td>" . $row['tidakdiketahu'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


</body>

</html>