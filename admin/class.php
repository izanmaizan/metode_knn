<?php 
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='simpan') {
        $nm_class = $_POST['nm_class'];
        mysqli_query($conn,"INSERT INTO tbl_class (nm_class)VALUES('$nm_class')");
        header("location:class.php");

    }elseif ($_GET['aksi']=='ubah') {
        $id_class = $_POST['id_class'];
        $nm_class = $_POST['nm_class'];
        mysqli_query($conn,"UPDATE tbl_class SET nm_class='$nm_atribut' WHERE id_class='$id_class'");
        header("location:class.php");

    }elseif ($_GET['aksi']=='hapus') {
        $id_class = $_GET['id_class'];
        mysqli_query($conn, "DELETE FROM tbl_class WHERE id_class='$id_class'");
        header("location:class.php");
    }
}

include 'header.php';
?>

<div class="container">
    <br><br><br>
    <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Class</li>
        </ol>
    </nav>

<div class="card">
  <div class="card-body p-5">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
<i class="bi bi-plus-square"></i> &emsp; Tambah Data
</button>
<hr>

<!-- Modal Simpan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="class.php?aksi=simpan" method="POST" enctype="multipart/form-data">
        <div class="from-group mb-4">
            <labe>Nama Class</label>
            <input type="text" name="nm_class" class="form-control">
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
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Class</th>
            <th class="text-center">Aksi</th>
        </tr>

        <?php
        $data = mysqli_query($conn,"SELECT * FROM tbl_class ORDER BY id_class");
        $no=1;
        while($a = mysqli_fetch_array($data)){ ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $a['nm_class'] ?></td>
            <td class="text-center">
                <a data-bs-toggle="modal" data-bs-target="#exampleUbah<?= $a['id_class']?>" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                <a href="class.php?id_class=<?= $a['id_class']?>&aksi=hapus" class="btn btn-secondary"><i class="bi bi-trash"></i></a>
            </td>
        </tr>


<!-- Modal Ubah -->
<div class="modal fade" id="exampleUbah<?= $a['id_class'] ?>" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        $det = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$a[id_class]'"); 
        $b=mysqli_fetch_array($det);?>
        <form action="class.php?aksi=ubah" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_class" value="<?= $b['id_class']?>">
        <div class="from-group mb-4">
            <labe>Nama Class</label>
            <input type="text" name="nm_class" class="form-control" value="<?= $b['nm_class']?>">
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
    </table>
</div>

  </div>
</div>
</div>

<?php
include 'footer.php';
?>