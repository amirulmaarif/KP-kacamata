<?php
require_once"koneksivar.php";

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
?>



<?php function RP($rupiah){return number_format($rupiah,"2",",",".");}?>
<?php
function WKT($sekarang){
if($sekarang=="0000-00-00"){$sekarang=date("Y-m-d");}

$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;
return $wk;
}
?>
<?php
function WKTP($sekarang){
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,2,2);

$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
$wk=$tanggal." ".$judul_bln[(int)$bulan]."'".$tahun;
return $wk;
}
?>

<?php
function process($conn,$sql){
$s=false;
$conn->autocommit(FALSE);
try {
  $rs = $conn->query($sql);
  if($rs){
	    $conn->commit();
	    $last_inserted_id = $conn->insert_id;
 		$affected_rows = $conn->affected_rows;
  		$s=true;
  }
} 
catch (Exception $e) {
	echo 'fail: ' . $e->getMessage();
  	$conn->rollback();
}
$conn->autocommit(TRUE);
return $s;
}

function getJum($conn,$sql){
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getField($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$d= $rs->fetch_assoc();
	$rs->free();
	return $d;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	//foreach($arr as $row) {
	//  echo $row['nama_kelas'] . '*<br>';
	//}
	
	$rs->free();
	return $arr;
}

function getUser($conn,$kode){
$field="nama_user";
$sql="SELECT `$field` FROM `tb_user` where `id_user`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
	
function getSupplier($conn,$kode){
$field="nama_supplier";
$sql="SELECT `$field` FROM `tb_supplier` where `id_supplier`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
	
function getProduk($conn,$kode){
$field="nama_produk";
$sql="SELECT `$field` FROM `tb_produk` where `id_produk`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
function getCustomer($conn,$kode){
$field="nama_customer";
$sql="SELECT `$field` FROM `tb_customer` where `id_customer`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
function getDetailM($conn,$kode){
 $sql="select * from `tb_pemasukan_detail` where  `id_pemasukan`='$kode' order by `id_pd` asc";
  $jum=getJum($conn,$sql);
  $gab="";
   $tot=0;
		if($jum > 0){ 	
		$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_produk=$d["id_produk"];
				$produk=getProduk($conn,$d["id_produk"]); 
				$jumlah=$d["jumlah"];
				$catatan=$d["catatan"];
				$tot+=$jumlah;
				$gab.="$produk ($id_produk):$jumlah ,";
		}
		$gab=substr($gab,0,strlen($gab)-1);
		$gab.="#Total Stok: $tot";
		}
		else{$gab="<u><i>Belum Ada Pemasukan Produk</u></i>";}
return $gab;
}
function getDetailM2($conn,$kode){
 $sql="select * from `tb_pemasukan_detail` where  `id_pemasukan`='$kode' order by `id_pd` asc";
  $jum=getJum($conn,$sql);
  $gab="";
   $tot=0;
		if($jum > 0){ 	
		$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_produk=$d["id_produk"];
				$produk=getProduk($conn,$d["id_produk"]); 
				$jumlah=$d["jumlah"];
				$catatan=$d["catatan"];
				$tot+=$jumlah;
				
		}
		$gab=substr($gab,0,strlen($gab)-1);
		$gab.="$tot";
		}
		else{$gab="<u>0</i>";}
return $gab;
}
function getDetailK($conn,$kode){
 $sql="select * from `tb_pengeluaran_detail` where  `id_pengeluaran`='$kode' order by `id_td` asc";
  $jum=getJum($conn,$sql);
  $gab="";
  $tot=0;
		if($jum > 0){ 	
		$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_produk=$d["id_produk"];
				$produk=getProduk($conn,$id_produk); 
				$jumlah=$d["jumlah"];
				$harga=$d["harga"];
				$subtotal=$d["subtotal"];
				$tot+=$subtotal;
				$gab.="$produk ($id_produk):$jumlah : Rp. ".RP($subtotal).",";
		}
			$gab=substr($gab,0,strlen($gab)-1);
			$gab.="#Subtotal: Rp. ".RP($tot);
		}
		else{$gab="<u><i>Belum Ada pengeluaran /Order Produk</u></i>";}
return $gab;
}	
function setPlus($conn,$id_produk,$jumlah){
 $sql="update `tb_produk` set 
	`stok`=`stok`+'$jumlah' where `id_produk`='$id_produk'";
	
	$ubah=process($conn,$sql);
}	

function setMin($conn,$id_produk,$jumlah){
$sql="update `tb_produk` set 
	`stok`=`stok`-'$jumlah' where `id_produk`='$id_produk'";
	$ubah=process($conn,$sql);
}

function setUbahM($conn,$id_produk,$jumlah0,$jumlah1){


$sel=$jumlah0-$jumlah1;

 $sql="update `tb_produk` set 
	`stok`=`stok`-'$sel' where `id_produk`='$id_produk'";
	$ubah=process($conn,$sql);
}	


function setUbahK($conn,$id_produk,$jumlah0,$jumlah1){


$sel=$jumlah1-$jumlah0;
$sql="update `tb_produk` set 
	`stok`=`stok`-'$sel' where `id_produk`='$id_produk'";
	$ubah=process($conn,$sql);
}

function cekM($T1,$J1,$set){

date_default_timezone_set('Asia/Jakarta');
$T2=date("Y-m-d");
$J2=date("H:i:s");
//echo"<br>TJ $T1 $J1 ==$T2 $J2<br>";
$awal  = date_create("$T1 $J1");
$akhir = date_create("$T2 $J2");
$diff  = date_diff( $akhir, $awal );
$jam= $diff->h;
$jam=$jam*60; 
$menit= $diff->i; 
$TM=$jam+$menit;
$hasil=0; 
if($TM>$set){
	$hasil=1; 
}
return $hasil;
}
?>


<?php
function BAL($tanggal){
	$arr=explode(" ",$tanggal);
	if($arr[1]=="Januari"||$arr[1]=="January"){$bul="01";}
	else if($arr[1]=="Februari"||$arr[1]=="February"){$bul="02";}
	else if($arr[1]=="Maret"||$arr[1]=="March"){$bul="03";}
	else if($arr[1]=="April"){$bul="04";}
	else if($arr[1]=="Mei"||$arr[1]=="May"){$bul="05";}
	else if($arr[1]=="Juni"||$arr[1]=="June"){$bul="06";}
	else if($arr[1]=="Juli"||$arr[1]=="July"){$bul="07";}
	else if($arr[1]=="Agustus"||$arr[1]=="August"){$bul="08";}
	else if($arr[1]=="September"){$bul="09";}
	else if($arr[1]=="Oktober"||$arr[1]=="October"){$bul="10";}
	else if($arr[1]=="November"){$bul="11";}
	else if($arr[1]=="Nopember"){$bul="11";}
	else if($arr[1]=="Desember"||$arr[1]=="December"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>	
