 <div class="container-fluid">
        <div class="row bg-secondary py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white pr-3" href="">FAQs</a>
                    <span class="text-white">|</span>
                    <a class="text-white px-3" href="">Help</a>
                    <span class="text-white">|</span>
                    <a class="text-white pl-3" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-3" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-3" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-3" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-capitalize"><span class="text-primary">Optik</span>Merpati</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="d-inline-flex flex-column text-center pr-3 border-right">
                        <h6>Opening Hours</h6>
                        <p class="m-0">09.00 - 16.00</p>
                    </div>
                    <div class="d-inline-flex flex-column text-center pl-3">
                        <h6>Call Us</h6>
                        <p class="m-0">0899-8315-914</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <?php
if($_SESSION["cstatus"]=="Administrator"){	
      echo"
	  <a ";if($mnu=="home"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=home'>Home</a>
      <a ";if($mnu=="user"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=user'>User</a>
      <a ";if($mnu=="produk"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=produk'>Produk</a>
	  <a ";if($mnu=="supplier"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=supplier'>Supplier</a>
	  <a ";if($mnu=="pemasukan"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=pemasukan'>Pemasukan</a>
	  <a ";if($mnu=="pengeluaran"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=pengeluaran'>Pengeluaran</a>
      <a ";if($mnu=="laporan"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=laporan'>Laporan</a>";
}
else if($_SESSION["cstatus"]=="Owner"){	
      echo"
	  <a ";if($mnu=="home"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=home'>Home</a>
      <a ";if($mnu=="profil"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=profil'>Profil Owner</a>
      <a ";if($mnu=="_produk"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=_produk'>Produk</a>
	  <a ";if($mnu=="_supplier"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=_supplier'>Supplier</a>
	  <a ";if($mnu=="_pemasukan"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=_pemasukan'>Pemasukan</a>
	  <a ";if($mnu=="_pengeluaran"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=_pengeluaran'>Pengeluaran</a>
      <a ";if($mnu=="laporan"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=laporan'>Laporan</a>";
}
else {
	  echo"
	  <a ";if($mnu=="home"){echo"class='nav-item nav-link active'";} echo" class='nav-item nav-link' href='index.php?mnu=home'>Home</a>";
	}
      ?>
                </div>
				<?php
if(isset($_SESSION["cid"])){?>
                <a href="index.php?mnu=logout" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Logout</a>
<?php } else { ?>
    <a href="login.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Login</a>
    <?php } ?>
            </div>
        </nav>
    </div>