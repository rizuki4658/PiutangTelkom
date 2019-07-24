<?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>

 <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
                    	<h2><small><i class="fa fa-search"></i></small><i class="fa fa-user"></i> <small>LAPORAN DETAIL PIUTANG PER TAHUN</small></h2>
                    	<ul class="nav navbar-right panel_toolbox">
                      	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      	</li>
                      	<li><a class="close-link"><i class="fa fa-close"></i></a>
                      	</li>
                    	</ul>
                    <div class="clearfix"></div>
                  	</div>
                 	<div class="x_content">
                 	<form class="form-horizontal form-label-left" action="./7_laporan_detail/tahun.php" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">SND <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="snD" id="snD" onchange="changeValue(this.value)" required>
                          <?php
                            $username=$_SESSION['username'];
                            $password=$_SESSION['password'];
                            $namalengkap="";
                            $usernpc="";
                            $pswd="";
                            $cek_user=mysqli_query($link,"SELECT * FROM users WHERE username = '$username' AND password='$password'");
                            if (mysqli_num_rows($cek_user)>0) {
                              while ($dataUser=mysqli_fetch_assoc($cek_user)) {
                                $namalengkap=$dataUser['nama'];
                                $usernpc=$dataUser['user_npc'];
                                $pswd=$dataUser['pswd'];
                                $cek_piutang=mysqli_query($link,"SELECT * FROM piutang WHERE nama = '$namalengkap' AND user_npc='$usernpc' AND pswd='$pswd'");
                                if (mysqli_num_rows($cek_piutang)>0) {
                                  $javaArray = "var KoPG = new Array();\n";
                                  echo "<option dselected/></option>";
                                  while ($row = mysqli_fetch_array($cek_piutang)) {

                                    echo "<option value='".$row['snd']."'>".$row['snd']."</option>";
                                    $javaArray .= "KoPG['" . $row['snd'] . "'] = {agenS:'" . addslashes($row['agen']) . "',cstS:'" . addslashes($row['customer']) . "',ndrefS:'" . addslashes($row['nd_ref']) . "',mailS:'" . addslashes($row['email']) . "',cicilS:'" . addslashes($row['cicilan']) . "',tglS:'" . addslashes($row['tgl']) . "'};\n";
                                  }
                                }
                              }
                            }
                          ?>
                          </select>
                          <input type="text" name="cst" id="cst" style="display: none;">
                          <input type="number" name="cicil" id="cicil" style="display: none;">
                          <input type="date" name="tanggal" id="tanggal" style="display: none;">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="info">Info <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" id="infoD" name="infoD" cols="100" rows="5" style="resize: none;" required></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulan">Tahun <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" class="form-control" name="tahun" id="tahun" min="2017" max="2025" required>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <center>
                          <button type="reset" class="btn btn-app"><i class="fa fa-trash"></i>Batal</button>
                          <button id="send" type="submit" name="Edit" value="Edit" class="btn btn-app"><i class="fa fa-print"></i>Print Prev</button>
                          </center>
                        </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>

<script type="text/javascript">  
  <?php echo $javaArray; ?>
  function changeValue(snD){
  var A=Number(KoPG[snD].cicilS);
  var number_string1 = A.toString(),
  sisa1 = number_string1.length % 3,
  rupiah1  = number_string1.substr(0, sisa1),
  ribuan1  = number_string1.substr(sisa1).match(/\d{3}/g);
   if (ribuan1) {
    separator1 = sisa1 ? '.' : '';
    rupiah1 += separator1 + ribuan1.join('.');
    }
  document.getElementById('infoD').value = "Nama Agen : " + KoPG[snD].agenS + "\r\n" + "Nama Customer : " + KoPG[snD].cstS + "\r\n" + "No. Telpon : " + KoPG[snD].ndrefS + "\r\n" + "Email : " + KoPG[snD].mailS + "\r\n" + "Cicilan : Rp." + rupiah1 +"/bln";
  document.getElementById('cst').value =KoPG[snD].cstS;
  document.getElementById('cicil').value =KoPG[snD].cicilS;
  document.getElementById('tanggal').value =KoPG[snD].tglS;
  };
</script>
