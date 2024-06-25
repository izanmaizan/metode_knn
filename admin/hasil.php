<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    mysqli_query($conn, "DELETE FROM tbl_hasil WHERE id_hasil='$_GET[id_hasil]'");
    header("location:hasil.php");
    exit;
}

include 'header.php';
?>

<div class="container">
    <br><br><br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Hasil</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body p-5">
            <button class="btn btn-primary mb-3" onclick="openPrintWindow()"><i class="bi bi-file-earmark-pdf"></i>
                Cetak PDF</button>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Class Actual</th>
                        <th class="text-center">Class Forecast</th>
                        <th class="text-center">Nilai K</th>
                        <th class="text-center">Error</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                    <?php
                    $data = mysqli_query($conn, "SELECT * FROM tbl_hasil a, tbl_class c WHERE a.id_class_knn=c.id_class ORDER BY id_hasil");
                    $no = 1;
                    while ($a = mysqli_fetch_array($data)) {
                        $dt = mysqli_query($conn, "SELECT * FROM tbl_dataset a, tbl_class c WHERE a.id_class=c.id_class AND a.tipe_data='$a[tipe_data]' AND ket_data='Data Uji'");
                        $d = mysqli_fetch_array($dt);

                        if ($d['nm_class'] == $a['nm_class']) {
                            $error = 'Valid';
                        } else {
                            $error = 'Invalid';
                        }
                        ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $a['tipe_data'] ?></td>
                        <td class="text-center"><?= $d['nm_class'] ?></td>
                        <td class="text-center"><?= $a['nm_class'] ?></td>
                        <td class="text-center"><?= $a['nilai_k'] ?></td>
                        <td class="text-center"><?= $error ?></td>
                        <td class="text-center">
                            <a href="hasil.php?id_hasil=<?= $a['id_hasil'] ?>&aksi=hapus" class="btn btn-secondary"><i
                                    class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function openPrintWindow() {
    window.open('print_hasil.php', '_blank', 'width=800,height=600');
}
</script>

<?php
include 'footer.php';
?>