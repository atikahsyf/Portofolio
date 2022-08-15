<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign In | Welcome Back</title>
    <link rel=stylesheet href="<?= base_url('assets/'); ?>style.css" type="text/css">
</head>

<body class="loggedin">
    <section class="cont" id="cont">
        <nav class="cont1">
            <h1 class="decor">welcome <br>back</h1>
            <br><br><br>
            <img src="<?= base_url('assets/'); ?>Frame.png" width="250">
        </nav>
        <article class="cont2">
            <div class="wrap">
                <div class="mrg"></div>
                <p class="text">Sign In</p>
                <div class="line"></div>
                <form action="<?= base_url(); ?>index.php/login/proses" method="post">
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
                    <div class="error">
                        <?php
                        if ($this->session->flashdata('failed_login') != '') {
                            echo $this->session->flashdata('failed_login');
                            $this->session->set_flashdata('failed_login', null);
                        }
                        ?>
                    </div>
                    <br>
                    <div class="button"><button type="submit" class="btn btn-dark" name="submit" value="edit" style="border-radius: 10px">Sign In</button></div>
                    <br><br>
                    <div class="trans">Don't have an account? <a href="<?= base_url(); ?>index.php/register">Sign Up</a></div>
                </form>
        </article>
    </section>
</body>

</html>