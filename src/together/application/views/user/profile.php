<div id="header">
    <div class="back-btn">
        <?php 
            if ($from == "Create") {
                $way_back = base_url("post/create");
            }elseif ($from == "Social") {
                $way_back = base_url("social");
            }else{
                $way_back = base_url("post");
            }
            
        ?>
        <a href="<?= $way_back?>"><i class="material-icons" id="back-icon">chevron_left</i></a>
    </div>
    <h1 class="title"><?= $title ?></h1>
    <div class="notify-btn">
        <div><i class="material-icons" id="nofity-icon">notifications</i></div>
    </div>
</div>
<div class="contents">
    <div class="user-info container">
        <div class="user-img" id="user-img">
            <?php if($user['img']):?>
                <img src="<?php echo base_url().'assets/img/users/'.$user['img'];?>" id="uploaded_image" class="img-responsive img-circle" />
            <?php else:?>
                <p id="user_ini"><?php echo $this->session->userdata('username')[0];?></p>
            <?php endif;?>
        </div>
        <label class="username-label"><?php echo $this->session->userdata('username')?></label>
    </div>
    <br>
    <div class="set-menu">
        
        <div class="p-2 menu-btn d-flex">
            <div>My Schedule</div>
            <a href="<?php echo base_url();?>user/schedule/<?php echo $this->session->userdata('user_id')?>" class="enter-btn"><i class="material-icons" id="enter-icon">chevron_right</i></a>
        </div>
        <div class="p-2 menu-btn d-flex">
            <div>My Events</div>
            <a href="<?php echo base_url();?>user/my_events/<?php echo $this->session->userdata('user_id')?>" class="enter-btn"><i class="material-icons" id="enter-icon">chevron_right</i></a>
        </div>
        <div class="p-2 menu-btn d-flex">
            <div>My Memory</div>
            <a href="<?php echo base_url();?>user/memories/<?php echo $this->session->userdata('user_id')?>" class="enter-btn"><i class="material-icons" id="enter-icon">chevron_right</i></a>
        </div>
        <div class="separate-line"></div>
        <div class="p-2 menu-btn d-flex">
            <div>Edit Profile</div>
            <a href="<?php echo base_url();?>user/edit_profile/<?php echo $this->session->userdata('user_id')?>" class="enter-btn"><i class="material-icons" id="enter-icon">chevron_right</i></a>
        </div>
        <div class="p-2 menu-btn d-flex">
            <div>Set Preference</div>
            <a href="<?php echo base_url();?>user/preference/<?php echo $this->session->userdata('user_id')?>" class="enter-btn"><i class="material-icons" id="enter-icon">chevron_right</i></a>
        </div> 
    </div>
    <br><br><br>
    <div class="container">
        <a href="<?php echo base_url(); ?>user/logout" class="btn btn-dark btn-lg col-12 full-btn">Sign Out</a>
    </div>
    <div id="notification-panel">
        <div id="cancel-btn" style="text-align:end;"><i class="material-icons" style="font-size:6rem !important;">cancel</i></div>
        <h1 style="font-size:5rem;">Notifications</h1>
        <br><br><br><br>
        <div id="notify_box"></div>
    </div>
</div>

<style>
 .username-label{
    color:#444;
    font-size:4rem;
    position:relative;
    left:50%;
    transform: translateX(-50%);
 }
 .notify_box{
     margin-top:3rem;
 }
 #notification-panel{
    width: 100%;
    height: 100%;
    padding: 50px;
    display: none;
    transition: .1s;
    position: absolute;
    top:0;
    background: #fff;
    text-align: center;
}
</style>