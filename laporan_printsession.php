<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
session_start();
error_reporting(0);
include "konmysqli.php";
echo"<link href='ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="ypathfile/";


$sql=$_SESSION["cprint"];

  ?>

<center>
<img src="img/logo.png" width="30%">
	<h3> Laporan Data pengeluaran Optik Merpati</h3>
</center>
 

<table width="98%" border="0">
  <tr bgcolor="#cccccc">
    <th width="3%">No</td>
	 <th width="10%">Nota pengeluaran</td>
    <th width="20%">Buyer</td>
    <th width="15%">Tanggal Pesanan</td>
	<th width="40%">List Produk</td>
	
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
  $gab=0;
  $total=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {
		$no++;
				$id_pengeluaran = $d["id_pengeluaran"];
				$buyer = $d["buyer"];
				$id_user = $d["id_user"];
				$user = getUser($conn, $d["id_user"]); 
				$tanggal = WKT($d["tanggal"]);
				$jam = $d["jam"];
				$status = $d["status"];
				$keterangan = $d["keterangan"];
	

	$list = getDetailK($conn, $id_pengeluaran);
				
				
				$gt=0;
				$sqld="select * from `$tbpengeluarandetail` where `id_pengeluaran`='$id_pengeluaran'";
				$arrd=getData($conn,$sqld );
				foreach($arrd as $dd) {	
					$id_produk = $dd["id_produk"];
					$produk = getProduk($conn, $dd["id_produk"]);
					$jumlah = $dd["jumlah"];
					$subtotal = $dd["subtotal"];
					$catatan = $dd["catatan"];
					
					
					$total+=$subtotal;
					$gt+=$total;
				}
				
				
				
				$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$id_pengeluaran</td>
				<td><b>$buyer</b></td>
				<td>$tanggal</td>
				<td>$list</td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>
<?php
echo" <center><b><font color='red'>Total Keseluruhan : Rp. " .RP($gt).";</font></b></center>";
?>