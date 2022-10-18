<div id="header">
    <h1 class="title"><?= $event['title'] ?></h1>
    <a href="<?php echo base_url();?>user/profile">
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
    <div class="event_details">
        <div class="event_imgs">
            <?php if($event['event_img']){$event_img_arr=explode(",", $event['event_img']);}?>
            <img class="event-thumb" width='100%' src="<?php echo base_url().'assets/img/events/'.$event_img_arr[0];?>">
            
        </div>
        <div class="mode"><h1><?= $event['event_mode']?> activity</h1></div>
        <br>
        <div class="event_descript">
            <h1><?= $event['body']?></h1>
        </div>
        <br>
        <div class="detail_info">
            <div class="radio-group detail-switchs">
                <input type="radio" id="option-one" name="mode-selector" class='radio-input mode-option' value="details" checked>
                <label class='radio-label begin detail-switch' for="option-one" onclick="switch_mode_to(this.id)" id="details">Details</label>
                <input type="radio" id="option-two" name="mode-selector" class='radio-input mode-option' value="participants">
                <label class='radio-label detail-switch' for="option-two" onclick="switch_mode_to(this.id)" id="participants">Participants</label>
                <input type="radio" id="option-three" name="mode-selector" class='radio-input mode-option' value="Founder">
                <label class='radio-label final detail-switch' for="option-three" onclick="switch_mode_to(this.id)" id="founder">Founder</label>
            </div>
            <div class="info-box" id="details-div">
                <div class="d-flex">
                    <div class="cate col-5">
                        <?php $cate_name=""; $cate_icon="";?>
                        <?php foreach($categories as $category):?>
                            <?php if($category['id'] == $event['category']){$cate_name=$category['name'];$cate_icon=$category['icon'];};?>
                        <?php endforeach;?>
                        <label class='cate-label'><i class="material-icons cate-icon"><?=$cate_icon?></i><?= $cate_name?></label>
                    </div>
                    <div class="line"></div><br>
                    <div class="event_time col-7">
                        <div class="date"><h1><?= $event_date['date']?> <?= $event_date['month']?> <?= $event_date['year']?></h1></div>
                        <?php $event_time = explode(":", $event['event_time']);?>
                        <div class="time">
                            <h1><?= $event_time[0]?>:<?= $event_time[1]?></h1>
                        </div>
                    </div>
                </div>
                <div class="ver_line"></div>
                <div class="event_location">
                    <?php if(!$event['zoomlink']):?>
                        <div><h1><?= $event['event_location']?></h1></div>
                        <div class="map container" id="map"><?= $event['google_map']?></div>
                    <?php else:?>
                        <div><h1>Zoom Meeting ID</h1></div>
                        <div><h1 id="zoomId"><?= $event['zoomlink']?></h1></div>
                    <?php endif;?>
                    
                </div>
            </div>
            <div class="info-box" id="participants-div">
                <div class="d-flex">
                    <div class="part-count"><h1 class="count">Quota</h1><h1 id="total-count"><?= $event['event_people']?></h1></div>
                    <div class="line"></div>
                    <div class="part-count"><h1 class="count">Left</h1><h1 id="left-count"></h1></div>
                </div>
                <div class="ver_line"></div>
                <div id="part_friends">
                    <h1>Your friends are ready to go</h1>
                    <div id="friend_list" class="d-flex justify-content-start"></div>
                </div>
            </div>
            <div class="info-box" id="founder-div">
                <div class="user-info container">
                    <div class="user-img" id="user-img">
                        <?php if($event['img']):?>
                            <img src="<?php echo base_url().'assets/img/users/'.$event['img'];?>" id="uploaded_image" class="img-responsive img-circle" />
                        <?php else:?>
                            <p id="user_ini"><?= $event['username'][0];?></p>
                        <?php endif;?>
                    </div>
                    <label class="username-label"><?= $event['username'];?></label>
                </div>
                <div class="container">
                    <div class="relation_container">
                        <button class="btn btn-warning btn-lg col-12" onclick="change_relationship('add')" id="add_friend">ADD FRIEND</button>
                        <button class="btn btn-warning btn-lg col-12" onclick="change_relationship('accept')" id="accept-request">ACCEPT REQEST</button>
                        <button class="btn btn-danger btn-lg col-12" onclick="change_relationship('unfriend')" id="cancel-request">CANCEL REQUEST</button>
                        <button class="btn btn-danger btn-lg col-12" onclick="change_relationship('unfriend')" id="unfriend">UNFRIEND</button>
                        <br>
                    </div>
                    <br>
                    <div class="massage_container">
                        <a class="btn btn-light btn-lg col-12" 
                            href="<?=base_url()?>social/message_board/<?=$this->session->userdata('user_id')?>/<?=$event['auth_id']?>" id='send_mess'>MASSAGE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="group-btns container d-flex" id="event-btns">
        <a class="btn btn-dark btn-lg col-5" href="<?php echo base_url('post');?>"><h1 style="color:white;">Return</h1></a>
        <div class="btn btn-warning btn-lg col-5" onclick="alert('edit')" id="edit-btn"><h1>Edit</h1></div>
        <div class="btn btn-warning btn-lg col-5" onclick="attend_event('attend')" id="attend-btn"><h1>Attend</h1></div>
        <div class="btn btn-warning btn-lg col-5" onclick="attend_event('cancel')" id="cancel-btn"><h1>Cancel</h1></div>
    </div>
    <br><br>
