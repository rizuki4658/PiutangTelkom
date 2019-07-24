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

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <title>SISTEM INFORMASI PIUTANG</title>
    <link rel="icon" href="./gambar/logo-tangan-telkom-2.png" type="image/ico" />

    <!-- Bootstrap -->
    <link href="./vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="./vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="./vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="./vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="./vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="./vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="./build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="./gambar/Indihome_Fiber.png" style="width: 200px;"></a>
            </div>

            <div class="clearfix"></div>
            <br />
            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li style="border-color: #F44336;">
                    <a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                </ul>
                <h3>Umum</h3>
                <ul class="nav side-menu">
                  <li style="border-color: #F44336;">
                    <a href="menupanel.php"><i class="fa fa-dashboard"></i> Dashboard </a>
                  </li>
                  <li style="border-color: #F44336;"><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="./1_agen.php"><i class="fa fa-plus"></i> AGEN</a></li>
                      <li><a href="./5_tabel_agen.php"><i class="fa fa-users"></i> DATA AGEN</a></li>
                      <li><a href="./4_tabel_piutang.php"><i class="fa fa-table"></i> DATA PIUTANG</a></li>
                    </ul>
                  </li>
                  <li style="border-color: #F44336;"><a><i class="fa fa-book"></i> Jurnal <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="./3_tabel_jurnal.php">Data Jurnal</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Laporan</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-credit-card"></i> Piutang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a>Piutang<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="2A_piutang_hari.php">Per Hari</a>
                            </li>
                            <li><a href="2A_piutang_minggu.php">Per Minggu</a>
                            </li>
                            <li><a href="2A_piutang_bulan.php">Per Bulan</a>
                            </li>
                            <li><a href="2A_piutang_tahun.php">Per Tahun</a>
                            </li>
                            <li><a href="./3_laporan_piutang/keseluruhan.php">Keseluruhan</a>
                            </li>
                          </ul>
                        </li><li><a>Detail Piutang<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="4A_detail_bulan.php">Per Bulan</a>
                            </li>
                            <li><a href="4A_detail_tahun.php">Per Tahun</a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                  </li>
                  <li style="border-color: #F44336;"><a><i class="fa fa-book"></i> Jurnal <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="3A_jurnal_hari.php">Per Hari</a></li>
                      <li><a href="3A_jurnal_minggu.php">Per Minggu</a></li>
                      <li><a href="3A_jurnal_bulan.php">Per Bulan</a></li>
                      <li><a href="3A_jurnal_tahun.php">Per Tahun</a></li>
                      <li><a href="./4_laporan_jurnal/keseluruhan.php">Keseluruhan</a></li>
                    </ul>
                  </li>
                  <li style="border-color: #F44336;"><a><i class="fa fa-users"></i> Agen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="1A_agen_hari.php">Per Hari</a></li>
                      <li><a href="1A_agen_minggu.php">Per Minggu</a></li>
                      <li><a href="1A_agen_bulan.php">Per Bulan</a></li>
                      <li><a href="1A_agen_tahun.php">Per Tahun</a></li>
                      <li><a href="./5_laporan_agen/keseluruhan.php">Keseluruhan</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="modal" data-placement="top" title="Logout" data-target="#modal-logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
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
        <!-- /top navigation -->





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
<?php
    }

}
?>
