
<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
    error_reporting(E_ALL & ~E_NOTICE);
?>
<?php
session_start();
error_reporting(0);
require_once "konmysqli.php";

$mnu = "";
if (isset($_GET["mnu"])) {
    $mnu = $_GET["mnu"];
}

if (!isset($_SESSION["cid"])) {
    die("<script>location.href='login.php';</script>");
}
?>

<body>
<?php require_once "layouts/head.php"; ?>
<?php require_once "layouts/header.php"; ?>
<?php if($mnu=="home" || $mnu==""){?>
<?php require_once "layouts/carousel.php"; ?>
<?php } ?>
    <div class="container py-5">
       
            <?php
    if ($mnu == "user") {
        require_once "user/user.php";
    }
	else if ($mnu == "profil") {
        require_once "user/profil.php";
    }
    else if ($mnu == "produk") {
        require_once "produk/produk.php";
    } 
    else if ($mnu == "_produk") {
        require_once "produk/_produk.php";
    } 
    else if ($mnu == "supplier") {
        require_once "supplier/supplier.php";
    } 
    else if ($mnu == "_supplier") {
        require_once "supplier/_supplier.php";
    } 
    else if ($mnu == "pemasukandetail") {
        require_once "pemasukandetail/pemasukandetail.php";
    } 
    else if ($mnu == "_pemasukandetail") {
        require_once "pemasukandetail/_pemasukandetail.php";
    }
	else if ($mnu == "pemasukan") {
        require_once "pemasukan/pemasukan.php";
    } 
	else if ($mnu == "_pemasukan") {
        require_once "pemasukan/_pemasukan.php";
    }
	else if ($mnu == "pembayaran") {
        require_once "pembayaran/pembayaran.php";
    } 
	else if ($mnu == "_pembayaran") {
        require_once "pembayaran/_pembayaran.php";
    }
    else if ($mnu == "pengeluaran") {
        require_once "pengeluaran/pengeluaran.php";
    } 
    else if ($mnu == "_pengeluaran") {
        require_once "pengeluaran/_pengeluaran.php";
    } 
    else if ($mnu == "list_pengeluaran") {
        require_once "pengeluaran/list_pengeluaran.php";
    } 
    else if ($mnu == "pengeluarandetail") {
        require_once "pengeluarandetail/pengeluarandetail.php";
    }
    else if ($mnu == "_pengeluarandetail") {
        require_once "pengeluarandetail/_pengeluarandetail.php";
    }  
    
    else if ($mnu == "pengeluarandetail_") {
        require_once "pengeluarandetail/pengeluarandetail_.php";
    }
    else if ($mnu == "laporan") {
        require_once "laporan.php";
    } 
    else if ($mnu == "laporan2") {
        require_once "laporan2.php";
    }   
	else if ($mnu == "login") {
        require_once "login.php";
    } 
	
	else if ($mnu == "logout") {
        require_once "logout.php";
    }   	
	else {
        require_once "home.php";
    }
    ?>
        
    </div>

  
   <?php require_once "layouts/footer.php"; ?>