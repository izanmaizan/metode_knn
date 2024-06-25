<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../assets/conn/config.php';
include '../assets/conn/cek.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATA MINING METODE KNN</title>
    <!--CDN CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--CDN ICON Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background-color: #f0f8ff;
        font-family: 'Arial', sans-serif;
        padding-top: 70px;
        /* Untuk memastikan konten tidak tertutup oleh navbar */
    }

    .navbar-brand {
        font-weight: bold;
        color: #007BFF;
    }

    .navbar-brand:hover {
        color: #0056b3;
    }

    .offcanvas-header {
        background-color: #007BFF;
        color: white;
    }

    .offcanvas-body {
        background-color: #e9ecef;
    }

    .nav-link {
        color: #007BFF;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #0056b3;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">METODE DATA MINING K-NEAREST NEIGHBOR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <?php
                    $username = $_SESSION['username'];
                    $data = mysqli_query($conn, "SELECT * FROM tbl_akun WHERE username='$username'");
                    $a = mysqli_fetch_array($data);
                    ?>
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?= $a['nama_lengkap'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="bi bi-house"></i> &emsp;Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="akun.php"><i class="bi bi-person-gear"></i> &emsp;Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data_set.php"><i class="bi bi-filetype-csv"></i> &emsp;Data
                                Set</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="setting.php"><i class="bi bi-gear"></i> &emsp;Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="atribut.php"><i class="bi bi-journal-text"></i> &emsp;Atribut</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="class.php"><i class="bi bi-card-list"></i> &emsp;Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="analisa.php"><i class="bi bi-rocket"></i> &emsp;Analisa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="hasil.php"><i class="bi bi-printer"></i> &emsp;Hasil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="bi bi-power"></i> &emsp;Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>