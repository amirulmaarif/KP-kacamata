<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="status";
$TB=$tbsupplier;
$item="supplier";



  $sql="select * from `$TB` order by `$field` asc";
  if(isset($_GET["pk"])){
	$pk=$_GET["pk"];
		$sql="select * from `$TB` where `$field`='$pk' order by `$field` asc";
  }

  echo "<h3><center>Laporan Data $item $pk</h3>";
  ?>


 

<table width="98%" border="0">
  <tr>
	<th width="5%">No</td>
					<th width="5%">IDSPL</td>
					<th width="15%">Nama Supplier</td>
					<th width="45%">Alamat</td>
					<th width="25%">Keterangan</td>
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
			$id_supplier = $d["id_supplier"];
						$nama_supplier = ucwords($d["nama_supplier"]);
						$deskripsi = $d["deskripsi"];
						$alamat = $d["alamat"];
						$email = $d["email"];
						$telepon = $d["telepon"];
						$status = $d["status"];
						$keterangan = $d["keterangan"];


						$color = "";
						if ($no % 2 == 0) {
							$color = "#eeeeee";
						}
						echo "<tr bgcolor='$color'>
				<td><small>$no</td>
				<td><small>$id_supplier</td>
				<td><small>$nama_supplier</a>
				<td><small>$alamat, Telp: $telepon, Email : $email
				<td><small>$deskripsi <i>$keterangan</i></small></td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>