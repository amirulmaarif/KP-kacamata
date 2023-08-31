<?php

$pro = "simpan";
$status = "Aktif";
$jumlah0 = 0;
$jumlah = 1;
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

<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('pengeluarandetail/pengeluarandetail_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>


<?php
$id_pengeluaran = $_GET["id"];
$sql = "select * from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
$d = getField($conn, $sql);
	    $id_pengeluaran = $d["id_pengeluaran"];
		$buyer = $d["buyer"];
		$id_user = $d["id_user"];
		$area = $d["area"];
		$alamat = $d["alamat"];
		$kecamatan = $d["kecamatan"];
		$kabupaten = $d["kabupaten"];
		$propinsi = $d["propinsi"];
		$kode_pos = $d["kode_pos"];
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
		<td colspan="2"> <?php echo $buyer; ?> 
	</tr>

	<tr>
		<th width="20%"><label for="tanggal">Waktu</label>
		<th width="1%">:
		<td colspan="2"><?php echo "$tanggal $jam Wib (Status $status)"; ?>
	</tr>


</table>
<hr>
<div id="accordion">
	<h3>Tambah Produk </h3>
	<div>

		<?php
		if ($_GET["pro"] == "ubah") {
			$id_td = $_GET["kode"];
			$sql = "select * from `$tbpengeluarandetail` where `id_td`='$id_td'";
			$d = getField($conn, $sql);
				$id_td = $d["id_td"];
				$id_td0 = $d["id_td"];
				$id_pengeluaran = $d["id_pengeluaran"];
				$id_produk = $d["id_produk"];
				$jumlah = $d["jumlah"];
				$subtotal = $d["subtotal"];
				$catatan = $d["catatan"];
				$pro = "ubah";
		}
		?>

<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<th width="20%"><label for="id_produk">Pilih Produk</label>
<th width="1%">:
<th colspan="2"><select name="id_produk" class="form-control" style="width: 550px;">
		<?php
		$s = "select * from `tb_produk` where `stok`!=0";
		$q = getData($conn, $s);
		foreach ($q as $d) {
			$id_produk0 = $d["id_produk"];
			$nama_produk = $d["nama_produk"];
			$harga = $d["harga"];
			$stok = $d["stok"];
			echo "<option value='$id_produk0' ";
			if ($id_produk0 == $id_produk) {
				echo "selected";
			}
			echo "> $nama_produk | $id_produk0 - <i>Rp. ".RP($harga)."</i> (Sisa : $stok) </option>";
		}
		?>
	</select></tr>

	<tr>
		<td height="24"><label for="jumlah">Jumlah</label>
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
			<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
			<input name="jumlah0" type="hidden" id="jumlah0" value="<?php echo $jumlah0; ?>" />
			<input name="id_pengeluaran" type="hidden" id="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>" />
			<input name="id_td0" type="hidden" id="id_td0" value="<?php echo $id_td0; ?>" />
			<a href="?mnu=_pengeluarandetail&id=<?php echo $id_pengeluaran; ?>"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
		</td>
	</tr>
</table>
</form>
<br />

		Data pengeluaran Detail | <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_pengeluaran; ?>')"> |
		<table class="table table-bordered table-hover">
			<tr class="bg-dark text-light">
			<th width="3%"><center>No</td>
				<th width="5%"><center>Gambar</td>
				<th width="25%"><center>Nama Produk</td>
				<th width="25%"><center>Harga</td>
				<th width="5%"><center>Jumlah</td>
                <th width="25%"><center>Subtotal</td>
				<th width="10%"><center>Catatan</td>
				<th width="13%"><center>Menu</td>
			</tr>
			<?php
			$sql = "select * from `$tbpengeluarandetail` where  `id_pengeluaran`='$id_pengeluaran' order by `id_td` desc";
			$jum = getJum($conn, $sql);
			if ($jum > 0) {
				$no = 1;
				$gab=0;
				$arr = getData($conn, $sql);
				foreach ($arr as $d) {
					$id_td = $d["id_td"];
					$id_pengeluaran = strtoupper($d["id_pengeluaran"]);
					$id_produk = $d["id_produk"];
					$produk = getproduk($conn, $d["id_produk"]);
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
				<td><div align='center'>	
<a href='?mnu=_pengeluarandetail&id=$id_pengeluaran&pro=ubah&kode=$id_td'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=_pengeluarandetail&id=$id_pengeluaran&pro=hapus&kode=$id_td&nama_produk=$nama_produk&id_produk=$id_produk&jumlah=$jumlah'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_produk pada data pengeluaran $nama_produk ?..\")'></a></div></td>
				</tr>";

					$no++;
				} //for dalam
			} //if
			else {
				echo "<tr><td colspan='6'><blink>Maaf, Data pengeluaran detail belum tersedia...</blink></td></tr>";
			}
			?>
		</table>
<?php
echo" <center>Total : Rp. " .RP($gab).";</center>";
?>
	</div>
</div>

<?php
if (isset($_POST["Simpan"])) {
	$pro = strip_tags($_POST["pro"]);

	$id_pengeluaran = strip_tags($_POST["id_pengeluaran"]);
	$id_produk = strip_tags($_POST["id_produk"]);
	$jumlah = strip_tags($_POST["jumlah"]);
	$jumlah0 = strip_tags($_POST["jumlah0"]);
	$catatan = strip_tags($_POST["catatan"]);
	$sqlc="select  * from `$tbproduk` where `id_produk`='$id_produk'";
	 $dc=getField($conn,$sqlc);
				$harga=strip_tags($_POST["harga"]);
				$harga=$dc["harga"];
				$subtotal=$jumlah * $harga;
				
	$produk = getProduk($conn, $id_produk);
	if ($pro == "simpan") {

		setMin($conn, $id_produk, $jumlah);

		$sql = " INSERT INTO `$tbpengeluarandetail` (
`id_pengeluaran` ,
`id_produk` ,
`jumlah` ,
`subtotal` ,
`catatan`  
) VALUES (
'$id_pengeluaran', 
'$id_produk', 
'$jumlah',
'$subtotal',
'$catatan'
)";

		$simpan = process($conn, $sql);
		if ($simpan) {
			echo "<script>alert('Data $produk berhasil disimpan !');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id=$id_pengeluaran';</script>";
		} else {
			echo "<script>alert('Data $produk gagal disimpan...');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id=$id_pengeluaran';</script>";
		}
	} else {

		$id_td = strip_tags($_POST["id_td"]);
		$id_td0 = strip_tags($_POST["id_td0"]);

		setUbahK($conn, $id_user, $id_produk, $jumlah0, $jumlah);

		$sql = "update `$tbpengeluarandetail` set 
	`id_pengeluaran`='$id_pengeluaran',
	`id_produk`='$id_produk',
	`jumlah`='$jumlah',
	`subtotal`='$subtotal',
	`catatan`='$catatan'
	 where `id_td`='$id_td0'";
		$ubah = process($conn, $sql);
		if ($ubah) {
			echo "<script>alert('Data $produk berhasil diubah !');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id=$id_pengeluaran';</script>";
		} else {
			echo "<script>alert('Data $produk gagal diubah...');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id=$id_pengeluaran';</script>";
		}
	} //else simpan
}
?>

<?php
if ($_GET["pro"] == "hapus") {
	$id_td = $_GET["kode"];
	$id_pengeluaran = $_GET["id"];
	$id_produk = $_GET["id_produk"];
	$jumlah = $_GET["jumlah"];
	$nama_produk = $_GET["nama_produk"];

	$sql = "delete from `$tbpengeluarandetail` where `id_td`='$id_td'";
	$hapus = process($conn, $sql);

	setPlus($conn, $id_produk, $jumlah);


	if ($hapus) {
		echo "<script>alert('Data $nama_produk berhasil dihapus !');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id=$id_pengeluaran';</script>";
	} else {
		echo "<script>alert('Data $nama_produk gagal dihapus...');document.location.href='?mnu=_pengeluarandetail&id=$id_pengeluaran&id_pengeluaran=$id_pengeluaran';</script>";
	}
}
?>