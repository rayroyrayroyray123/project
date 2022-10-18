<form class="container login-form" action="<?php echo base_url().'user/login'?>" method="post">
    <img src="<?php echo base_url()?>assets/img/logos/logo_org.png" id="entry-logo"><br>
    <div id="header2">
        <h1 class="title login-title"><?= $title ?></h1>
    </div>
    <br><br>
    <?php if($this->session->flashdata('login_failed')){?>
      <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>';?>
    <?php }; ?>
    <br>
    <div class="input-area">
        <div class="form-group">
            <div class="input-label">USERNAME</div>
            <input type="text" name="username" id="username" class="form-cols" placeholder="type in username"
                value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}?>"/>
        </div>
        
        <div class="form-group">
            <div class="input-label">PASSWORD</div>
            <input type="password" name="password" id="password" class="form-cols" placeholder="type in password"
            value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"/>
        </div>
    </div>
    <br>
    <div class="form-group">
        <input type="checkbox" name="remember" id="remember" value="1" class='checkbox-rem' <?php if(isset($_COOKIE['username'])){ echo "checked='checked'";};?>>
        <label class="form-check-label" for="remember"> Remember me</label>
    </div>
    <br>
    <div class="login-btns" style="text-align:center;">
        <div class="form-group login-btn">
            <?php echo $this->session->flashdata('error');?>
            <input type="submit" name="insert" value="Sign In" class="btn btn-warning btn-lg col-12"/>
        </div>
        <div class="form-group login-btn">
            <a href="<?php echo base_url(); ?>user/register" class="btn btn-dark btn-lg col-12"><div style="color:#fff;">Register</div></a>
        </div>
        <a href="<?=base_url('users/forgetPassword')?>" style="font-size:2rem;">Forget Password?</a>
    </div>
    <br><br>
</form>
<div id="login-bg">
    <div class="cover-logo">
        <img src="<?php echo base_url()?>assets/img/logos/logo_org.png" style="width:300px;"><br>
        <h1 class="login-title" style="font-size:5rem;color:#F37022;">TOGETHER</h1>
    </div>
    <div class="cover-slogan">
        <h1>Life is not about age but energy</h1>
    </div>
</div>
<style>
    .form-check-label, #remember{
        font-size: 2rem;
    }
    .login-btns{
        padding-top: 150px
    }
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        transform: scale(2);
        padding: 10px;
    }
    .form-check-label{
        padding: 10px;
        font-size: 2rem;
        display: inline-block;
        background: rgb(221, 220, 220);
        transition: 0.1s;
    }

    .checkbox-rem:checked + .form-check-label{
        background:#F37022;
        color: #fff;
    }
    .login-btn{
        padding-top: 1rem
    }
</style>
<script>
    $(document).ready(function(){
        setTimeout(() => {
            $("#login-bg").css("display","none");
        }, 2000);
    });
</script>
