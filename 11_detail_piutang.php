<?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
	<div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">

          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-user"></i> <small>INFO AGEN & CUSTOMER</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <?php
                      $key=$_GET['snd'];
                      $ref_piutang="SELECT * FROM piutang WHERE snd='$key'";
                      $hasil_ref=mysqli_query($link,$ref_piutang);
                      if (mysqli_num_rows($hasil_ref)>0) {
                        while ($dataP=mysqli_fetch_assoc($hasil_ref)) { ?>
                    <div class="col-xs-6">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td style="width:50%; font-weight: bold;">SND :</td>
                          <td style="width:50%;"><?php echo $dataP['snd']; ?></td>
                        </tr>
                        <tr>
                          <td style="width:50%; font-weight: bold;">Nama Agen :</td>
                          <td style="width:50%;"><?php echo $dataP['agen']; ?></td>
                        </tr>
                        <tr>
                          <td style="width:50%; font-weight: bold;">Nama Customer :</td>
                          <td style="width:50%;"><?php echo $dataP['customer']; ?></td>
                        </tr>
                        <tr>
                          <td style="width:50%; font-weight: bold;">Kontak/ND_REF :</td>
                          <td style="width:50%;"><?php echo $dataP['nd_ref']; ?></td>
                        </tr>
                        <tr>
                          <td style="width:50%; font-weight: bold;">email :</td>
                          <td style="width:50%;"><?php echo $dataP['email']; ?></td>
                        </tr>
                        <tr>
                          <td style="width:50%; font-weight: bold;">Pembayaran Thn.1 :</td>
                          <td style="width:50%;"><?php echo "Rp,".number_format($dataP['nominal']); ?></td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <a data-toggle="modal" data-target="#modal-siapC" class="btn btn-default"><i class="fa fa-cube"></i> Siapkan Cicilan Berikutnya</a>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                    <div class="col-xs-6">
                      <div style="border:1px solid #e6e9ed; height: 200px;">
                        <h1 style=" margin: 10% 10%;">
                          <i class="fa fa-money"></i> 
                          <small>Cicilan Perbulan<P></P>
                            <center>
                            <?php echo "Rp,".number_format($dataP['cicilan'])." /bln"; ?>
                            </center>
                          </small> 
                        </h1>
                      </div>
                    </div>

                    <?php      
                        }
                      }
                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>

                <div class="">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2><i class="fa fa-table"></i> <small>TABEL CICILAN</small></h2>
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
                          <th>SND</th>
                          <th>Bulan Ke</th>
                          <th>Grouping</th>
                          <th>Keterangan</th>
                          <th>CP Penerima</th>
                          <th>Penerima</th>
                          <th>Nominal</th>
                          <th>Bayar</th>
                          <th>Sisa</th>
                          <th>Denda</th>
                          <th>Status</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>
                      	
                      		<?php
                      			$no=1;
                      			$bulan=1;
                      			$SND=$_GET['snd'];
                      			$query_detil="SELECT * FROM detail_piutang WHERE snd='$SND' ORDER BY tgl ASC LIMIT 100";
                      			$tabelD=mysqli_query($link,$query_detil);
                      			if (mysqli_num_rows($tabelD)>0) {
                      				while ($dataD=mysqli_fetch_assoc($tabelD)) { 
                      					$nilai_denda=$dataD['denda'] * $dataD['nominal']/100;
                            ?>

                            <tr>
                      				
                      				<td><?php echo $no++; ?></td>	
                      				<td><?php echo $dataD['tgl']; ?></td>
                      				<td><?php echo $dataD['snd']; ?></td>
                      				<td>
                                <?php
                                if ($dataD['status']=='Lunas(Thn. Pertama)') {
                                   echo "Tahun Pertama";
                                 }else{
                                    echo "Bulan ".$bulan++;      
                                 }
                                ?>
                              </td>
                      				<td><?php echo $dataD['grouping'] ?> </td>
                      				<td><?php echo $dataD['keterangan']; ?></td>
                      				<td><?php echo $dataD['cp_penerima'];?></td>
                      				<td><?php echo $dataD['penerima']; ?></td>
                      				<td style="text-align: right;"><?php echo number_format($dataD['nominal']);?></td>
                      				<td style="text-align: right;"><?php echo number_format($dataD['bayar']);?></td>
                      				<td style="text-align: right;">
                                  <?php
                                    $nol=0;
                                    if ($dataD['sisa']<0) {
                                      echo "Rp".$nol;
                                    }else{
                                      echo "Rp,".number_format($dataD['sisa']);
                                    }
                                  ?>                                 
                              </td>
                      				<td><?php echo $dataD['denda']." %(Rp,".number_format($nilai_denda).")"; ?></td>
                      				<td><?php echo $dataD['status']; ?></td>
                      				<td>
                                  <?php
                                    if ($dataD['status']=='Lunas(Thn. Pertama)') { 
                                      echo "_";
                                      
                                    }elseif ($dataD['status']=='BELUM BAYAR'){ 
                                    ?>

                                    <a href="<?php echo "12_pembayaran.php?kode=".$dataD['kode_p']."&snd=".$dataD['snd']."&cicil=".$dataD['nominal']."&tgl=".$dataD['tgl']."&cst=".$_GET['cst']; ?>" class="btn btn-default" title="Pembayaran">Pembayaran</a>
                                    
                                    <a class="btn btn-danger" title="Hapus" href="<?php echo "./6_detil_piutang/hapus_pembayaran.php?kode=".$dataD['kode_p']."&snd=".$dataD['snd']."&cicil=".$dataD['nominal']."&tgl=".$dataD['tgl']."&cst=".$_GET['cst']; ?>" onclick="return confirm('Hapus data piutang?')"><i class="fa fa-trash"></i></a>
                                  <?php
                                    }else{ ?>
                                    <a href="<?php echo "13_edit_pembayaran.php?kode=".$dataD['kode_p']."&snd=".$dataD['snd']."&cicil=".$dataD['nominal']."&tgl=".$dataD['tgl']."&cst=".$_GET['cst']; ?>" class="btn btn-default" title="Edit Data">Edit</a>

                                    <a class="btn btn-danger" title="Hapus" href="<?php echo "./6_detil_piutang/hapus_pembayaran.php?kode=".$dataD['kode_p']."&snd=".$dataD['snd']."&cicil=".$dataD['nominal']."&tgl=".$dataD['tgl']."&cst=".$_GET['cst']; ?>" onclick="return confirm('Hapus data piutang?')"><i class="fa fa-trash"></i></a>
                                  <?php
                                    }
                                  ?>    
                              </td>
                      		

                          </tr>
                          <?php
                      				}
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

          <!-- Small modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-siapC">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span>
                          </button>
                    <h4 class="modal-title" id="myModalLabel2">
                      <center><i class="fa fa-cube"></i> <small>CICILAN</small></center>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <form class="demo-form" method="post" action="./6_detil_piutang/persiapan_cicilan.php">
                      <div id="valid_tgl">
                      
                      </div>
                      
                      <label for="tanggal">Tanggal * :</label>
                      <input type="date" id="tanggal" name="tanggal" class="form-control" style="text-align: center;" onchange="cektgl(this.value);" required />

                      <label for="tanggal">SND :</label>
                      <input type="text" name="snd" class="form-control" value="<?php echo $_GET['snd']; ?>" required readonly style="text-align: right;">
                      
                      <label for="tanggal">CUSTOMER :</label>
                      <input type="text" name="customer" class="form-control" value="<?php echo $_GET['cst'] ?>" required readonly style="text-align: right;">
                      <label for="tanggal">CICILAN :</label>
                      <input type="text" name="cicilan" class="form-control" value="<?php echo $_GET['cicil'] ?>" required readonly style="text-align: right;">
                      <?php
                      $sndtgl=$_GET['snd'];
                      $cek_cicilan_tgl="SELECT * FROM detail_piutang WHERE snd='$sndtgl' ORDER BY tgl DESC LIMIT 1";
                      $hasil_cek_tgl=mysqli_query($link, $cek_cicilan_tgl);
                      $hasil_tgl='';
                      if (mysqli_num_rows($hasil_cek_tgl)>0) {
                        while ($datacekC=mysqli_fetch_assoc($hasil_cek_tgl)) { 
                          $hasil_tgl=$datacekC['tgl'];
                      ?>


                      <input type="date" name="tgl" value="<?php echo $datacekC['tgl']; ?>" id="tgl" style="display: none;">

                      <?php
                        }                        
                      }
                      ?>
                      <center>
                        <div id="button_tgl" style="margin-top: 5px;">
                            
                        </div>
                      </center>
                    </form>                 
                  </div>
                  <div class="modal-footer">
                    <a href="<?php echo "11_detail_piutang.php?snd=$_GET[snd]&cst=$_GET[cst]&cicil=$_GET[cicil]&tgl=$hasil_tgl"; ?>" class="btn btn-round btn-default" style="border-radius: 100%;"><i class="fa fa-trash"></i> </a>               
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->
        </div>
        <!-- /page content -->


 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>

 <script type="text/javascript">
  function cektgl(tanggal){
    var tanggal1=document.getElementById('tanggal').value;
    var tanggal2=document.getElementById('tgl').value;
    if (tanggal1 <= tanggal2) {
      document.getElementById('valid_tgl').innerHTML='<i style="color: red;">Tanggal tidak sesuai/atau cicilan sudah dicatat pada tanggal tersebut.</i>';
      document.getElementById('button_tgl').innerHTML=''; 
    }else{
       document.getElementById('valid_tgl').innerHTML='';
      document.getElementById('button_tgl').innerHTML='<button type="reset" name="Reset" class="btn btn-warning"><i class="fa fa-refresh" title="Reset"></i> Reset</button><button type="submit" name="OK" class="btn btn-primary"><i class="fa fa-edit" title="Catat"></i> Catat</button>';
    }
  }
</script>