<?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>

 <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  	<div class="x_title">
                    	<h2><i class="fa fa-users"></i><small>LAPORAN AGEN PER HARI</small></h2>
                    	<ul class="nav navbar-right panel_toolbox">
                      	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      	</li>
                      	<li><a class="close-link"><i class="fa fa-close"></i></a>
                      	</li>
                    	</ul>
                    <div class="clearfix"></div>
                  	</div>
                 	<div class="x_content">
                 	<form class="form-horizontal form-label-left" novalidate action="./5_laporan_agen/hari.php" method="post">
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tanggal <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" required="required" class="form-control col-md-7 col-xs-12" id="tanggal" name="tanggal">
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
