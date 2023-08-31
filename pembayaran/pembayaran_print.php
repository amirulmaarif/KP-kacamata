<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";

  ?>

<?php
$id_pengeluaran = $_GET["pk"];
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
 

<table width="98%" border="0">
  <tr>
  <th width="3%">No</td>
   <th width="10%">Struk</th>
    <th width="25%">Pembayaran</th>
	<th width="45%">List Order</th>
	<th width="15%">Status</th>
  </tr>
<?php  
 $sql="select * from `$tbpembayaran` where  `id_pengeluaran`='$id_pengeluaran' order by `id_pembayaran` desc";
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
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
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>