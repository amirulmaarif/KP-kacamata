<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
error_reporting(0);
$id_pemasukan=$_GET["pk"];
	$sql="select * from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
	$d=getField($conn,$sql);
				$id_pemasukan=$d["id_pemasukan"];
				$id_supplier = $d["id_supplier"];
	$supplier = strtoupper(getSupplier($conn, $d["id_supplier"]));
	$id_user = $d["id_user"];
	$user = getUser($conn, $d["id_user"]);
	$tanggal = WKTP($d["tanggal"]);
	$jam = $d["jam"];
	$status = $d["status"];
	$keterangan = $d["keterangan"];
?>


<h3>Data pemasukan <?php echo $supplier; ?></h3>
<hr>
<table width="70%">
	<tr>
		<th width="20%"><label for="id_pemasukan">ID pemasukan</label>
		<th width="1%">:
		<th colspan="2"><b><?php echo $id_pemasukan; ?></b>
	</tr>
	<tr>
		<th width="20%"><label for="id_supplier">Supplier</label>
		<th width="1%">:
		<th colspan="2"><b><?php echo $supplier; ?> | <?php echo $id_supplier; ?></b>
	</tr>
	<tr>
		<th width="20%"><label for="id_pemasukan">Staf Kasir</label>
		<th width="1%">:
		<th colspan="2"><b><?php echo $user; ?> | <?php echo $id_user; ?></b>
	</tr>

</table>
<hr>

	
<div id="accordion"> 
<table width="98%">
  <tr bgcolor="#cccccc">
	<th width="3%"><center>No</td>
	<th width="5%"><center>Gambar</td>
	<th width="25%"><center>Nama Barang</td>
	<th width="25%"><center>Deskripsi</td>
	<th width="5%"><center>Jumlah</td>
	<th width="30%"><center>Catatan</td>
  </tr>
<?php  
  $sql="select * from `$tbpemasukandetail` where  `id_pemasukan`='$id_pemasukan' order by `id_pd` asc";
  $jum=getJum($conn,$sql);
		if($jum > 0){ 		
$no=1;		
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_pd = $d["id_pd"];
					$id_produk = $d["id_produk"];
					$jumlah = $d["jumlah"];
					$catatan = $d["catatan"];

					$sql0 = "select * from `$tbproduk` where `id_produk`='$id_produk'";
					$d0 = getField($conn, $sql0);
					$nama_produk = $d0["nama_produk"];
					$deskripsi = $d0["deskripsi"];
					$kategori = $d0["kategori"];
					$gambar = $d0["gambar"];
					$harga = $d0["harga"];


					$color = "";
					if ($no % 2 == 0) {
						$color = "";
					}
					echo "<tr bgcolor='$color'>
				<td>$no</td>
				<td><div align='center'>";
					echo "<a href='#' onclick='buka(\"produk/zoom.php?id=$id_produk\")'>
<img src='$YPATH/$gambar' width='40' height='40' /></a></div>";
					echo "</td>
				<td><small>$nama_produk</b>  
				<td><small>$deskripsi</i></td>
				<td><small>$jumlah</a></td>
				<td><small>$catatan</td>
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data pemasukan detail belum tersedia...</blink></td></tr>";}
?>
</table>

</div>
</div>