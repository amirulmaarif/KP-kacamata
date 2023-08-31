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
	$field = "status";
	$TB = $tbuser;
	$item = "Pengguna";

	$pk = "";

	$sql = "select * from `$TB` order by `$field` asc";
	if (isset($_GET["pk"])) {
		$pk = $_GET["pk"];
		$sql = "select * from `$TB` where `$field`='$pk' order by `$field` asc";
	}

	echo "<h3><center>Laporan Data $item " . $pk . "</h3>";
	?>




	<table width="98%" border="0">
		<tr>
			<th width="3%">No</td>
			<th width="5%">IDUser</td>
			<th width="30%">Nama User</td>
			<th width="15%">Telepon</td>
			<th width="10%">Level</td>
			<th width="30%">Keterangan</td>
		</tr>
		<?php
		$jum = getJum($conn, $sql);
		$no = 0;
		if ($jum > 0) {
			$arr = getData($conn, $sql);
			foreach ($arr as $d) {
				$no++;
				$id_user = $d["id_user"];
				$nama_user = ucwords($d["nama_user"]);
				$level = $d["level"];
				$username = $d["username"];
				$password = $d["password"];
				$telepon = $d["telepon"];
				$email = $d["email"];
				$status = $d["status"];
				$keterangan = $d["keterangan"];
				$color = "";
				if ($no % 2 == 0) {
					$color = "";
				}
				echo "<tr bgcolor='$color'>
				<td>$no</td>
				<td>$id_user</td>
				<td><a href='mailto:$email'>$nama_user</a></td>
				<td>$telepon</td>
				<td>$level</td>
				<td>$keterangan</td>
				</tr>";
			}
		} //if
		else {
			echo "<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";
		}

		echo "</table>";
		?>