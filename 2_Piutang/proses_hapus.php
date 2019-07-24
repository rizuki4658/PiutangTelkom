<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){ //cek apakah user sudah login
        header("location:./Login_Logout/");
    }else {
    $link=mysqli_connect("localhost","root","","telkomsel");
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $login=mysqli_query($link,"SELECT * FROM users WHERE username = '$username' AND password='$password'");
    while ($data=mysqli_fetch_assoc($login)) {

        $SND=$_GET['id'];
        $query_piutang="DELETE FROM piutang WHERE snd='$SND'";
        $query_detil="DELETE FROM detail_piutang WHERE snd='$SND'";
        $query_jurnal="DELETE FROM jurnal WHERE snd='$SND'";
        $query_agen="DELETE FROM agen WHERE snd='$SND'";

        $execute_piutang=mysqli_query($link,$query_piutang);
        $execute_detil=mysqli_query($link,$query_detil);
        $execute_jurnal=mysqli_query($link,$query_jurnal);
        $execute_agen=mysqli_query($link,$query_agen);
        if (!$execute_piutang || !$execute_jurnal || !$execute_agen || !$execute_detil) {
            header('location: ../error_page/page_500.html');
        }else{
            header('location: ../4_tabel_piutang.php');
        }

    }
}
?>