</div>
<style>
    .event_imgs{
        height: 19vh;
        overflow:hidden;
    }
    .event-thumb{
        position: relative;
        top:15%;
    }
    .detail_info{
        width: 45vh;
        height: 45vh;
        background-color: #DDE2E5;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 35px;
        overflow: hidden;
    }
    .event_descript{
        padding: 3%;
    }
    .event_descript>h1{
        line-height:4rem;
        font-size: 3rem;
        font-weight: 400
    }
    .contents{
        padding-top:0;
    }
    .detail-switchs{
        width:100%;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
    .detail-switch{
        width:32vw;
        border-radius:0;
        font-size:3rem;
        height:5vh;
        text-align:center;
    }
    .info-box{
        width: 100%;
        /* display:none; */
    }
    .cate{
        width:35vw;
        height:30vw;
    }
    .line{
        border-right: 2.5px solid #444;
        height:10rem;
        position: relative;
        top: 9rem;
        transform: translateY(-50%);
    }
    .ver_line{
        border-top: 2.5px solid #444;
        width: 85%;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
    .cate-label{
        width: 70%;
        height: 100%;
        padding: 10% 10%;
        font-size: 3rem;
        display: inline-block;
        text-align: center;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        color:#E24814;
    }
    .cate-icon{
        color:#E24814;
    }
    .event_time{
        padding-top: 6%;
        
    }
    .event_time h1{
        font-size: 4rem;
        padding-left:2rem
    }
    .event_location{
        height:100%;
        text-align:center
    }
    .event_location h1{
        position: relative;
        top: 2rem
    }
    .map{
        height:18vh;
        width:100%;
        border-radius: 15px;
        position: relative;
        top: 3rem;
    }
    .part-count{
        height:30vw;
        width:50%;
    }
    .part-count h1{
        text-align:center;
        position: relative;
        top: 3rem;
    }
    #part_friends h1{
        text-align:center;
        position: relative;
        top: 2rem;
    }
    .count{
        font-size: 3rem;
    }
    #total-count, #left-count{
        font-size: 5rem;
    }
    #friend_list{
        position: relative;
        top: 5rem;
        width:85%;
        left: 50%;
        transform: translateX(-50%);
        overflow: scroll;
        height:100%;
    }
    .event-participants{
        width: 6rem;
        height: 6rem;
        border-radius: 50%;
        overflow: hidden;
        background-color: #495057;
        border: 1px #495057 solid;
        text-align: center;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 1rem
    }
    .part-friend{
        width:20vw;
        height: 15vw;
        text-align: center
    }
    #event-btns>.btn{
        padding: 1.8rem 1.5rem;
    }
    #event-btns>.btn>h1{
        font-size: 3.5rem
    }
    .mode{
        /* position: absolute; */
        height: 6rem;
        background-color: #E24814;
        color: white;
        padding: 1rem 1rem;
        /* border-radius: 15px 0 0 15px; */
        /* top: -60%;
        right:0 */
    }
    .mode h1{
        font-size: 3rem
    }
    #zoomId{
        font-size: 5rem;
        margin-top:5rem
    }
</style>
<script>
    var user_id = <?php echo $this->session->userdata('user_id')?>;
    var event_id = <?= $event['id']?>;
    var event_auth_id = <?= $event['auth_id']?>;
    $('#edit-btn').hide();$('#attend-btn').hide();$('#cancel-btn').hide();
    get_attend_list();
    get_attend_count();
    get_friend_list();
    function attend_event(mode){
        var url = '<?=base_url();?>post/change_attend';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'user_id': user_id, 'event_id': event_id, 'mode': mode},
                cache: false,
                success:function(data){
                    get_attend_list();
                    get_attend_count();
                }
            });
        }
    }

    function get_attend_list(){
        var url = '<?=base_url();?>post/attend_list';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'event_id': event_id},
                cache: false,
                success:function(data){
                    $('#edit-btn').hide();$('#attend-btn').hide();$('#cancel-btn').hide();
                    if(user_id == event_auth_id){
                        $('#edit-btn').show();
                    } else if(data !== ''){
                        var list = data.split(',');
                        if(list.includes(String(user_id))){
                            $('#cancel-btn').show();
                        }else{
                            $('#attend-btn').show();
                        }
                    } else{
                        $('#attend-btn').show();
                    }
                    
                }
            });
        }
    }
    function get_attend_count(){
        var url = '<?=base_url();?>post/attend_count';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'event_id': event_id},
                cache: false,
                success:function(data){
                    var left = parseInt(<?= $event['event_people']?>) - parseInt(data);
                    $('#left-count').html(left);
                    if(left == 0){
                        alert(full);
                    }
                }
            });
        }
    }
    function get_friend_list(){
        var url = '<?=base_url();?>post/attend_friends';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'user_id': user_id, 'event_id': event_id},
                cache: false,
                success:function(data){
                    // alert(data);
                    $('#friend_list').html(data);
                }
            });
        }
    }
</script>
<script>
    var mode='details';
    switch_mode_to(mode);
    function switch_mode_to(switch_mode){
        if(switch_mode == 'details'){
            $('#participants-div').hide();
            $('#founder-div').hide();
            $('#details-div').show();
        }
        if(switch_mode == 'participants'){
            $('#participants-div').show();
            $('#founder-div').hide();
            $('#details-div').hide();
        }
        if(switch_mode == 'founder'){
            $('#participants-div').hide();
            $('#founder-div').show();
            $('#details-div').hide();
        }
        
        
    }
</script>
<script>
    var user_id = <?=$this->session->userdata('user_id')?>;
    var friend_id = <?=$event['auth_id']?>;
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
                    }else if(friend_id == user_id){
                        //pass
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
<script>
    var map;
    var lat = <?php echo explode(',',$event['google_map'])[0]?>;
    var lng = <?php echo explode(',',$event['google_map'])[1]?>;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat, lng: lng},
            zoom: 16
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATbfMry6IVzAwEg6THCoxqanEy_D1NABM&callback=initMap"async defer></script>
