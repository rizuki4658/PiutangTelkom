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



	$kode=$_GET['kode'];
	$SND=$_GET['snd'];
	$CST=$_GET['cst'];
	$tgl=$_GET['tgl'];

	$kodeD=$kode."D";
	$kodeK=$kode."K";
	$kodeBD=$kode."BD";
	$kodeBK=$kode."BK";
	
	$hapus_detil="DELETE FROM detail_piutang WHERE kode_p='$kode'";
	$hapus_jurnalD="DELETE FROM jurnal WHERE kode_p='$kodeD'";
	$hapus_jurnalK="DELETE FROM jurnal WHERE kode_p='$kodeK'";
	$hapus_jurnalBD="DELETE FROM jurnal WHERE kode_p='$kodeBD'";
	$hapus_jurnalBK="DELETE FROM jurnal WHERE kode_p='$kodeBK'";
	
	$execute_detil=mysqli_query($link,$hapus_detil);
	$execute_jurnalD=mysqli_query($link,$hapus_jurnalD);
	$execute_jurnalK=mysqli_query($link,$hapus_jurnalK);
	$execute_jurnalBD=mysqli_query($link,$hapus_jurnalBD);
	$execute_jurnalBK=mysqli_query($link,$hapus_jurnalBK);
		if (!$execute_detil || !$execute_jurnalD || !$execute_jurnalK || !$execute_jurnalBD || !$execute_jurnalBK) {
			header('location: ../error_page/page_500.html');
		}else{
			header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$nominal.'&tgl='.$tgl);
		}

	}
}
?>