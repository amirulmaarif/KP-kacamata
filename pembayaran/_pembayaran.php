 <?php
	$pro="simpan";
	$id_pengeluaran="";
	$nominal="";
	$pesan="";
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
	$bukti_bayar="avatar.jpg";
	$bukti_bayar0="avatar.jpg";
	$status="Order";
	$keterangan="";
?>
  


<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('pembayaran/pembayaran_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `id_pembayaran` from `$tbpembayaran` order by `id_pembayaran` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="PBY".$th.$bl;
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["id_pembayaran"];
   
   $bul=substr($idmax,5,2);
   $tah=substr($idmax,3,2);
    if($bul==$bl && $tah==$th){
     $urut=substr($idmax,7,3)+1;
     if($urut<10){$idmax="$kd"."00".$urut;}
     else if($urut<100){$idmax="$kd"."0".$urut;}
     else{$idmax="$kd".$urut;}
    }//==
    else{
     $idmax="$kd"."001";
     }   
   }//jum>0
  else{$idmax="$kd"."001";}
  $id_pembayaran=$idmax;
?>


<?php
$id_pengeluaran = $_GET["id"];
$sql = "select * from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
$d = getField($conn, $sql);
	    $id_pengeluaran = $d["id_pengeluaran"];
		$buyer = $d["buyer"];
		$id_user = $d["id_user"];
		$tanggal = WKT($d["tanggal"]);
		$jam = $d["jam"];
		$status = $d["status"];
		$keterangan = $d["keterangan"];

?>


<h3>Pengeluaran <?php echo $id_pengeluaran; ?></h3>
<hr>
<table width="100%">
	<tr>
		<th width="20%"><label for="id_pengeluaran">ID Pengeluaran</label>
		<th width="1%">:
		<td colspan="2"><?php echo $id_pengeluaran; ?>
	</tr>

	<tr>
		<th width="20%"><label for="buyer">Nama Buyer</label>
		<th width="1%">:
		<td colspan="2"> <?php echo $buyer; ?> 
	</tr>

	<tr>
		<th width="20%"><label for="tanggal">Waktu</label>
		<th width="1%">:
		<td colspan="2"><?php echo "$tanggal $jam Wib (Status $status)"; ?>
	</tr>


</table>
<hr>


	
 <link rel="stylesheet" href="jsacordeon/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
  <script src="jsacordeon/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
	
	
    <div id="accordion">
 <h3>Detail Pembayaran</h3>
 <div>
Cetak | <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_pengeluaran;?>')"> |
<br>

<table class="table table-bordered">
  <tr bgcolor="#cccccc">
  <th width="2%">No</th>
	<th width="10%">Struk</th>
    <th width="25%">Pembayaran</th>
	<th width="45%">List Order</th>
	<th width="20%">Status</th>
  </tr>
<?php  
  $sql="select * from `$tbpembayaran` where  `id_pengeluaran`='$id_pengeluaran' order by `id_pembayaran` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){	
		$no=1;
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_pembayaran=$d["id_pembayaran"];
				$id_pengeluaran=$d["id_pengeluaran"];
				$nominal=$d["nominal"];
				$pesan=$d["pesan"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$bukti_bayar=$d["bukti_bayar"];
				$keterangan=$d["keterangan"]; 
				$status=$d["status"]; 
				$list=getDetailK($conn,$id_pengeluaran);
				
			$sqlv="select `buyer` from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
				$dv=getField($conn,$sqlv);  
				$buyer=$dv["buyer"];
				
				$color="#ffffff";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
	<td><small>$no</td>
	<td><small><div align='center'>";
	echo"<a href='#' onclick='buka(\"pembayaran/zoom.php?id=$id_pembayaran\")'>
	<img src='$YPATH/$bukti_bayar' width='80' height='80' /></a></div>";
	echo"</td>	
	<td><small><b>$id_pembayaran</b><br> $tanggal Jam $jam Wib
	<td> <small>Nominal TF: <u>Rp. ".RP($nominal)."</u></i> <i>Pesan: $pesan</small>
	<br><small>List Produk : $list </small>
	<td><small>$status <i>#$keterangan</i></td>
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data pembayaran belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
echo"</div>";
?>


</div>
