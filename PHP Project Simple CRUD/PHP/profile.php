<?php
require('koneksi.php');
session_start();
$error = '';
if( !isset($_SESSION['username']) ){
    $_SESSION['msg'] = 'You have to Sign In first';
    header('Location: index.php');
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    if(cek_nama($_POST['username'], $con) == 0){
        $username = $_POST['username'];
    }
    else{
        $username = $_SESSION['username'];
    }
    $email = $_POST['email'];

    if($query = $con->prepare("UPDATE accounts SET name = ?, username = ?, email = ? WHERE username = ?") or die("Gagal")){
        $query->bind_param('ssss', $name, $username, $email, $_SESSION['username']);
        $result = $query->execute();
        if($result){
            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $query->close();
        }
    }
    
}
function cek_nama($username,$con){
    $nama = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM accounts WHERE username = '$nama'";
    if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
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
            <ul class="hometxt" active><a href="home.php">home</a></ul>
            <ul class="more"><a href="home.php">our profile</a></ul>
            <ul class="dropdown">
                <p class="user"><?php echo $_SESSION['username'] ?></p> 
                <i class="fas fa-caret-down"></i>
                <div class="dropdown-content">
                    <a href="profile.php">profile <i class="fas fa-user"></i></a>
                    <a href="logout.php">logout <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </ul>
        </nav>
        <br><br><br><br><br>
            <div class="contt">
                <div class="garis">
                    <div class="photo">
                        <img src="<?php echo $_SESSION['profpic'] . ".png"?>">
                    </div>
                </div>
            </div>
            <div class="con">
                <p class="uname"><?php echo $_SESSION['username'] ?></p>
                <table class="identity">
                    <tr>
                        <th>name</th>
                        <td><?php echo $_SESSION['name'] ?></td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><?php echo $_SESSION['email'] ?></td>
                    </tr>
                </table>
                <br>
                <p><?php echo $error ?></p>
                <div class="tks">
                    <a href="edit.php" class="editBtn">edit profile</a>
                </div>
            </div>
    </body>
</html>