<?php
$pro = "simpan";
$status = "Aktif";
$id_supplier = "";
$nama_supplier = "";
$deskripsi = "";
$alamat ="";
$email = "";
$telepon = "";
$keterangan = "";
//$PATH="ypathcss";
?>

<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('supplier/supplier_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
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
	<?php
	$sqlc = "select distinct(`status`) from `$tbsupplier` order by `status` asc";
	$jumc = getJum($conn, $sqlc);
	if ($jumc < 1) {
		echo "<h1>Maaf data supplier belum tersedia</h1>";
	}
	$arrc = getData($conn, $sqlc);
	foreach ($arrc as $dc) {
		$status = $dc["status"];
	?>
		<h3>Data Supplier <?php echo $status ?>:</h3>
		<div>

<font color="black">Data Supplier </font>| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $status; ?>')"> |
			<table class="table table-bordered table-hover">
				<tr class="bg-dark text-light">
					<th width="5%">No</td>
					<th width="5%">IDSPL</td>
					<th width="15%">Nama Supplier</td>
					<th width="45%">Alamat</td>
					<th width="25%">Keterangan</td>
				</tr>
				<?php
				$sql = "select * from `$tbsupplier` where  `status`='$status' order by `id_supplier` desc";
				$jum = getJum($conn, $sql);
				if ($jum > 0) {
					$no = 1;
					$arr = getData($conn, $sql);
					foreach ($arr as $d) {
						$id_supplier = $d["id_supplier"];
						$nama_supplier = ucwords($d["nama_supplier"]);
						$deskripsi = $d["deskripsi"];
						$alamat = $d["alamat"];
						$email = $d["email"];
						$telepon = $d["telepon"];
						$status = $d["status"];
						$keterangan = $d["keterangan"];


						$color = "";
						if ($no % 2 == 0) {
							$color = "#eeeeee";
						}
						echo "<tr bgcolor='$color'>
				<td><small>$no</td>
				<td><small>$id_supplier</td>
				<td><a href='mailto:$email' title='$email'><b>$nama_supplier</b></a>
				<td><small>$alamat, Telp: $telepon
				<td><small>$deskripsi <i>$keterangan</i></small></td>
						</tr>";

						$no++;
					} //for dalam
				} //if
				else {
					echo "<tr><td colspan='6'><blink>Maaf, Data supplier belum tersedia...</blink></td></tr>";
				}
				?>
			</table>

		<?php
		echo "</div>";
	} //for atas
		?>


		</div>
