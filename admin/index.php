<?php include 'header.php';?>
<html>
    <head>
        <title>Background Campuran</title>
        <style type="text/css">
            body {
                background-color : #99CCFF;
                background-image : url("LAB1.png");
                background-repeat : no-repeat; 
            }
            h1 {
                background : green;
                text-align : center;
                letter-spacing :0,5cm;
            }
            h3 {
                background-color : transparent;
                text-align : center;
                letter-spacing : 2px; 
            }
            p {background : rgb(240,248,255)}
        </style>
    </head>
    <body>

    </body>
</html>

<?php
session_start ();
include '../assets/conn/config.php';
include '../assets/conn/cek.php';
?>

<h1>WELCOME TO HOME</h1><br>
        <h4>Nama    : FOFY HIDAYAH</h4>
        <h4>No.Bp   : 21101152610284</h4>
        <h4>Jurusan : SISTEM INFORMASI</h4><br>
        <h4>Nama    : JUMELIA HANIFA PUTRI</h4>
        <h4>No.Bp   : 21101152610290</h4>
        <h4>Jurusan : SISTEM INFORMASI</h4><br
        

<?php
include 'footer.php';
?>