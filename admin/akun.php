<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='ubah') {
        $id_akun = $_POST['id_akun'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $username = $_POST['username'];
        $password = $_POST['password'];

       $cek = mysqli_query($conn, "UPDATE tbl_akun SET nama_lengkap='$nama_lengkap', username='$username', password='$password' WHERE id_akun='$id_akun'");

       if ($cek) {
          header("location:akun.php?aksi=berhasil");
       }else{
        header("location:akun.php?aksi=gagal");
       }
        
    }

}
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <?php
    if (isset($_GET['aksi'])) {
        if($_GET['aksi']=='berhasil') {
            echo '<div class="alert alert-primary" role="alert">
            <i class="bi bi-check-square"></i>&emsp; Data berhasil diubah
            </div>';
        }
        if($_GET['aksi']=='gagal') {
            echo '<div class="alert alert-danger" role="alert">
            <i class="bi bi-check-square"></i>&emsp; Data gagal diubah
            </div>';
        }
    }
    ?>
    <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Akun</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body p-5">
            <?php
            $data = mysqli_query($conn,"SELECT * FROM tbl_akun WHERE username='".$_SESSION['username']."'");
            $a = mysqli_fetch_array($data);
            ?>
            <form action="akun.php?aksi=ubah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_akun" value="<?= $a['id_akun'] ?>">
                <div class="from-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $a['nama_lengkap'] ?>">
                </div>
                <div class="from-group mt-4">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $a['username'] ?>">
                </div>
                <div class="from-group mt-4">
                    <label>Password</label>
                    <input type="text" name="password" class="form-control" value="<?= $a['password'] ?>">
                </div>
                <hr>

                <a href="index.php" class="btn btn-primary">Batal</a>
                <input type="submit" class="btn btn-secondary" value="Ubah">
            </form>
        </div>
    </div>        
</div>

<?php
include 'footer.php';
?>