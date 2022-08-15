<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();
 
$error = '';
//mengecek apakah form registrasi di submit atau tidak
if( isset($_POST['submit']) ){
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($con, $username);
        $name     = stripslashes($_POST['name']);
        $name     = mysqli_real_escape_string($con, $name);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($con, $password);
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password))){
            //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
            $res = $con->prepare("SELECT username FROM accounts WHERE username = ?");
            $res->bind_param('s', $username);
            $res->execute();
            $res->bind_result($uname);
            $res->fetch();
            //hashing password sebelum disimpan didatabase
            if(!empty($uname)){
                $res->close();
                $error =  'Username has been registered. Please Sign In instead.';
            }
            else{
                $res->close();
                $pass  = password_hash($password, PASSWORD_DEFAULT);
                //insert data ke database
                $query = "INSERT INTO accounts (name,username,password,email) VALUES ('$name','$username','$pass','$email')";
                $result   = mysqli_query($con, $query);
                //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
                if ($result) {
                    $_SESSION['username'] = $username;
                    mysqli_close($con);
                    header('Location: home.php');
                    
                //jika gagal maka akan menampilkan pesan error
                } 
                else {
                    $error =  'Can not be done.';
                }
            }
            
            
        }else {
            $error =  'Data can not be blank';
        }
} 
    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function checking($username, $email, $con){
        $username = mysqli_real_escape_string($con, $username);
        $email = mysqli_real_escape_string($con, $email);
        $stmt = $con->prepare('SELECT username, email FROM accounts WHERE username = ? OR email = ? LIMIT 1');

        $stmt->bind_param('ss', $username, $email);
        $res = $stmt->execute();
        if($res){
            return $stmt->num_rows();
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sign Up  |  New Member?</title>
        <link rel=stylesheet href="style.css" type="text/css">
    </head>
    <body class="loggedin">
        <section class="cont" id="cont">
            <nav class="cont1">
                <h1 class="decor">get ready <br>to explore</h1>
                <br><br><br>
                <img src="Vectary.png" width="200" class="setimage">
            </nav>
            <article class="cont2">
                <div class="wrap">
                    <p class="text">Sign Up</p>
                    <div class="line"></div>
                        <form action="register.php" method="post">
                            <div class="mb-3">
                                <label>name</label><br>
                                <input type="text" name="name" placeholder="" id="name" required>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label>username</label><br>
                                <input type="text" name="username" placeholder="" id="username" required>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label>email</label><br>
                                <input type="email" name="email" placeholder="" id="email" required>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label>password</label>
                                <br>
                                <input type="password" name="password" placeholder="" id="password" required>
                            </div>
                            <br>
                            <div class="error"><?php echo $error ?></div>
                            <br>
                            <div class="button"><button type="submit" class="btn btn-dark" name="submit" value="edit" style="border-radius: 10px">Sign Up</button></div>
                            <br>
                            <div class="trans">Already a member? <a href="index.php">Sign In</a></div>
                        </form>
                    </div>
                </div>
            </article>
        </section>
    </body>
</html>
