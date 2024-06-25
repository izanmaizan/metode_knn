<?php
include '../assets/conn/config.php';

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    mysqli_query($conn, "DELETE FROM tbl_hasil WHERE id_hasil='$_GET[id_hasil]'");
    header("location:hasil.php");
    exit;
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil - DATA MINING METODE KNN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background: linear-gradient(to right, #f0f8ff, #a6c1ee);
        font-family: 'Arial', sans-serif;
        padding-top: 70px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 70px);
    }

    .card {
        margin-top: 150px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 100vw;
    }

    .card-body {
        padding: 0;
    }

    .card-title {
        color: #007bff;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        padding: 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    /* Style untuk teks "Hasil" */
    .breadcrumb-item.active {
        color: #007bff;
        opacity: 0;
    }
    </style>
</head>

<body>
    <div class="container">

        <div class="card">
            <h1 class="card-title text-center mb-4">Hasil</h1> <!-- Tambahkan judul di sini -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Hasil</li>
                </ol>
            </nav>
            <div class="card-body p-5">
                <button class="btn btn-primary mb-3" onclick="openPrintWindow()"><i class="bi bi-file-earmark-pdf"></i>
                    Cetak PDF</button>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Class Actual</th>
                                <th class="text-center">Class Forecast</th>
                                <th class="text-center">Nilai K</th>
                                <th class="text-center">Error</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = mysqli_query($conn, "SELECT * FROM tbl_hasil a, tbl_class c WHERE a.id_class_knn=c.id_class ORDER BY id_hasil");
                            $no = 1;
                            while ($a = mysqli_fetch_array($data)) {
                                $dt = mysqli_query($conn, "SELECT * FROM tbl_dataset a, tbl_class c WHERE a.id_class=c.id_class AND a.tipe_data='$a[tipe_data]' AND ket_data='Data Uji'");
                                $d = mysqli_fetch_array($dt);

                                $error = ($d['nm_class'] == $a['nm_class']) ? 'Valid' : 'Invalid';
                                ?>
                            <tr>
                                <td class="text-center">
                                    <?= $no++ ?>
                                </td>
                                <td class="text-center">
                                    <?= htmlspecialchars($a['tipe_data']) ?>
                                </td>
                                <td class="text-center"><?= htmlspecialchars($d['nm_class']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($a['nm_class']) ?></td>
                                <td class="text-center">
                                    <?= htmlspecialchars($a['nilai_k']) ?>
                                </td>
                                <td class="text-center"><?= htmlspecialchars($error) ?></td>
                                <td class="text-center">
                                    <a href="hasil.php?id_hasil=<?= $a['id_hasil'] ?>&aksi=hapus"
                                        class="btn btn-secondary"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'footer.php'; ?>