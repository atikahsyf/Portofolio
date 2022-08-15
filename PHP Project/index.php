<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();
 
$error = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['username']) ) header('Location: home.php');
 
//mengecek apakah form disubmit atau tidak
if( isset($_POST['submit']) ){
         
  // menghilangkan backshlases
  $username = stripslashes($_POST['username']);
  //cara sederhana mengamankan dari sql injection
  $username = mysqli_real_escape_string($con, $username);
    // menghilangkan backshlases
  $password = stripslashes($_POST['password']);
    //cara sederhana mengamankan dari sql injection
  $password = mysqli_real_escape_string($con, $password);
  
  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
  if(!empty(trim($username)) && !empty(trim($password))){

    //select data berdasarkan username dari database
    $stmt = $con->prepare('SELECT password FROM accounts WHERE username = ?');

    $stmt->bind_param('s', $username);
    $res = $stmt->execute();
    
    

    if ($res) {
      $stmt->bind_result($hash);
      $stmt->fetch();
      $stmt->close();
      if(password_verify($password, $hash)){
          $_SESSION['username'] = $username;
      
          header('Location: home.php');
      }
      else{
        $error = 'Username and password are not match';
      }
                      
      //jika gagal maka akan menampilkan pesan error
    } else {
        $error = 'Unable to find data. Please Sign Up';
    }
          
    }else {
        $error = 'Data can not be blank';
  }
} 
?>


<!DOCTYPE html>
<html>

  <head>
      <meta charset="utf-8">
      <title>Sign In  |  Welcome Back</title>
      <link rel=stylesheet href="style.css" type="text/css">
  </head>

  <body class="loggedin">
    <section class="cont" id="cont">
      <nav class="cont1">
        <h1 class="decor">welcome <br>back</h1>
        <br><br><br>
        <img src="Frame.png" width="250">
      </nav>
      <article class="cont2">
        <div class="wrap">
          <div class="mrg"></div>
          <p class="text">Sign In</p>
          <div class="line"></div>
            <form action="index.php" method="post">
              <div class="mb-3">
                <div class="inp">
                  <label>username</label><br>
                  <input type="text" name="username" placeholder="" id="username" required>
                </div>
              </div>
              <br>
              <div class="mb-3">
                <div class="inp">
                <label>
                  password
                  <a href=# class="fp">forgot password?</a>
                </label><br>

                <input type="password" name="password" placeholder="" id="password" required>
              </div>
            </div>
            <br>
            <div class="error"><?php echo $error ?></div>
            <br>
            <div class="button"><button type="submit" class="btn btn-dark" name="submit" value="edit" style="border-radius: 10px">Sign In</button></div>
            <br><br>
            <div class="trans">Don't have an account? <a href="register.php">Sign Up</a></div>
          </form>
      </article>
    </section>
  </body>

</html>