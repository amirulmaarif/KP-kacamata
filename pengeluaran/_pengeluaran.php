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
<h3>pengeluaran Tanggal <?php echo WKT($tanggal) . " ($jum pengeluaran)"; ?>:</h3>
<div>

<font color="black">Data pengeluaran </font>| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $tanggal; ?>')"> |
<table class="table table-bordered table-hover">
<tr class="bg-dark text-light">
<th width="3%">No</td>
<th width="10%">Nota pengeluaran</td>
<th width="25%">Buyer</td>
<th width="45%">List Produk Dan Keterangan</td>
<th width="15%">Status</td>
<th width="13%"><center>Detail</td>
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
echo"<td><small>$status <i>$keterangan <b> <i>Perlu cek pembayaran </i><b></small></td>";}
else {echo"<td><small>$status, Validasi oleh $user <i>$keterangan</small></td>";}

echo"<td><div align='center'>
<a href='?mnu=pengeluarandetail_&id=$id_pengeluaran'><img src='ypathicon/search.png' title='List Detail pengeluaran'></a>
<a href='?mnu=_pembayaran&id=$id_pengeluaran'><img src='ypathicon/konfirmasi.png' title='Detail Pembayaran pengeluaran'></a>
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
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=_pengeluaran'>« Prev</a></span> ";
} else {
echo "<span class=disabled>« Prev</span> ";
}

for ($i = 1; $i <= $jmlhal; $i++)
if ($i != $page) {
echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=_pengeluaran'>$i</a> ";
} else {
echo " <span class=current>$i</span> ";
}

if ($page < $jmlhal) {
$next = $page + 1;
echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=_pengeluaran'>Next »</a></span>";
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
