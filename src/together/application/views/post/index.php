<div id="header">
    <div class="back-btn">
        <div><i class="material-icons" id="nofity-icon">notifications</i></div>
    </div>
    <h1 class="title"><?= $title ?></h1>
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
    <div>
        <div class="search-box d-flex" style="justify-content: space-around;">
            <div class="search-input col-7">
                <input type="text" class="form-control mr-sm-2 form-control-lg" id="search-events" 
                name="search-events" placeholder="Type to search events" aria-label="Search" autocomplete="off">
            </div>
            <div class="search-btn col-2"><a href="<?php echo base_url();?>post/" id="search_btn"><i class="material-icons" id="search-icon">search</i></a></div>
            <div class="filter-btn btn-secondary col-2" id="filter-btn"><a href="#"><i class="material-icons" id="search-icon">filter_alt</i></a></div>
        </div>
        <div class="col-7" id="search-result-box"></div> 
        
    </div>
    <div class="events-box" id="events-box">
        <?php foreach($events as $event):?>
            <?php if($event['event_img']){$event_img_arr=explode(",", $event['event_img']);}?>
            <div id="item<?= $event['id']?>">
                <div class="event-box" id="<?= $event['id']?>" onClick="moreDetail(this.id)">
                    <div class="event-photo">
                        <div class="event-title">
                            <h3 class="col col-9 event-title"><?php echo $event['title']?></h3>
                        </div>
                        <img class="event-thumb" width='100%' src="<?php echo base_url().'assets/img/events/'.$event_img_arr[0];?>">
                    </div>
                    <div class="d-flex event-info">
                        <div class="d-flex col-8">
                            <div class="event-founder">
                                <a href="#">
                                    <?php if($event['img']):?>
                                        <img src="<?php echo base_url().'assets/img/users/'.$event['img'];?>" id="uploaded_image" class="img-responsive img-circle" />
                                    <?php else:?>
                                        <p id="user_ini" style="top: 40%;"><?= $event['username'][0]?></p>
                                    <?php endif;?>
                                </a>
                            </div>
                            <div><h3><?= $event['username']?></h3></div>
                        </div>
                        <div class="col col-4"><p><?php echo str_replace("-", "/", $event['event_date'])?></p></div>
                    </div>
                </div>
                <br>
            </div>
            <br>
        <?php endforeach;?>
    </div>
    <div id="filter-panel">
        <form action="#" class='filter-form'>
            <div id="cancel-btn-filter" style="text-align:end;"><i class="material-icons" style="font-size:6rem !important;">cancel</i></div>
            <h1 style="font-size:5rem;">Filter</h1>
            <br><br>
            <div class='preference-box d-flex align-content-start flex-wrap' style="width:80%;position: relative;
                left: 90%;transform: translateX(-90%);">
                <?php foreach($categories as $category):?>
                    <div class="prefer-item">
                        <input type="checkbox" class='checkbox-input' id="cate-<?= $category['id']?>" name="cate-<?= $category['id']?>" value="<?= $category['id']?>">
                        <label class='category-label' for="cate-<?= $category['id']?>"><i class="material-icons"><?= $category['icon']?></i><?php echo $category['name']?></label>
                    </div>
                <?php endforeach;?>
            </div>
            <br>
            <div class="radio-group">
                <input type="radio" id="option-one" name="mode-selector" class='radio-input mode-option' value="both" checked>
                <label class='radio-label begin' for="option-one">Both</label>
                <input type="radio" id="option-two" name="mode-selector" class='radio-input mode-option' value="online">
                <label class='radio-label' for="option-two">Online</label>
                <input type="radio" id="option-three" name="mode-selector" class='radio-input mode-option' value="offline">
                <label class='radio-label final' for="option-three">Offline</label>
            </div>
            <br><br>
            <div class="radio-group">
                <input type="radio" id="type-one" name="type-selector" class='radio-input type-option' value="both" checked>
                <label class='radio-label begin' for="type-one">Both</label>
                <input type="radio" id="type-two" name="type-selector" class='radio-input type-option' value="public">
                <label class='radio-label' for="type-two">Public</label>
                <input type="radio" id="type-three" name="type-selector" class='radio-input type-option' value="private">
                <label class='radio-label final' for="type-three">Private</label>
            </div>
            <br><br>
            <button type="button" class="btn btn-warning btn-lg col-12 full-btn" id="filter-apply">Apply</button>
        </form>
    </div>
    <div id="message">
        <img src="<?php echo base_url()?>assets/img/logos/logo_org.png" style="width:250px;"><br>
        <h1 class="login-title" style="font-size:5rem">TOGETHER</h1><br><br><br><br><br><br>
        <div class="check-circle">
            <i class="material-icons" id="check-icon">check</i>
        </div>
        <h1 class="login-title" style="font-size:5rem">Success</h1><br><br><br>
        <h1>Ready to log in.</h1><br>
        <h1>Redirect in few seconds...</h1>
    </div>
    <div id="notification-panel">
        <div id="cancel-btn" style="text-align:end;"><i class="material-icons" style="font-size:6rem !important;">cancel</i></div>
        <h1 style="font-size:5rem;">Notifications</h1>
        <br><br><br><br>
        <div id="notify_box"></div>
    </div>
