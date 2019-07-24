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
        $nama=$data['nama'];
        $user=$data['user_npc'];
        $pswd=$data['pswd'];
        
        $nama_bulan='';

        $snd=$_POST['snD'];
        $cst=$_POST['cst'];
        $cicil=$_POST['cicil'];
        $tanggal=$_POST['tanggal'];

        $tahun=$_POST['tahun'];
        $tanggal_awal=$tahun.'-'.'01'.'-'.'01';
        $tanggal_akhir=$tahun.'-'.'12'.'-'.'31';

        $query_agen="SELECT * FROM detail_piutang WHERE snd = '$snd' AND tgl >='$tanggal_awal' AND tgl<='$tanggal_akhir'";
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
    <link rel="icon" href="../images/favicon.ico" type="image/ico" />

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
        <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id="modal-agen">
            <div class="modal-dialog modal-md">
              <div class="modal-content" style="margin-top: 20%;">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">
                      <small><i class="fa fa-search"></i></small><i class="fa fa-user"></i> <small>LAPORAN DETAIL PIUTANG PER BULAN</small>
                    </h4>
                  </div>
                  <div class="modal-body">
                    <center><i class="glyphicon glyphicon-remove-circle" style="font-size: 50px;"></i></center>
                    <br>
                    <center>Data detail piutang <?php echo "dengan SND(".$snd.") atas nama ".$cst." ".$tahun; ?> tidak ditemukan</center>                 
                  </div>
                  <div class="modal-footer">
                    <a href="../4A_detail_tahun.php" class="btn btn-round btn-default" style="height: 35px;">OK</a>                 
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
        $this->Cell(35,0,"LAPORAN DETAIL PIUTANG INDIHOME",0,0,'C');

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
        $this->SetX(10);
        $link=mysqli_connect("localhost","root","","telkomsel");
        $snd=$_POST['snD'];
        $cst=$_POST['cst'];
        $cicil=$_POST['cicil'];
        $tanggal=$_POST['tanggal'];

        $nama_bulan='';

        $snd=$_POST['snD'];
        $cst=$_POST['cst'];
        $cicil=$_POST['cicil'];
        $tanggal=$_POST['tanggal'];

        $tahun=$_POST['tahun'];
        $tanggal_awal=$tahun.'-'.'01'.'-'.'01';
        $tanggal_akhir=$tahun.'-'.'12'.'-'.'31';
        
        
        $username=$_SESSION['username'];
        $password=$_SESSION['password'];
        $nama='';
        $user='';
        $pswd='';
        $login=mysqli_query($link,"SELECT * FROM users WHERE username = '$username' AND password='$password'");
        while ($data=mysqli_fetch_assoc($login)) {
        $nama=$data['nama'];
        $user=$data['user_npc'];
        $pswd=$data['pswd'];
        $this->SetX(230);
        $this->Cell(35,0,"Nama User : ".$data['nama'],0,0,'L');
        $this->Ln(5);
        $this->SetX(230);
        $this->Cell(35,0,"User NPC: ".$data['user_npc'],0,0,'L');
        $this->Ln(5);
        $this->SetX(230);
        $this->Cell(35,0,"PSWD: ".$data['pswd'],0,0,'L');
        }
        $this->SetX(10);
        $this->SetY(34);
        $query_piutang=mysqli_query($link, "SELECT * FROM piutang WHERE snd='$snd'");
        if (mysqli_num_rows($query_piutang)>0) {
            while ($data_piutang=mysqli_fetch_assoc($query_piutang)) {
                $this->Cell(30,5,"Nama Agen",0,0,'J');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(35,5, $data_piutang['agen'],0,0,'J');
                $this->Ln(5);
                $this->Cell(30,5,"Customer",0,0,'L');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(35,5, $data_piutang['customer'],0,0,'J');
                $this->Ln(5);
                $this->Cell(30,5,"ND REF",0,0,'L');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(35,5, $data_piutang['nd_ref'],0,0,'J');
                $this->Ln(5);
                $this->Cell(30,5,"Email",0,0,'L');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(35,5, $data_piutang['email'],0,0,'J');
                $this->Ln(5);
                $this->Cell(30,5,"Cicilan",0,0,'L');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(35,5,"Rp,".number_format($data_piutang['cicilan'])."/bln",0,0,'J');
                $this->Ln(5);
                $this->Cell(30,5,"Mulai Berlangganan",0,0,'L');
                $this->Cell(5,5,":",0,0,'C');
                $this->Cell(10,5, date("d-m-Y", strtotime($data_piutang['tgl'])),0,0,'J');
                $this->Ln(10);
            }
        }
        $this->SetX(5);
        $this->Cell(10,5, "SND : ".$snd,0,0,'J');
        $this->ln();
        $this->SetX(5);
        $this->Cell(10,5,"No",1,0,'C');
        $this->Cell(15,5,"Tanggal",1,0,'C');
        $this->Cell(35,5,"Grouping",1,0,'C');
        $this->Cell(50,5,"Keterangan",1,0,'C');
        $this->Cell(40,5,"Penerima",1,0,'C');
        $this->Cell(30,5,"CP Penerima",1,0,'C');
        $this->Cell(20,5,"Nominal",1,0,'C');
        $this->Cell(20,5,"Bayar",1,0,'C');
        $this->Cell(20,5,"Sisa",1,0,'C');
        $this->Cell(10,5,"Denda",1,0,'C');
        $this->Cell(40,5,"Status",1,0,'C');
        $this->Ln();
        $this->SetX(5);
        $this->SetFont('Times','',9);
        
        $no=1;
        $link=mysqli_connect("localhost","root","","telkomsel");
        
        $query="SELECT * from detail_piutang WHERE snd='$snd' AND tgl >= '$tanggal_awal' AND tgl <= '$tanggal_akhir' ORDER BY tgl ASC";
        $hasil=mysqli_query($link,$query);
        $query2="SELECT * from detail_piutang WHERE snd='$snd' AND tgl >= '$tanggal_awal' AND tgl <= '$tanggal_akhir' AND denda !=0 ORDER BY tgl ASC";
        $hasil2=mysqli_query($link,$query2);
        if (mysqli_num_rows($hasil) > 0) {
            $totalN=0;
            $totalB=0;
            $totalS=0;
            $totalD=0;
            $baris=1;
            if (mysqli_num_rows($hasil2)<=0) {                
                $baris=1;
            }else{
                $baris=mysqli_num_rows($hasil);
            }
            $persen=0;
            while($lihat=mysqli_fetch_array($hasil)){
                $totalN+=$lihat['nominal'];
                $totalB+=$lihat['bayar'];
                $totalS+=$lihat['sisa'];
                $totalD+=$lihat['denda'];
                $persen=$totalD/$baris;
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
            $this->Cell(15,5, date("d-m-y",strtotime($lihat['tgl'])),1, 0, 'C');
            $this->Cell(35,5, $lihat['grouping'], 1, 0,'C');
            $panjangKet=$this->GetStringWidth($lihat['keterangan']);
            if ($panjangKet>=50) {
                $this->Cell(50,5, substr($lihat['keterangan'], 0, 47).'...',1, 0, 'L');
            }else{
                $this->Cell(50,5, $lihat['keterangan'],1, 0, 'L');
            }
            
            $panjangPen=$this->GetStringWidth($lihat['penerima']);
            if ($panjangPen>=40) {
                $this->Cell(40,5, substr($lihat['penerima'], 0, 37).'...',1, 0, 'L');
            }else{
                $this->Cell(40,5, $lihat['penerima'],1, 0, 'L');
            }

            $panjangCP=$this->GetStringWidth($lihat['cp_penerima']);
            if ($panjangCP>=30) {
                $this->Cell(30,5, substr($lihat['cp_penerima'], 0, 27).'...',1, 0, 'L');
            }else{
                $this->Cell(30,5, $lihat['cp_penerima'],1, 0, 'L');
            }
            $this->Cell(20,5, number_format($lihat['nominal']), 1, 0, 'R');
            $this->Cell(20,5, number_format($lihat['bayar']),1, 0, 'R');
            $this->Cell(20,5, number_format($lihat['sisa']), 1, 0,'R');
            $this->Cell(10,5, number_format($lihat['denda'])." %", 1, 0,'C');
            $this->Cell(40,5, $lihat['status'], 1, 0,'C');
            $this->ln();
            $this->SetX(5);
            $no++;
            }
            $this->Cell(180,5, "Total", 1, 0, 'C');
            $this->Cell(20,5, number_format($totalN), 1, 0, 'R');
            $this->Cell(20,5, number_format($totalB), 1, 0, 'R');
            $this->Cell(20,5, number_format($totalS), 1, 0, 'R');
            $this->Cell(10,5, number_format($persen)." %", 1, 0, 'C');
            $this->Cell(40,5, "", 1, 0, 'C');
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
$pdf->SetTitle('Laporan Piutang '.$cst.'('.$tahun.')');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Content();
$pdf->Output();

        }
    }
   }
?>