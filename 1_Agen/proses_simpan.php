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
	$nama_pegawai=$data['nama'];
  $user_npc=$data['user_npc'];
  $pswd=$data['pswd'];
  $nama_agen=$_POST['nama'];
  $SND=$_POST['SND'];
  $nama_customer=$_POST['customer'];
  $nd_ref=$_POST['nd_ref'];
  $email=$_POST['emails'];
  $nominal=$_POST['nominal'];
  $cicilan=$_POST['cbln'];
  $cek="SELECT * FROM agen WHERE snd='$SND'";
  $cek_piutang="SELECT * FROM piutang WHERE snd='$SND'";
  $eksekusi=mysqli_query($link,$cek);
  $eksekusi_piutang=mysqli_query($link,$cek_piutang);
  if (mysqli_num_rows($eksekusi_piutang)<=0 && mysqli_num_rows($eksekusi_piutang)<=0) {
    $simpan_agen="INSERT INTO agen (tgl,id,nama,snd,customer,nd_ref,mail,nominal,cicilan) VALUES ('$tgl','','$nama_agen','$SND','$nama_customer','$nd_ref','$email','$nominal','$cicilan')";
    $simpan_piutang="INSERT INTO piutang (tgl,nama,user_npc,pswd,agen,snd,customer,nd_ref,email,nominal,cicilan,status) VALUES('$tgl','$nama_pegawai','$user_npc','$pswd','$nama_agen','$SND','$nama_customer','$nd_ref','$email','$nominal','$cicilan','Lunas(Thn. Pertama)')";
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
                      <center>Data agen di tambahkan !</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="fa fa-rocket" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../1_agen.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
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
                      <center>Data agen sudah di input !</center>
                      <?php echo mysqli_num_rows($eksekusi_piutang)?>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../1_agen.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
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