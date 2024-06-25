<?php
include 'header.php';
?>

<div class="container">
    <br><br><br>
    <?php if (empty($_GET['nilai_k'])) { ?>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Analisa</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body p-5">
           
            <form action="" method="GET" enctype="multipart/form-data">
                <div class="from-group">
                    <label>Nilai K</label>
                    <input type="number" name="nilai_k" class="form-control" placeholder="0">
                </div>

                <div class="from-group mt-4">
                    <label>Data Uji</label>
                    <select name="tipe_data" class="form-control">
                        <option selected disabled>Pilih</option>
                        <?php
                        $data = mysqli_query($conn,"SELECT  DISTINCT tipe_data, ket_data FROM tbl_dataset WHERE ket_data='Data Uji'");
                        while ($a=mysqli_fetch_array($data)) {
                            echo "<option value='$a[tipe_data]'>$a[tipe_data] - ($a[ket_data])</option>";
                        } ?>
                    </select>
        
                </div>
                <hr>
                <input type="submit" class="btn btn-primary" value="Proses Analisa">
            </form>
        </div>
    </div>  

    <?php }else{  ?> 

    <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">Hasil Analisa K-Nearest Neighbor</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body p-5">
            <h5>Data Latih</h5>
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Data</th>
                    <?php 
                    $data = mysqli_query($conn,"SELECT * FROM tbl_atribut ORDER BY id_atribut");
                    while ($a=mysqli_fetch_array($data)) {
                        echo"<th class='text-center'>$a[nm_atribut]</th>";
                    } ?>
                    <th class="text-center">Class</th>
                </tr>
                
                <?php
        $data = mysqli_query($conn,"SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset WHERE ket_data='Data Latih' ORDER BY id_atribut");
        $no=1;
        while($a = mysqli_fetch_array($data)){
            $nm_data = $a['tipe_data'];
            $id_class = $a['id_class'];  
            
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $nm_data ?></td>
            <?php 
            $dt = mysqli_query($conn,"SELECT d.nilai_set as nilai_set, c.id_class FROM tbl_dataset d, tbl_atribut a, tbl_class c WHERE d.id_atribut=a.id_atribut AND d.id_class=c.id_class And d.tipe_data='$nm_data' ORDER BY a.id_atribut");
            while ($td=mysqli_fetch_array($dt)) {
                echo "<td class='text-center'>$td[nilai_set]</td>";
                
            } 
            $cls = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$id_class'");
            $s= mysqli_fetch_array($cls);
            echo "<td class='text-center'>$s[nm_class]</td>";
            ?>
            
        </tr>
        <?php } ?>
            </table>
            <br>

            <h6>Data Uji</h6>
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Data</th>
                    <?php 
                    $data = mysqli_query($conn,"SELECT * FROM tbl_atribut ORDER BY id_atribut");
                    while ($a=mysqli_fetch_array($data)){
                        echo"<th class='text-center'>$a[nm_atribut]</th>";
                    } ?>
                    <th class="text-center">Class Actual</th>
                    <th class="text-center">Class Analisa</th>
                </tr>
                
                <?php
        $data = mysqli_query($conn,"SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset WHERE ket_data='Data Uji' ORDER BY id_atribut");
        $no=1;
        while($a = mysqli_fetch_array($data)){
            $nm_data = $a['tipe_data']; 
        ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center"><?= $nm_data ?></td>
            <?php 
            $dt = mysqli_query($conn,"SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a, tbl_class c WHERE d.id_atribut=a.id_atribut AND d.id_class=c.id_class And d.tipe_data='$nm_data' ORDER BY a.id_atribut");
            while ($td=mysqli_fetch_array($dt)) {
                echo "<td class='text-center'>$td[nilai_set]</td>";
                
            } 
            $cls = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$a[id_class]'");
            $s= mysqli_fetch_array($cls);
            echo "<td class='text-center'>$s[nm_class]</td>";
            echo "<td class='text-center'>?</td>";
            ?>
            
        </tr>
        <?php } ?>

            </table>
            <br>
            <h6>Distance</h6>  
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Data</th>
                    <?php 
                    $data = mysqli_query($conn,"SELECT * FROM tbl_atribut ORDER BY id_atribut");
                    while ($a=mysqli_fetch_array($data)){
                        echo"<th class='text-center'>$a[nm_atribut]</th>";
                    } ?>
                    <th class="text-center">Distance</th>
                </tr>
        
                <?php
                $result = array();
                $data = mysqli_query($conn,"SELECT DISTINCT tipe_data, id_class, ket_data FROM tbl_dataset WHERE ket_data='Data Latih' ORDER BY id_atribut");
                $no=1;
                  while($a = mysqli_fetch_array($data)){
                    $sum = 0.0;
                    $nm_data = $a['tipe_data']; 
                    $id_class = $a['id_class'];
                    $row_data = array();

                    $row_data['nm_data'] = $nm_data;
                    $row_data['id_class'] = $id_class;
                ?> 
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $nm_data ?></td>

                <?php    
                $dt = mysqli_query($conn,"SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a, tbl_class c WHERE d.id_atribut=a.id_atribut AND d.id_class=c.id_class And d.tipe_data='$nm_data' ORDER BY a.id_atribut");
                while ($td=mysqli_fetch_array($dt)) {

                    $dat = mysqli_query($conn,"SELECT DISTINCT tipe_data FROM tbl_dataset WHERE ket_data='Data Uji' AND tipe_data='$_GET[tipe_data]'");
                    $aa = mysqli_fetch_array($dat);

                    $qur = mysqli_query($conn,"SELECT d.nilai_set as nilai_set FROM tbl_dataset d, tbl_atribut a WHERE d.id_atribut=a.id_atribut AND d.tipe_data='$aa[tipe_data]' ORDER BY a.id_atribut");
                    $ke=mysqli_fetch_array($qur);

                    $nilai_latih = $td['nilai_set'];
                    $nilai_uji = $ke['nilai_set'];

                    //Rumus KNN
                    $kurang = $nilai_latih-$nilai_uji;
                    $val = pow($kurang, 2);
                    $sum += $val;
                    $akr = sqrt($sum);
                    //Tambahkan ke dalam Array
                    $row_data['nilai'][] = $akr;
                    echo"
                    <td>
                    ".$nilai_latih." - ".$nilai_uji." = ".$kurang."<br>".$kurang."<sup>2</sup> = ".$val."
                    </td>
                    ";

                 }
                 //Tambahkan Array Baris
                 $results[] = $row_data;
                 echo"
                 <td> 
                 &radic;".$sum." = ".round($akr,2)."
                 </td>
                 ";
                ?>      
                </tr> 
                <?php } ?>
                </table>
                <br>
                <?php
                $nilai_akhir_array = array();
                $count_id_class_ya = array();
                $count_id_class = array();
                foreach ($results as $result) {
                    $nilai_akhir = end($result['nilai']);

                    $id_class = $result['id_class'];
                    $nilai_akhir_array[$id_class] = $nilai_akhir;

                    if (isset($count_id_class[$id_class])) {
                        $count_id_class[$id_class] + 1;      
                    }else{
                        $count_id_class[$id_class] = 1;

                    }
                }

                array_multisort($nilai_akhir_array, SORT_ASC, $result);
                $rangking = 1;

                echo"
                <table class='table table-bordered'>
                <tr>
                <th class='text-center'>Rangs</th>
                <th class='text-center'>Data</th>
                <th class='text-center'>Distance</th>
                <th class='text-center'>Class</th>
                <th class='text-center'>Klasifikasi</th>
                </tr>
                ";

                foreach ($results as $result) {
                    $data = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$result[id_class]'");
                    $a = mysqli_fetch_array($data);
                    
                    echo "
                    <tr>
                    <td class='text-center'>".$rangking."</td>
                    <td class='text-center'>".$result['nm_data']."</td>
                    <td class='text-center'>".end($result['nilai'])."</td>
                    <td class='text-center'>".$a['nm_class']."</td>";
                   
                    if ($_GET['nilai_k'] >= $rangking++) {
                        $klasifikasi = "YA";
                        $id_class = $result['id_class'];
                        if (isset($count_id_class_ya[$id_class])) {
                            $count_id_class_ya[$id_class] + 1;      
                        }else{
                            $count_id_class_ya[$id_class] = 1;
                        }
                    }else{
                        $klasifikasi = "Tidak";  
                    } 
                    
                    echo"<td class='text-center'>".$klasifikasi."</td>
                    </tr>";
                }
                echo"</table><br>";

                echo"
                <div style='border: 1px solid; padding:20px;'>
                Berdasarkan dengan <b>K=$_GET[nilai_k]</b> jumlah kemunculan setiap class dengan klasifikasi <b>(ya)</b>. <br>";
                foreach ($count_id_class_ya as $id_class => $count) {
                    $data = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$id_class'");
                    $a = mysqli_fetch_array($data);    
                    echo "Class : <b>".$a['nm_class']."</b>, jumlah : <b>(".$count.")</b>. <br>";
                }

                $max_count = max($count_id_class_ya);
                $id_class_max = array_search($max_count, $count_id_class_ya);
                $data = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$id_class_max'");
                $a = mysqli_fetch_array($data);

                echo "
                <div class='text-jastify'>
                Jumlah class yang paling banyak muncul dengan klasifikasi <b>(YA)</b> : <b>".$a['nm_class']."</b> dengan jumlah : <b>(".$max_count.")</b>.
                Sehingga dapat disimpulkan untuk data <b>($_GET[tipe_data])</b> dengan kasus yang telah ditentukan class ya <b>".$a['nm_class']."</b>.
                </div>
                </div>
                ";
                
                $max_count = max($count_id_class_ya);
                $id_class_max = array_search($max_count, $count_id_class_ya);
                $data = mysqli_query($conn,"SELECT * FROM tbl_class WHERE id_class='$id_class_max'");
                $a = mysqli_fetch_array($data);

                echo "
                <div class='text-jastify'>
                Jadi, Berdasarkan Jumlah class yang paling banyak muncul di dapatkan jenis class yaitu PERLU DITINGKATKAN
                Sehingga dapat disimpulkan untuk semua data </b> dengan kasus yang telah ditentukan classnya <b>".$a['nm_class']."</b>.
                </div>
                </div>
                "; 
                
                $cek = mysqli_query($conn,"SELECT * FROM tbl_hasil WHERE tipe_data='($_GET[tipe_data])'");
                $ak = mysqli_num_rows($cek);

                if ($ak > 0) {
                    //jika kalau ada ya kita update
                    mysqli_query($conn,"UPDATE tbl_hasil SET id_class_knn='$id_class_max', nilai_k='$_GET[nilai_k]' WHERE tipe_data='$_GET[tipe_data]'");
                }else{
                    //jika tidak ada data ya kita insert
                    mysqli_query($conn,"INSERT INTO tbl_hasil(tipe_data,id_class_knn,nilai_k)VALUES('$_GET[tipe_data]','$id_class_max','$_GET[nilai_k]')");
                    
                }
                ?>
        </div>
    </div>

     <?php } ?>

</div>

<?php
include 'footer.php';
?>