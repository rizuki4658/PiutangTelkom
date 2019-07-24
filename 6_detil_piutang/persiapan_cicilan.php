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
?>

<?php

  $SND=$_POST['snd'];
  $CST=$_POST['customer'];
  $NOMINAL=$_POST['cicilan'];
  $TGL=$_POST['tanggal'];
  $KODE="PTG-".rand(1,9999)."-".Date("d").Date("m").Date("y");
  $BULAN=date('m',strtotime($TGL));
  $HARI=date('d',strtotime($TGL));
  $TAHUN=date('Y',strtotime($TGL));

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

  $KET="Piutang (tagihan cicilan) atas jasa servis Indihome kepada ".$CST." dengan SND (".$SND.") pada tanggal ".$HARI." ".$BULAN." ".$TAHUN;

  $QUERY_DETIL="INSERT INTO detail_piutang (tgl,kode_p,snd,grouping,keterangan,cp_penerima,penerima,nominal,bayar,sisa,denda,status) VALUES('$TGL','$KODE','$SND','BELUM BAYAR','BELUM BAYAR','_','_','$NOMINAL','0','$NOMINAL','0','BELUM BAYAR')";
  $KODED=$KODE.'D';
  $KODEK=$KODE.'K';
  $QUERY_JURNAL_D="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$KODED','$TGL','1.1.3','Piutang','$NOMINAL','0','_','$SND')";

  $QUERY_JURNAL_K="INSERT INTO jurnal (kode_p,tgl,kode_akun,nama_akun,debet,kredit,ket,snd) VALUES ('$KODEK','$TGL','4.1.4','Pendapatan Servis Indihome','0','$NOMINAL','$KET','$SND')";

  $EXECUT_DETIL=mysqli_query($link, $QUERY_DETIL);

  $EXECUT_JURNALD=mysqli_query($link, $QUERY_JURNAL_D);

  $EXECUT_JURNALK=mysqli_query($link, $QUERY_JURNAL_K);

  if (!$EXECUT_DETIL && !$EXECUT_JURNALD && !$EXECUT_JURNALD) {
      header('location: ./error_page/page_500.html');
  }else{
      header('location: ../11_detail_piutang.php?snd='.$SND.'&cst='.$CST.'&cicil='.$NOMINAL.'&tgl='.$TGL);
  }
?>

<?php
    }
  }
?>