<?php
include '../assets/conn/config.php';

// Proses simpan, ubah, dan hapus atribut
if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'simpan') {
    $nm_atribut = $_POST['nm_atribut'];
    mysqli_query($conn, "INSERT INTO tbl_atribut (nm_atribut) VALUES ('$nm_atribut')");
    header("location:atribut.php");
    exit();
  } elseif ($_GET['aksi'] == 'ubah') {
    $id_atribut = $_POST['id_atribut'];
    $nm_atribut = $_POST['nm_atribut'];
    mysqli_query($conn, "UPDATE tbl_atribut SET nm_atribut='$nm_atribut' WHERE id_atribut='$id_atribut'");
    header("location:atribut.php");
    exit();
  } elseif ($_GET['aksi'] == 'hapus') {
    $id_atribut = $_GET['id_atribut'];
    mysqli_query($conn, "DELETE FROM tbl_atribut WHERE id_atribut='$id_atribut'");
    header("location:atribut.php");
    exit();
  }
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribut - DATA MINING METODE KNN</title>
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
        max-width: 800px;
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

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #545b62;
        border-color: #545b62;
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

    .breadcrumb {
        opacity: 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                <h1 class="card-title text-center mb-4">Atribut</h1> <!-- Tambahkan judul di sini -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Atribut</li>
                    </ol>
                </nav>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-plus-square"></i> &emsp; Tambah Data
                </button>
                <hr>

                <!-- Modal Simpan -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="atribut.php?aksi=simpan" method="POST">
                                    <div class="form-group mb-4">
                                        <label for="nm_atribut">Nama Atribut</label>
                                        <input type="text" name="nm_atribut" id="nm_atribut" class="form-control"
                                            required>
                                    </div>
                                    <hr>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Atribut</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $data = mysqli_query($conn, "SELECT * FROM tbl_atribut ORDER BY id_atribut");
              $no = 1;
              while ($a = mysqli_fetch_array($data)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $a['nm_atribut'] ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleUbah<?= $a['id_atribut'] ?>"><i
                                            class="bi bi-pencil"></i></button>
                                    <a href="atribut.php?id_atribut=<?= $a['id_atribut'] ?>&aksi=hapus"
                                        class="btn btn-secondary"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Modal Ubah -->
                            <div class="modal fade" id="exampleUbah<?= $a['id_atribut'] ?>" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="atribut.php?aksi=ubah" method="POST">
                                                <input type="hidden" name="id_atribut" value="<?= $a['id_atribut'] ?>">
                                                <div class="form-group mb-4">
                                                    <label for="nm_atribut">Nama Atribut</label>
                                                    <input type="text" name="nm_atribut" id="nm_atribut"
                                                        class="form-control" value="<?= $a['nm_atribut'] ?>" required>
                                                </div>
                                                <hr>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>
                        </tbody>
                    </table>
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