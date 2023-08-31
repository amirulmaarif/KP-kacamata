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
<th width="10%">Detail</td>
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
$tanggal = WKTP($d["tanggal"]);
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
<a href='?mnu=_pemasukandetail&id=$id_pemasukan'><img src='ypathicon/search.png' title='List Detail pemasukan'></a>
</div></td>
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
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=_pemasukan'>« Prev</a></span> ";
} else {
echo "<span class=disabled>« Prev</span> ";
}

for ($i = 1; $i <= $jmlhal; $i++)
if ($i != $page) {
echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=_pemasukan'>$i</a> ";
} else {
echo " <span class=current>$i</span> ";
}

if ($page < $jmlhal) {
$next = $page + 1;
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=_pemasukan'>Next »</a></span>";
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
