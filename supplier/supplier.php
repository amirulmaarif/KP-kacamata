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

<?php
$sql = "select `id_supplier` from `$tbsupplier` order by `id_supplier` desc";
$jum = getJum($conn, $sql);
$kd = "SPL";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_supplier'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_supplier = $idmax;
?>
<?php
if ($_GET["pro"] == "ubah") {
	$id_supplier = $_GET["kode"];
	$sql = "select * from `$tbsupplier` where `id_supplier`='$id_supplier'";
	$d = getField($conn, $sql);
	$id_supplier = $d["id_supplier"];
	$id_supplier0 = $d["id_supplier"];
	$nama_supplier = $d["nama_supplier"];
	$deskripsi = $d["deskripsi"];
	$alamat = $d["alamat"];
	$email = $d["email"];
	$telepon = $d["telepon"];
	$status = $d["status"];
	$keterangan = $d["keterangan"];
	$pro = "ubah";
}
?>
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
	<h3>Masukan Data Supplier</h3>
	<div>

		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<th width="20%"><label for="id_supplier">ID Supplier</label>
					<th width="1%">:
					<th colspan="2"><b><?php echo $id_supplier; ?></b>
				</tr>
				<tr>
					<td><label for="nama_supplier">Nama Supplier</label>
					<td>:
					<td width="213"><input required class="form-control" style="width: 450px;" name="nama_supplier" type="text" id="nama_supplier" value="<?php echo $nama_supplier; ?>" size="25" />
					</td>

				<tr>
					<td height="24"><label for="deskripsi">Deskripsi</label>
					<td>:
					<td>
						<textarea required class="form-control" name="deskripsi" cols="55" rows="2"><?php echo $deskripsi; ?></textarea>
					</td>
				</tr>

				<tr>
					<td height="24"><label for="alamat">Alamat</label>
					<td>:
					<td>
						<textarea required class="form-control" name="alamat" cols="55" rows="2"><?php echo $alamat; ?></textarea>
					</td>
				</tr>


				<tr>
					<td height="24"><label for="email">Email</label>
					<td>:
					<td><input required class="form-control" style="width: 350px;" name="email" type="email" id="email" value="<?php echo $email; ?>" size="25" />
					</td>
				</tr>

				<tr>
					<td height="24"><label for="telepon">Telepon</label>
					<td>:
					<td><input required class="form-control" style="width: 150px;" name="telepon" type="number" id="telepon" value="<?php echo $telepon; ?>" size="25" />
					</td>
				</tr>


				<tr>
					<td><label for="status">Status</label>
					<td>:
					<td colspan="2">
						<input type="radio" name="status" id="status" checked="checked" value="Aktif" <?php if ($status == "Aktif") {
																											echo "checked";
																										} ?> />Aktif
						<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if ($status == "Tidak Aktif") {
																								echo "checked";
																							} ?> />Tidak Aktif
					</td>
				</tr>

				<tr>
					<td height="24"><label for="keterangan">Keterangan</label>
					<td>:
					<td>
						<textarea name="keterangan" class="form-control" cols="55" rows="2"><?php echo $keterangan; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>
					<td>
					<td colspan="2"><input name="Simpan" class="btn btn-primary" type="submit" id="Simpan" value="Simpan" />
						<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
						<input name="id_supplier" type="hidden" id="id_supplier" value="<?php echo $id_supplier; ?>" />
						<input name="id_supplier0" type="hidden" id="id_supplier0" value="<?php echo $id_supplier0; ?>" />
						<a href="?mnu=supplier"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>
		<br />
	</div>

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

<font color="black">Data Supplier </font> | <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $status; ?>')"> |
			<table class="table table-bordered table-hover">
				<tr class="bg-dark text-light">
					<th width="5%">No</td>
					<th width="5%">IDSPL</td>
					<th width="15%">Nama Supplier</td>
					<th width="45%">Alamat</td>
					<th width="25%">Keterangan</td>
					<th width="10%">Menu</td>
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
				<td><div align='center'>
<a href='?mnu=supplier&pro=ubah&kode=$id_supplier'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=supplier&pro=hapus&kode=$id_supplier'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_supplier pada data supplier ?..\")'></a></div></td>
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

		<?php
		if (isset($_POST["Simpan"])) {
			$pro = strip_tags($_POST["pro"]);
			$id_supplier = strip_tags($_POST["id_supplier"]);
			$id_supplier0 = strip_tags($_POST["id_supplier0"]);
			$nama_supplier = strip_tags($_POST["nama_supplier"]);
			$deskripsi = strip_tags($_POST["deskripsi"]);
			$alamat = strip_tags($_POST["alamat"]);
			$email = strip_tags($_POST["email"]);
			$telepon = strip_tags($_POST["telepon"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);


			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tbsupplier` (
`id_supplier` ,
`nama_supplier` ,
`deskripsi` ,
`alamat` ,
`email` ,
`telepon` ,
`status` ,
`keterangan`
) VALUES (
'$id_supplier', 
'$nama_supplier',
'$deskripsi',
'$alamat', 
'$email', 
'$telepon',
'$status' ,
'$keterangan'

)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $nama_supplier berhasil disimpan !');document.location.href='?mnu=supplier';</script>";
				} else {
					echo "<script>alert('Data $nama_supplier gagal disimpan...');document.location.href='?mnu=supplier';</script>";
				}
			} else {
				$sql = "update `$tbsupplier` set 
	`id_supplier`='$id_supplier',
	`nama_supplier`='$nama_supplier',
	`deskripsi`='$deskripsi',
	`alamat`='$alamat',
	`email`='$email',
	`telepon`='$telepon' ,
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_supplier`='$id_supplier0'";
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $nama_supplier berhasil diubah !');document.location.href='?mnu=supplier';</script>";
				} else {
					echo "<script>alert('Data $nama_supplier gagal diubah...');document.location.href='?mnu=supplier';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if ($_GET["pro"] == "hapus") {
			$id_supplier = $_GET["kode"];
			$sql = "delete from `$tbsupplier` where `id_supplier`='$id_supplier'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_supplier berhasil dihapus !');document.location.href='?mnu=supplier';</script>";
			} else {
				echo "<script>alert('Data $id_supplier gagal dihapus...');document.location.href='?mnu=supplier';</script>";
			}
		}
		?>