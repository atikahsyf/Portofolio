<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | New Member?</title>
    <link rel=stylesheet href="<?= base_url('assets/'); ?>style.css" type="text/css">
</head>

<body class="loggedin">
    <section class="cont" id="cont">
        <nav class="cont1">
            <h1 class="decor">get ready <br>to explore</h1>
            <br><br><br>
            <img src="<?= base_url('assets/'); ?>Vectary.png" width="200" class="setimage">
        </nav>
        <article class="cont2">
            <div class="wrap">
                <p class="text">Sign Up</p>
                <div class="line"></div>
                <form action="<?php echo base_url(); ?>index.php/register/proses" method="post" enctype="multipart/form-data">
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
                    <div class="error">
                        <?php
                        if ($this->session->flashdata('failed_register') != '') {
                            echo $this->session->flashdata('failed_register');
                            $this->session->set_flashdata('failed_register', null);
                        }
                        ?>
                    </div>
                    <br>
                    <div class="button"><button type="submit" class="btn btn-dark" name="submit" value="edit" style="border-radius: 10px">Sign Up</button></div>
                    <br>
                    <div class="trans">Already a member? <a href="<?= base_url(); ?>index.php/login">Sign In</a></div>
                </form>
            </div>
            </div>
        </article>
    </section>
</body>

</html>