<?php
require('koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
    echo 'You have to Sign In first';
    header('Location: index.php');
}
if($stmt = $con->prepare("SELECT * FROM accounts WHERE username = ?") or die("Gagal mengecek user di database")){
    $stmt->bind_param('s', $_SESSION['username']);
    $res = $stmt->execute();

    if ($res) {
        $stmt->bind_result($id, $name, $username, $password, $email, $profpic);
        $stmt->fetch();
        $stmt->close();

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
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
        <title>Edit Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    </head>
    <body class="home">
        <br><br>
        <div class="contt">
            <div class="garis">
                <div class="photo">
                    <img src="<?php echo $_SESSION['profpic'] . ".png"; ?>">
                </div>
                <button type="button" class="btn btn-secondary position-absolute" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="far fa-edit"></i>
                </button>
            </div>
        </div>
        <form action="profile.php" method="post" class="form">
            <div class="wrapin">
                <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" required>
            </div>
            <table class="identity">
                <tr>
                    <th>name</th>
                    <td><input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" required></td>
                </tr>
                <tr>
                    <th>email</th>
                    <td><input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" required></td>
                </tr>
            </table>
        
            <br>
            <div class="editpw"><a href="editpw.php" class="epBtn">edit password <i class="fas fa-external-link-alt"></i></a></div>
            <div class="tks">
                <button type="submit" name="submit" value="submit" class="editBtn">save</button>
                <a href="profile.php" class="Btn2">cancel</a>
            </div>
        </form>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">edit profile photo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            choose file
                            <input type="file" class="form-control form-control-sm mb-3" name="fileToUpload" id="fileToUpload" accept="image/png"><br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="sub" value="Upload Image" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>