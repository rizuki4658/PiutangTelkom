 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>

<!-- page content -->
<script><!--
        function startCalc(){
        interval = setInterval("calc()",1);}
        function calc(){
        persen = document.formcicil.persenT.value;
        cicil = document.formcicil.cicilN.value;
        document.formcicil.dendaT.value = ((persen * 1) * (cicil * 1)) / (100 * 1);}
        function stopCalc(){
        clearInterval(interval);}
</script>

        <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-credit-card"></i> <small>PEMBAYARAN CICILAN (<?php echo $_GET['cst']." No. SND ".$_GET['snd']; ?>)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div>
                      
                    </div>
                    <form class="demo-form" name="formcicil" method="post" action="./6_detil_piutang/simpan_pembayaran.php">
                            <input type="text" name="kode" id="kode" value="<?php echo $_GET['kode']; ?>" style="display: none;">
                            <input type="text" name="cst" id="cst" value="<?php echo $_GET['cst']; ?>" style="display: none;">
                            <input type="date"  id="tgl" name="tgl" value="<?php echo $_GET['tgl']; ?>" style="display: none;">
                            <input type="number" id="cicilN" name="cicilN" value="<?php echo $_GET['cicil']; ?>" style="display: none;">
                            <input type="text" name="snd" id="snd" value="<?php echo $_GET['snd']; ?>" style="display: none;">

                            <label for="tanggalT">Tanggal * : <i id="validtgl" style="color: red; font-weight: normal;"></i></label>
                            <input type="date" id="tanggalT" name="tanggalT" class="form-control" onchange="cekTGL(this.value);" required />

                            <label for="grouping">Grouping * :</label>
                            <select class="form-control" id="groupingT" name="groupingT" onchange="groupingbyr(this.value);" required>
                              <option></option>
                              <option>KENDALA KEUANGAN</option>
                              <option>MINTA CABUT</option>
                              <option>RUKOS</option>
                              <option>SUDAH BAYAR</option>
                              <option>TIDAK BERTEMU YBS</option>
                            </select>

                            <label for="keteranganT">Keterangan * :</label>
                            <textarea class="form-control" id="keteranganT" name="keteranganT" cols="100" rows="10" style="height: 60px; resize: none;" required></textarea>

                            <label for="penerimaT">Penerima * :</label>
                            <input type="text" name="penerimaT" id="penerimaT" class="form-control" required>

                            <label for="cpenerimaT">CP Penerima * :</label>
                            <input type="text" name="cpenerimaT" id="cpenerimaT" class="form-control">

                            
                            <label for="statusT">Status</label>
                            <select name="statusT" id="statusT" class="form-control" onchange="cekStatus(this.value);" onmo required>
                              <option></option>
                            </select>
                            
                            
                            <div id="inputangka">

                              
                            </div>

                            <div id="buttonaksi" style="margin-top: 10px;">
                              
                            </div>
                          </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php require_once 'angka.php'; ?>
 <!-- /page content -->
 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>


 <script type="text/javascript">
  var CEK_X='';
  function cekTGL(tanggalT){
    var tanggal1=document.getElementById('tanggalT').value;
    var tanggal2=document.getElementById('tgl').value;
    if (tanggal1 <= tanggal2) {
      document.getElementById('validtgl').innerHTML='Tidak sesuai dengan tanggal pencatatan cicilan.';
      CEK_X='Tidak'; 
    }else{
       document.getElementById('validtgl').innerHTML='';
       CEK_X='OK';
    }
  }
  function cekStatus(statusT) {
    var status=document.getElementById('statusT').value;
    if (status=='BAYAR(TEPAT WAKTU)') {
      document.getElementById('inputangka').innerHTML='';
      document.getElementById('buttonaksi').innerHTML='<button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Simpan</button><button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>';
    }else if (status=='MINTA CABUT') {
      document.getElementById('inputangka').innerHTML='<label for="pembayaranT">Pembayaran * :</label><input type="number" name="pembayaranT" id="pembayaranT" class="form-control" required>';
       document.getElementById('buttonaksi').innerHTML='<button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Simpan</button><button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>';
    }else if (status=='TIDAK BAYAR'){
        document.getElementById('inputangka').innerHTML='';
         document.getElementById('buttonaksi').innerHTML='<button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Simpan</button><button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>';
    }else if (status=='TELAT BAYAR') {
        document.getElementById('inputangka').innerHTML='<label for="persenT" style="display:block;">Denda * :</label><input type="number" name="persenT" id="persenT" class="form-control" style="width: 10%; display:inline;" onchange="startCalc();" onfocus="startCalc();" onblur="stopCalc();" onkeyup="pemisah();" onmouseup="pemisah();" min="0" max="100" required>%  <input type="hidden" name="dendaT" id="dendaT" class="form-control" style="width: 88.5%; display:inline; text-align:center;" required><input id="dnaaaa" type="text" placeholder="Nominal Denda" class="form-control" style="width: 88.5%; display:inline; text-align:center;" readonly required/>';
         document.getElementById('buttonaksi').innerHTML='<button type="submit" class="btn btn-default"><i class="fa fa-save"></i> Simpan</button><button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>';
    }
  }
</script>

<script type="text/javascript">
  function pemisah(dnaaaa) {
    var A = Number(document.getElementById("dendaT").value);
    var number_string1 = A.toString(),
    sisa1 = number_string1.length % 3,
    rupiah1  = number_string1.substr(0, sisa1),
    ribuan1  = number_string1.substr(sisa1).match(/\d{3}/g);
    if (ribuan1) {
    separator1 = sisa1 ? '.' : '';
    rupiah1 += separator1 + ribuan1.join('.');
    }   
    
    document.getElementById("dnaaaa").value = "Rp " + rupiah1;
  }
</script>

<script type="text/javascript">
  function groupingbyr(groupingT){
    var groupingnya = document.getElementById('groupingT').value;
    if (groupingnya=="KENDALA KEUANGAN"){
      document.getElementById('statusT').innerHTML ="<option></option><option>TELAT BAYAR</option><option>TIDAK BAYAR</option>";
    }else if (groupingnya=="MINTA CABUT") {
      document.getElementById('statusT').innerHTML ="<option></option><option>MINTA CABUT</option>";
    }else if (groupingnya=="RUKOS" || groupingnya=="TIDAK BERTEMU YBS") {
      document.getElementById('statusT').innerHTML ="<option></option><option>TIDAK BAYAR</option>";
    }else if (groupingnya=="SUDAH BAYAR") {
      document.getElementById('statusT').innerHTML ="<option></option><option>BAYAR(TEPAT WAKTU)</option>";
    }
  };
</script>