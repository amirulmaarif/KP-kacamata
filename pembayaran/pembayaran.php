 <?php
	$pro="simpan";
	$id_pengeluaran="";
	$nominal="";
	$pesan="";
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
	$bukti_bayar="avatar.jpg";
	$bukti_bayar0="avatar.jpg";
	$status="Order";
	$keterangan="";
?>
  


<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('pembayaran/pembayaran_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `id_pembayaran` from `$tbpembayaran` order by `id_pembayaran` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="PBY".$th.$bl;
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["id_pembayaran"];
   
   $bul=substr($idmax,5,2);
   $tah=substr($idmax,3,2);
    if($bul==$bl && $tah==$th){
     $urut=substr($idmax,7,3)+1;
     if($urut<10){$idmax="$kd"."00".$urut;}
     else if($urut<100){$idmax="$kd"."0".$urut;}
     else{$idmax="$kd".$urut;}
    }//==
    else{
     $idmax="$kd"."001";
     }   
   }//jum>0
  else{$idmax="$kd"."001";}
  $id_pembayaran=$idmax;
?>


<?php
$id_pengeluaran = $_GET["id"];
$sql = "select * from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
$d = getField($conn, $sql);
	    $id_pengeluaran = $d["id_pengeluaran"];
		$buyer = $d["buyer"];
		$id_user = $d["id_user"];
		$tanggal = WKT($d["tanggal"]);
		$jam = $d["jam"];
		$status = $d["status"];
		$keterangan = $d["keterangan"];

?>


<h3>Pengeluaran <?php echo $id_pengeluaran; ?></h3>
<hr>
<table width="100%">
	<tr>
		<th width="20%"><label for="id_pengeluaran">ID Pengeluaran</label>
		<th width="1%">:
		<td colspan="2"><?php echo $id_pengeluaran; ?>
	</tr>

	<tr>
		<th width="20%"><label for="buyer">Nama Buyer</label>
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
<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_pembayaran=$_GET["kode"];
	$sql="select * from `$tbpembayaran` where `id_pembayaran`='$id_pembayaran'";
	$d=getField($conn,$sql);
				$id_pembayaran=$d["id_pembayaran"];
				$id_pembayaran0=$d["id_pembayaran"];
				$id_pengeluaran=$d["id_pengeluaran"];
				$nominal=$d["nominal"];
				$pesan=$d["pesan"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$bukti_bayar=$d["bukti_bayar"];
				$bukti_bayar0=$d["bukti_bayar"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$pro="ubah";		
}
?>

			<?php
$sql="select * from `$tbpengeluarandetail` where `id_pengeluaran`='$id_pengeluaran' order by `id_td` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){
$no = 1;							
	$gab=0;
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_td=$d["id_td"];
				$id_pengeluaran=$d["id_pengeluaran"];
				$id_produk=$d["id_produk"];
				$jumlah=$d["jumlah"];
				$subtotal=$d["subtotal"];
				$catatan=$d["catatan"];
				$gab+=$subtotal;
				}//for dalam
		}//if
				
$nominal=$gab;
	?>	
 <link rel="stylesheet" href="jsacordeon/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
  <script src="jsacordeon/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
	
	
    <div id="accordion">
  <h3>Masukan Data Pembayaran</h3>
  <div>
			
<form action="" method="post" enctype="multipart/form-data">
<table class="table table-bordered" >
<tr>
<th width="20%"><label for="id_pembayaran">ID Pembayaran</label>
<th width="1%">:
<th colspan="2"><b><?php echo $id_pembayaran;?></b></tr>

<tr>
<td><label for="nominal">Nominal</label>
<td>:<td colspan="2"><input required  style="width: 450px;" class="form-control" name="nominal" type="number" id="nominal" value="<?php echo $nominal;?>" size="25" />
</td></tr>

<tr>
<td height="24"><label for="pesan">Pesan</label>
<td>:<td>
<textarea name="pesan" class="form-control" style="width: 650px;"  cols="55" rows="2"><?php echo $pesan;?></textarea>
</td>
</tr>
<tr>
  <td height="24"><label for="bukti_bayar">Struk Bukti Transfer</label>
    <td>:<td colspan="2">
        <input class="form-control" name="bukti_bayar" type="file" id="bukti_bayar" size="20" /> 
      => <a href='#' onclick='buka("pembayaran/zoom.php?id=<?php echo $id_pembayaran;?>")'><?php echo $bukti_bayar0;?></a></td>
