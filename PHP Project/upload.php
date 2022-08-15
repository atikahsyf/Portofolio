<?php
require('koneksi.php');
session_start();

$stmt = $con->prepare('SELECT profpic FROM accounts WHERE username = ?');

$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($profpic);
$stmt->fetch();
$stmt->close();

$target_dir = "uploads/";
$temp = explode(".", $_FILES["fileToUpload"]["name"]); //memisahkan nama file yang di-upload dengan ekstensinya dan ditampung pada variabel
$newfilename = $_SESSION['username'] . "." . end($temp); //membuat judul "profile_pic" dengan ekstensi file yang di-upload
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $newfilename; //menggabungkan variabel target_dir dan newfilename menjadi alamat penyimpanan file yang di-upload
$uploadOk = 1; //menginisialisasi variabel yang nantinya menjadi variabel indikator keberhasilan upload
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //menampung ekstensi variabel target_file dalam lowercase

// Check if image file is a actual image or fake image

 //menjalankan perkondisian ketika user mengklik tombol submit
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); 
  //mengambil ukuran dan dimensi file temporary yang menampung foto yang di-upload. jika file bukan file image, maka return false
  if ($check !== false) { //mengecek validitas file yang di-upload
    $uploadOk = 1; //mengubah nilai variabel keberhasilan menjadi 1
  } else {
    echo "File is not an image.";
    $uploadOk = 0; //mengubah nilai variabel indikator keberhasilan menjadi 0
  }



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) { //menjalankan perkondisian untuk mengecek variabel indikator keberhasilan. file tidak akan di-upload jika variabel = 0
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else { 
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { 
    //menjalankan perkondisian untuk mengetahui keberhasilan pemindahan file yang di-upload ke uploads/profile_pic
    if($query = $con->prepare('UPDATE accounts SET profpic = ? WHERE username = ?')){
      $query->bind_param('ss', $_SESSION['username'], $_SESSION['username']);
      $result = $query->execute();
      
      //jika insert data berhasil maka akan diredirect ke halaman index.php serta menyimpan data username ke session
      if ($result) {
        $_SESSION['profpic'] = "uploads/" . $_SESSION['username'];
        header('Location: profile.php');
          
      //jika gagal maka akan menampilkan pesan error
      } else {
          $error =  'Unable to change password';
      }
    }

    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
