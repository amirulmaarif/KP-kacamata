<style type="text/css">
	body {
		width: 100%;
	}
</style>

<body OnLoad="window.print()" OnFocus="window.close()">
	<?php
	include "../konmysqli.php";
	echo "<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
	$YPATH = "../ypathfile/";
	$pk = "";

	?>

	<table width="98%" border="0">
		<tr>
		<th width="3%"><center>No</td>
<th width="5%"><center>Gambar</td>
	<th width="30%"><center>Nama Produk</td>
	<th width="15%"><center>Harga</td>
	<th width="5%"><center>Stok</td>
	<th width="15%"><center>Keterangan</td>
		</tr>
		<?php
		$sql = "select * from `$tbproduk` order by `id_produk` desc";
		$jum = getJum($conn, $sql);
		$no = 0;
		if ($jum > 0) {
			$arr = getData($conn, $sql);
			foreach ($arr as $d) {
				$no++;
			$id_produk = $d["id_produk"];
			$nama_produk = ucwords($d["nama_produk"]);
			$deskripsi = $d["deskripsi"];
			$gambar = $d["gambar"];
			$stok = $d["stok"];
			$keterangan = $d["keterangan"];
			$harga = $d["harga"];

			$color = "#dddddd";
			if ($no % 2 == 0) {
				$color = "#eeeeee";
			}
			echo "<tr bgcolor='$color'>
		<td>$no</td>
		<td><div align='center'>";
			echo "<a href='#' onclick='buka(\"produk/zoom.php?id=$id_produk\")'>
<img src='$YPATH/$gambar' width='40' height='40' /></a></div>";
			echo "</td>
		<td><small><b>$nama_produk</b>  
		<br> <i>#$deskripsi</i></small>
		<td><small><i>Rp. ".RP($harga)."</i></td>
		<td><small>$stok</td>
		<td><small>$keterangan</td>
				</tr>";
			}
		} //if
		else {
			echo "<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";
		}

		echo "</table>";
		?>