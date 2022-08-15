<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="<?= base_url('assets/'); ?>style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body class="home">
    <nav class="navtop">
        <ul class="hometxt" active><a href="<?= base_url(); ?>index.php/home">home</a></ul>
        <ul class="more"><a href="<?= base_url(); ?>index.php/home">our profile</a></ul>
        <ul class="dropdown">
            <p class="user"><?php echo $this->session->userdata('username'); ?></p>
            <i class="fas fa-caret-down"></i>
            <div class="dropdown-content">
                <a href="<?= base_url(); ?>index.php/profile">profile <i class="fas fa-user"></i></a>
                <a href="<?= base_url(); ?>index.php/login/logout">logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </ul>
    </nav>
    <br><br><br><br><br>
    <div class="contt">
        <div class="garis">
            <div class="photo">
                <img src="<?php echo base_url('assets/uploads/') . $this->session->userdata('profpic'); ?>.png">
            </div>
        </div>
    </div>
    <div class="con">
        <p class="uname"><?php echo $this->session->userdata('username'); ?></p>
        <table class="identity">
            <tr>
                <th>name</th>
                <td><?php echo $this->session->userdata('name'); ?></td>
            </tr>
            <tr>
                <th>email</th>
                <td><?php echo $this->session->userdata('email'); ?></td>
            </tr>
        </table>
        <br>
        <p></p>
        <div class="tks">
            <a href="<?= base_url(); ?>index.php/editprofile" class="editBtn">edit profile</a>
        </div>
    </div>
</body>

</html>