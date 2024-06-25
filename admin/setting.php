<?php
include '../assets/conn/config.php';

// Proses update setting data latih dan data uji
if (isset($_GET['aksi']) && $_GET['aksi'] == 'setting') {
    // Mengambil nilai jumlah data latih dari form
    $jumlah_data_latih = isset($_POST['latih']) ? intval($_POST['latih']) : 0;

    // Mengambil semua tipe data yang ada dari tabel dataset
    $query = mysqli_query($conn, "SELECT DISTINCT tipe_data FROM tbl_dataset");

    if (mysqli_num_rows($query) > 0) {
        $index = 0;
        while ($row = mysqli_fetch_assoc($query)) {
            // Tentukan nilai untuk kolom "ket_data" berdasarkan jumlah data latih
            $nilai_ket_data = ($index < $jumlah_data_latih) ? "Data Latih" : "Data Uji";

            // Update nilai kolom "ket_data" berdasarkan tipe data
            mysqli_query($conn, "UPDATE tbl_dataset SET ket_data='$nilai_ket_data' WHERE tipe_data='{$row['tipe_data']}'");
            $index++;
        }
    }

    // Redirect dengan pesan berhasil
    header("location:setting.php?aksi=berhasil");
    exit();
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting - DATA MINING METODE KNN</title>
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
        margin-top: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <?php if (isset($_GET['aksi']) && $_GET['aksi'] == 'berhasil'): ?>
                <div class="alert alert-primary" role="alert">
                    <i class="bi bi-check-square"></i>&emsp; Data berhasil diubah
                </div>
                <?php endif; ?>
                <h1 class="card-title">Setting</h1>
                <form action="setting.php?aksi=setting" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="latih">Data Latih</label>
                        <input type="number" name="latih" id="latih" class="form-control" placeholder="0" required>
                        <div class="form-text text-danger">* Set nilai untuk memisahkan data latih dan data uji</div>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-primary">Batal</a>
                    <input type="submit" class="btn btn-secondary" value="Setting">
                </form>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include 'footer.php';
?>