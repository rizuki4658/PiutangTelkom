<!DOCTYPE html>
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
<html>
<head>
	   <title>SISTEM INFORMASI PIUTANG</title>
    <link rel="icon" href="./gambar/logo-tangan-telkom-2.png" type="image/ico" />
    <!-- CSS CUSTOM -->
    <link rel="stylesheet" type="text/css" href="./css custom/style.css">
	<!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">
     <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    		background-color: #2a3f54;
    	}
    </style>
</head>
<body>
	<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                  	style="text-transform: uppercase; border-radius: 10px; font-weight: bold; color: white;">
                    <?php echo $data['nama'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a data-toggle="modal" data-target="#modal-profil"> Profile</a></li>
                    <li><a data-toggle="modal" data-target="#modal-logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

	<center>
		<img src="./gambar/Indihome_Fiber.png" alt="indihome logo" class="gambar menu-logo">
		<h1 class="menu-tiitle"><i>SISTEM INFORMASI PENAGIHAN PIUTANG</i> <i class="fa fa-angle-double-right"></i> </h1>
	</center>

	<div class="main">
		<div>
			<div class="kol-4">
				<center>
				<div class="wrap">
					<img src="./gambar/teknisi-icon.png" alt="Agen"/>
					<div class="info">
						<a href="1_agen.php"><i class="fa fa-plus"></i> Agen</a>
						<a href="5_tabel_agen.php"><i class="fa fa-table"></i> Tabel Agen</a>
						<a href="./5_laporan_agen/keseluruhan.php"><i class="fa fa-book"></i> Lap. Agen</a>
					</div>
					<br>
				</div>
				</center>
			</div>
		</div>

		<div>
			<div class="kol-4">
				<center>
					<div class="wrap">
						<img src="./gambar/money-bag-with-dollar-symbol.png" alt="Agen"/>
						<div class="info">
							<a href="4_tabel_piutang.php"><i class="fa fa-table"></i> Tabel Piutang</a>
						</div>
					</div>
				</center>
			</div>
		</div>

		<div>
			<div class="kol-4">
				<center>
				<div class="wrap">
					<img src="./gambar/contract.png" alt="Agen"/>
					<div class="info">
						<a href="3_tabel_jurnal.php"><i class="fa fa-table"></i> Tabel Jurnal</a>
						<a href="./4_laporan_jurnal/keseluruhan.php"><i class="fa fa-book"></i> Lap. Jurnal</a>
					</div>
				</div>
			</center>
			</div>
		</div>

		<div>
			<div class="kol-4">
				<center>
				<div class="wrap">
					<img src="./gambar/chart.png" alt="Agen"/>
					<div class="info">
						<a href="2A_piutang_hari.php"><i class="fa fa-book"></i> Lap. Periode</a>
						<a href="3_laporan_piutang/keseluruhan.php"><i class="fa fa-book"></i> Semua</a>
					</div>
				</div>
				<center>
			</div>
		</div>
	</div>

	<div style="width: 100%;"">
		<center>
		<img src="./gambar/logo-tangan-telkom-2.png" style="width: 5%">
		<h2 style="color: #909193; display: inline-block;">PT. Telkom Indonesia</h2>
		</center>
	</div>


	
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal-profil" style="color: grey;">
         <div class="modal-dialog modal-lg">
            <div class="modal-content" style="margin-top: 10%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                          </button>
                    <h2 class="modal-title" id="myModalLabel2" style="text-transform: uppercase;">
                      <center><?php echo $data['nama'];?> <i class="fa fa-user"></i></center>
                    </h2>
                 </div>
                 <div class="modal-body">
                    <?php 
                      $username=$data['username'];
                      $profil_query="SELECT * FROM users WHERE username='$username'";
                      $cek_prof=mysqli_query($link,$profil_query);
                      while ($dataP=mysqli_fetch_assoc($cek_prof)) { ?>

                      <form class="form-horizontal form-label-left" method="post" action="./8_update_profil/proses_update.php">
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">username <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="nama_user" name="nama_user" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $dataP['username']; ?>" readonly required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">password <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input name="password_user" id="password_user" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" type="password" value="<?php echo $dataP['password']; ?>" required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">confirm password <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input name="cpassword_user" id="cpassword_user" class="form-control col-md-7 col-xs-12" type="password" data-validate-linked="password_user" required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usernpc">User_NPC <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="user_npc_nama" name="user_npc_nama" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $dataP['user_npc']; ?>" required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usernpc">PSWD <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="pswd_user" name="pswd_user" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $dataP['pswd']; ?>" required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input name="nama_lengkap_usr" id="nama_lengkap_usr" class="form-control col-md-7 col-xs-12" value="<?php echo $dataP['nama']; ?>" required>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input name="email_usr" class="form-control col-md-7 col-xs-12" type="email" value="<?php echo $dataP['mail']; ?>" required>
                            </div>
                        </div>

                         <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"> <span class="required"></span>
                            </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" name="id_user" value="<?php echo $dataP['id']; ?>" style="display: none;">
                              <input type="text" name="nama_asal" value="<?php echo $dataP['nama']; ?>" style="display: none;">
                              <input type="submit" class="btn btn-success" name="Update" value="Update">
                              <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                          </div>
                        </div>

                      </form>
                    <?php
                      }
                    ?>                
                 </div>
                 <div class="modal-footer">

                 </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-logout">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                          </button>
                    <h4 class="modal-title" id="myModalLabel2">
                      <center>Anda ingin keluar ?</center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><h1><i class="fa fa-power-off"></i></h1></center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="./Login_Logout/proses_logout.php" class="btn btn-round btn-danger" style="height: 35px;">Ya</a>
                    <a href="" class="btn btn-round btn-default" data-dismiss="modal" style="height: 35px;">Tidak</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->
	 <!-- jQuery -->
    <script src="./vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
	}
}
?>