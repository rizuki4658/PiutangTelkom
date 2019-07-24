 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>

<?php
  if (!isset($_GET['id'])) { ?>
    
 <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>EDIT DATA PIUTANG<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
<?php
  }else{
  $id=$_GET['id'];
  $query_cek="SELECT * FROM piutang WHERE snd='$id' LIMIT 1";
  $view_data=mysqli_query($link,$query_cek);
  if (mysqli_num_rows($view_data)>0) {
    while ($dataE=mysqli_fetch_assoc($view_data)) { ?>
<!-- page content -->
        <div class="right_col" role="main" style="background-image: url('./images/Background2.jpg'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>EDIT DATA PIUTANG<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left" novalidate action="./2_Piutang/proses_edit.php" method="post">
                      <span class="section">Informasi Piutang</span>
                      <button type="button" class="btn btn-round btn-default" data-toggle="modal" data-target="#modal-user">Detail</button>
                      <?php require_once 'detail_agen_edit.php';  ?>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">SND <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="SND" name="SND" required="required" class="form-control col-md-7 col-xs-12" onchange="changeValue(this.value);">
                            <option value="<?php echo $dataE['id']; ?>"><?php echo $dataE['snd']; ?></option>
                            <?php
                              $user=$_SESSION['username'];
                              $cek_username="SELECT * FROM users WHERE username='$user'";
                              $hasil_user=mysqli_query($link,$cek_username);
                              while ($data_user=mysqli_fetch_assoc($hasil_user)) {
                                $nama_pegawai=$data_user['nama'];                                
                                $cek_SND="SELECT * FROM piutang WHERE nama ='$nama_pegawai'";
                                $hasil_SND=mysqli_query($link,$cek_SND);
                                $DataArray="var DSND = new Array();\n";
                                while ($data_SND=mysqli_fetch_assoc($hasil_SND)) {
                                  echo "<option value='".$data_SND['id']."'>".$data_SND['snd']."</option>";
                                  $DataArray .= "DSND['" . $data_SND['id'] . "'] = {snds:'" . addslashes($data_SND['snd']) . "',namas:'" . addslashes($data_SND['nama']) . "',agens:'" . addslashes($data_SND['agen']) . "',usernpcs:'" . addslashes($data_SND['user_npc']) . "',pswds:'" . addslashes($data_SND['pswd']) . "',nd_refs:'" . addslashes($data_SND['nd_ref']) . "',emails:'" . addslashes($data_SND['email']) . "'};\n";
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tanggal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" required="required" class="form-control col-md-7 col-xs-12" id="tanggal" name="tanggal" value="<?php echo $dataE['tgl']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Grouping <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="grouping" name="grouping" required="required" class="form-control col-md-7 col-xs-12">
                              <option><?php echo $dataE['grouping']; ?></option>
                              <option>KENDALA KEUANGAN</option>
                              <option>MINTA CABUT</option>
                              <option>RUKOS</option>
                              <option>SUDAH BAYAR</option>
                              <option>TIDAK BERTEMU YBS</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Keterangan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="ket" name="ket" required="required" name="textarea" class="form-control col-md-7 col-xs-12"><?php echo $dataE['keterangan']; ?></textarea>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Penerima <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="penerima" name="penerima" required="required" placeholder="" class="form-control col-md-7 col-xs-12" value="<?php echo $dataE['penerima']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">CP Penerima <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="cp_penerima" name="cp_penerima" required="required" placeholder="" class="form-control col-md-7 col-xs-12" data-validate-length-range="6,15" value="<?php echo $dataE['cp_penerima']; ?>">
                        </div>
                      </div>                    
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Nominal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="nominal" name="nominal" required="required" placeholder="" class="form-control col-md-7 col-xs-12" data-validate-minmax="0,100000000" value="<?php echo $dataE['nominal']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" required="required" class="form-control col-md-7 col-xs-12">
                              <option><?php echo $dataE['status']; ?></option>
                              <option>BAYAR</option>
                              <option>MINTA CABUT</option>
                              <option>TIDAK BAYAR</option>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Batal</button>
                          <input type="submit" name="Edit" value="Edit" id="send" class="btn btn-success" onmousedown="validasi();">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php    
    }
  }
}
?>
       
 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>
 <script type="text/javascript">
  <?php echo $DataArray;?>
    function changeValue(SND){
    document.getElementById('SND2').value = DSND[SND].snds;
    document.getElementById('nama_p').value = DSND[SND].namas;
    document.getElementById('nama_s').value = DSND[SND].agens;
    document.getElementById('usenpc').value = DSND[SND].usernpcs;
    document.getElementById('pswd').value = DSND[SND].pswds;
    document.getElementById('nd_ref').value = DSND[SND].nd_refs;
    document.getElementById('email').value = DSND[SND].emails;
    };
 </script>
 <script type="text/javascript">
   function validasi() {
    var x = document.getElementById('SND').value;
    var y = document.getElementById('status').value;
    if (x=="" ||  x=="0" || x==0) {
      $('#modal-SND').modal('show');
    }else if(y=="Baru"){
      $('#modal-Status').modal('show');
    }
   }
 </script>