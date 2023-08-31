<?php

$pro = "simpan";
$jumlah = 1;
$jumlah0 = 0;
$id_pd = "";
$id_pemasukan = "";
$id_produk = "";
$catatan = "";
?>
<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('pemasukandetail/pemasukandetail_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
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

<?php
$id_pemasukan = $_GET["id"];
$sql = "select * from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
	$d = getField($conn, $sql);
	$id_pemasukan = $d["id_pemasukan"];
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
		<th width="20%"><label for="id_pemasukan">Admin</label>
		<th width="1%">:
		<th colspan="2"><b><?php echo $user; ?> | <?php echo $id_user; ?></b>
	</tr>

</table>
<hr>

<div id="accordion">
	<h3>Masukan Data pemasukan</h3>
	<div>

		<?php
		if ($_GET["pro"] == "ubah") {
			$id_pd = $_GET["kode"];
			$sql = "select * from `$tbpemasukandetail` where `id_pd`='$id_pd'";
			$d = getField($conn, $sql);
			$id_pd = $d["id_pd"];
			$id_pd0 = $d["id_pd"];
			$id_pemasukan = $d["id_pemasukan"];
			$id_produk = $d["id_produk"];
			$jumlah = $d["jumlah"];
			$jumlah0 = $d["jumlah"];
			$catatan = $d["catatan"];

			$pro = "ubah";
		}
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<table class="table">


				<tr>
					<th width="20%"><label for="id_produk">Pilih Produk</label>
					<th width="1%">:
					<th colspan="2"><select name="id_produk" class="form-control" style="width: 450px;">
							<?php
							$s = "select * from `tb_produk`";
							$q = getData($conn, $s);
							foreach ($q as $d) {
								$id_produk0 = $d["id_produk"];
								$nama_produk = $d["nama_produk"];
								echo "<option value='$id_produk0' ";
								if ($id_produk0 == $id_produk) {
									echo "selected";
								}
								echo "> $nama_produk | $id_produk0  </option>";
							}
							?>
						</select>
				</tr>

				<tr>
					<td height="24"><label for="jumlah">Jumlah </label>
					<td>:
					<td><input required class="form-control" style="width: 150px;" name="jumlah" type="number" id="jumlah" value="<?php echo $jumlah; ?>" size="25" /></td>
				</tr>

				<tr>
					<td height="24"><label for="catatan">Catatan</label>
					<td>:
					<td>
						<textarea name="catatan" class="form-control" cols="55" rows="2"><?php echo $catatan; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>
					<td>
					<td colspan="2">
						<input name="Simpan" class="btn btn-primary" type="submit" id="Simpan" value="Simpan" />
						<input name="id_supplier" type="hidden" id="id_supplier" value="<?php echo $id_supplier; ?>" />
						<input name="jumlah0" type="hidden" id="jumlah0" value="<?php echo $jumlah0; ?>" />
						<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
						<input name="id_pemasukan" type="hidden" id="id_pemasukan" value="<?php echo $id_pemasukan; ?>" />
						<input name="id_pd0" type="hidden" id="id_pd0" value="<?php echo $id_pd0; ?>" />
						<a href="?mnu=pemasukandetail&id=<?php echo $id_pemasukan; ?>"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
					</td>
				</tr>
			</table>
		</form>
		<br />

<font color="black">Data Detail pemasukan </font>| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_pemasukan; ?>')"> |
		<table class="table table-bordered">
			<tr class="bg-dark text-light">
				<th width="3%"><center>No</td>
				<th width="5%"><center>Gambar</td>
				<th width="25%"><center>Nama produk</td>
				<th width="25%"><center>Deskripsi</td>
				<th width="5%">Jumlah</td>
				<th width="30%">Catatan</td>
				<th width="5%">Menu</td>
			</tr>
			<?php
			$sql = "select * from `$tbpemasukandetail` where  `id_pemasukan`='$id_pemasukan' order by `id_pd` asc";
			$jum = getJum($conn, $sql);
			if ($jum > 0) {
				$no = 1;
				$arr = getData($conn, $sql);
				foreach ($arr as $d) {
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
				<td><div align='center'>
<a href='?mnu=pemasukandetail&id=$id_pemasukan&pro=ubah&kode=$id_pd'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=pemasukandetail&id=$id_pemasukan&pro=hapus&kode=$id_pd&nama_produk=$nama_produk&id_supplier=$id_supplier&id_produk=$id_produk&jumlah=$jumlah'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_produk pada data pemasukan Detail $id_pemasukan?..\")'></a></div></td>
				</tr>";

					$no++;
				} //for dalam
			} //if
			else {
				echo "<tr><td colspan='6'><blink>Maaf, Data pemasukan detail belum tersedia...</blink></td></tr>";
			}
			?>
		</table>

	</div>
</div>

<?php
if (isset($_POST["Simpan"])) {
	$pro = strip_tags($_POST["pro"]);
	$id_pemasukan = strip_tags($_POST["id_pemasukan"]);
	$id_produk = strip_tags($_POST["id_produk"]);
	$jumlah = strip_tags($_POST["jumlah"]);
	$jumlah0 = strip_tags($_POST["jumlah0"]);
	$catatan = strip_tags($_POST["catatan"]);
	$nama_produk = getProduk($conn, $id_produk);

	if ($pro == "simpan") {
	setPlus($conn, $id_produk, $jumlah);

$sql = " INSERT INTO `$tbpemasukandetail` (
`id_pemasukan` ,
`id_produk` ,
`jumlah` , 
`catatan` 
) VALUES (
'$id_pemasukan' ,
'$id_produk' ,
'$jumlah' ,
'$catatan' 
)";

		$simpan = process($conn, $sql);
		if ($simpan) {
			echo "<script>alert('Data $nama_produk berhasil disimpan..');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id=$id_pemasukan';</script>";
		} else {
			echo "<script>alert('Data $nama_produk gagal disimpan...');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id=$id_pemasukan';</script>";
		}
	} else {


		$id_pd = strip_tags($_POST["id_pd"]);
		$id_pd0 = strip_tags($_POST["id_pd0"]);

		setUbahM($conn, $id_produk, $jumlah0, $jumlah);

		$sql = "update `$tbpemasukandetail` set 
	`id_produk`='$id_produk',
	`jumlah`='$jumlah',
	`catatan`='$catatan'
	 where `id_pd`='$id_pd0'";
		$ubah = process($conn, $sql);
		if ($ubah) {
			echo "<script>alert('Data $nama_produk berhasil diubah !');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id=$id_pemasukan';</script>";
		} else {
			echo "<script>alert('Data $nama_produk gagal diubah...');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id=$id_pemasukan';</script>";
		}
	} //else simpan
}
?>

<?php
if ($_GET["pro"] == "hapus") {
	$id_pd = $_GET["kode"];
	$id_supplier = $_GET["id_supplier"];
	$id_produk = $_GET["id_produk"];
	$jumlah = $_GET["jumlah"];
	$id_pemasukan = $_GET["id"];
	$nama_produk = $_GET["nama_produk"];
	$sql = "delete from `$tbpemasukandetail` where `id_pd`='$id_pd'";
	$hapus = process($conn, $sql);

	setMin($conn, $id_produk, $jumlah);


	if ($hapus) {
		echo "<script>alert('Data $nama_produk / $id_pemasukan-$id_pd berhasil dihapus !');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id=$id_pemasukan';</script>";
	} else {
		echo "<script>alert('Data $nama_produk / $id_pemasukan-$id_pd gagal dihapus...');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan&id_pemasukan=$id_pemasukan';</script>";
	}
}
?>