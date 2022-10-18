<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>post"><i class="material-icons" id="back-icon">chevron_left</i></a>
    </div>
    <div class="col-10" id="friend-search"><input class="form-cols" name="find-events" id="event-friends" type="text" placeholder="<?=$keyword?>"></div>
</div>
<div class="contents">
    <div class="events-box">
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
</div>