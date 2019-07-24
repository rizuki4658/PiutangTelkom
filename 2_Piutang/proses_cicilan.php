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



			$SND=$_POST['snd'];
			$tanggal=$_POST['tanggal'];
			$kode_p="PTG-".rand(1,9999)."-".Date("d").Date("m").Date("y");
			//$tanggal=Date("y-m-d");
			$cek_piutang="SELECT * FROM piutang WHERE snd='$SND'";
			$hasil_piutang=mysqli_query($link,$cek_piutang);
			if (mysqli_num_rows($hasil_piutang)>0) {
				while ($datapiutang=mysqli_fetch_assoc($hasil_piutang)) {
					$tgl=$datapiutang['tgl'];
					$nominal=$datapiutang['nominal'];
					$cicilan=$datapiutang['cicilan'];
					$query_detil="INSERT INTO detail_piutang (tgl,kode_p,snd,grouping,keterangan,cp_penerima,penerima,nominal,bayar,sisa,denda,status) VALUES ('$tgl','$kode_p','$SND','_','_','_','_','$nominal','$nominal','0','0','Lunas(Thn. Pertama)')";
					$simpan_detil=mysqli_query($link, $query_detil);

					$idjurnalD=$kode_p.'D';
					$idjurnalK=$kode_p.'K';
					$idjurnalLD=$kode_p.'LD';
					$idjurnalLK=$kode_p.'LK';

					$keterangan="Pendapatan Servis Indihome kepada ".$datapiutang['customer']." dengan no SND (".$SND.")";
					$jurnalD="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$idjurnalD','$tgl','1.1.3','Piutang','$nominal','0','-','$SND')";
					$jurnalK="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$idjurnalK','$tgl','4.1.4','Pendapatan Servis Indihome','0','$nominal','$keterangan','$SND')";
					$jurnal_lunasD="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$idjurnalLD','$tanggal','1.1.1','Kas','$nominal','0','-','$SND')";
					$jurnal_lunasK="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$idjurnalLK','$tanggal','1.1.3','Piutang','0','$nominal','$keterangan','$SND')";
					$simpan_jurnal1=mysqli_query($link,$jurnalD);
					$simpan_jurnal2=mysqli_query($link,$jurnalK);
					$simpan_jurnal3=mysqli_query($link,$jurnal_lunasD);
					$simpan_jurnal4=mysqli_query($link,$jurnal_lunasK);
					if (!$simpan_detil && !$simpan_jurnal1 && !$simpan_jurnal2 && !$simpan_jurnal3 && !$simpan_jurnal4) {
						header('location: ../error_page/page_500.html');
					}else{
						header('location: ../4_tabel_piutang.php');
					}
				}
			}







		}
	}
?>


