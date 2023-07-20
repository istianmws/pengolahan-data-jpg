<?php
include "utility/navbar.php";

?>
<!-- Begin Page Content -->
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    INI ADALAH HALAMAN DASHBOARD
</nav>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Ringkasan Data Tiap Daerah</h1>
    <p class="mb-4">Pastikan semua data yang di-input sesaui dengan data lapangan untuk validitas data</p>

    <!-- Ringkasan Daerah -->
    <?php
    include 'view/ringkasanData.php';
    include 'view/tabelDataSelesai.php';
    ?>

    <!-- Data Table  -->

</div>
<?php
include "utility/footer.php";
