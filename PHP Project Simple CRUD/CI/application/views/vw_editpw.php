<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit Password</title>
    <link href="<?= base_url('assets/'); ?>style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body class="home">
    <form action="<?= base_url(); ?>index.php/editpw/updatePassword" method="post" class="form2">
        <label>current password</label><br>
        <input type="password" name="current" required><br>
        <label>new password</label><br>
        <input type="password" name="new" required><br>
        <p></p>
        <button type="submit" name="submit" value="submit" class="editBtn">save</button>
        <a href="<?= base_url(); ?>index.php/editprofile" class="btntwo">cancel</a>
    </form>
    <div class="error">
        <?php
        if ($this->session->flashdata('error_editPw') != '') {
            echo $this->session->flashdata('error_editPw');
            $this->session->set_flashdata('error_editPw', null);
        }
        ?>
    </div>
</body>

</html>