<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){ //cek apakah user sudah login
        header("location:./Login_Logout/");
    }else {
    $link=mysqli_connect("localhost","root","","telkomsel");
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $login=mysqli_query($link,"SELECT * FROM users WHERE username = '$username' AND password='$password'");
    while ($data=mysqli_fetch_assoc($login)) {

	    $query_agen="SELECT * FROM agen ORDER BY tgl ASC";
	    $execute_agen=mysqli_query($link, $query_agen);
	    if (mysqli_num_rows($execute_agen)<=0) { ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>SISTEM INFORMASI PIUTANG</title>
    <link rel="icon" href="../gambar/logo-tangan-telkom-2.png" type="image/ico" />

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatab.les -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <body>
    
    <!-- Small modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modal-agen">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <i class="fa fa-users"></i> <small>LAPORAN AGEN PER TAHUN</small>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 50px;"></i></center>
                    <br>
                    <center>Data Agen Tahun <?php echo $tahun; ?> tidak ditemukan</center>
                  </div>
                  <div class="modal-footer">
                    <a href="../1A_agen_tahun.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
                  </div>
              </div>
            </div>
          </div>
    <!-- /modals -->


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script type="text/javascript">
        $('#modal-agen').modal({backdrop: 'static', keyboard: false});
    </script>
 </body>
</html>

<?php
	   	}else{


require('../phpfpdf/fpdf.php');

class PDF extends FPDF
{
    //Page header
    function Header()
    {
        
        $this->Image('../gambar/Indihome_Fiber.png',10,5,30,15);
        $this->SetFont('Times','B',15);
        $this->SetX(130);
        $this->Cell(35,0,"LAPORAN DATA AGEN INDIHOME",0,0,'C');

        $this->SetFont('Times','B',10);
        
        $this->Ln(7);
        $this->SetFont('Times','B',15);
        $this->SetX(130);
        $this->Cell(35,0,"KANTOR PLASA TELKOM",0,0,'C');
        $this->Ln(7);
        $this->SetFont('Times','',10);
        $this->SetX(130);
        $this->Cell(35,0,"JL. WR. Supratman No. 62 Bandung, Jawa Barat, Telp.(022) - 7202071, Fax(022) - 4241585",0,0,'C');
        $this->Ln(5);
      
        $this->SetX(80);
        
        $this->Line(10,28,285,28);
        
        $this->SetFont('Arial','B',15);
        
        //pindah baris
        $this->Ln(5);

    }
 
    //Page Content
    function Content()
    {


        $this->SetFont('Times','B',9);
        $this->SetX(2);
        $this->Cell(35,0,"Keseluruhan",0,0,'C');
        $this->Ln(4);
        $this->Cell(10,5,"No",1,0,'C');
        $this->Cell(30,5,"Tanggal",1,0,'C');
        $this->Cell(40,5,"Nama Agen",1,0,'C');
        $this->Cell(30,5,"SND",1,0,'C');
        $this->Cell(40,5,"Customer",1,0,'C');
        $this->Cell(30,5,"ND REF",1,0,'C');
        $this->Cell(50,5,"Email",1,0,'C');
        $this->Cell(20,5,"Cicilan",1,0,'C');
        $this->Cell(25,5,"Nominal",1,0,'C');
        $this->Ln();
        $this->SetFont('Times','',9);
        
        $no=1;
        $link=mysqli_connect("localhost","root","","telkomsel");
       	
        $query="SELECT * from agen ORDER BY tgl ASC";
        $hasil=mysqli_query($link,$query);
        if (mysqli_num_rows($hasil) > 0) {
            $total=0;
            while($lihat=mysqli_fetch_array($hasil)){
                $total+=$lihat['nominal'];
                $bulan=date("M",strtotime($lihat['tgl']));
            if ($bulan=='01' || $bulan=="Jan") {
                $bulan="Januari";
            }elseif ($bulan=='02' || $bulan=="Feb") {
                $bulan="Februari";
            }elseif ($bulan=='03' || $bulan=="Mar") {
                $bulan="Maret";
            }elseif ($bulan=='04' || $bulan=="Apr") {
                $bulan="April;";
            }elseif ($bulan=='05' || $bulan=="May") {
                $bulan="Mei";
            }elseif ($bulan=='06' || $bulan=="Jun") {
                $bulan="Juni";
            }elseif ($bulan=='07' || $bulan=="Jul") {
                $bulan="Juli";
            }elseif ($bulan=='08' || $bulan=="Aug") {
                $bulan="Agustus";
            }elseif ($bulan=='09' || $bulan=="Sep") {
                $bulan="September";
            }elseif ($bulan=='10' || $bulan=="Oct") {
                $bulan="Oktober";
            }elseif ($bulan=='11' || $bulan=="Nov") {
                $bulan="November";
            }elseif ($bulan=='12' || $bulan=="Dec") {
                $bulan="Desember";
            }
            $this->Cell(10,5, $no , 1, 0, 'C');
            $this->Cell(30,5, date("d",strtotime($lihat['tgl']))." ".$bulan." ".date("Y",strtotime($lihat['tgl'])),1, 0, 'C');
            $this->Cell(40,5, $lihat['nama'], 1, 0,'L');
            $this->Cell(30,5, $lihat['snd'],1, 0, 'C');
            $this->Cell(40,5, $lihat['customer'], 1, 0,'L');
            $this->Cell(30,5, $lihat['nd_ref'],1, 0, 'C');
            $this->Cell(50,5, $lihat['mail'],1, 0, 'C');
            $this->Cell(20,5, number_format($lihat['cicilan']),1, 0, 'R');
            $this->Cell(25,5, number_format($lihat['nominal']),1, 0, 'R');
            $this->ln();
            $no++;
                }
            $this->SetFont('Times','B',9);
            $this->Cell(250,5,"Total (".mysqli_num_rows($hasil)." Customer)",1,0,'C');
            $this->Cell(25,5, "Rp, ".number_format($total),1,0,'R');
        }else{

        }
    }
 
    //Page footer
    function Footer()
    {
        $bulan2=date("M");
         if ($bulan2=='01' || $bulan2=="Jan") {
            $bulan2="Januari";
        }elseif ($bulan2=='02' || $bulan2=="Feb") {
            $bulan2="Februari";
        }elseif ($bulan2=='03' || $bulan2=="Mar") {
            $bulan2="Maret";
        }elseif ($bulan2=='04' || $bulan2=="Apr") {
            $bulan2="April;";
        }elseif ($bulan2=='05' || $bulan2=="May") {
            $bulan2="Mei";
        }elseif ($bulan2=='06' || $bulan2=="Jun") {
            $bulan2="Juni";
        }elseif ($bulan2=='07' || $bulan2=="Jul") {
            $bulan2="Juli";
        }elseif ($bulan2=='08' || $bulan2=="Aug") {
            $bulan2="Agustus";
        }elseif ($bulan2=='09' || $bulan2=="Sep") {
            $bulan2="September";
        }elseif ($bulan2=='10' || $bulan2=="Oct") {
            $bulan2="Oktober";
        }elseif ($bulan2=='11' || $bulan2=="Nov") {
            $bulan2="November";
        }elseif ($bulan2=='12' || $bulan2=="Dec") {
            $bulan2="Desember";
        }
        $this->Ln(20);
        $this->SetFont('Times','',10);
    
        $this->SetX(250);
        $this->Cell(1,10,"............................, ".date("d")." ".$bulan2." ".date("Y"),0,0,'C');
        $this->Ln(20);
        $this->SetX(10);
        $this->Ln(15);
        $this->SetX(220);
        $this->Cell(1,10,"(...................................................................)",0,0,'L');
        $this->Ln(5);
        //$this->SetX(220);
        //$this->Cell(1,10,"NIP.",0,0,'L');
        //atur posisi 1.5 cm dari bawah
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10,$this->GetY(),285,$this->GetY());
        //Arial italic 9
        $this->SetFont('Times','',9);
        //nomor halaman
        $this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
    }
}
//contoh pemanggilan class
$pdf = new PDF('L','mm','A4');
$pdf->SetTitle('Laporan Agen Keseluruhan');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output();




	   	}
    }

  }
?>