</tr>

<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){?>
<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Order" <?php if($status=="Order"){echo"checked";}?>/> Order &emsp;
<input type="radio" name="status" id="status"  value="Valid" <?php if($status=="Valid"){echo"checked";}?>/> Valid &emsp;
<input type="radio" name="status" id="status" value="InValid" <?php if($status=="InValid"){echo"checked";}?>/> InValid
</td></tr>

<tr>
<td height="24"><label for="keterangan">Catatan Penerimaan</label>
<td>:<td>
<textarea name="keterangan" style="width: 450px;" class="form-control" cols="55" rows="2"><?php echo $keterangan;?></textarea>
</td>
</tr>
<?php
}
?>
<tr>
<td>
<td>
<td colspan="2">
<input name="Simpan" type="submit" id="Simpan" value="Simpan" class="btn btn-primary"/>
<input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
<input name="id_pengeluaran" type="hidden" id="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>" />
<input name="bukti_bayar0" type="hidden" id="bukti_bayar0" value="<?php echo $bukti_bayar0;?>" />
<input name="id_pembayaran" type="hidden" id="id_pembayaran" value="<?php echo $id_pembayaran;?>" />
<input name="id_pembayaran0" type="hidden" id="id_pembayaran0" value="<?php echo $id_pembayaran0;?>" />
<a href="?mnu=pembayaran&id=<?php echo $id_pengeluaran;?>"><input name="Batal" type="button" id="Batal" value="Batal" class="btn btn-danger"/></a>
</td></tr>
</table>
</form>
<br />

Data Pembayaran | <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_pengeluaran;?>')"> |
<br>

<table class="table table-bordered">
  <tr bgcolor="#cccccc">
  <th width="2%">No</th>
	<th width="10%">Struk</th>
    <th width="25%">Pembayaran</th>
	<th width="45%">List Order</th>
	<th width="15%">Status</th>
    <th width="13%">Menu</th>
  </tr>
