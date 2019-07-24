 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
<!-- page content -->
<?php
if (!isset($_GET['id'])){?>
 <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
<div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-edit"></i> <small>EDIT DATA AGEN</small></h2>
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
$query_tabel="SELECT * FROM agen WHERE id='$id'";
$view_tabel=mysqli_query($link,$query_tabel);
if (mysqli_num_rows($view_tabel)>0) {
  while ($dataE=mysqli_fetch_assoc($view_tabel)) { ?>
        <div class="right_col" role="main" style="background-image: url('./images/Background2.jpg'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-edit"></i> <small>EDIT DATA AGEN</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate action="./1_Agen/proses_edit.php" method="post">
                      <input type="hidden" name="id" id="id" value="<?php echo $dataE['id']; ?>">
                      <p>
                      </p>
                      <span class="section"></span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nama" name="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="nama lengkap e.g (Rizki Khair)" required="required" type="text" value="<?php echo $dataE['nama']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">SND <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input data-validate-length-range="12" type="text" id="SND" name="SND" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $dataE['snd']; ?>" readonly>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="customer" name="customer" required="required" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="<?php echo $dataE['customer']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">ND Ref <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="nd_ref" name="nd_ref" required="required" data-validate-length-range="6,20" class="form-control col-md-7 col-xs-12" value="<?php echo $dataE['nd_ref']; ?>">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email Customer <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" placeholder="" class="form-control col-md-7 col-xs-12" value="<?php echo $dataE['mail']; ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nominal">Nominal Thn. 1 <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="nominal" name="nominal" required="required" placeholder="" class="form-control col-md-7 col-xs-12" min="0" max="10000000000000" value="<?php echo $dataE['nominal']; ?>" onchange="hitungcicilan(this.value);">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cbln">Cicilan Perbulan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cbln" name="cbln" required="required" placeholder="" class="form-control col-md-7 col-xs-12" min="0" max="10000000" value="<?php echo $dataE['cicilan']; ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl">Mulai Berlangganan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" id="tgl" name="tgl" required="required" placeholder="" class="form-control col-md-7 col-xs-12" value="<?php echo $dataE['tgl']; ?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Batal</button>
                          <button id="send" type="submit" class="btn btn-success">Simpan</button>
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
	 function sndacak(){
	 	var tgl = new Date();
	 	var Bulan ="0";
	 	if (tgl.getMonth()==0) {
	 		Bulan="01";
	 	}else if(tgl.getMonth()==1){
	 		Bulan="02";
	 	}else if (tgl.getMonth()==2) {
	 		Bulan="03";
	 	}else if (tgl.getMonth()==3) {
	 		Bulan="04";
	 	}else if (tgl.getMonth()==4) {
	 		Bulan="05";
	 	}else if (tgl.getMonth()==5) {
	 		Bulan="06";
	 	}else if (tgl.getMonth()==6) {
	 		Bulan="07";
	 	}else if (tgl.getMonth()==7) {
	 		Bulan="08";
	 	}else if (tgl.getMonth()==8) {
	 		Bulan="09";
	 	}else if (tgl.getMonth()==9) {
	 		Bulan="10";
	 	}else if (tgl.getMonth()==10) {
	 		Bulan="11";
	 	}else if (tgl.getMonth()==11) {
	 		Bulan="12";
	 	}
	 	var x=2500000;
	 	var y=1000000
	 	var idnumber = Math.floor(Math.random() * x)+y;;
	 	document.getElementById('SND').value=<?php echo date('y') ?> + Bulan + <?php echo date('d'); ?> +""+idnumber;	
 	}
 </script>

<script type="text/javascript">
	function hitungcicilan(nominal){
		var x = document.getElementById('nominal').value;
		var y = 12;
		var z = x / y;
		document.getElementById('cbln').value = z;		
	};
</script>