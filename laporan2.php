<?php
$pro="simpan";
$tanggal=WKT(date("Y-m-d"));
?>

    
<div align="right">
	<?php
if($_SESSION["cstatus"]=="Owner"){
	echo"<h3><a href='?mnu=laporan2'>Pemasukan</a> | <a href='?mnu=laporan'>pengeluaran</a> | </h3>"; 
}
else if($_SESSION["cstatus"]=="Administrator"){
	echo"<h3><a href='?mnu=laporan2'>Pemasukan</a> | <a href='?mnu=laporan'>pengeluaran</a> | </h3>"; 
}
	
	?>
	</div>
	  
<script type="text/javascript"> 
function PRINTS(){ 
win=window.open('laporan_printsession2.php','win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
$pilih="bt";
$wkt=WKT(date("Y-m-d"));
$item=$ar[1]." ".$ar[0];

	
if(isset($_POST["Cari"])){
	$pilih=$_POST["pilih"];
	$item=$_POST["item"];
}
?>
<div id="accordion">
  <h3>Laporan Data Pemasukan</h3>
  <div>

<form action="" method="post" enctype="multipart/form-data">
<table class="table table-hover">


<tr>
<th><label for="id_pemasukan">Pencarian Berdasarkan:</label>
<th>

<select name="pilih" class="form-control" >
<option value="bt" <?php if($pilih=="bt"){echo"selected";}?>>Bulan Tahun</option>
<option value="tanggal" <?php if($pilih=="tanggal"){echo"selected";}?>>Tanggal Pemasukan</option>

</select>

<th>Item Dicari
<th>
<input name="item" class="form-control" type="text" id="item" value="<?php echo $item;?>" size="15" />
<th >
<input name="Cari" type="submit" class="btn btn-success" id="Cari" value="Cari" />
<a href="?mnu=laporan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</th></tr>
</table>
</form>
<hr>


PRINT  <img src='ypathicon/print.png' title='Print Hasil Pencarian' OnClick="PRINTS()"> |
 
<table class="table table-bordered table-striped table-hover" width="100%">
  <tr bgcolor="#CCCCCC">
    <th width="3%">No</th>
    <th width="10%">Nota Pemasukan</td>
    <th width="20%">Supplier</td>
    <th width="15%">Tanggal Pemasukan</td>
	<th width="40%">List Produk</td>
	<th width="15%">Jumlah Barang</td>
  </tr>
<?php  
$sql="select * from `$tbpemasukan` where `status`='Konfirmasi'  order by `id_pemasukan` asc";


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$bulan=date("m");
$tahun=date("Y");
$awal="$tahun-$bulan-01";
$ahir="$tahun-$bulan-31";
if(isset($_POST["Cari"])){
	$pilih=$_POST["pilih"];
	$item=trim($_POST["item"]);
	
	 if($pilih=="bt"){
		$ar=explode(" ",$item);
		$bln=strtolower($ar[0]);
		$bulan=1;
		if($bln=="januari"|| $bln=="jan"){$bulan=1;}
		else if($bln=="februari"|| $bln=="feb"){$bulan=2;}
		else if($bln=="maret"|| $bln=="mar"){$bulan=3;}
		else if($bln=="april"|| $bln=="apr"){$bulan=4;}
		else if($bln=="mei"|| $bln=="mei"){$bulan=5;}
		else if($bln=="juni"|| $bln=="jun"){$bulan=6;}
		else if($bln=="juli"|| $bln=="jul"){$bulan=7;}
		else if($bln=="agustus"|| $bln=="agu"){$bulan=8;}
		else if($bln=="september"|| $bln=="sep"){$bulan=9;}
		else if($bln=="oktober"|| $bln=="okt"){$bulan=10;}
		else if($bln=="november"|| $bln=="nov"){$bulan=11;}
		else if($bln=="desember"|| $bln=="des"){$bulan=12;}
		
		$tahun=$ar[1];
		$awal="$tahun-$bulan-01";
		$ahir="$tahun-$bulan-31";
		 $sql="select * from `$tbpemasukan` where `tanggal` between '$awal' and '$ahir' and `status`='Konfirmasi' order by `id_pemasukan` asc";
		 $jumx=getJum($conn,$sql);
	}
	else 	if($pilih=="tanggal"){
		$item=BAL($item);
		 $sql="select * from `$tbpemasukan` where  `tanggal`='$item' and `status`='Konfirmasi' order by `id_pemasukan` asc";
		 $jumx=getJum($conn,$sql);
	}

	
	
	
	
}//isset

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$_SESSION["cprint"]=$sql;
   $jum=getJum($conn,$sql);
		if($jum > 0){
			$no=1;
			//--------------------------------------------------------------------------------------------
			$batas   = 30;
			$page = $_GET['page'];
			if(empty($page)){$posawal  = 0;$page = 1;}
			else{$posawal = ($page-1) * $batas;}

			$sql2 = $sql." LIMIT $posawal,$batas";
			$no = $posawal+1;
			$gab=0;
			$total=0;
			//--------------------------------------------------------------------------------------------									
			$arr=getData($conn,$sql2);
			foreach($arr as $d) {	
				$id_pemasukan = $d["id_pemasukan"];
$id_supplier = getSupplier($conn,$d["id_supplier"]);
$id_user = $d["id_user"];
$user = getUser($conn, $d["id_user"]);
$tanggal = WKT($d["tanggal"]);
$jam = $d["jam"];
$status = $d["status"];
$keterangan = $d["keterangan"];

$list = getDetailM($conn, $id_pemasukan);	
$list2 = getDetailM2($conn, $id_pemasukan);	

				$gt=0;
				$sqld="select * from `$tbpemasukandetail` where `id_pemasukan`='$id_pemasukan'";
				$arrd=getData($conn,$sqld );
				foreach($arrd as $dd) {	
					$id_pd = $dd["id_pd"];
					$id_produk = $dd["id_produk"];
					$jumlah = $dd["jumlah"];
					$catatan = $dd["catatan"];

					$sql0 = "select * from `$tbproduk` where `id_produk`='$id_produk'";
					$d0 = getField($conn, $sql0);
					$nama_produk = $d0["nama_produk"];
					$deskripsi = $d0["deskripsi"];
					$kategori = $d0["kategori"];
					$gambar = $d0["gambar"];
					$harga = $d0["harga"];
					
					$total+=$jumlah;
				}
				
					
				$color="#dddddd";	
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td>$no</td>
				<td>$id_pemasukan</td>
				<td><b>$id_supplier</b></td>
				<td>$tanggal</td>
				<td>$list</td>
				<td>$list2</td>
								</tr>";
			
			$no++;
			
			}//for
			
		}//if
		
		else{echo"<tr><td colspan='7'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
		
?>
</table>

<?php
echo" <center><b><font color='red'>Total Keseluruhan Stok Masuk : $total</font></b></center>";
?>

<?php

$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=laporan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=laporan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=laporan'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";
?>
</div>
</div>