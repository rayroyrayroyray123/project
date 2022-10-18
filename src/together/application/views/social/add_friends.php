<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>social"><i class="material-icons" id="back-icon">chevron_left</i></a>
    </div>
    <div class="col-10" id="friend-search"><input class="form-cols" name="find-friends" id="find-friends" type="text" placeholder="Find your friends"></div>
</div>
<div class="contents" id="search-result-box"></div>

<style>
#friend-search{
    position:relative;
    left:12%;
    top: 20%;
}
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
</style>
<script>
    $("#find-friends").keyup(function(){
        var keyword = $("#find-friends").val();
        var $user_id = <?=$this->session->userdata('user_id')?>;
        var data = { 'keyword': keyword , 'user_id':$user_id};
        var url = '<?=base_url()?>social/search_users';
        if(keyword != ''){
            {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(data){
                        $('#search-result-box').html(data);
                    }
                });
            }
        }else{
            $('#search-result-box').html('');
        };
    });
</script>