<?php
$pro = "simpan";
$id_produk ="";
$nama_produk ="";
$deskripsi ="";
$gambar0 = "avatar.jpg";
$stok = 0;
$harga = "";
$keterangan ="";
//$PATH="ypathcss";
?>


<script type="text/javascript">
	function PRINT() {
		win = window.open('produk/produk_print.php', 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>


<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>



<link rel="stylesheet" href="jsacordeon/jquery-ui.css">
<link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
<script src="jsacordeon/jquery-ui.js"></script>
<script>
	$(function() {
		$("#accordion").accordion({
			collapsible: true
		});
	});
</script>

<div id="accordion">
<h3>Data Produk</h3>
<div>
<font color="#000">Cetak | </font><img src='ypathicon/print.png' title='PRINT ALL' OnClick="PRINT()"> |
<table class="table table-bordered table-hover">
<tr class="bg-dark text-light">
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
	if ($jum > 0) {
		$no=1;
		$arr = getData($conn, $sql);
		foreach ($arr as $d) {
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

			$no++;
		} //for dalam
	} //if
	else {
		echo "<tr><td colspan='6'><blink>Maaf, Data produk belum tersedia...</blink></td></tr>";
	}
	?>
</table>

<?php
$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";
echo "</div>";
?>
</div>
