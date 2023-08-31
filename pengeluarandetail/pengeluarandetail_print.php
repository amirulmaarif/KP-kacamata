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



<h3>pengeluaran <?php echo $id_pengeluaran; ?></h3>
<hr>
<table width="100%">
	<tr>
		<th width="20%"><label for="id_pengeluaran">ID pengeluaran</label>
		<th width="1%">:
		<td colspan="2"><?php echo $id_pengeluaran; ?>
	</tr>

	<tr>
		<th width="20%"><label for="buyer">Buyer</label>
		<th width="1%">:
		<td colspan="2"><?php echo $buyer; ?> 
	</tr>
	<tr>
<th height="24"><label for="alamat">Alamat Pengiriman</label>
<th>:<td><small><?php echo "<b>$area</b> - $alamat, Kec.$kecamatan, Kab. $kabupaten, Prov $propinsi, Kode Pos $kode_pos";?>

</tr>
	<tr>
		<th width="20%"><label for="tanggal">Waktu</label>
		<th width="1%">:
		<td colspan="2"><?php echo "$tanggal $jam Wib (Status $status)"; ?>
	</tr>


</table>
<hr>

    <div id="accordion">
  <h3>Info Detail Pengeluaran </h3>
  <div>
<table width="98%">
  <tr bgcolor="#E9967A">
	<th width="3%"><center><center>No</td>
	<th width="5%"><center>Gambar</td>
				<th width="25%"><center>Nama Produk</td>
				<th width="25%"><center>Harga</td>
				<th width="5%"><center>Jumlah</td>
                <th width="25%"><center>Subtotal</td>
				<th width="10%"><center>Catatan</td>
  </tr>
<?php  
$sql = "select * from `$tbpengeluarandetail` where  `id_pengeluaran`='$id_pengeluaran' order by `id_td` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){ 		
	$no=1;	
$gab=0;		
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_td = $d["id_td"];
					$id_pengeluaran = $d["id_pengeluaran"];
					$id_produk = $d["id_produk"];
					$produk = getProduk($conn, $d["id_produk"]);
					$jumlah = $d["jumlah"];
					$subtotal = $d["subtotal"];
					$catatan = $d["catatan"];

					$sql0 = "select * from `$tbproduk` where `id_produk`='$id_produk'";
					$d0 = getField($conn, $sql0);
					$nama_produk = $d0["nama_produk"];
					$gambar = $d0["gambar"];
					$harga = $d0["harga"];
					
					$gab+=$subtotal;
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
				<td><small><i>Rp. ".RP($harga)."</i></b>  
				<td><small>$jumlah</a></td>
				<td><small><i>Rp. ".RP($subtotal)."</i></b>  
				<td><small>$catatan</td>
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data Pengeluaran $id_pengeluaran belum tersedia...</blink></td></tr>";}
?>
</table>
 <?php
echo" <center>Total : Rp. " .RP($gab).";</center>";
?>
</div>
</div>