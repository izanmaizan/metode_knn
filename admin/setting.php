<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='setting') {
        //mengambil nilai data latih
        $jumlah_data_latih = isset($_POST['latih']) ? intval($_POST['latih']) : 0;

        //mengeksekusi kueri untuk mengambil semua data dari tabel
        $query = mysqli_query($conn,"SELECT DISTINCT tipe_data FROM tbl_dataset");

        //memeriksa apakah ada hasil yang ditemukan
        if ($result =mysqli_num_rows($query) > 0) {
            //ambil data dari hasil kueri
            $index = 0;
            while ($row = mysqli_fetch_assoc($query)) {
                //tentukan nilai untuk kolom "ket_data" berdasarkan indeks
                $nilai_ket_data = ($index < $jumlah_data_latih) ? "Data Latih" : "Data Uji";

                //ambil hasil penetuan ket_data
            $cek = mysqli_query($conn,"UPDATE tbl_dataset SET ket_data='$nilai_ket_data' WHERE tipe_data='{$row['tipe_data']}'");
                $index++;
            }

        }
        header("location:setting.php?aksi=berhasil");
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
    }
    ?>
    
    <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Setting</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body p-5">
            <form action="setting.php?aksi=setting" method="POST" enctype="multipart/form-data">
                <div class="from-group">
                    <label>Data Latih</label>
                    <input type="number" name="latih" class="form-control" placeholder="0">
                    <div class="form-text text-danger">*set nilai untuk memisahkan data latih dan data uji</div>
                </div>
                <hr>

                <a href="index.php" class="btn btn-primary">Batal</a>
                <input type="submit" class="btn btn-secondary" value="Setting">
            </form>
        </div>
        <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Data</th>
            <?php 
            $at = mysqli_query($conn,"SELECT * FROM tbl_atribut ORDER BY id_atribut");
            while ($a=mysqli_fetch_array($at)) {
              echo "<th class='text-center'>$a[nm_atribut]</th>";
          } ?>
          <th class="text-center">Class</th>
          <th class="text-center">Tipe Data</th>
      </tr>


      <?php
      $data = mysqli_query($conn,"SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset ORDER BY id_atribut");
      $no=1;
      while($a = mysqli_fetch_array($data)){
        $nm_data = $a['tipe_data']  
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $nm_data ?></td>
            <?php 
            $dt = mysqli_query($conn,"SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a  WHERE d.id_atribut=a.id_atribut  AND d.tipe_data='$nm_data' ORDER BY a.id_atribut");
            while ($td=mysqli_fetch_array($dt)) {
                echo "<td class='text-center'>$td[nilai_set]</td>";
            } 
            $cls = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$a[id_class]'");
            $s= mysqli_fetch_array($cls);
            echo "<td class='text-center'>$s[nm_class]</td>";
            echo "<td class='text-center'>$a[ket_data]</td>";
            ?>
            
        </tr>
    <?php } ?>
</table>
</div>
    </div>        
</div>



<?php
include 'footer.php';
?>
