<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analisa - DATA MINING METODE KNN</title>
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
                <h1 class="card-title">Analisa</h1>
                <?php if (empty($_GET['nilai_k'])) { ?>
                <!-- Analisa Form -->
                <form action="" method="GET" enctype="multipart/form-data">
                    <div class="form-group mb-4">
                        <label for="nilai_k">Nilai K</label>
                        <input type="number" name="nilai_k" id="nilai_k" class="form-control"
                            placeholder="Masukkan Nilai K" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="tipe_data">Data Uji</label>
                        <select name="tipe_data" id="tipe_data" class="form-control" required>
                            <option selected disabled>Pilih</option>
                            <?php
                                    $query = "SELECT DISTINCT tipe_data, ket_data FROM tbl_dataset WHERE ket_data='Data Uji'";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $tipe_data, $ket_data);
                                    while (mysqli_stmt_fetch($stmt)) {
                                        echo "<option value='" . htmlspecialchars($tipe_data) . "'>" . htmlspecialchars($tipe_data) . " - (" . htmlspecialchars($ket_data) . ")</option>";
                                    }
                                    mysqli_stmt_close($stmt);
                                    ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Proses Analisa</button>
                </form>
                <?php } else { ?>
                <!-- Hasil Analisa -->
                <div class="alert alert-primary mt-4" role="alert">
                    <i class="bi bi-check-square"></i>&emsp; Hasil Analisa K-Nearest Neighbor
                </div>

                <!-- Tabel Data Latih -->
                <h4 class="mt-4">Data Latih</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Data</th>
                                <?php
                                        $query = "SELECT * FROM tbl_atribut ORDER BY id_atribut";
                                        $data = mysqli_query($conn, $query);
                                        while ($a = mysqli_fetch_array($data)) {
                                            echo "<th class='text-center'>" . htmlspecialchars($a['nm_atribut']) . "</th>";
                                        }
                                        ?>
                                <th class="text-center">Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $query = "SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset WHERE ket_data='Data Latih' ORDER BY id_atribut";
                                    $data = mysqli_query($conn, $query);
                                    $no = 1;
                                    while ($a = mysqli_fetch_array($data)) {
                                        $nm_data = htmlspecialchars($a['tipe_data']);
                                        echo "<tr>";
                                        echo "<td class='text-center'>$no</td>";
                                        echo "<td class='text-center'>$nm_data</td>";

                                        // Fetch attribute values
                                        $query_values = "SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a WHERE d.id_atribut=a.id_atribut AND d.tipe_data='$nm_data' ORDER BY a.id_atribut";
                                        $stmt_values = mysqli_prepare($conn, $query_values);
                                        mysqli_stmt_execute($stmt_values);
                                        mysqli_stmt_bind_result($stmt_values, $nilai_set);
                                        while (mysqli_stmt_fetch($stmt_values)) {
                                            echo "<td class='text-center'>" . htmlspecialchars($nilai_set) . "</td>";
                                        }
                                        mysqli_stmt_close($stmt_values);

                                        // Fetch class name
                                        $query_class = "SELECT * FROM tbl_class WHERE id_class=?";
                                        $stmt_class = mysqli_prepare($conn, $query_class);
                                        mysqli_stmt_bind_param($stmt_class, "i", $a['id_class']);
                                        mysqli_stmt_execute($stmt_class);
                                        mysqli_stmt_bind_result($stmt_class, $id_class, $nm_class);
                                        mysqli_stmt_fetch($stmt_class);
                                        mysqli_stmt_close($stmt_class);
                                        echo "<td class='text-center'>" . htmlspecialchars($nm_class) . "</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                    ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tabel Data Uji -->
                <h4 class="mt-4">Data Uji</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Data</th>
                                <?php
                                        $query = "SELECT * FROM tbl_atribut ORDER BY id_atribut";
                                        $data = mysqli_query($conn, $query);
                                        while ($a = mysqli_fetch_array($data)) {
                                            echo "<th class='text-center'>" . htmlspecialchars($a['nm_atribut']) . "</th>";
                                        }
                                        ?>
                                <th class="text-center">Class Actual</th>
                                <th class="text-center">Class Analisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $query = "SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset WHERE ket_data='Data Uji' ORDER BY id_atribut";
                                    $data = mysqli_query($conn, $query);
                                    $no = 1;
                                    while ($a = mysqli_fetch_array($data)) {
                                        $nm_data = htmlspecialchars($a['tipe_data']);
                                        echo "<tr>";
                                        echo "<td class='text-center'>$no</td>";
                                        echo "<td class='text-center'>$nm_data</td>";

                                        // Fetch attribute values
                                        $query_values = "SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a WHERE d.id_atribut=a.id_atribut AND d.tipe_data='$nm_data' ORDER BY a.id_atribut";
                                        $stmt_values = mysqli_prepare($conn, $query_values);
                                        mysqli_stmt_execute($stmt_values);
                                        mysqli_stmt_bind_result($stmt_values, $nilai_set);
                                        while (mysqli_stmt_fetch($stmt_values)) {
                                            echo "<td class='text-center'>" . htmlspecialchars($nilai_set) . "</td>";
                                        }
                                        mysqli_stmt_close($stmt_values);

                                        // Fetch actual class name
                                        $query_class = "SELECT * FROM tbl_class WHERE id_class=?";
                                        $stmt_class = mysqli_prepare($conn, $query_class);
                                        mysqli_stmt_bind_param($stmt_class, "i", $a['id_class']);
                                        mysqli_stmt_execute($stmt_class);
                                        mysqli_stmt_bind_result($stmt_class, $id_class, $nm_class);
                                        mysqli_stmt_fetch($stmt_class);
                                        mysqli_stmt_close($stmt_class);
                                        echo "<td class='text-center'>" . htmlspecialchars($nm_class) . "</td>";

                                        // Fetch analyzed class name
                                        $query_analyzed = "SELECT * FROM tbl_hasil WHERE tipe_data=?";
                                        $stmt_analyzed = mysqli_prepare($conn, $query_analyzed);
                                        mysqli_stmt_bind_param($stmt_analyzed, "s", $nm_data);
                                        mysqli_stmt_execute($stmt_analyzed);
                                        mysqli_stmt_bind_result($stmt_analyzed, $id_hasil, $tipe_data, $id_class_knn, $nilai_k);
                                        mysqli_stmt_fetch($stmt_analyzed);
                                        mysqli_stmt_close($stmt_analyzed);

                                        $query_class_knn = "SELECT * FROM tbl_class WHERE id_class=?";
                                        $stmt_class_knn = mysqli_prepare($conn, $query_class_knn);
                                        mysqli_stmt_bind_param($stmt_class_knn, "i", $id_class_knn);
                                        mysqli_stmt_execute($stmt_class_knn);
                                        mysqli_stmt_bind_result($stmt_class_knn, $id_class_knn, $nm_class_knn);
                                        mysqli_stmt_fetch($stmt_class_knn);
                                        mysqli_stmt_close($stmt_class_knn);
                                        echo "<td class='text-center'>" . htmlspecialchars($nm_class_knn) . "</td>";

                                        echo "</tr>";
                                        $no++;
                                    }
                                    ?>
                        </tbody>
                    </table>
                </div>

                <!-- Hasil Klasifikasi -->
                <h4 class="mt-4">Hasil Klasifikasi</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Rangking</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Distance</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Klasifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    // Your code for classification results goes here...
                                    ?>
                        </tbody>
                    </table>
                </div>

                <!-- Summary of Most Frequently Classified Class -->
                <div class="mt-4">
                    <div class="border p-3">
                        <p>Berdasarkan K=<?= $_GET['nilai_k'] ?>, jumlah kemunculan setiap class dengan klasifikasi
                            (YA):</p>
                        <?php
                                // Your code for summary goes here...
                                ?>
                        <p>Jumlah class yang paling banyak muncul dengan klasifikasi (YA):
                            <b><?= htmlspecialchars($nm_class) ?></b> dengan jumlah: <b>($max_count)</b>. Sehingga dapat
                            disimpulkan untuk data (<?= $_GET['tipe_data'] ?>) dengan kasus yang telah ditentukan class
                            (YA) adalah <b><?= htmlspecialchars($nm_class) ?></b>.</p>
                    </div>

                    <!-- Insert or Update Result -->
                    <?php
                            // Your code for inserting or updating result goes here...
                            ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php include 'footer.php'; ?>