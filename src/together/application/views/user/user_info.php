<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>social"><i class="material-icons" id="enter-icon">chevron_left</i></a>
    </div>
</div>
<div class="contents">
    <div class="user-info container">
        <div class="user-img" id="user-img">
            <?php if($user['img']):?>
                <img src="<?php echo base_url().'assets/img/users/'.$user['img'];?>" id="uploaded_image" class="img-responsive img-circle" />
            <?php else:?>
                <p id="user_ini"><?=$user['username'][0]?></p>
            <?php endif;?>
        </div>
        <label class="username-label"><?=$user['username']?></label>
    </div>

    <div class="location"><?=$user['location']?></div>
    <div class="container">
        <div class="relation_container">
            <button class="btn btn-warning btn-lg col-12" onclick="change_relationship('add')" id="add_friend">ADD FRIEND</button>
            <button class="btn btn-warning btn-lg col-12" onclick="change_relationship('accept')" id="accept-request">ACCEPT REQEST</button>
            <button class="btn btn-danger btn-lg col-12" onclick="change_relationship('unfriend')" id="cancel-request">CANCEL REQUEST</button>
            <button class="btn btn-danger btn-lg col-12" onclick="change_relationship('unfriend')" id="unfriend">UNFRIEND</button>
        </div>
        <div class="massage_container">
            <a class="btn btn-light btn-lg col-12" 
                href="<?=base_url()?>social/message_board/<?=$this->session->userdata('user_id')?>/<?=$user['id']?>" id='send_mess'>MASSAGE</a>
        </div>
    </div>
</div>
<style>
.massage_container{
    padding-top:1.5%;
    margin-top:2vh
}
.location {
    text-align: center;
    font-size:4rem;
    color: #000;
    font-weight: bold;
}
.relation_container{
    padding-top:1.5%;
    margin-top:2vh
}
.btn-light{
    border: 1px solid #444;
}

.username-label{
    color:#444;
    font-size:4rem;
    position:relative;
    left:50%;
    transform: translateX(-50%);
 }
</style>
<script>
    var user_id = <?=$this->session->userdata('user_id')?>;
    var friend_id = <?=$user['id']?>;
    check_relationship();
    function check_relationship(){
        var url = '<?=base_url();?>social/check_relationship';
        var data = { 'user_id': user_id , 'friend_id':friend_id};
        {
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data){
                    $('#add_friend').hide();$('#unfriend').hide();$('#send_mess').hide();
                    $('#cancel-request').hide();$('#accept-request').hide();
                    
                    if(data !== ''){
                        var sender_id = data.split(',')[0];
                        var status = data.split(',')[1];
                        if(user_id == sender_id && status == 'pending'){
                            $('#cancel-request').show();
                        }else if(friend_id == sender_id && status == 'pending'){
                            $('#accept-request').show();
                        }else if(status == 'accept'){
                            $('#unfriend').show();
                            $('#send_mess').show();
                        }
                    }else{
                        $('#add_friend').show();
                    }
                }
            });
        }
    }
    function change_relationship(mode){
        var url = '<?=base_url();?>social/change_relationship';
        var data = { 'user_id': user_id , 'friend_id':friend_id, 'mode': mode};
        {
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(data){
                    check_relationship();
                }
            });
        }
    }
</script>

