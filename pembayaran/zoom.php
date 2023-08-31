<?php
include"../konmysqli.php";

echo"<link href='../$PATH/$css' rel='stylesheet' type='text/css' />";
$sql="SELECT `bukti_bayar` FROM `$tbpembayaran` WHERE `id_pembayaran`='".$_GET["id"]."'";
if(getJum($conn,$sql)>0){
	$d = getField($conn,$sql);
	$bukti_bayar=$d["bukti_bayar"];
}
else{$bukti_bayar="avatar.jpg";	}
echo "<p align=center><img src='../$YPATH/$bukti_bayar' border='0' width='100%' height='100%'></p>";
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


?>
