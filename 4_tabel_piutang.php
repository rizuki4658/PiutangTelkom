 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
<!-- page content -->
         <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-table"></i> <small>TABEL PIUTANG</small></h2>
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
                          <th>USERS_NPC</th>
                          <th>PSWD</th>
                          <th>Agen</th>
                          <th>SND</th>
                          <th>Customer</th>
                          <th>Telp.</th>
                          <th>Email</th>
                          <th>Nominal</th>
                          <th>Cicilan/Bln</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        	$no=1;
                          $username=$_SESSION['username'];
                          $query_users="SELECT * FROM users WHERE username='$username'";
                          $execute=mysqli_query($link,$query_users);
                          $namapegawai="";
                          if (mysqli_num_rows($execute)==1) {
                            while ($datauser=mysqli_fetch_assoc($execute)) {
                              $namapegawai=$datauser['nama'];
                            }
                          }
                        	$query_tabel="SELECT * FROM piutang WHERE nama='$namapegawai' ORDER BY tgl ASC LIMIT 100";
                        	$view_tabel=mysqli_query($link,$query_tabel);
                        	if (mysqli_num_rows($view_tabel)>0) {
                        	while ($datapiutang=mysqli_fetch_assoc($view_tabel)) {
                        		
                        	 ?>                           	
                        <tr>
                          		<td><?php echo $no++; ?></td>
                          		<td><?php echo date("d-m-y",strtotime($datapiutang['tgl'])); ?></td>
                          		<td><?php echo $datapiutang['nama']; ?></td>
                          		<td><?php echo $datapiutang['user_npc']; ?></td>
                          		<td><?php echo $datapiutang['pswd']; ?></td>
                          		<td><?php echo $datapiutang['agen']; ?></td>
                              <td><?php echo $datapiutang['snd']; ?></td>
                              <td><?php echo $datapiutang['customer']; ?></td>
                              <td><?php echo $datapiutang['nd_ref']; ?></td>
                              <td><?php echo $datapiutang['email']; ?></td>
                              <td><?php echo "Rp,".number_format($datapiutang['nominal']); ?></td>
                              <td><?php echo "Rp,".number_format($datapiutang['cicilan']); ?></td>
                              <td>
                                <a href="<?php echo "./2_Piutang/proses_hapus.php?id=$datapiutang[snd]"; ?>" class="btn btn-danger" onclick="return confirm('Hapus data piutang?')" title="Hapus Data">
                                  Hapus
                                </a>
                                <?php
                                  $SND=$datapiutang['snd'];
                                  $nama=$datapiutang['nama'];
                                  $cek_detil="SELECT * FROM detail_piutang WHERE snd='$SND'";
                                  $hasil_detil=mysqli_query($link,$cek_detil);
                                  if (mysqli_num_rows($hasil_detil)==0) { ?>
                                  <a href="<?php echo "4_tabel_piutang.php?snd=$datapiutang[snd]&tgl=$datapiutang[tgl]"; ?>" class="btn btn-primary" title="Siapkan Cicilan">Cicilan</a>

                              <?php
                                  }else{ ?>
                                  <a href="<?php echo "11_detail_piutang.php?snd=$datapiutang[snd]&cst=$datapiutang[customer]&cicil=$datapiutang[cicilan]&tgl=$datapiutang[tgl]"; ?>" class="btn btn-success" title="Detail">Detail</a>
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

       <?php
          if (isset($_GET['snd'])) {?>
            
  <!-- Small modal -->
        <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal-siap">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                          </button>
                    <h4 class="modal-title" id="myModalLabel2">
                      <center><i class="fa fa-space-shuttle"></i> <small>CICILAN SIAP DI JURNAL</small></center>
                    </h4>
                  </div>

                  <div class="modal-body">
                    
                      <form class="form-horizontal form-label-left" method="post" action="./2_Piutang/proses_cicilan.php">
                          <?php
                            $id=$_GET['snd'];
                            $tgl_lgn=$_GET['tgl'];
                            if (isset($_GET['snd']) && isset($_GET['tgl'])) { ?>

                            <input type="text" name="snd" value="<?php echo $id; ?>" style="display: none;">

                            <input type="date" name="tglL" value="<?php echo $tgl_lgn; ?>" id="tglL" style="display: none;">
                          <?php  
                            }

                          ?>
                          <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal: <span class="required">*</span>
                            </label>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input  type="date" id="tanggal" name="tanggal" required="required" class="form-control col-md-7 col-xs-12" onchange="cektgl(this.value);">
                            </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-3" id="button_refresh">
                               
                              </div>
                          </div>
                      </form>

                  </div>

                  <div class="modal-footer">
                    <a href="4_tabel_piutang.php" class="btn btn-default" style="height: 35px;"><i class="fa fa-trash"></i></a>
                  </div>
              </div>
            </div>
          </div>
        </div>
    <!-- /modals -->
  <!-- /page content -->

        <?php
          }else{ ?>


        </div>
  <!-- /page content -->

        <?php

          }

       ?>
 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>



<script type="text/javascript">
    $('#modal-siap').modal({backdrop: 'static', keyboard: false});
</script>

<script type="text/javascript">
  function cektgl(tanggal){
    var tanggal1=document.getElementById('tanggal').value;
    var tanggal2=document.getElementById('tglL').value;
    if (tanggal1 <= tanggal2) {
      document.getElementById('button_refresh').innerHTML='<h6 style="color: red;">Tanggal Tidak Sesuai</h6>'; 
    }else{
      document.getElementById('button_refresh').innerHTML='<button type="reset" class="btn btn-default"><i class="fa fa-refresh" title="refresh"></i> Reset</button><button id="send" type="submit" class="btn btn-default"><i class="fa fa-check"></i> OK</button>';
    }
  }
</script>