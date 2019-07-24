 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
<!-- page content -->
         <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-table"></i> <small>TABEL AGEN</small></h2>
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
                          <th>Nama</th>
                          <th>SND</th>
                          <th>Customer</th>
                          <th>ND REF</th>
                          <th>Email</th>
                          <th>Thn. Pertama</th>
                          <th>Cicilan</th>
                          <th style="text-align: center;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$no=1;
                        	$query_tabel="SELECT * FROM agen ORDER BY nama ASC LIMIT 100";
                        	$view_tabel=mysqli_query($link,$query_tabel);
                        	if (mysqli_num_rows($view_tabel)>0) {
                        	while ($dataagen=mysqli_fetch_assoc($view_tabel)) {
                        		
                        	 ?>                           	
                        <tr>
                          		<td><?php echo $no++; ?></td>
                              <td><?php echo $dataagen['tgl']; ?></td>
                          		<td><?php echo $dataagen['nama']; ?></td>
                          		<td><?php echo $dataagen['snd']; ?></td>
                              <td><?php echo $dataagen['customer']; ?></td>
                              <td><?php echo $dataagen['nd_ref']; ?></td>
                              <td><?php echo $dataagen['mail']; ?></td>
                              <td style="text-align: right;"><?php echo "Rp, ".number_format($dataagen['nominal']); ?></td>
                              <td style="text-align:right;"><?php echo "Rp, ".number_format($dataagen['cicilan'])." /bln"; ?></td>
                              <td style="text-align: center;">
                              <?php
                                  $SND=$dataagen['snd'];
                                  $nama=$dataP['nama'];
                                  $cek_detil="SELECT * FROM detail_piutang WHERE snd='$SND'";
                                  $hasil_detil=mysqli_query($link,$cek_detil);
                                  if (mysqli_num_rows($hasil_detil)==0) { ?>
                                  <a href="<?php echo "7_edit_agen.php?id=$dataagen[id]"; ?>" class="btn btn-default" title="Edit"><i class="fa fa-edit"></i></a>

                              <?php
                                  }else{ ?>
                                  <a href="#" title="Sudah Ditetapkan"><i class="fa fa-check"></i> </a>
                              <?php
                                  }
                                ?>
                              </td>
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