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

<?php
$sql = "select `id_produk` from `$tbproduk` order by `id_produk` desc";
$jum = getJum($conn, $sql);
$kd = "PRD";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_produk'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_produk = $idmax;
?>
<?php
if ($_GET["pro"] == "ubah") {
	$id_produk = $_GET["kode"];
	$sql = "select * from `$tbproduk` where `id_produk`='$id_produk'";
	$d = getField($conn, $sql);
	$id_produk = $d["id_produk"];
	$id_produk0 = $d["id_produk0"];
	$nama_produk = $d["nama_produk"];
	$deskripsi = $d["deskripsi"];
	$gambar = $d["gambar"];
	$gambar0 = $d["gambar"];
	$stok = $d["stok"];
	$harga = $d["harga"];
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
	<h3>Masukan Data Produk</h3>
	<div>

<form action="" method="post" enctype="multipart/form-data">
<table class="table">

	<tr>
		<td><label for="nama_produk">Nama Produk</label>
		<td>:
		<td><input required class="form-control"  name="nama_produk" type="text" id="nama_produk" value="<?php echo $nama_produk; ?>" size="25" />
		</td>
	</tr>

    
<tr>
<td><label for="deskripsi">Deskripsi</label>
<td>:
<td>
	<textarea required class="form-control" name="deskripsi" cols="55" rows="2"><?php echo $deskripsi; ?></textarea>
</td>
</tr>

	
	<tr>
		<td><label for="harga">Harga</label>
		<td>:
		<td><input required class="form-control" style="width: 175px;" name="harga" type="number" id="harga" value="<?php echo $harga; ?>" size="25" />
		</td>
	</tr>

	<tr>
		<td>Gambar
		<td>:
		<td colspan="2"><label for="gambar"></label>
			<input name="gambar" type="file" id="gambar" size="20" />
			=> <a href='#' onclick='buka("produk/zoom.php?id=<?php echo $id_produk; ?>")'><?php echo $gambar0; ?></a>
		</td>
	</tr>


	<tr>
		<td><label for="keterangan">Catatan</label>
		<td>:
		<td>
			<textarea name="keterangan" class="form-control" cols="55" rows="2"><?php echo $keterangan; ?></textarea>
		</td>
	</tr>



	<tr>
		<td>
		<td>
		<td colspan="2">
			<input name="Simpan" class="btn btn-primary" type="submit" id="Simpan" value="Simpan" />
			<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
			<input name="gambar0" type="hidden" id="gambar0" value="<?php echo $gambar0; ?>" />
			<input name="id_produk" type="hidden" id="id_produk" value="<?php echo $id_produk; ?>" />
			<input name="id_produk0" type="hidden" id="id_produk0" value="<?php echo $id_produk0; ?>" />
			<a href="?mnu=produk"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
		</td>
	</tr>
</table>
</form>
<br />
</div>
<h3>Data Produk</h3>
<div>
<font color="black"> Cetak </font> | <img src='ypathicon/print.png' title='PRINT ALL' OnClick="PRINT()"> |
<table class="table table-bordered table-hover">
<tr class="bg-dark text-light">
	<th width="3%"><center>No</td>
	<th width="5%"><center>Gambar</td>
	<th width="30%"><center>Nama Produk</td>
	<th width="15%"><center>Harga</td>
	<th width="5%"><center>Stok</td>
	<th width="15%"><center>Keterangan</td>
	<th width="10%"><center>Menu</td>
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
		<td><small><b>$nama_produk | $id_produk</b>  
		<br> <i>#$deskripsi</i></small>
		<td><small><i>Rp. ".RP($harga)."</i></td>";
		if($stok<3){
		echo"<td><small><font color='red' title='Segera tambah barang'>$stok </font></td>";}
		else{echo"<td><small>$stok</td>";}
		echo"<td><small>$keterangan</td>
		<td><div align='center'>
<a href='?mnu=produk&pro=ubah&kode=$id_produk'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=produk&pro=hapus&kode=$id_produk&nama_produk=$nama_produk'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan 
menghapus $nama_produk pada Data produk ?..\")'></a></div></td>
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

<?php
if (isset($_POST["Simpan"])) {
	$pro = strip_tags($_POST["pro"]);
	$id_produk = strip_tags($_POST["id_produk"]);
	$id_produk0 = strip_tags($_POST["id_produk0"]);
	$nama_produk = strip_tags($_POST["nama_produk"]);
	$deskripsi = strip_tags($_POST["deskripsi"]);
	$gambar = strip_tags($_POST["gambar"]);
	$harga = strip_tags($_POST["harga"]);
	$keterangan = strip_tags($_POST["keterangan"]);

	$gambar0 = strip_tags($_POST["gambar0"]);
	if ($_FILES["gambar"] != "") {
		move_uploaded_file($_FILES["gambar"]["tmp_name"], "$YPATH/" . $_FILES["gambar"]["name"]);
		$gambar = $_FILES["gambar"]["name"];
	} else {
		$gambar = $gambar0;
	}
	if (strlen($gambar) < 1) {
		$gambar = $gambar0;
	}

	if ($pro == "simpan") {

		$sql = " INSERT INTO `$tbproduk` (
`id_produk` ,
`nama_produk` ,
`deskripsi` ,
`gambar` ,
`stok` ,
`harga` ,
`keterangan`
) VALUES (
'$id_produk', 
'$nama_produk',
'$deskripsi',
'$gambar',
'0',
'$harga',
'$keterangan'
)";

		$simpan = process($conn, $sql);
		if ($simpan) {
			echo "<script>alert('Data $nama_produk berhasil disimpan !');document.location.href='?mnu=produk';</script>";
		} else {
			echo "<script>alert('Data $nama_produk gagal disimpan...');document.location.href='?mnu=produk';</script>";
		}
	} else {
		$sql = "update `$tbproduk` set 
	`nama_produk`='$nama_produk',
	`deskripsi`='$deskripsi',
	`gambar`='$gambar' ,
	`harga`='$harga',
	`keterangan`='$keterangan'
	 where `id_produk`='$id_produk'";
		$ubah = process($conn, $sql);
		if ($ubah) {
			echo "<script>alert('Data $nama_produk berhasil diubah !');document.location.href='?mnu=produk';</script>";
		} else {
			echo "<script>alert('Data $nama_produk gagal diubah...');document.location.href='?mnu=produk';</script>";
		}
	} //else simpan
}
?>

<?php
if ($_GET["pro"] == "hapus") {
	$id_produk = $_GET["kode"];
	$nama_produk = $_GET["nama_produk"];
	$sql = "delete from `$tbproduk` where `id_produk`='$id_produk'";
	$hapus = process($conn, $sql);
	if ($hapus) {
		echo "<script>alert('Data $nama_produk berhasil dihapus !');document.location.href='?mnu=produk';</script>";
	} else {
		echo "<script>alert('Data $nama_produk gagal dihapus...');document.location.href='?mnu=produk';</script>";
	}
}
?>