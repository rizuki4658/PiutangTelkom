 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
<!-- page content -->
        <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>TABEL JURNAL<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <!--<p class="text-muted font-13 m-b-30">
                            KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
                          </p>-->

                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Debet</th>
                          <th>Kredit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$no=1;
                        	$query_tabel="SELECT * FROM jurnal WHERE debet!=0 OR kredit!=0 ORDER BY tgl ASC LIMIT 100";
                        	$view_tabel=mysqli_query($link,$query_tabel);
                        	if (mysqli_num_rows($view_tabel)>0) {
                        	while ($datajurnal=mysqli_fetch_assoc($view_tabel)) {
                        		$keterangan=$datajurnal['ket'];
                        	 ?>                           	
                        <tr>
                          		<td><?php echo $no++; ?></td>
                          		<td><?php echo date("d-m-y",strtotime($datajurnal['tgl'])); ?></td>
                          		<td><?php echo $datajurnal['kode_akun']; ?></td>
                          		<td><?php if (number_format($datajurnal['kredit'])!=0 && number_format($datajurnal['debet'])==0 ) {
                          			echo "&nbsp;&nbsp;&nbsp;&nbsp;".$datajurnal['nama_akun'];
                          		}else{
                          			echo $datajurnal['nama_akun'];
                          		}  
                          		?></td>
                          		<td style="text-align: right;"><?php if (number_format($datajurnal['debet'])==0) {
                          			echo "";
                          		}else{
                          			echo number_format($datajurnal['debet']);
                          		} 
                          		?></td>
                          		<td style="text-align: right;"><?php if (number_format($datajurnal['kredit'])==0) {
                          			echo "";
                          		}else{
                          			echo number_format($datajurnal['kredit']);
                          		}?></td>
                        </tr>
                        <?php
                        	}
                        }else{?>

                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       
 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>