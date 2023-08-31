<?php
	$id_user=$_SESSION["cid"];
	$sql="select * from `$tbuser` where `id_user`='$id_user'";
	$d=getField($conn,$sql);
				$id_user=$d["id_user"];
				$level=$d["level"];
				$nama_user=$d["nama_user"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$alamat=$d["alamat"];
?>
     <section class="project-detail section-padding">
          <div class="container">
               <div class="row">


                    <div class="col-lg-6 col-md-6 mr-lg-auto mt-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
<img src="ypathfile/profile.jpg" width="100" height="80"/>
                      <h3>Profil</h3><hr>
                        <ul class="list-detail">
						<li><span>Nama: <?php echo $nama_user; ?></span></li>
						<li><span>Alamat: <?php echo $alamat; ?></span></li>
                        <li><span>Telepon: <?php echo $telepon; ?></span></li>
                        <li><span>Email: <?php echo $email; ?></span></li>
                        <li><span>Username: <?php echo $username; ?></span></li>
                        <li><span>Password: <?php echo $password; ?></span></li>
                      </ul>
                    </div>
					

<div class="col-lg-6 col-md-6 mr-lg-auto mt-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
<img src="ypathfile/up.jpg"/  width="100" height="80"/><h3>Ubah Profil</h3><hr>
<form action="#" method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
<div class="row">
							
<div class="col-lg-12 col-12">
<label>Nama User</label>
<input type="text" class="form-control" name="nama_user" value="<?php echo $nama_user; ?>" placeholder="Telepon">
</div>						   
<div class="col-lg-6 col-12">
<label>Telepon</label>
<input type="text" class="form-control" name="telepon" value="<?php echo $telepon; ?>" placeholder="Telepon">
</div>

<div class="col-lg-6 col-12">
<label>Email</label>
<input type="email" class="form-control" name="email"  value="<?php echo $email; ?>" placeholder="Email">
</div>

<div class="col-lg-6 col-12">
<label>Username</label>
<input type="text" class="form-control" name="username"  value="<?php echo $username; ?>" placeholder="Username">
</div>

<div class="col-lg-6 col-12">
<label>Password</label>
<input type="password" class="form-control" name="password"  value="<?php echo $password; ?>"  placeholder="Password">
</div>

<div class="col-lg-12 col-12">
<label>Alamat</label>
<input type="text" class="form-control" name="alamat"  value="<?php echo $alamat; ?>" placeholder="Alamat">
</div>

<div class="col-lg-5 mx-auto col-7">
<button type="simpan" class="btn btn-success" name="Simpan" name="simpan">Update Profil</button>
<input name="id_user" type="hidden" id="id_user" value="<?php echo $id_user;?>" />
</div>
</div>
</form>
</div>
              </div>
          </div>
     </section>

<?php
if(isset($_POST["Simpan"])){
	$id_user=strip_tags($_SESSION["cid"]);
	$alamat=strip_tags($_POST["alamat"]);
	$nama_user = strip_tags($_POST["nama_user"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	
	$sql="update `$tbuser` set 
	`username`='$username',
	`password`='$password',
	`telepon`='$telepon' ,`alamat`='$alamat' ,
	`email`='$email'
	 where `id_user`='$id_user'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>alert('Data $nama_user berhasil diubah !');document.location.href='?mnu=profil_user';</script>";}
		else{echo"<script>alert('Data $nama_user gagal diubah...');document.location.href='?mnu=profil_user';</script>";}
	}//else simpan
?>
