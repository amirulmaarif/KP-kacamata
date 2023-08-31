<?php

$pro = "simpan";
$status = "Proses";
$tanggal=WKT(date("Y-m-d"));
$jam=date("H:i:s");
$id_pemasukan0 = "";
$id_supplier = "";
$id_user = "";
$keterangan = "";

?>


<script type="text/javascript">
function PRINT(id_supplier) {
win = window.open('pemasukan/pemasukan_print.php?pk=' + id_supplier, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
}
</script>
<script language="JavaScript">
function buka(url) {
window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
}
</script>

<?php
$sql = "select `id_pemasukan` from `$tbpemasukan` order by `id_pemasukan` desc";
$q = mysqli_query($conn, $sql);
$jum = mysqli_num_rows($q);
$th = date("y");
$bl = date("m") + 0;
if ($bl < 10) {
$bl = "0" . $bl;
}

$kd = "PBL" . $th . $bl; //KEG1610001
if ($jum > 0) {
$d = mysqli_fetch_array($q);
$idmax = $d["id_pemasukan"];

$bul = substr($idmax, 5, 2);
$tah = substr($idmax, 3, 2);
if ($bul == $bl && $tah == $th) {
$urut = substr($idmax, 7, 3) + 1;
if ($urut < 10) {
$idmax = "$kd" . "00" . $urut;
} else if ($urut < 100) {
$idmax = "$kd" . "0" . $urut;
} else {
$idmax = "$kd" . $urut;
}
} //==
else {
$idmax = "$kd" . "001";
}
} //jum>0
else {
$idmax = "$kd" . "001";
}
$id_pemasukan = $idmax;
?>
<?php
if ($_GET["pro"] == "ubah") {
	$id_pemasukan = $_GET["kode"];
	$sql = "select * from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
	$d = getField($conn, $sql);
	$id_pemasukan = $d["id_pemasukan"];
	$id_pemasukan0 = $d["id_pemasukan"];
	$id_supplier = $d["id_supplier"];
	$id_user = $d["id_user"];
	$tanggal = WKT($d["tanggal"]);
	$jam = $d["jam"];
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
<h3>Data pemasukan</h3>
<div>

<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
<th width="20%"><label for="id_pemasukan">ID pemasukan</label>
<th width="1%">:
<th colspan="2"><b><?php echo $id_pemasukan; ?></b>
</tr>


<tr>
<td><label for="id_supplier">Pilih Supplier</label>
<td>:
<td width="213">
<select name="id_supplier" class="form-control" style="width: 450px;">
<?php
$s = "select * from `tb_supplier` where `status`='Aktif'";
$q = getData($conn, $s);
foreach ($q as $d) {
$id_supplier0 = $d["id_supplier"];
$nama_supplier = $d["nama_supplier"];
echo "<option value='$id_supplier0' ";
if ($id_supplier0 == $id_supplier) {
	echo "selected";
}
echo "> $nama_supplier | $id_supplier0  </option>";
}
?>
</select>
</td>
</tr>

<tr>
<td height="24"><label for="keterangan">Keterangan</label>
<td>:
<td>
<textarea name="keterangan" class="form-control" cols="55" rows="2"><?php echo $keterangan; ?></textarea>
</td>
</tr>

<?php
if ($_GET["pro"] == "ubah") {?>
<tr>
<td><label for="status">Status</label>
<td>:
<td colspan="2">
<input type="radio" name="status" id="status" checked="checked" value="Proses" <?php if ($status == "Proses") {
																			echo "checked";
																		} ?> /> Proses
<input type="radio" name="status" id="status" value="Konfirmasi" <?php if ($status == "Konfirmasi") {
																echo "checked";
															} ?> /> Konfirmasi
</td>
</tr>


<?php
}
?>
<tr>
<td>
<td>
<td colspan="2">
<input name="Simpan" class="btn btn-primary" type="submit" id="Simpan" value="Simpan" />
<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
<input name="id_pemasukan" type="hidden" id="id_pemasukan" value="<?php echo $id_pemasukan; ?>" />
<input name="id_pemasukan0" type="hidden" id="id_pemasukan0" value="<?php echo $id_pemasukan0; ?>" />
<a href="?mnu=pemasukan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td>
</tr>
</table>
</form>
<br />
</div>

<?php
$sqlc = "select distinct(`tanggal`) from `$tbpemasukan` order by `tanggal` desc";
$jumc = getJum($conn, $sqlc);
if ($jumc < 1) {
echo "<h1>Maaf data pemasukan belum tersedia</h1>";
}
$arrc = getData($conn, $sqlc);
foreach ($arrc as $dc) {
	$tanggal = $dc["tanggal"];
	$TGL = WKT($tanggal);
	$sql = "select * from `$tbpemasukan` where `tanggal`='$tanggal'  order by `id_pemasukan` desc";
	$jum = getJum($conn, $sql);
?>
<h3>Data pemasukan <?php echo $TGL . " ($jum TX)"; ?>:</h3>
<div>

<font color="black">Data pemasukan </font>| <img src="ypathicon/print.png" title='PRINT' OnClick="PRINT('<?php echo $tanggal; ?>')"> |
<table class="table table-bordered table-hover">
<tr class="bg-dark text-light">
<th width="3%">No</td>
<th width="10%">Nota pemasukan</td>
<th width="25%">Supplier</td>
<th width="45%">List Produk Dan Keterangan</td>
<th width="15%">Status</td>
<th width="10%">Menu</td>
</tr>
<?php

if ($jum > 0) {
//------------------------- 
$batas   = 10;
$page = $_GET['page'];
if (empty($page)) {
$posawal  = 0;
$page = 1;
} else {
$posawal = ($page - 1) * $batas;
}

$sql2 = $sql . " LIMIT $posawal,$batas";
$no = $posawal + 1;
//-------------------------------- 						
$arr = getData($conn, $sql2);
foreach ($arr as $d) {
$id_pemasukan = $d["id_pemasukan"];
$id_supplier = $d["id_supplier"];
$id_user = $d["id_user"];
$user = getUser($conn, $d["id_user"]);
$tanggal = WKT($d["tanggal"]);
$jam = $d["jam"];
$status = $d["status"];
$keterangan = $d["keterangan"];

$list = getDetailM($conn, $id_pemasukan);

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
<td><small>$id_pemasukan<br>$jam Wib
<td><small>$nama_supplier<br>$alamat
<td><small>$list
<td><small>$status <i>$keterangan
<td><div align='center'>
<a href='?mnu=pemasukandetail&id=$id_pemasukan'><img src='ypathicon/search.png' title='List Detail pemasukan'></a>
<br>
<a href='?mnu=pemasukan&pro=ubah&kode=$id_pemasukan'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=pemasukan&pro=hapus&kode=$id_pemasukan'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $id_pemasukan pada data pemasukan ?..\")'></a></div></td>
</tr>";

$no++;
} //for dalam
} //if
else {
echo "<tr><td colspan='6'><blink>Maaf, Data pemasukan belum tersedia...</blink></td></tr>";
}
?>
</table>

<?php
$jmldata = $jum;
if ($jmldata > 0) {
if ($batas < 1) {
$batas = 1;
}
$jmlhal  = ceil($jmldata / $batas);
echo "<div class=paging>";
if ($page > 1) {
$prev = $page - 1;
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pemasukan'>« Prev</a></span> ";
} else {
echo "<span class=disabled>« Prev</span> ";
}

for ($i = 1; $i <= $jmlhal; $i++)
if ($i != $page) {
echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pemasukan'>$i</a> ";
} else {
echo " <span class=current>$i</span> ";
}

if ($page < $jmlhal) {
$next = $page + 1;
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pemasukan'>Next »</a></span>";
} else {
echo "<span class=disabled>Next »</span>";
}
echo "</div>";
} //if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";

echo "</div>";
} //for atas
?>


</div>

<?php
if (isset($_POST["Simpan"])) {
$pro = strip_tags($_POST["pro"]);
$id_pemasukan = strip_tags($_POST["id_pemasukan"]);
$id_pemasukan0 = strip_tags($_POST["id_pemasukan0"]);
$id_user = strip_tags($_SESSION["cid"]);
$id_supplier = strip_tags($_POST["id_supplier"]);
$tanggal = date("Y-m-d");
$jam = date("H:i:s");
$keterangan = strip_tags($_POST["keterangan"]);	


if ($pro == "simpan") {
$sql = " INSERT INTO `$tbpemasukan` (
`id_pemasukan` ,
`id_user` ,
`id_supplier` ,
`tanggal` ,
`jam` ,
`status`, 
`keterangan` 
) VALUES (
'$id_pemasukan' ,
'$id_user' ,
'$id_supplier' ,
'$tanggal' ,
'$jam' ,
'Proses', 
'' 
)";

$simpan = process($conn, $sql);
if ($simpan) {
echo "<script>alert('Data pemasukan $id_pemasukan berhasil disimpan !');document.location.href='?mnu=pemasukandetail&id=$id_pemasukan';</script>";
} else {
echo "<script>alert('Data pemasukan $id_pemasukan gagal disimpan...');document.location.href='?mnu=pemasukan';</script>";
}
} else {
$status = strip_tags($_POST["status"]);

$sql = "update `$tbpemasukan` set 
`id_supplier`='$id_supplier',
`status`='$status',
`keterangan`='$keterangan'
where `id_pemasukan`='$id_pemasukan0'";
$ubah = process($conn, $sql);
if ($ubah) {
echo "<script>alert('Data pemasukan $id_pemasukan berhasil diubah !');document.location.href='?mnu=pemasukan';</script>";
} else {
echo "<script>alert('Data pemasukan $id_pemasukan gagal diubah...');document.location.href='?mnu=pemasukan';</script>";
}
} //else simpan
}
?>

<?php
if ($_GET["pro"] == "hapus") {
$id_pemasukan = $_GET["kode"];
$sql = "delete from `$tbpemasukan` where `id_pemasukan`='$id_pemasukan'";
$hapus = process($conn, $sql);

$sql = "delete from `$tbpemasukandetail` where `id_pemasukan`='$id_pemasukan'";
$hapus = process($conn, $sql);
if ($hapus) {
echo "<script>alert('Data $id_pemasukan berhasil dihapus !');document.location.href='?mnu=pemasukan';</script>";
} else {
echo "<script>alert('Data $id_pemasukan gagal dihapus...');document.location.href='?mnu=pemasukan';</script>";
}
}
?>