<body OnLoad="window.print()" OnFocus="window.close()">
	<?php
	include "../konmysqli.php";
	echo "<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
	$YPATH = "../ypathfile/";
	$pk = "";
	$field = "tanggal";
	$TB = $tbpembelian;
	$item = "Pembelian";


	$sql = "select * from `$TB` order by `$field` asc";
	if (isset($_GET["pk"])) {
		$pk = $_GET["pk"];
		$sql = "select * from `$TB` where `$field`='$pk' order by `$field` asc";
	}

	echo "<h3><center>Laporan Data $item " . WKT($pk) . "</h3>";
	?>




<table width="98%" border="0">
<tr>
<th width="3%">No</td>
<th width="10%">Nota Pembelian</td>
<th width="25%">Supplier</td>
<th width="45%">List Produk Dan Keterangan</td>
<th width="15%">Status</td>
		</tr>
		<?php
		$jum = getJum($conn, $sql);
		$no = 0;
		if ($jum > 0) {
			$arr = getData($conn, $sql);
			foreach ($arr as $d) {
				$no++;
			$id_pembelian = $d["id_pembelian"];
$id_supplier = $d["id_supplier"];
$id_user = $d["id_user"];
$user = getUser($conn, $d["id_user"]);
$tanggal = WKTP($d["tanggal"]);
$jam = $d["jam"];
$status = $d["status"];
$keterangan = $d["keterangan"];

$list = getDetailM($conn, $id_pembelian);

$sqlv = "select `nama_supplier`,`alamat` from `$tbsupplier` where `id_supplier`='$id_supplier'";
	$dv = getField($conn, $sqlv);
	$nama_supplier = $dv["nama_supplier"];
	$alamat = $dv["alamat"];
	
$color = "";
if ($no % 2 == 0) {
$color = "#eeeeee";
}
echo "<tr bgcolor='$color'>
<td><small>$no</td>
<td><small>$id_pembelian<br>$jam Wib
<td><small>$nama_supplier<br>$alamat
<td><small>$list
<td><small>$status <i>$keterangan
				</tr>";
			}
		} //if
		else {
			echo "<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";
		}

		echo "</table>";
		?>