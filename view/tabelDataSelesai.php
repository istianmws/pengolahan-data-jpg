<?PHP

include "dbconnect.php";
print_r($_POST);
if (isset($_POST['cariData'])) {
    // Ambil data dari form
    $daerahPetugas = $_POST['daerahPetugas'];
    $namaPetugas = $_POST['namaPetugas'];

    if ($daerahPetugas == "Pilih Daerah" && $namaPetugas == "Pilih Nama") {
        $querycari = "WHERE daerahpetugas != '$daerahPetugas' AND namapetugas != '$namaPetugas'";
    } elseif ($daerahPetugas != "Pilih Daerah" && $namaPetugas == "Pilih Nama") {
        $querycari = "WHERE daerahpetugas = '$daerahPetugas'";
    } elseif ($daerahPetugas == "Pilih Daerah" && $namaPetugas != "Pilih Nama") {
        $querycari = "WHERE namapetugas = '$namaPetugas'";
    } else {
        $querycari = "WHERE namapetugas = '$namaPetugas' AND daerahpetugas = '$daerahPetugas'";
    }

    // Range Tnggal
    $mindate = $_POST['mindate'];
    $maxdate = $_POST['maxdate'];
    if ($mindate == "" && $maxdate == "") {
        $querycari = $querycari;
    } elseif ($mindate == "" && $maxdate != "") {
        $querycari = "$querycari AND tanggalsetor <= '$maxdate'";
    } elseif ($maxdate == "" && $mindate != "") {
        $querycari = "$querycari AND tanggalsetor >= '$mindate'";
    } else {
        $querycari = "$querycari AND tanggalsetor >= '$mindate' AND tanggalsetor <= '$maxdate'";
    }
    print_r($querycari);
} else {
    $querycari = "";
}
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Selesai</h6>
    </div>
    <div class="card-body">
        <form class="row g-3 mb-3" action="index.php" method="POST">
            <div class="col-md-2">
                <!-- <label for="daerahPetugas" class="form-label">Daerah Pertugas</label> -->
                <select id="daerahPetugas" class="form-select" name="daerahPetugas">
                    <option>Pilih Daerah</option>
                    <option>Kabupaten Magelang</option>
                    <option>Kota Magelang</option>
                    <option>Kabupaten Temanggung</option>
                    <option>Kabupaten Boyolali</option>
                    <option>Kota Surakarta</option>

                </select>
            </div>
            <div class="col-md-2">
                <!-- <label for="namaPetugas" class="form-label">Nama Pertugas</label> -->
                <select id="namaPetugas" class="form-select" name="namaPetugas">
                    <option>Pilih Nama</option>
                    <option>Dika</option>
                    <option>Yoyok</option>
                    <option>Puji</option>
                    <option>Dwi</option>
                    <option>dkk</option>

                </select>
            </div>

            <div class="col-md-1">
                <label for="min" class="form-label mt-2 ml-2">Dari</label>
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" id="min" name="mindate" placeholder="mindate">
            </div>

            <div class="col-md-1">
                <label for="min" class="form-label mt-2 ml-2">Sampai</label>
            </div>
            <div class="col-md-2">
                <!-- <label for="max" class="form-label">Tanggal Akhir</label> -->
                <input type="date" class="form-control" id="max" name="maxdate">
            </div>

            <div class="col-md-2">
                <button id="cariData" name="cariData" type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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