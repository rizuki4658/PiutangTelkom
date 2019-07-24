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
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="proses_login.php" method="post">
              <h1 style="color: white;">Login</h1>
              <div>         
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required=""/>
              </div>
              <div>
                <input type="submit" class="btn btn-round btn-danger" name="Login" value="Log in" style="margin-left: 40%;">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link" style="color: white;">Pengguna baru?
                  <a href="#signup" class="to_register" style="color: white;"> Buat Akun </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div style="color: white;">
                  <h1><img src="../images/logo.png" style="width: 20%; height: 20%;">Telkom Indonesia</h1>
                  <p>©2018 celenoteam.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="proses_daftar.php" method="post">
              <h1 style="color: white;">Buat Akun</h1>
              <div>
                <input type="text" class="form-control" placeholder="Nama" name="nama" required/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" required/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required/>
              </div>
              <div>
                <input type="submit" class="btn btn-round btn-success" value="Daftar" name="Daftar" style="margin-left: 40%;">
              </div>

              <div class="clearfix"></div>

              <div class="separator" style="color: white;">
                <p class="change_link">Sudah punya akun?
                  <a href="#signin" class="to_register" style="color: white;"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div style="color: white;">
                  <h1><img src="../images/logo.png" style="width: 20%; height: 20%;"> Telkom Indonesia</h1>
                  <p>©2018 celenoteam.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>          

    <!-- jQuery -->
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
    function validasiU() {
      var nama_user=document.getElementById('username').value;
      var pass_user=document.getElementById('password').value;
      if (nama_user=="") {
       document.getElementById('ValidUs').innerHTML="isi username";
      }else if(nama_user!=""){
       document.getElementById('ValidUs').innerHTML="";
      }
     }
     function validasiP() {
      var pass_user=document.getElementById('password').value;
      if (pass_user=="") {
       document.getElementById('ValidPs').innerHTML="isi password";
      }else if(pass_user!=""){
       document.getElementById('ValidPs').innerHTML="";
      }
     }
     function validasiL() {
      var nama_user=document.getElementById('username').value;
      var pass_user=document.getElementById('password').value;
      if (nama_user=="" || pass_user=="") {
        document.getElementById('ValidPs').innerHTML="isi password";
        document.getElementById('ValidPs').innerHTML="";
      }else{
        return true;
      }
     }
  </script>
  <script type="text/javascript">
    $('#modal-user').modal('show');
  </script>
  </body>
</html>