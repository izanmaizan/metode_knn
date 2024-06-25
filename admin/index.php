<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Welcome to Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to right, #f0f8ff, #a6c1ee);
        font-family: 'Arial', sans-serif;
        padding-top: 70px;
        /* Untuk memastikan konten tidak tertutup oleh navbar */
    }

    .main-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 70px);
    }

    .card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card h1 {
        color: #007BFF;
        margin-bottom: 20px;
    }

    .card h4 {
        color: #555;
    }

    .separator {
        margin: 20px 0;
        border-top: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <div class="container main-content">
        <div class="card text-center">
            <h1>WELCOME TO HOME</h1>
            <div class="separator"></div>
            <h4>Nama: FOFY HIDAYAH</h4>
            <h4>No.Bp: 21101152610284</h4>
            <h4>Jurusan: SISTEM INFORMASI</h4>
            <div class="separator"></div>
            <h4>Nama: JUMELIA HANIFA PUTRI</h4>
            <h4>No.Bp: 21101152610290</h4>
            <h4>Jurusan: SISTEM INFORMASI</h4>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include 'footer.php';
?>