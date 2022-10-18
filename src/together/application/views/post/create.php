<div id="header">
    <h1 class="title"><?= $title ?></h1>
    <a href="<?php echo base_url();?>user/profile/<?= $title ?>">
        <div class="user-img-header" id="user-img">
            <?php if($this->session->userdata('image')):?>
                <img src="<?php echo base_url().'assets/img/users/'.$this->session->userdata('image');?>" id="uploaded_image" class="img-responsive img-circle" />
            <?php else:?>
                <p id="user_ini"><?php echo $this->session->userdata('username')[0];?></p>
            <?php endif;?>
        </div>
    </a>
</div>
<div class="contents">
    <br><br><br>
    <div class="slogan">
        <img src="<?php echo base_url()?>assets/img/logos/logo_org.png" id="entry-logo">
        <div class="project-title">
            <h1>TOGETHER</h1>
            <p>Life is not about age but energy</p>
        </div>
    </div>
    <br><br><br><br><br>
    <div class="instruction">
        <p>Choose the Event Mode</p>
    </div>
    <br>
    <div class="container project-title">
        <a href="<?php echo base_url(); ?>post/create_form/online" class="btn btn-warning btn-lg col-12 full-btn"><div style="color:#fff;">Online Event</div></a><br>
        <div><a href="<?php echo base_url(); ?>post/create_form/offline" class="btn btn-dark btn-lg col-12 full-btn"><div style="color:#fff;">Offline Event</div></a></div>
    </div>
</div>