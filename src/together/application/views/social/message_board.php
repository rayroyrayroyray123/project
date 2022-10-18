<?php
    if($this->session->userdata('logged_in')){
        if((time() - $this->session->userdata('logged_in_time')) > 86400){
            redirect(base_url().'user/logout');
        };
    }else{
        redirect(base_url().'user/login');
    };
?>
<div class="nav" style="display:inline">
    <div id="message_input" class="">
        <div class="col-10"><input class="form-cols" name="message_send" id="new_message" type="text" placeholder="Enter messages"></div>
        <div class="btn btn-warning btn-lg col-2 send-btn" onClick="insert_new_message()">
            <i class="material-icons send-icon" id="enter-icon" style="font-size:100px !important;position:relative;top:3%;color:white;">send</i>
        </div>
    </div>
</div>
<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>social"><i class="material-icons" id="enter-icon">chevron_left</i></a>
    </div>
    <h1 class="title"><?= $sender['username'] ?></h1>
</div>
<div class="contents" class="box" id="chat-box"></div>
<style>
.chat-person{
    width: 5rem;
    height: 5rem;
    border-radius: 50%;
    overflow: hidden;
    background-color: #495057;
    border: 1px #495057 solid;
    text-align: center;
    margin-right: 1.3rem;
    margin-left: 1.3rem;
} 
.message>p{
    position:relative;
    top:50%;
    transform: translateY(-50%);
    font-size:3rem;
    padding:1rem 1.5rem 1rem 1.5rem;
    background-color:#DDE2E5;
    border-radius:25px;
    margin: .5rem;
    max-width:55vw
}

.receiver-message>p{
    background-color:#F37022;
    color:#fff;
    border:none;
}

.message{
    padding-top:.3vh;
    padding-bottom:.3vh

}
.sender-message-box{
    padding-left:1.5rem;
    padding-top:1rem
}
.receiver-message-box{
    flex-direction: row-reverse;
    padding-right:1.5rem;
    padding-top:1rem
}
#message_input{
    display:flex;
    padding:1rem
}
.send-btn{
    font-size:3.5rem;
    padding: .8rem 1rem;
}
#chat-box{
    overflow-y:scroll;
}
.mess-time>h5{
    position:relative;
    top:75%;
    margin-right:.5vw;
    margin-left:.5vw;
    color:#DDE2E5;
}
.send-icon{
    font-size:100px !important;
}
</style>
<script>
    var sender_id = <?=$sender_id?>;
    var receiver_id = <?=$receiver_id?>;
    var targetDiv = document.getElementById('chat-box');
    var action = 'inactive';
    var scrollHeight;
    var targetDiv;
    load_chat_data();
    
    setInterval(function(){ 
        load_chat_data();
        if((targetDiv.scrollHeight-scrollHeight)>=149){
            scrollToBottom();
            update_read();
        }
    }, 5000);
    function load_chat_data(){
        var url = '<?=base_url();?>social/load_chat_data';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'sender_id': sender_id, 'receiver_id': receiver_id},
                cache: false,
                success:function(data){
                    $("#chat-box").html(data);
                    if(action == 'inactive'){
                        action = 'active';
                        scrollToBottom();
                    };
                    
                }
            });
        }
    }
    function insert_new_message(){
        var url = '<?=base_url();?>social/insert_new_message';
        var message = $('#new_message').val();
        
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'sender_id': receiver_id, 'receiver_id': sender_id, 'message':message},
                cache: false,
                success:function(data){
                    $('#new_message').val('');
                    action = 'inactive';
                    load_chat_data();
                    
                }
            });
        }
    }

    function scrollToBottom(){
        scrollHeight = targetDiv.scrollHeight;
        targetDiv.scrollTop = targetDiv.scrollHeight;
    }

    function update_read(){
        var url = '<?=base_url();?>social/update_read';
        {
            $.ajax({
                url:url,
                method:"POST",
                data:{'sender_id': sender_id, 'receiver_id': receiver_id},
                cache: false,
                success:function(data){
                    
                }
            });
        }
    }
</script>