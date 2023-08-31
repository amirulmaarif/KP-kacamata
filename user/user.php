<?php
$pro = "simpan";
$status = "Aktif";
?>

<script type="text/javascript">
	function PRINT(pk) {
		win = window.open('user/user_print.php?pk=' + pk, 'win', 'width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0');
	}
</script>
<script language="JavaScript">
	function buka(url) {
		window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');
	}
</script>

<?php
$sql = "select `id_user` from `$tbuser` order by `id_user` desc";
$jum = getJum($conn, $sql);
$kd = "USR";
if ($jum > 0) {
	$d = getField($conn, $sql);
	$idmax = $d['id_user'];
	$urut = substr($idmax, 3, 2) + 1; //01
	if ($urut < 10) {
		$idmax = "$kd" . "0" . $urut;
	} else {
		$idmax = "$kd" . $urut;
	}
} else {
	$idmax = "$kd" . "01";
}
$id_user = $idmax;
?>
<?php
if ($_GET["pro"] == "ubah") {
	$id_user = $_GET["kode"];
	$sql = "select * from `$tbuser` where `id_user`='$id_user'";
	$d = getField($conn, $sql);
	$id_user = $d["id_user"];
	$id_user0 = $d["id_user"];
	$level = $d["level"];
	$alamat = $d["alamat"];
	$nama_user = $d["nama_user"];
	$username = $d["username"];
	$password = $d["password"];
	$telepon = $d["telepon"];
	$email = $d["email"];
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
	<h3>Masukan Data User</h3>
	<div>

<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
	<th width="20%"><label for="id_user">ID User</label>
	<th width="1%">:
	<th colspan="2"><b><?php echo $id_user; ?></b>
</tr>
<tr>
	<td><label for="nama_user">Nama User</label>
	<td>:
	<td width="213"><input required class="form-control" style="width: 250px;" name="nama_user" type="text" id="nama_user" value="<?php echo $nama_user; ?>" size="25" />
	</td>

<tr>
	<td><label for="level">Level User</label>
	<td>:
	<td width="213">
		
		<input type="radio" name="level" id="level" checked="checked" value="Administrator" <?php if ($level == "Administrator") {
																			echo "checked";
																		} ?> />Administrator
		<input type="radio" name="level" id="level" value="Owner" <?php if ($level == "Owner") {
																			echo "checked";
																		} ?> />Owner

	</td>
<tr>
	<td height="24"><label for="email">Email</label>
	<td>:
	<td><input required class="form-control" style="width: 350px" name="email" type="email" id="email" value="<?php echo $email; ?>" size="25" />
	</td>
</tr>
<tr>
	<td><label for="alamat">Alamat</label>
	<td>:
	<td width="213">
		<textarea name="alamat" class="form-control" cols="55" rows="2"><?php echo $alamat; ?></textarea>
	</td>
<tr>
<tr>
	<td height="24"><label for="telepon">Telepon</label>
	<td>:
	<td><input required class="form-control" style="width: 170px" name="telepon" type="number" id="telepon" value="<?php echo $telepon; ?>" size="25" />
	</td>
</tr>

<tr>
	<td height="24"><label for="username">Username</label>
	<td>:
	<td><input required class="form-control" style="width: 150px;" name="username" type="username" id="username" value="<?php echo $username; ?>" size="25" /></td>
</tr>

<tr>
	<td height="24"><label for="password">Password</label>
	<td>:
	<td><input required class="form-control" style="width: 175px;" name="password" type="password" id="password" value="<?php echo $password; ?>" size="25" /></td>
</tr>

<tr>
	<td><label for="status">Status</label>
	<td>:
	<td colspan="2">
		<input type="radio" name="status" id="status" checked="checked" value="Aktif" <?php if ($status == "Aktif") {echo "checked";} ?> />Aktif
		<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if ($status == "Tidak Aktif") {echo "checked";} ?> />Tidak Aktif
	</td>
</tr>

<tr>
	<td height="24"><label for="keterangan">Keterangan</label>
	<td>:
	<td>
		<textarea name="keterangan" class="form-control" cols="55" rows="2"><?php echo $keterangan; ?></textarea>
	</td>
</tr>

<tr>
	<td>
	<td>
	<td colspan="2">
		<input name="Simpan" class="btn btn-primary" type="submit" id="Simpan" value="Simpan" />
		<input name="pro" type="hidden" id="pro" value="<?php echo $pro; ?>" />
		<input name="id_user" type="hidden" id="id_user" value="<?php echo $id_user; ?>" />
		<input name="id_user0" type="hidden" id="id_user0" value="<?php echo $id_user0; ?>" />
		<a href="?mnu=user"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
	</td>
</tr>
</table>
</form>
<br />
</div>



	<?php
	$sqlc = "select distinct(`status`) from `$tbuser` order by `status` asc";
	$jumc = getJum($conn, $sqlc);
	if ($jumc < 1) {
		echo "<h1>Maaf data User belum tersedia</h1>";
	}
	$arrc = getData($conn, $sqlc);
	foreach ($arrc as $dc) {
		$status = $dc["status"];
		$sql = "select * from `$tbuser` where  `status`='$status' order by `id_user` asc";
		$jum = getJum($conn, $sql);
	?>
		<h3>User Status <?php echo $status . " ($jum User)"; ?>:</h3>
		<div>
 
 <font color="black">Data User : </font>
			<table class="table table-bordered table-hover">
				<tr class="bg-dark text-light">
					<th width="3%">No</td>
					<th width="5%">IDUSR</td>
					<th width="15%">Nama User</td>
					<th width="7%">Telepon</td>
					<th width="7%">Level</td>
					<th width="15%">Alamat</td>
					<th width="25%">Keterangan</td>
					<th width="5%">Menu</td>
				</tr>
				<?php

				if ($jum > 0) {
					$no = 1;
					$arr = getData($conn, $sql);
					foreach ($arr as $d) {
						$id_user = $d["id_user"];
						$nama_user = ucwords($d["nama_user"]);
						$level = $d["level"];
						$alamat = $d["alamat"];
						$password = $d["password"];
						$telepon = $d["telepon"];
						$email = $d["email"];
						$status = $d["status"];
						$keterangan = $d["keterangan"];
						$color = "";
						if ($no % 2 == 0) {
							$color = "";
						}
						echo "<tr bgcolor='$color'>
				<td><small>$no</td>
				<td><small>$id_user</td>
				<td><small><a href='mailto:$email'>$nama_user</a></td>
				<td><small>$telepon</td>
				<td><small>$level</td>
				<td><small><i>$alamat</i></td> 
				<td><small>$keterangan</small></td>
				<td><div align='center'>
<a href='?mnu=user&pro=ubah&kode=$id_user'><img src='ypathicon/ub.png' title='ubah'></a>
<a href='?mnu=user&pro=hapus&kode=$id_user'><img src='ypathicon/ha.png' title='hapus' 
onClick='return confirm(\"Apakah Anda benar-benar akan menghapus $nama_user pada data user ?..\")'></a></div></td>
				</tr>";
						$no++;
					} //for dalam
				} //if
				else {
					echo "<tr><td colspan='6'><blink>Maaf, Data user belum tersedia...</blink></td></tr>";
				}
				?>
			</table>
		<?php
		echo "</div>";
	} //for atas
		?>
		</div>

		<?php
		if (isset($_POST["Simpan"])) {
			$pro = strip_tags($_POST["pro"]);
			$id_user = strip_tags($_POST["id_user"]);
			$id_user0 = strip_tags($_POST["id_user0"]);
			$level = strip_tags($_POST["level"]);
			$alamat = strip_tags($_POST["alamat"]);
			$username = strip_tags($_POST["username"]);
			$nama_user = strip_tags($_POST["nama_user"]);
			$password = strip_tags($_POST["password"]);
			$telepon = strip_tags($_POST["telepon"]);
			$email = strip_tags($_POST["email"]);
			$status = strip_tags($_POST["status"]);
			$keterangan = strip_tags($_POST["keterangan"]);

			if ($pro == "simpan") {
				$sql = " INSERT INTO `$tbuser` (
`id_user` ,
`nama_user` ,
`level` ,
`username` ,
`alamat` ,
`password` ,
`telepon` ,
`email` ,
`keterangan`, 
`status` 
) VALUES (
'$id_user', 
'$nama_user',
'$level',
'$username',
'$alamat',
'$password', 
'$telepon',
'$email',
'$keterangan',
'$status'
)";

				$simpan = process($conn, $sql);
				if ($simpan) {
					echo "<script>alert('Data $nama_user berhasil disimpan !');document.location.href='?mnu=user';</script>";
				} else {
					echo "<script>alert('Data $nama_user gagal disimpan...');document.location.href='?mnu=user';</script>";
				}
			} else {
				$sql = "update `$tbuser` set 
	`nama_user`='$nama_user',
	`level`='$level',
	`username`='$username',`alamat`='$alamat',
	`password`='$password',
	`telepon`='$telepon' ,
	`email`='$email',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_user`='$id_user0'";
				$ubah = process($conn, $sql);
				if ($ubah) {
					echo "<script>alert('Data $nama_user berhasil diubah !');document.location.href='?mnu=user';</script>";
				} else {
					echo "<script>alert('Data $nama_user gagal diubah...');document.location.href='?mnu=user';</script>";
				}
			} //else simpan
		}
		?>

		<?php
		if ($_GET["pro"] == "hapus") {
			$id_user = $_GET["kode"];
			$sql = "delete from `$tbuser` where `id_user`='$id_user'";
			$hapus = process($conn, $sql);
			if ($hapus) {
				echo "<script>alert('Data $id_user berhasil dihapus !');document.location.href='?mnu=user';</script>";
			} else {
				echo "<script>alert('Data $id_user gagal dihapus...');document.location.href='?mnu=user';</script>";
			}
		}
		?>