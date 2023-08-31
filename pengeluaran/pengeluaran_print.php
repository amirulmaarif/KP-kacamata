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
	error_reporting(0);
	$field = "tanggal";
	$TB = $tbpengeluaran;
	$item = "pengeluaran";



	$sql = "select * from `$TB` order by `$field` asc";
	if (isset($_GET["pk"])) {
		$pk = $_GET["pk"];
		$sql = "select * from `$TB` where `$field`='$pk' order by `$field` asc";
	}

	echo "<h3><center>Laporan  $item Tanggal ".WKT($pk)."</h3>";
	?>




	<table width="98%" border="0">
		<tr>
<th width="3%">No</td>
<th width="10%">Nota pengeluaran</td>
<th width="25%">Buyer</td>
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
				$id_pengeluaran = $d["id_pengeluaran"];
	$buyer = $d["buyer"];
	$id_user = $d["id_user"];
	$user = getUser($conn, $d["id_user"]); 
	$tanggal = WKT($d["tanggal"]);
	$jam = $d["jam"];
	$status = $d["status"];
	$keterangan = $d["keterangan"];
	
	
	$list = getDetailK($conn, $id_pengeluaran);

$color = "";
if ($no % 2 == 0) {
$color = "#eeeeee";
}
echo "<tr bgcolor='$color'>
<td><small>$no</td>
<td><small>$id_pengeluaran<br>$jam Wib
<td><small><b><u>$buyer</u></b></td>
<td><small>$list</small></td>";
if($status=="Proses" ){
echo"<td><small>$status <i>$keterangan</small></td>";}
else if($status=="Konfirmasi" ){
echo"<td><small>$status <i>$keterangan <b> <i>Perlu cek pembayaran </i><b></small></td>";}
else if($status=="Pengiriman" ){
echo"<td><small>$status, Validasi oleh $user  <i>$keterangan <b> <i>Segera isi resi </i><b></small></td>";}
else {echo"<td><small>$status, Validasi oleh $user <i>$keterangan</small></td>";}
				echo"</tr>";
			}
		} //if
		else {
			echo "<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";
		}

		echo "</table>";
		?>