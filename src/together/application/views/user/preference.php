<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>user/profile"><i class="material-icons" id="back-icon">chevron_left</i></a>
    </div>
    <h1 class="title"><?= $title ?></h1>
</div>
<div class="content" style="text-align: center;padding-top:130px;" >
    <?php $preferences_arr=explode(",", $user['preferences']);?>
    <form action="<?php echo base_url();?>user/set_preferences" class="container" method="post" enctype="multipart/form-data">
        <h1>Reset your preferences</h1><br><br>
        <div class='preference-box d-flex align-content-start flex-wrap' style="width:80%;position: relative;
                    left: 50%;transform: translateX(-50%);">
            <?php foreach($categories as $category):?>
                <div class="prefer-item">
                    <input type="checkbox" class='checkbox-input' id="cate-<?= $category['id']?>" name="preferences[]" value="<?= $category['id']?>"
                    <?php if(in_array($category['id'],$preferences_arr)){echo 'checked';}?>>
                    <label class='category-label' for="cate-<?= $category['id']?>"><i class="material-icons"><?= $category['icon']?></i><?php echo $category['name']?></label>
                </div>
            <?php endforeach;?>
        </div><br><br><br>
        <input type="hidden" name="user_id" value="<?= $user['id']?>">
        <input type="submit" id='submit-btn' value="Submit" class="btn btn-warning btn-lg col-12">    
    </form>
    
</div>