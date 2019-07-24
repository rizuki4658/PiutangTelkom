<?php
session_start();
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

 <body class="login" style="background-image: url('../images/Background.jpg'); background-repeat: no-repeat; background-size: 100%;">
<?php
	$username=$_POST['username'];
	$password=$_POST['password'];
	if ($username==""){
		header("location: Index.php");		
	}elseif ($username=="") {
		header("location: Index.php");
	}elseif ($username=="" && $password=="") {
		header("location: Index.php");
	}else{
	$conn=mysqli_connect('localhost','root','','telkomsel');
	$query="SELECT * FROM users WHERE username='$username' AND password='$password'";
	$cek=mysqli_query($conn,$query);
	if (mysqli_num_rows($cek) > 0) {
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;		
		header("location: ../");
	}else{?>

	<!-- Small modal -->
		<div style="margin-top: 20%">
			<center><a href="Index.php#signup" class="btn btn-round btn-success" style="height: 35px;">Daftar</a></center>
		</div>
        <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal-user">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                          </button>
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Username belum terdaftar !</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 100px;"></i></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="Index.php" class="btn btn-round btn-default" style="height: 35px;">Back</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->
<?php
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
    $('#modal-user').modal('show');
</script>
 </body>
</html>