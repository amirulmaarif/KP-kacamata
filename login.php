<?php
session_start();
require_once "konmysqli.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Design by foolishdeveloper.com -->
  <title><?php echo $tittle ?></title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  
  <!--Stylesheet-->
  <style media="screen">
    *,
    *:before,
    *:after {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background-image: url(img/yt.jpg);
    }

    .background {
      width: 430px;
      height: 520px;
      position: absolute;
      transform: translate(-50%, -50%);
      left: 50%;
      top: 50%;
    }

    .background .shape {
      height: 200px;
      width: 200px;
      position: absolute;
      border-radius: 50%;
    }

    .shape:first-child {
      background: linear-gradient(#1845ad,
          #23a2f6);
      left: -80px;
      top: -80px;
    }

    .shape:last-child {
      background: linear-gradient(to right,
          #ff512f,
          #f09819);
      right: -30px;
      bottom: -80px;
    }

    form {
      height: 520px;
      width: 400px;
      background-color: black;
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
      padding: 50px 35px;
    }

    form * {
      font-family: 'Poppins', sans-serif;
      color: #ffffff;
      letter-spacing: 0.5px;
      outline: none;
      border: none;
    }

    form h3 {
      font-size: 32px;
      font-weight: 500;
      line-height: 42px;
      text-align: center;
    }

    label {
      display: block;
      margin-top: 30px;
      font-size: 16px;
      font-weight: 500;
    }

    input {
      display: block;
      height: 50px;
      width: 100%;
      background-color: rgba(255, 255, 255, 0.07);
      border-radius: 3px;
      padding: 0 10px;
      margin-top: 8px;
      font-size: 14px;
      font-weight: 300;
    }

    ::placeholder {
      color: #e5e5e5;
    }

    button {
      margin-top: 50px;
      width: 100%;
      background-color: #ffffff;
      color: #080710;
      padding: 15px 0;
      font-size: 18px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
    }

    .social {
      margin-top: 30px;
      display: flex;
    }

    .social div {
      background: red;
      width: 150px;
      border-radius: 3px;
      padding: 5px 10px 10px 5px;
      background-color: rgba(255, 255, 255, 0.27);
      color: #eaf0fb;
      text-align: center;
    }

    .social div:hover {
      background-color: rgba(255, 255, 255, 0.47);
    }

    .social .fb {
      margin-left: 25px;
    }

    .social i {
      margin-right: 4px;
    }
  </style>
</head>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <form action="" method="post">
  <center><img src="img/logo.png" width="50%"></center>
    <h3>Login </h3>

    <label for="username">Username</label>
    <input type="text" placeholder="Username" name="user">

    <label for="password">Password</label>
    <input type="password"  id="myInput" placeholder="Password" name="pass">
	<input type="checkbox" style="width:15px;height:15px;" onclick="myFunction()"><font color="#fff" size="2">Show Password</font>
	
    <button type="submit" name="Login">Log In</button>
  </form>
</body>

</html>

<?php
if (isset($_POST["Login"])) {
  $usr = $_POST["user"];
  $pas = $_POST["pass"];

  $sql1 = "select * from `$tbuser` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";

  if (getJum($conn, $sql1) > 0) {
    $d = getField($conn, $sql1);
    $kode = $d["id_user"];
    $nama = $d["nama_user"];
	$level = $d["level"];
    $_SESSION["cid"] = $kode;
    $_SESSION["cnama"] = $nama;
    $_SESSION["cstatus"] = $level;
    echo "<script>alert('Otentikasi " . $_SESSION["cstatus"] . " an " . $_SESSION["cnama"] . " (" . $_SESSION["cid"] . ") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
  } else {
    session_destroy();
    echo "<script>alert('Otentikasi Login GAGAL !,Silakan cek data Anda kembali...');
			document.location.href='index.php?mnu=login';</script>";
  }
}


?>