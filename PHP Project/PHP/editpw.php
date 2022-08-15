<?php
require('koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
    $_SESSION['msg'] = 'You have to Sign In first';
    exit;
}

$error = '';
if(isset($_POST['submit'])){
            
    $pass = $_POST['current'];
    if(password_verify($pass, $_SESSION['password'])){
        $password = stripslashes($_POST['new']);
        $password = mysqli_real_escape_string($con, $password);
        $newpass = password_hash($password, PASSWORD_DEFAULT);
        //insert data ke database
        if($stmt = $con->prepare("UPDATE accounts SET password = ? WHERE username = ?") or die("Gagal memperbarui")){
            $stmt->bind_param('ss', $newpass, $_SESSION['username']);
            $result   = $stmt->execute();
            //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
            if ($result) {
                $stmt->close();
                header('Location: edit.php');
                
            //jika gagal maka akan menampilkan pesan error
            } 
            else {
                $error =  'Unable to change password';
            }
        }
        
    }
    else{
        $error = 'Current password is wrong';
    }
}

    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit Password</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    </head>
    <body class="home">
        <form action="editpw.php" method="post" class="form2">
            <label>current password</label><br>
            <input type="password" name="current" required><br>
            <label>new password</label><br>
            <input type="password" name="new" required><br>
            <p><?php echo $error ?></p>
            <button type="submit" name="submit" value="submit" class="editBtn">save</button>
            <a href="edit.php" class="btntwo">cancel</a>
        </form>
        
    </body>
</html>