 <?php require_once './Top_Bottom_Menu/Top_Menu.php'; ?>
<!-- page content -->
        <div class="right_col" role="main" style="background-image: url('./gambar/Indihome_Fiber.png'); background-repeat: no-repeat; background-position: center;">
          <!-- top tiles -->
          <div class="row tile_count" style="margin-top: 45%;">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Agen</span>
              <div class="count" style="font-size: 20px;">
                <?php
                   $cek_agen=mysqli_query($link, "SELECT * FROM agen ORDER BY tgl ASC");
                   if (mysqli_num_rows($cek_agen)>0) {
                    $jumlah_agen=mysqli_num_rows($cek_agen);
                     echo number_format($jumlah_agen);
                   }else{
                    echo "0";
                   }
                ?>
              </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Orang</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-male"></i> Total Customer</span>
              <div class="count" style="font-size: 20px;">
                <?php
                   $cek_customer=mysqli_query($link, "SELECT * FROM piutang ORDER BY tgl ASC");
                   if (mysqli_num_rows($cek_customer)>0) {
                    $jumlah_cst=mysqli_num_rows($cek_customer);
                     echo number_format($jumlah_cst);
                   }else{
                    echo "0";
                   }
                ?>                  
              </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i></i> Orang</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-long-arrow-down"></i> Total Masuk</span>
              <div class="count green" style="font-size: 15px;">
                <?php
                   $jumlah_bayar=0;
                   $tanggal='';
                   $cek_bayar=mysqli_query($link, "SELECT * FROM detail_piutang ORDER BY tgl ASC");
                   if (mysqli_num_rows($cek_bayar)>0) {
                      while ($data_Bayar=mysqli_fetch_assoc($cek_bayar)) {
                        $jumlah_bayar+=$data_Bayar['bayar'];
                        $tanggal=$data_Bayar['tgl'];
                      }
                      echo "Rp, ".number_format($jumlah_bayar);
                   }else{
                    echo "0";
                   } 
                ?>

                </div>                
                <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> s/d</i> <?php echo date('d-M-Y',strtotime($tanggal)); ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-long-arrow-up"></i> Total Piutang</span>
              <div class="count red" style="font-size: 15px;">
                <?php
                   $jumlah_sisa=0;
                   $tanggal_S='';
                   $cek_sisa=mysqli_query($link, "SELECT * FROM detail_piutang ORDER BY tgl ASC");
                   if (mysqli_num_rows($cek_sisa)>0) {
                      while ($data_Sisa=mysqli_fetch_assoc($cek_sisa)) {
                        $jumlah_sisa+=$data_Sisa['sisa'];
                        $tanggal_S=$data_Sisa['tgl'];
                      }
                      echo "Rp, ".number_format($jumlah_sisa);
                   }else{
                    echo "0";
                   } 
                ?>

                </div>                
                <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i> s/d</i> <?php echo date('d-M-Y',strtotime($tanggal_S)); ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"> Masukan Lainnya(Denda)</span>
              <div class="count blue" style="font-size: 15px;">
                <?php
                   $jumlah_N=0;
                   $tanggal_D='';
                   $denda=0;
                   $persen=0;
                   $baris=1;
                   $cek_denda=mysqli_query($link, "SELECT * FROM detail_piutang WHERE denda !=0 ORDER BY tgl ASC");
                   if (mysqli_num_rows($cek_denda)>0) {
                      $baris=mysqli_num_rows($cek_denda);
                      while ($data_Denda=mysqli_fetch_assoc($cek_denda)) {
                        $jumlah_N+=$data_Denda['nominal'];
                        $persen+=$data_Denda['denda'];
                        $tanggal_D=$data_Denda['tgl'];
                      }
                      $denda=($jumlah_N*$persen)/100;
                      echo "Rp, ".number_format($denda);
                   }else{
                    echo "0";
                   } 
                ?>

              </div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i> s/d</i> <?php echo date('d-M-Y',strtotime($tanggal_D)); ?></span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-warning"></i> Kerugian Piutang</span>
              <div class="count yellow" style="font-size: 15px;">
                <?php
                  $nominal=0;
                  $sisa=0;
                  $persentase=0;
                  $cek_kerugian=mysqli_query($link, "SELECT * FROM detail_piutang ORDER BY tgl ASC");
                  if (mysqli_num_rows($cek_kerugian)>0) {
                    while ($data_kerugian=mysqli_fetch_assoc($cek_kerugian)) {
                      $nominal+=$data_kerugian['nominal'];
                      $sisa+=$data_kerugian['sisa'];
                      $persentase=$sisa/$nominal;
                    }
                    echo "Rp, ".number_format($sisa);
                  }

                ?>
              </div>
              <span class="count_bottom"><i class="yellow"><i class="fa fa-sort-right"></i><?php echo $persentase." %"; ?></i> dari <?php echo "Rp, ".number_format($nominal); ?></span>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
               
          </div>
          <br />

                

        </div>
        <!-- /page content -->
 <?php require_once './Top_Bottom_Menu/Bottom_Menu.php'; ?>
