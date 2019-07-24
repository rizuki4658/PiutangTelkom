<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){ //cek apakah user sudah login
        header("location:./Login_Logout/");
    }else {
    $link=mysqli_connect("localhost","root","","telkomsel");
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $login=mysqli_query($link,"SELECT * FROM users WHERE username = '$username' AND password='$password'");
    while ($data=mysqli_fetch_assoc($login)) { ?>
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
  	$username=$_POST['nama_user'];
  	$password=$_POST['cpassword_user'];
  	$usernpc=$_POST['user_npc_nama'];
  	$pswd=$_POST['pswd_user'];
    $pswd2=$_POST['pswd_user'];
  	$nama=$_POST['nama_lengkap_usr'];
  	$email=$_POST['email_usr'];
  	$id=$_POST['id_user'];
    $nama_asal=$_POST['nama_asal'];
  	$cek_user=mysqli_query($link,"SELECT * FROM users WHERE id='$id' AND username='$username'");
  		if (mysqli_num_rows($cek_user)>1) { ?>
  
  <!-- Small modal -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Username sudah digunakan</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../index.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->

<?php
		}else{
			
      $cek_piutang=mysqli_query($link, "SELECT * FROM piutang WHERE nama='$nama_asal'");
      if (mysqli_num_rows($cek_piutang)>0) {
          while ($datas=mysqli_fetch_assoc($cek_piutang)) {
            $snd=$datas['snd'];

            $update=mysqli_query($link, "UPDATE piutang SET nama='$nama',user_npc='$usernpc',pswd='$pswd' WHERE snd='".$datas['snd']."'");
              if (!$update) {
                  header('location: ../error_page/page_500.html');      
              }else{
                $queryupdate="UPDATE users SET nama='$nama',user_npc='$usernpc',pswd='$pswd2',username='$username',password='$password',mail='$email' WHERE id='$id'";
                  $execute_update=mysqli_query($link, $queryupdate); 
                if (!$execute_update) {
                  header('location: ../error_page/page_500.html');
                }else{ 
                  $_SESSION['username']=$username;
                  $_SESSION['password']=$password;
                  
                ?>
  <!-- Small modal -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Profil berhasil diupdate</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-ok" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../index.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->
<?php
                }
              }
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
<?php      
    }

}
?>