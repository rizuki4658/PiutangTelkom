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
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISTEM INFORMASI PIUTANG</title>
    <link rel="icon" href="../gambar/logo-tangan-telkom-2.png" type="image/ico" />
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
     <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

 <body class="login">
<?php
  $tgl=$_POST['tgl'];
  $nominal=$_POST['nominal'];
  $cicilan=$_POST['cbln'];
  $id=$_POST['id'];
	$nama_pegawai=$data['nama'];
  $user_npc=$data['user_npc'];
  $pswd=$data['pswd'];
  $nama_agen=$_POST['nama'];
  $SND=$_POST['SND'];
  $nama_customer=$_POST['customer'];
  $nd_ref=$_POST['nd_ref'];
  $email=$_POST['email'];
  $cek="SELECT * FROM agen WHERE snd='$SND'";
  $cek_piutang="SELECT * FROM piutang WHERE snd='$SND'";
  $eksekusi=mysqli_query($link,$cek);
  $eksekusi_piutang=mysqli_query($link,$cek_piutang);
  if (mysqli_num_rows($eksekusi_piutang)>0 && mysqli_num_rows($eksekusi_piutang)>0) {
    $simpan_agen="UPDATE agen SET nama='$nama_agen',snd='$SND',customer='$nama_customer',nd_ref='$nd_ref',mail='$email',nominal='$nominal',cicilan='$cicilan',tgl='$tgl' WHERE id='$id'";
    $simpan_piutang="UPDATE piutang SET nama='$nama_pegawai',user_npc='$user_npc',pswd='$pswd',agen='$nama_agen',customer='$nama_customer',nd_ref='$nd_ref',email='$email',nominal='$nominal',cicilan='$cicilan' WHERE snd='$SND'";
    $eksekusi_s_agen=mysqli_query($link,$simpan_agen);
    $eksekusi_s_piutang=mysqli_query($link,$simpan_piutang);
    if (!$eksekusi_s_agen) {
      header('location: ../error_page/page_500.html');
    }elseif (!$eksekusi_s_piutang) {
      header('location: ../error_page/page_500.html');
    }else{ ?>

  <!-- Small modal -->
    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Data agen di diubah !</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="fa fa-space-shuttle" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../5_tabel_agen.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->

<?php
    }
  }else{
	?>

	<!-- Small modal -->
		<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Data agen belum di input !</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../5_tabel_agen.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->
<?php
  }
	}
}
?>
 	<script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

<script type="text/javascript">
    $('#modal-user').modal({backdrop: 'static', keyboard: false});
</script>
 </body>
</html>