<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
session_start();
include "konmysqli.php";
echo"<link href='ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="ypathfile/";


$sql=$_SESSION["cprint"];

  ?>

<center>
<img src="img/logo.png" width="30%">	
<h3> Laporan Data pemasukan Optik Merpati</h3>
</center>
 

<table width="98%" border="0">
  <tr bgcolor="#cccccc">
    <th width="3%">No</td>
	<th width="10%">Nota pemasukan</td>
    <th width="20%">Supplier</td>
    <th width="15%">Tanggal pemasukan</td>
	<th width="40%">List Produk</td>
	<th width="15%">Jumlah barang</td>
	
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
				$id_pemasukan = $d["id_pemasukan"];
$id_supplier = getSupplier($conn,$d["id_supplier"]);
$id_user = $d["id_user"];
$user = getUser($conn, $d["id_user"]);
$tanggal = WKT($d["tanggal"]);
$jam = $d["jam"];
$status = $d["status"];
$keterangan = $d["keterangan"];

$list = getDetailM($conn, $id_pemasukan);
$list2 = getDetailM2($conn, $id_pemasukan);	

				$gt=0;
				$sqld="select * from `$tbpemasukandetail` where `id_pemasukan`='$id_pemasukan'";
				$arrd=getData($conn,$sqld );
				foreach($arrd as $dd) {	
					$id_pd = $dd["id_pd"];
					$id_produk = $dd["id_produk"];
					$jumlah = $dd["jumlah"];
					$catatan = $dd["catatan"];

					$sql0 = "select * from `$tbproduk` where `id_produk`='$id_produk'";
					$d0 = getField($conn, $sql0);
					$nama_produk = $d0["nama_produk"];
					$deskripsi = $d0["deskripsi"];
					$gambar = $d0["gambar"];
					$harga = $d0["harga"];
					
					$total+=$jumlah;
				}
				
				$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
			<td>$id_pemasukan</td>
				<td><b>$id_supplier</b></td>
				<td>$tanggal</td>
				<td>$list</td>
				<td>$list2</td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>
<?php
echo" <center><b><font color='red'>Total Keseluruhan Stok Masuk : $total</font></b></center>";
?>