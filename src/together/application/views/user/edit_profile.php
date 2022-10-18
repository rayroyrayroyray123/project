<div id="header">
    <div class="back-btn">
        <a href="<?php echo base_url();?>user/profile"><i class="material-icons" id="back-icon">chevron_left</i></a>
    </div>
    <h1 class="title"><?= $title ?></h1>
</div>
<div class="contents container">
    <div class="user-info container">
        <form id="img-form" method="post" action="<?php echo base_url('user/upload_img/'.$user['id'])?>">
            <div class="user-img" id="user-img">
                <?php if($user['img']):?>
                    <img src="<?php echo base_url().'assets/img/users/'.$user['img'];?>" id="uploaded_image" class="img-responsive img-circle" />
                <?php else:?>
                    <p id="user_ini"><?php echo $this->session->userdata('username')[0];?></p>
                <?php endif;?>
            </div>
            <label class="change-photo" for="upload_image">change photo</label>
            <input type="file" name="image" class="image" id="upload_image" style="display:none"/>
        </form>
    </div>
    <form id="profile_update" action="<?php echo base_url();?>user/set_profile" class="container" method="post" enctype="multipart/form-data">
        <div class="input-label">EMAIL</div>
        <input class="form-cols" name="email" id="email" type="text" value="<?= $user['email']?>">
        <div class="input-label">EVENT LOCATION</div>
        <input class="form-cols" name="event_location" id="event_location" type="text" 
            value="<?php if($user['event_location']){echo $user['event_location'];}?>"
            placeholder="where is the place to hold events">
        <div class="input-label">ZOOM LINK</div>
        <input class="form-cols" name="zoom_link" id="zoom_link" type="text" 
            value="<?php if($user['zoom_link']){echo $user['zoom_link'];}?>"
            placeholder="online events' link">
        <br><br><br>
        <input type="hidden" name="user_id" value="<?= $user['id']?>">
        <input type="submit" id='submit-btn' value="Submit" class="btn btn-warning btn-lg col-12"> 
    </form>
</div>
<div class="row">
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Crop Image</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons" style="font-size:6rem !important;">cancel</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-10">
                                <img src="" id="sample_image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="crop" class="btn btn-warning btn-lg">Crop</button>
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .change-photo{
        position:relative;
        left:50%;
        transform: translateX(-50%);
    }
</style>
<script>
    $('#submit-btn').click(function(){
        var form = $("#profile_update"),
        url = form.attr('action'),
        method = form.attr('method'),
        user_id = $("#user_id").val(),
        email = $("#email").val(),
        event_location = $("#event_location").val(),
        birthdate = $("#birthdate").val(),
        data = {
            'user_id': user_id,
            'email': email,
            'event_location':event_location,
            'birthdate': birthdate
        }
        $.ajax({
            url:url,
            method:method,
            data:data,
            success: function(val){
                alert('Your profile has been updated!');
            }
        })
        
    });
</script>
<script>
// https://www.webslesson.info/2020/08/php-crop-image-while-uploading-with-cropper-js.html
$(document).ready(function(){

	var $modal = $("#modal");
    
    var form = $("#img-form");

    var baseUrl= form.attr('action');

	var image = document.getElementById('sample_image');

	var cropper;

	$("#upload_image").change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on("shown.bs.modal", function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on("hidden.bs.modal", function(){
		cropper.destroy();
   		cropper = null;
	});
    $("#crop").click(function(){
		canvas = cropper.getCroppedCanvas({
			width:500,
			height:500
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
                    url:baseUrl,
					method:"post",
					data:{'image':base64data},
                    error: function() {
                        alert("Something is wrong");
                    },
					success:function(data)
					{
						$modal.modal("hide");
                        if($('#uploaded_image')){
                            $('#uploaded_image').attr('src', "https://deco3801-teamwetried.uqcloud.net/together/assets/img/users/"+data);
                        }else{
                            $('#user_ini').remove();
                            $('#user-img').append('<img src="https://deco3801-teamwetried.uqcloud.net/together/assets/img/users/'+data+' id="uploaded_image" class="img-responsive img-circle" />');
                        }
                        
                        // alert(data);
					}
				});
			};
		});
	});
	
});
</script>
