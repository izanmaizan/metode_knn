<?php 
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='simpan') {
        $nm_atribut = $_POST['nm_atribut'];
        mysqli_query($conn,"INSERT INTO tbl_atribut (nm_atribut)VALUES('$nm_atribut')");
        header("location:atribut.php");

    }elseif ($_GET['aksi']=='ubah') {
        $id_atribut = $_POST['id_atribut'];
        $nm_atribut = $_POST['nm_atribut'];
        mysqli_query($conn,"UPDATE tbl_atribut SET nm_atribut='$nm_atribut' WHERE id_atribut='$id_atribut'");
        header("location:atribut.php");

    }elseif ($_GET['aksi']=='hapus') {
        $id_atribut = $_GET['id_atribut'];
        mysqli_query($conn, "DELETE FROM tbl_atribut WHERE id_atribut='$id_atribut'");
        header("location:atribut.php");
    }
}

include 'header.php';
?>

<div class="container">
    <br><br><br>
    <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Atribut</li>
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
        <form action="atribut.php?aksi=simpan" method="POST" enctype="multipart/form-data">
        <div class="from-group mb-4">
            <labe>Nama Atribut</label>
            <input type="text" name="nm_atribut" class="form-control">
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
            <th class="text-center">Atribut</th>
            <th class="text-center">Aksi</th>
        </tr>

        <?php
        $data = mysqli_query($conn,"SELECT * FROM tbl_atribut ORDER BY id_atribut");
        $no=1;
        while($a = mysqli_fetch_array($data)){ ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $a['nm_atribut'] ?></td>
            <td class="text-center">
                <a data-bs-toggle="modal" data-bs-target="#exampleUbah<?= $a['id_atribut'] ?>" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                <a href="atribut.php?id_atribut=<?= $a['id_atribut']?>&aksi=hapus" class="btn btn-secondary"><i class="bi bi-trash"></i></a>
            </td>
        </tr>


<!-- Modal Ubah -->
<div class="modal fade" id="exampleUbah<?= $a['id_atribut'] ?>" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        $det = mysqli_query($conn,"SELECT * FROM tbl_atribut WHERE id_atribut='$a[id_atribut]'"); 
        $b=mysqli_fetch_array($det);?>
        <form action="atribut.php?aksi=ubah" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_atribut" value="<?= $b['id_atribut']?>">
        <div class="from-group mb-4">
            <label>Nama Atribut</label>
            <input type="text" name="nm_atribut" class="form-control" value="<?= $b['nm_atribut']?>">
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