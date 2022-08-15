<?php
require('koneksi.php');
//inisialisasi session
session_start();
 
//mengecek username pada session
if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'You have to Sign In first';
  header('Location: index.php');
}
 
if($stmt = $con->prepare("SELECT * FROM accounts WHERE username = ?") or die("Gagal mengecek user di database")){
    $stmt->bind_param('s', $_SESSION['username']);
    $res = $stmt->execute();

    if ($res) {
        $stmt->bind_result($id, $name, $username, $password, $email, $profpic);
        $stmt->fetch();

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['profpic'] = "uploads/" . $profpic;
    }
    else{
        echo 'error';
    }
}
?>
 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body class="home">
    <nav class="navtop">
        <ul class="hometxt" active><a href="#main">home</a></ul>
        <ul class="more"><a href="#more">our profile</a></ul>
        <ul class="dropdown">
            <p class="user"><?php echo $_SESSION['username'] ?></p> 
            <i class="fas fa-caret-down"></i>
            <div class="dropdown-content">
                <a href="profile.php">profile <i class="fas fa-user"></i></a>
                <a href="logout.php">logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </ul>
    </nav>
    <section id="main">
        <div class="wrtext">
            <p class="textone">Proyek UTS <br>Pemrograman Web 2</p>
            <div class="inl">
                <p class="texttwo">Made by</p>
                <p class="textthree">Kelompok 20</p>
            </div>
        </div>
        <div class="imge">
            <img src="Group.png" width="240">
        </div>
        <a class="moreBtn" href="#more">More info</a>
    </section>
    <section id="more">
        <div class="at">
            <img src="25.png">
            <div class="teks">
                <p class="nama">Atikah Syifa</p>
                <p class="nim">NIM. 09021182025027</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>
        <div class="au">
            <img src="25.png">
            <div class="teks">
                <p class="nama">Aura Rabbani</p>
                <p class="nim">NIM.  09021282025110</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>
        <div class="mu">
            <img src="25.png">
            <div class="teks">
                <p class="nama">Munawaroh Syahfitri</p>
                <p class="nim">NIM.  09021282025107</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>
        
    </section>
</body>

</html>