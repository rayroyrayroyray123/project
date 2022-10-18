<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>social/add_friends"><i class="material-icons" id="enter-icon" style="font-size: 90px !important;">group_add</i></a>
    </div>
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
<div class="contents" style="padding-top:0;">
    <div class="radio-group gender-option" style="padding-top:0;margin-top:0;position:fixed">
        <input type="radio" id="type-one" name="gender-option" class='radio-input type-option' value="freinds" checked>
        <label class='radio-label begin' for="type-one" id="friends" onclick="switch_mode_to(this.id)" 
            style="width:50.5vw;border-radius:0;font-size:3rem;height:5vh;">Freinds</label>
        <input type="radio" id="type-three" name="gender-option" class='radio-input type-option' value="chats">
        <label class='radio-label final' for="type-three" id="chats" onclick="switch_mode_to(this.id)" 
            style="width:50.5vw;;border-radius:0;font-size:3rem;height:5vh;">Chats</label>
    </div>
    <div id="friends_area">
        <div class="social-info" id="load-social-data"></div>
        <div class="social-subbox" id="friends_div">
            <div id="requests_list_box">
                <div class="box-title"><h1>New Requests</h1></div><hr>   
                <div id="requests_list"></div>
            </div>
            <div id="friends_list_box">
                <div class="box-title"><h1>My Friends</h1></div><hr>  
                <div id="friends_list"></div>
            </div>
        </div>
        <div class="social-subbox" id="chats_list_box">
            <!-- <div class="box-title"><h1></h1></div><hr> -->
            <div id="chats_list"></div>
        </div>
    </div>
</div>

<style>
.friends{
    font-size: 30px;
    width: 50%;
    height: 5%;
    margin-top: 5%;
    float: left;
    background-color: #F37022;
    border:none;
}

.friends-info{
    height: 65vh
}

.chats{
    font-size: 30px;
    width: 50%;
    height: 5%;
    margin-top: 5%;
    float: right;
    background-color: #F37022;
    border:none
}
	/* addFriends */

.search {
    height: 50px;
    background: rgb(180, 90, 90);
    position: relative;
}

.add-friends{
    position:relative;
    font-size: 30px;
    width: 100%;
    height: 7%;
    margin-top: 5%;
    text-align:center;
    background-color: #ebdfdf;
    border:none
}

.addfriends {
    background: #F37022;
    border:none;
    border-radius: 0.5ch;
}

/* put into css */
.person-head{
    width: 10rem;
    height: 10rem;
    border-radius: 50%;
    overflow: hidden;
    background-color: #495057;
    text-align: center;
    /* display: flex; */
    margin-right: 1.3rem;
    
}
.person-info{
    /* border-top: 1px solid #495057; */
    /* border-bottom: 1px solid #495057; */
    padding: 1vh;
    padding-top: 1.3vh;
    
}
.person-info div{
    align-items: center;
}
.person-info h3{
    font-size:2.5rem;
    padding-left:2vw;
}

.two-btns>div{
    padding-right:1rem;
}

.box-title{
    padding:2rem 1rem .5rem 1rem;
}

a, a:hover, a:active, a:visited, a:focus {
    text-decoration:none;
}
#friends_area{
    padding-top:5vh;
}
.mess_alert{
    width:4vh;
    height:4vh;
    border: 1px solid #dc3545;
    border-radius:50%;
    background-color:#dc3545;
    color:#fff;
    justify-content: center;
    margin-right:1vw
}
.mess_alert>h3{
    position:relative;
    top:50%;
    left:50%;
    transform: translate(-50%, -50%);
    font-size:3rem;
    padding-left: 2.5vw;
}
</style>
<script>
    var mode = 'friends';
    var action = 'inactive';
    var url = '<?=base_url();?>social/get_lists/<?php echo $this->session->userdata('user_id');?>';

    if(action == 'inactive'){
        action = 'active';
        load_social_data(mode);
    }

    function switch_mode_to(choice){
        $("#requests_list").html('');
        $("#friends_list").html('');
        $("#chats_list").html('');
        mode = choice;
        action = 'active';
        load_social_data(mode);
    }

    function load_social_data(mode){
        if(mode=='friends'){
            $('#chats_list_box').hide();
            $('#friends_div').show();
            load_data('requests_list');
            load_data('friends_list');
        }else{
            $('#friends_div').hide();
            $('#chats_list_box').show();
            load_data('chats_list');
        }
    }

    function load_data(act){
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'action': act},
                cache: false,
                success:function(data){
                    // alert(data);
                    if(data == ""){
                        $("#"+act+"_box").hide();
                        action = 'active';
                    }else{
                        $("#"+act).append(data);
                        action = 'inactive';
                    }
                }
            });
        }
    }
</script>