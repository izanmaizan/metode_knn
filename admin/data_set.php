<?php 
include '../assets/conn/config.php';
if (isset($_POST['upload'])) {
        //cek data
        $data = mysqli_query($conn, "SELECT * FROM tbl_dataset");
        $a = mysqli_num_rows($data);
        if ($a > 0) {
            //hapus data lama
            mysqli_query($conn,"TRUNCATE TABLE tbl_dataset");
            //simpan kembali data baru
            $file = $_FILES["file"];
            //pastikan file yang diunggah ada file csv
            $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            if ($file_extension != "csv") {
                header("location:data_set.php?pesan=gagal");
                exit();
            }
            //baca isi file csv
            //file pemisah (;)
            $csv_data = array_map(function($line) { return str_getcsv($line, ';'); }, file($file["tmp_name"]));
            //file pemisah (,)
            //$csv_data = array_map('str_getcsv', file($file["tmp_name"]));

            //loop untuk memasukkan data
            foreach ($csv_data as $row) {
                //sesuaikan query INSERT dengan struktur  tabel
                mysqli_query($conn,"INSERT INTO tbl_dataset(tipe_data,id_atribut,nilai_set,id_class,ket_data)VALUES('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."')");
            }
            header("location:data_set.php?pesan=berhasil");

        }else{
            $file = $_FILES["file"];
            //pastikan file yang diunggah ada file csv
            $file_extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            if ($file_extension != "csv") {
                header("location:data_set.php?pesan=gagal");
                exit();
            }
            //baca isi file csv
            //file pemisah (;)
            $csv_data = array_map(function($line) { return str_getcsv($line, ';'); }, file($file["tmp_name"]));
            //file pemisah (,)
            //$csv_data = array_map('str_getcsv', file($file["tmp_name"]));

            //loop untuk memasukkan data
            foreach ($csv_data as $row) {
                //sesuaikan query INSERT dengan struktur  tabel
                mysqli_query($conn,"INSERT INTO tbl_dataset(tipe_data,id_atribut,nilai_set,id_class,ket_data)VALUES('".$row[0]."','".$row[1]."','".$row[2]."','".$row[3]."','".$row[4]."')");
            }
            header("location:data_set.php?pesan=berhasil");

        }
}
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <?php 
    if (isset($_GET['pesan'])){
        if ($_GET['pesan']=='berhasil'){
            echo '<div class="alert alert-primary" role="alert">
            <i class="bi bi-check-square"></i>&emsp; Data berhasil diupload
            </div>';
        }elseif ($_GET['pesan']=='gagal'){
            echo '<div class="alert alert-danger" role="alert">
            <i class="bi bi-x-square"></i>&emsp; Data gagal diupload
            </div>';
        }
    } ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dataset</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body p-5">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-upload"></i> &emsp; Upload Data
            </button>
            <hr>
        </div>

        <!-- Modal Simpan -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="data_set.php" method="POST" enctype="multipart/form-data">
                            <div class="from-group mb-4">
                                <label>File CSV</label>
                                <input type="file" name="file" id="file" class="form-control">
                                <div class="form-text text-danger">*upload file dengan format .csv</div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="submit" name="upload" id="upload" class="btn btn-primary">Upload</button>
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
</div>

<?php
include 'footer.php';
?>