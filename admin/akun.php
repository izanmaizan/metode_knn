<?php
include '../assets/conn/config.php';

// Proses perubahan data akun
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ubah') {
    $id_akun = $_POST['id_akun'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "UPDATE tbl_akun SET nama_lengkap='$nama_lengkap', username='$username', password='$password' WHERE id_akun='$id_akun'");

    if ($cek) {
        header("location:akun.php?aksi=berhasil");
        exit;
    } else {
        header("location:akun.php?aksi=gagal");
        exit;
    }
}

include 'header.php';

// Ambil data akun dari database
$data = mysqli_query($conn, "SELECT * FROM tbl_akun WHERE username='" . $_SESSION['username'] . "'");
$a = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ubah Akun - DATA MINING METODE KNN</title>
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
        max-width: 400px;
    }

    .card h1 {
        color: #007bff;
        margin-bottom: 20px;
    }

    .card h4 {
        color: #555;
    }

    .form-control {
        border-color: #007bff;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-cancel {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-cancel:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1 class="text-center">Ubah Profil</h1>
            <?php
            if (isset($_GET['aksi'])) {
                if ($_GET['aksi'] == 'berhasil') {
                    echo '<div class="alert alert-primary" role="alert">
                            <i class="bi bi-check-square"></i>&emsp; Data berhasil diubah
                          </div>';
                }
                if ($_GET['aksi'] == 'gagal') {
                    echo '<div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-triangle"></i>&emsp; Data gagal diubah
                          </div>';
                }
            }
            ?>
            <form action="akun.php?aksi=ubah" method="POST">
                <input type="hidden" name="id_akun" value="<?= $a['id_akun'] ?>">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                        value="<?= $a['nama_lengkap'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $a['username'] ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        value="<?= $a['password'] ?>" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-cancel btn-block text-white">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include 'footer.php';
?>