<?php

$pro = "simpan";
$status = "Aktif";
$tanggal=WKT(date("Y-m-d"));
$jam=date("H:i:s");
$id_pengeluaran = "";
$buyer = "";
$id_user = "";
$keterangan = "";
?>
<script type="text/javascript">
var xmlHttp;

function showUp(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
var url="getCust.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC1;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC1() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText ;
 } 
}

function GetXmlHttpObject(){
var xmlHttp=null;
try{xmlHttp=new XMLHttpRequest();}
catch (e){
	try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
 	catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
 }
return xmlHttp;
}
</script>
<script type="text/javascript">
function PRINT(pk) {
win = window.open('pengeluaran/pengeluaran_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
}
</script>
<script language="JavaScript">
function buka(url) {
window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
}
</script>

<?php
$sql = "select `id_pengeluaran` from `$tbpengeluaran` order by `id_pengeluaran` desc";
$q = mysqli_query($conn, $sql);
$jum = mysqli_num_rows($q);
$th = date("y");
$bl = date("m") + 0;
if ($bl < 10) {
$bl = "0" . $bl;
}

$kd = "ORD" . $th . $bl; //KEG1610001
if ($jum > 0) {
$d = mysqli_fetch_array($q);
$idmax = $d["id_pengeluaran"];

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
$id_pengeluaran = $idmax;
?>
<?php
if ($_GET["pro"] == "ubah") {
$id_pengeluaran = $_GET["kode"];
	$sql = "select * from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
	$d = getField($conn, $sql);
		$id_pengeluaran = $d["id_pengeluaran"];
		$id_pengeluaran0 = $d["id_pengeluaran0"];
		$buyer = $d["buyer"];
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
<h3>Data pengeluaran</h3>
<div>

<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
<th width="170"><label for="id_pengeluaran">ID pengeluaran</label>
<th width="10">:
<th colspan="2"><b><?php echo $id_pengeluaran; ?></b>
</tr>
<tr>
		<td><label for="buyer">Buyer</label>
		<td>:
		<td><input required class="form-control"  name="buyer" type="text" id="buyer" value="<?php echo $buyer; ?>" size="25" />
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
<input type="radio" name="status" id="status" checked="checked" value="Proses" <?php if ($status == "Proses") {echo "checked";} ?> /> Proses
<input type="radio" name="status" id="status" value="Selesai" <?php if ($status == "Selesai") {echo "checked";} ?> /> Selesai
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
<input name="id_pengeluaran" type="hidden" id="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>" />
<input name="id_pengeluaran0" type="hidden" id="id_pengeluaran0" value="<?php echo $id_pengeluaran0; ?>" />
<a href="?mnu=pengeluaran"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td>
</tr>
</table>
</form>
<br />
</div>

<?php
$sqlc = "select distinct(`tanggal`) from `$tbpengeluaran` order by `tanggal` desc";
$jumc = getJum($conn, $sqlc);
if ($jumc < 1) {
echo "<h1>Maaf data pengeluaran belum tersedia</h1>";
}
$arrc = getData($conn, $sqlc);
foreach ($arrc as $dc) {
$tanggal = $dc["tanggal"];

$sql = "select * from `$tbpengeluaran` where  `tanggal`='$tanggal' order by `id_pengeluaran` desc";
$jum = getJum($conn, $sql);
?>
<h3>Data Pengeluaran Tanggal <?php echo WKT($tanggal) . " ($jum Pengeluaran)"; ?>:</h3>
<div>

<font color="black">Data Pengeluaran </font>| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $tanggal; ?>')"> |
<table class="table table-bordered table-hover">
<tr class="bg-dark text-light">
<th width="3%">No</td>
<th width="10%">Nota Pengeluaran</td>
<th width="25%">Buyer</td>
<th width="35%">List Produk Dan Keterangan</td>
<th width="15%">Status</td>
<th width="20%"><center>Menu</td>
</tr>
<?php

if ($jum > 0) {
//---------------------------------- 
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
echo"<td style='background-color:yellow'><small>$status <i>$keterangan <b> <i>Perlu cek pembayaran </i><b></small></td>";}
else if($status=="Batal" ){
echo"<td style='background-color:red'><small>$status, Validasi oleh $user  <i>$keterangan <b> <i>pengeluaran Batal </i><b></small></td>";}
else {echo"<td><small>$status, Validasi oleh $user <i>$keterangan</small></td>";}

echo"<td><div align='center'>
<a href='?mnu=pengeluarandetail&id=$id_pengeluaran'><img src='ypathicon/search.png' title='List Detail pengeluaran'><font size='1'>Detail Order</font></a>
<br>
<a href='?mnu=pembayaran&id=$id_pengeluaran'><img src='ypathicon/konfirmasi.png' title='Detail Pembayaran pengeluaran'><font size='1'>Detail Bayar</font></a>
<br>
<a href='?mnu=pengeluaran&pro=ubah&kode=$id_pengeluaran'><img src='ypathicon/ub.png' title='ubah'><font size='1'>Ubah Data</font></a>
<br>
<a href='?mnu=pengeluaran&pro=hapus&kode=$id_pengeluaran'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $id_pengeluaran pada data pengeluaran ?..\")'><font size='1'>Hapus Data</font></a></div></td>
</tr>";

$no++;
} //for dalam
} //if
else {
echo "<tr><td colspan='6'><blink>Maaf, Data pengeluaran belum tersedia...</blink></td></tr>";
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
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=pengeluaran'>« Prev</a></span> ";
} else {
echo "<span class=disabled>« Prev</span> ";
}

for ($i = 1; $i <= $jmlhal; $i++)
if ($i != $page) {
echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=pengeluaran'>$i</a> ";
} else {
echo " <span class=current>$i</span> ";
}

if ($page < $jmlhal) {
$next = $page + 1;
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=pengeluaran'>Next »</a></span>";
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
	$id_pengeluaran = strip_tags($_POST["id_pengeluaran"]);
	$id_pengeluaran0 = strip_tags($_POST["id_pengeluaran"]);
	$id_user = strip_tags($_SESSION["cid"]);
	$buyer= strip_tags($_POST["buyer"]);
	$status= strip_tags($_POST["status"]);
	$keterangan = strip_tags($_POST["keterangan"]);
	$tanggal = date("Y-m-d");
	$jam = date("H:i:s");

	
if ($pro == "simpan") {
$sql = " INSERT INTO `$tbpengeluaran` (
`id_pengeluaran` ,
`buyer` ,
`id_user` ,
`tanggal` ,
`jam` ,
`status` ,
`keterangan` 
) VALUES (
'$id_pengeluaran', 
'$buyer',
'$id_user',
'$tanggal', 
'$jam',
'Proses',
''
)";

$simpan = process($conn, $sql);
if ($simpan) {
echo "<script>alert('Data pengeluaran $buyer berhasil disimpan !');document.location.href='?mnu=pengeluarandetail&id=$id_pengeluaran';</script>";
} else {
echo "<script>alert('Data pengeluaran $buyer gagal disimpan...');document.location.href='?mnu=pengeluaran';</script>";
}
} else {
	$status = strip_tags($_POST["status"]);
	


$sql = "update `$tbpengeluaran` set 
`buyer`='$buyer',
`status`='$status',
`keterangan`='$keterangan'
where `id_pengeluaran`='$id_pengeluaran0'";
$ubah = process($conn, $sql);
if ($ubah) {
echo "<script>alert('Data pengeluaran $buyer berhasil diubah !');document.location.href='?mnu=pengeluaran';</script>";
} else {
echo "<script>alert('Data pengeluaran $buyer gagal diubah...');document.location.href='?mnu=pengeluaran';</script>";
}
} //else simpan
}
?>

<?php
if ($_GET["pro"] == "hapus") {
$id_pengeluaran = $_GET["kode"];
$sql = "delete from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
$hapus = process($conn, $sql);

$sql = "delete from `$tbpengeluarandetail` where `id_pengeluaran`='$id_pengeluaran'";
$hapus = process($conn, $sql);


if ($hapus) {
echo "<script>alert('Data pengeluaran $id_pengeluaran berhasil dihapus !');document.location.href='?mnu=pengeluaran';</script>";
} else {
echo "<script>alert('Data pengeluaran $id_pengeluaran gagal dihapus...');document.location.href='?mnu=pengeluaran';</script>";
}
}
?>