<?php  
  $sql="select * from `$tbpembayaran` where  `id_pengeluaran`='$id_pengeluaran' order by `id_pembayaran` desc";
  $jum=getJum($conn,$sql);
		if($jum > 0){	
		$no=1;
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_pembayaran=$d["id_pembayaran"];
				$id_pengeluaran=$d["id_pengeluaran"];
				$nominal=$d["nominal"];
				$pesan=$d["pesan"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$bukti_bayar=$d["bukti_bayar"];
				$keterangan=$d["keterangan"]; 
				$status=$d["status"]; 
				$list=getDetailK($conn,$id_pengeluaran);
				
			$sqlv="select `alamat` from `$tbpengeluaran` where `id_pengeluaran`='$id_pengeluaran'";
				$dv=getField($conn,$sqlv);  
				$buyer=$dv["buyer"];
				
				$color="#ffffff";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
	<td><small>$no</td>
	<td><small><div align='center'>";
	echo"<a href='#' onclick='buka(\"pembayaran/zoom.php?id=$id_pembayaran\")'>
	<img src='$YPATH/$bukti_bayar' width='80' height='80' /></a></div>";
	echo"</td>	
	<td><small><b>$id_pembayaran</b><br> $tanggal Jam $jam Wib 
	<td> <small>Nominal TF: <u>Rp. ".RP($nominal)."</u></i> <i>Pesan: $pesan</small>
	<br><small>List Produk : $list </small>
	<td><small>$status <i>#$keterangan</i></td>
<td style='white-space: nowrap;'><div align='center'>
<a href='?mnu=pembayaran&id=$id_pengeluaran&pro=ubah&kode=$id_pembayaran'><img src='ypathicon/ub.png' title='Ubah $id_pembayaran'></a>

<a href='?mnu=pembayaran&id=$id_pengeluaran&pro=hapus&id_pengeluaran=$id_pengeluaran&kode=$id_pembayaran&tanggal=$tanggal'><img src='ypathicon/ha.png' title='Hapus $id_pembayaran' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus data pada Nota pembayaran \"$id_pembayaran\" pada Data Arsip ?..\")'></a></div></td>
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data pembayaran belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
echo"</div>";
?>


</div>

<?php
if(isset($_POST["Simpan"])){
	
	$pro=strip_tags($_POST["pro"]);
	$id_pembayaran=strip_tags($_POST["id_pembayaran"]);
	$id_pembayaran0=strip_tags($_POST["id_pembayaran0"]);
	$nominal=strip_tags($_POST["nominal"]);
	$pesan=strip_tags($_POST["pesan"]);
	$id_pengeluaran=strip_tags($_POST["id_pengeluaran"]);
	$status=strip_tags($_POST["status"]);
	if($status=="Valid"){
	$sql="Update `$tbpengeluaran` set `status`='Selesai',`id_user`='".$_SESSION['cid']."' where `id_pengeluaran`='$id_pengeluaran'";
	$up=process($conn,$sql);
	}
	
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
	
	$bukti_bayar0=strip_tags($_POST["bukti_bayar0"]);
	if ($_FILES["bukti_bayar"] != "") {
		move_uploaded_file($_FILES["bukti_bayar"]["tmp_name"],"$YPATH/".$_FILES["bukti_bayar"]["name"]);
		$bukti_bayar=$_FILES["bukti_bayar"]["name"];
		} 
	else {$bukti_bayar=$bukti_bayar0;}
	if(strlen($bukti_bayar)<1){$bukti_bayar=$bukti_bayar0;}
	$deskripsi=strip_tags($_POST["deskripsi"]);

 $sql = "select sum(`subtotal`) as `total` from `$tbpengeluarandetail` where `id_pengeluaran`='$id_pengeluaran'";
	$d = getField($conn, $sql);
	$total = $d["total"];
	$totals=RP($total);
	$nominals=RP($nominal);
	if($nominal<$total){
	echo"<script>alert('Maaf Pembayaran Anda \"$nominals\"   Kurang bayar dari seharusnya \"$totals\"...');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";	
	}
	else{
if($pro=="simpan"){
	
	
 $sql=" INSERT INTO `$tbpembayaran` (
`id_pembayaran` ,
`id_pengeluaran` ,
`nominal` ,
`pesan` ,
`tanggal` ,
`jam` ,
`bukti_bayar` ,
`keterangan`, 
`status` 
) VALUES (
'$id_pembayaran', 
'$id_pengeluaran',
'$nominal',
'$pesan',
'$tanggal', 
'$jam',
'$bukti_bayar',
'',
'Order'
)";
	
$simpan=process($conn,$sql);
	if($simpan) {echo "<script>alert('Data pembayaran \"$id_pembayaran\" berhasil disimpan !');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
		else{echo"<script>alert('Data pembayaran tanggal \"$id_pembayaran\"  gagal disimpan...');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
	}
	else{
		
	$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbpembayaran` set 
	`nominal`='$nominal',
	`pesan`='$pesan',
	`bukti_bayar`='$bukti_bayar',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_pembayaran`='$id_pembayaran0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>alert('Data  pembayaran \"$id_pembayaran\"  berhasil diubah !');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
		else{echo"<script>alert('Data  pembayaran \"$id_pembayaran\"  gagal diubah...');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
	}//else simpan
	
	}
}
?>

<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="hapus"){
$id_pembayaran=$_GET["kode"];
$id_pengeluaran=$_GET["id_pengeluaran"];
$sql="delete from `$tbpembayaran` where `id_pembayaran`='$id_pembayaran'";
$hapus=process($conn,$sql);

$sql="Update `$tbpengeluaran` set `status`='Proses' where `id_pengeluaran`='$id_pengeluaran'";
	$up=process($conn,$sql);
	if($hapus) {echo "<script>alert('Data  pembayaran \"$id_pembayaran\"  berhasil dihapus !');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
	else{echo"<script>alert('Data  pembayaran \"$id_pembayaran\"  gagal dihapus...');document.location.href='?mnu=pembayaran&id=$id_pengeluaran';</script>";}
}
?>

