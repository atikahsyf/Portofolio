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
        <ul class="hometxt" active><a href="#main">home</a></ul>
        <ul class="more"><a href="#more">our profile</a></ul>
        <ul class="dropdown">
            <p class="user"><?php echo $this->session->userdata('username'); ?></p>
            <i class="fas fa-caret-down"></i>
            <div class="dropdown-content">
                <a href="<?= base_url(); ?>index.php/profile">profile <i class="fas fa-user"></i></a>
                <a href="<?= base_url(); ?>index.php/login/logout">logout <i class="fas fa-sign-out-alt"></i></a>
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
            <img src="<?= base_url('assets/'); ?>Group.png" width="240">
        </div>
        <a class="moreBtn" href="#more">More info</a>
    </section>
    <section id="more">
        <div class="at">
            <img src="<?= base_url('assets/'); ?>25.png">
            <div class="teks">
                <p class="nama">Atikah Syifa</p>
                <p class="nim">NIM. 09021182025027</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>
        <div class="au">
            <img src="<?= base_url('assets/'); ?>25.png">
            <div class="teks">
                <p class="nama">Aura Rabbani</p>
                <p class="nim">NIM.  09021282025110</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>
        <div class="mu">
            <img src="<?= base_url('assets/'); ?>25.png">
            <div class="teks">
                <p class="nama">Munawaroh Syahfitri</p>
                <p class="nim">NIM.  09021282025107</p>
                <p class="kelas">3 REG A</p>
            </div>
        </div>

    </section>
</body>

</html>