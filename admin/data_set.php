<?php
include '../assets/conn/config.php';

// Proses upload data set
if (isset($_POST['upload'])) {
    // Cek apakah ada data sebelumnya, jika ada hapus data lama
    $data = mysqli_query($conn, "SELECT * FROM tbl_dataset");
    $num_rows = mysqli_num_rows($data);

    if ($num_rows > 0) {
        mysqli_query($conn, "TRUNCATE TABLE tbl_dataset");
    }

    // Simpan data baru dari file CSV yang diunggah
    $file = $_FILES["file"];
    $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);

    if ($file_extension != "csv") {
        header("location:data_set.php?pesan=gagal");
        exit();
    }

    $csv_data = array_map(function ($line) {
        return str_getcsv($line, ';');
    }, file($file["tmp_name"]));

    foreach ($csv_data as $row) {
        mysqli_query($conn, "INSERT INTO tbl_dataset(tipe_data, id_atribut, nilai_set, id_class, ket_data) 
                           VALUES ('" . $row[0] . "', '" . $row[1] . "', '" . $row[2] . "', '" . $row[3] . "', '" . $row[4] . "')");
    }

    header("location:data_set.php?pesan=berhasil");
    exit();
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Set - DATA MINING METODE KNN</title>
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
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 100vw;
    }

    .card-title {
        color: #007bff;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .modal-title {
        color: #007bff;
    }

    .form-control {
        border-color: #007bff;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .alert {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == 'berhasil'): ?>
                <div class="alert alert-primary" role="alert">
                    <i class="bi bi-check-square"></i>&emsp; Data berhasil diupload
                </div>
                <?php elseif ($_GET['pesan'] == 'gagal'): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-square"></i>&emsp; Data gagal diupload
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <h1 class="card-title">Dataset</h1>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-upload"></i> &emsp; Upload Data
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Data</th>
                                <?php
                                $at = mysqli_query($conn, "SELECT * FROM tbl_atribut ORDER BY id_atribut");
                                while ($a = mysqli_fetch_array($at)) {
                                    echo "<th class='text-center'>$a[nm_atribut]</th>";
                                }
                                ?>
                                <th class="text-center">Class</th>
                                <th class="text-center">Tipe Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = mysqli_query($conn, "SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset ORDER BY id_atribut");
                            $no = 1;
                            while ($a = mysqli_fetch_array($data)) {
                                $nm_data = $a['tipe_data'];
                                ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $nm_data ?></td>
                                <?php
                                    $dt = mysqli_query($conn, "SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a  WHERE d.id_atribut=a.id_atribut  AND d.tipe_data='$nm_data' ORDER BY a.id_atribut");
                                    while ($td = mysqli_fetch_array($dt)) {
                                        echo "<td class='text-center'>$td[nilai_set]</td>";
                                    }
                                    $cls = mysqli_query($conn, "SELECT * FROM tbl_class WHERE id_class='$a[id_class]'");
                                    $s = mysqli_fetch_array($cls);
                                    echo "<td class='text-center'>$s[nm_class]</td>";
                                    echo "<td class='text-center'>$a[ket_data]</td>";
                                    ?>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Upload Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="data_set.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <label for="file" class="form-label">File CSV</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".csv" required>
                            <div class="form-text text-danger">*Upload file dengan format .csv</div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include 'footer.php';
?>