</div>
<style>
#search-result-box{
    position: absolute;
    margin-left:6.5vw;
    margin-top:-15px;
    border:1px solid #fff;
    border-radius:10px;
    z-index: 999;
    background-color:#fff;
    padding-top:3%;
    display:none;
    width:51%
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
#search-result-box{
    font-size:2.5rem;
}
</style>
<script>
    function moreDetail(id){
        var btn = document.getElementById("detail-btn");
        if(btn){btn.remove();}
        document.getElementById("item"+id).insertAdjacentHTML("afterend", "<div id='detail-btn'><a href='https://deco3801-teamwetried.uqcloud.net/together/post/view/"+id+"' class='btn btn-warning btn-lg col-12'><h1>More details</h1></a></div>");
        document.getElementById('detail-btn').scrollIntoView();
    }
</script>
<script>
    $(document).ready(function(){
        $("#filter-btn").click(function(){
            $("#filter-panel").css('display','flex');
            
        });

        $("#cancel-btn-filter").click(function(){
            $("#filter-panel").css('display','none');
        });

        $("#filter-apply").click(function(){
            $("#filter-panel").css('display','none');
        });

        <?php if($this->session->flashdata('user_registered')){?>
            $("#message").css("display","inline");
            setTimeout(() => {
                $("#message").css("display","none");
            }, 2500);
        <?php }else{ ?>
            $("#message").css("display","none");
        <?php };?>
    });

    $("#search-events").keyup(function(){
        var keyword = $("#search-events").val();
        var data = { 'keyword': keyword};
        var url = '<?=base_url()?>post/search_events';
        if(keyword != ''){
            {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(data){
                        $('#search-result-box').fadeIn();
                        $('#search-result-box').html(data);
                        $('#search_btn').attr('href', "<?php echo base_url(); ?>post/search/"+keyword);
                    }
                });
            }
        }else{
            $('#search-result-box').fadeOut();
        };
    });
    $(document).on('click', 'li', function(){
        var id = $(this).attr('id');
        $('#search-events').val($(this).text());
        $('#search_btn').attr('href', "<?php echo base_url(); ?>post/search/"+id);
        $('#search-result-box').fadeOut();
    });
    $('#filter-apply').click(function(){
        var mode = $("input[type='radio'][name='mode-selector']:checked").val();
        var type = $("input[type='radio'][name='type-selector']:checked").val();
        var preferences = '';
        var preferenceBox = document.getElementsByClassName('checkbox-input');
        for(var prefer of preferenceBox){
            if(prefer.checked){
                preferences += prefer.value + ",";
            }
        }
        
        var url = '<?=base_url();?>post/get_filtered_events';
        var data = {'mode': mode, 'type': type, 'preferences': preferences};
        {
            $.ajax({
                url:url,
                method:"POST",
                data:data,
                cache: false,
                success:function(data){
                    if(data == ''){
                        alert('No eligible results');
                        $('#events-box').html('');
                    }else{
                        $('#events-box').html(data);
                    };
                }
            });
        }
    });
</script>