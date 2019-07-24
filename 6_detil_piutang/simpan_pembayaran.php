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



	$kode=$_POST['kode'];
	$SND=$_POST['snd'];
	$CST=$_POST['cst'];
	$tgl=$_POST['tgl'];
	$nominal=$_POST['cicilN'];
	$tanggal=$_POST['tanggalT'];
	$grouping=$_POST['groupingT'];
	$keterangan=$_POST['keteranganT'];
	$penerima=$_POST['penerimaT'];
	$cppenerima=$_POST['cpenerimaT'];
	$status='';
	$kode_p="PTG-".rand(1,9999)."-".Date("d").Date("m").Date("y");

	 $BULAN=date('m',strtotime($tanggal));
	 $HARI=date('d',strtotime($tanggal));
	 $TAHUN=date('Y',strtotime($tanggal));

	  if ($BULAN==1) {
	    $BULAN="Januari";
	  }elseif ($BULAN==2) {
	    $BULAN="Februari";
	  }elseif ($BULAN==3) {
	    $BULAN="Maret";
	  }elseif ($BULAN==4) {
	    $BULAN="April";
	  }elseif ($BULAN==5) {
	    $BULAN="Mei";
	  }elseif ($BULAN==6) {
	    $BULAN="Juni";
	  }elseif ($BULAN==7) {
	    $BULAN="Juli";
	  }elseif ($BULAN==8) {
	    $BULAN="Agustus";
	  }elseif ($BULAN==9) {
	    $BULAN="September";
	  }elseif ($BULAN==10) {
	    $BULAN="Oktober";
	  }elseif ($BULAN==11) {
	    $BULAN="November";
	  }elseif ($BULAN==12) {
	    $BULAN="Desember";
	  }

	 $KET="Pembayaran Piutang (tagihan cicilan) atas jasa servis Indihome kepada ".$CST." dengan SND (".$SND.") pada tanggal ".$HARI." ".$BULAN." ".$TAHUN;

	if ($_POST['statusT']=='BAYAR(TEPAT WAKTU)') {
		$status=$_POST['statusT'];
		$query_detail="UPDATE detail_piutang SET grouping='$grouping',keterangan='$keterangan',cp_penerima='$cppenerima',penerima='$penerima',bayar='$nominal',sisa='0',denda='0',status='$status' WHERE kode_p='$kode'";
		$kodeD=$kode."BD";
		$kodeK=$kode."BK";
		$query_jurnalD="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeD','$tanggal','1.1.1','Kas','$nominal','0','_','$SND')";
		$query_jurnalK="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeK','$tanggal','1.1.3','Piutang','0','$nominal','$KET','$SND')";
		$execute_detail=mysqli_query($link, $query_detail);
		$execute_jurnalD=mysqli_query($link, $query_jurnalD);
		$execute_jurnalK=mysqli_query($link, $query_jurnalK);
		if (!$execute_detail && !$execute_jurnalD && !$execute_jurnalK) {
				header('location: ../error_page/page_500.html');
			}else{
				header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$nominal.'&tgl='.$tgl);
			}	
	}elseif ($_POST['statusT']=='MINTA CABUT') {
		$status=$_POST['statusT'];
		$bayar=$_POST['pembayaranT'];
		$sisa=$nominal-$bayar;
		$query_detail="UPDATE detail_piutang SET grouping='$grouping', keterangan='$keterangan', cp_penerima='$cppenerima',penerima='$penerima', bayar='$bayar', sisa='$sisa', denda='0', status='$status' WHERE kode_p='$kode'";
		$kodeD=$kode."BD";
		$kodeK=$kode."BK";
		$query_jurnalD="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeD','$tanggal','1.1.1','Kas','$bayar','0','_','$SND')";
		$query_jurnalK="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeK','$tanggal','1.1.3','Piutang','0','$bayar','$KET','$SND')";
		$execute_detail=mysqli_query($link, $query_detail);
		$execute_jurnalD=mysqli_query($link, $query_jurnalD);
		$execute_jurnalK=mysqli_query($link, $query_jurnalK);
		if (!$execute_detail && !$execute_jurnalD && !$execute_jurnalK) {
				header('location: ../error_page/page_500.html');
			}else{
				header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$nominal.'&tgl='.$tgl);
			}
	}elseif ($_POST['statusT']=='TIDAK BAYAR') {
		$status=$_POST['statusT'];
		$query_detail="UPDATE detail_piutang SET grouping='$grouping', keterangan='$keterangan', cp_penerima='$cppenerima',penerima='$penerima', status='$status' WHERE kode_p='$kode'";
		$execute_detail=mysqli_query($link, $query_detail);
		if (!$execute_detail) {
				header('location: ../error_page/page_500.html');
			}else{
				header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$nominal.'&tgl='.$tgl);
			}
	}elseif ($_POST['statusT']=='TELAT BAYAR') {
		$status=$_POST['statusT'];
		$persen=$_POST['persenT'];
		$denda=$_POST['dendaT'];
		$bayar=$nominal+$denda;
		$kodeD=$kode."BD";
		$kodeK=$kode."BK";
		$KET="Pembayaran Piutang (tagihan cicilan) plus denda ".$persen."%(".$denda.")atas jasa servis Indihome kepada ".$CST." dengan SND (".$SND.") pada tanggal ".$HARI." ".$BULAN." ".$TAHUN;

		$query_detail="UPDATE detail_piutang SET grouping='$grouping', keterangan='$keterangan', cp_penerima='$cppenerima', penerima='$penerima', bayar='$bayar', sisa='0', denda='$persen', status='$status' WHERE kode_p='$kode'";
		$query_jurnalD="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeD','$tanggal','1.1.1','Kas','$bayar','0','_','$SND')";
		$query_jurnalK="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES('$kodeK','$tanggal','1.1.3','Piutang','0','$bayar','$KET','$SND')";
		$execute_detail=mysqli_query($link, $query_detail);
		$execute_jurnalD=mysqli_query($link, $query_jurnalD);
		$execute_jurnalK=mysqli_query($link, $query_jurnalK);
		if (!$execute_detail && !$execute_jurnalD && !$execute_jurnalK) {
				header('location: ../error_page/page_500.html');
			}else{
				header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$nominal.'&tgl='.$tgl);
			}
	}


	}
}
?>