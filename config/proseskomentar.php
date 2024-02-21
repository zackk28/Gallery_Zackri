<?php
    include "koneksi.php";
    session_start();

    $fotoid=$_POST['FotoID'];
    $isikomentar=$_POST['IsiKomentar'];
    $tanggalkomentar=date("Y-m-d");
    $userid=$_SESSION['UserID'];

    $sql=mysqli_query($koneksi,"INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isikomentar','$tanggalkomentar')");

    header("Location: " . $_SERVER['HTTP_REFERER']);
?>