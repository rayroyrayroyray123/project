<div id="header">
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
<div class="contents" style="padding:5vw; overflow:hidden;">
<div class="setStep" id="setStep">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
</div><br>
<form id="img-form" method="post" action="<?php echo base_url('post/upload_img')?>">
    <!-- <label id="add-label" style="display:block;" class="material-icons" for="upload_image">add_circle</label> -->
    <input type="file" name="image" class="image" id="upload_image" style="display:none"/>
</form>
<form id="creatForm" action="<?php echo base_url().'post/create_event/'.$mode;?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?= $this->session->userdata('user_id');?>">
    <!--steps of the form-->
    
    <!--Page 1-->
    <div class="page">
        <h1>Information</h1><br>
        <div id="infoPage">
            <div class="input-label">Event Title</div>
            <input class="form-cols" name="eventTitle" id="eventTitle" type="text" placeholder="eg.Hiking" required><br>
            <div class="input-label">Description</div>
            <textarea class="form-cols form-textarea" id="eventDescript" rows = "5" cols="60" name="description" placeholder="Describe the event contents..." required></textarea><br>
            <div class="input-label">Photos</div>
            <div class="d-flex align-items-center">
                <div id="uploaded-box" class="d-flex align-items-center">
                    <div id="img-icon" class="event-img-box"><span class="material-icons" style="padding-top:15px;">image</span></div>
                    <?php for($i = 1; $i < 4; $i++){?>
                        <div id="uploaded_img<?=$i?>" class="event-img-box">
                            <div id="delete-btn<?=$i?>" class="img-delete-btn">
                                <i id="remove<?=$i?>" onclick="deletePhoto(this.id)" class="material-icons delete-icon">remove_circle</i>
                            </div>
                            <img id="img<?=$i?>" src="" width="100%" class="event-img"/>
                        </div>
                    <?php };?>
                </div>
                <label id="add-label" style="display:block;" class="material-icons" for="upload_image">add_circle</label>   
            </div>
            <div id="event-img-inputs"></div>
        </div>
    </div>

    <!--Page 2-->
    <div class="page">
        <h1>Choose an Event Category</h1><br>
        <div class='preference-box d-flex align-content-start flex-wrap' style="margin-top:3rem;width:80%;position: relative;
            left: 90%;transform: translateX(-90%);">
            <?php foreach($categories as $category):?>
                <div class="prefer-item">
                    <input type="radio" class='checkbox-input' id="cate-<?= $category['id']?>" name="category" value="<?= $category['id']?>" required>
                    <label class='category-label' for="cate-<?= $category['id']?>"><i class="material-icons"><?= $category['icon']?></i><?php echo $category['name']?></label>
                </div>
            <?php endforeach;?>
        </div>
    </div>

    <!--Page 3-->
    <div class="page">
        <h1>Set Event Time</h1><br>
        <div id="timePage">
            <div class="input-label">Event Date</div> 
            <input class="form-cols" type='date' name="eventDate" required><br>
            <div class="input-label">Start Time</div> 
            <input class="form-cols" type="time" name="eventTime" required><br>
            <div class="input-label">Duration</div> 
            
            <input class="form-cols" type="number" name="eventDuration" style="width:50%;" required>
            <p style="font-size:2rem;transform: none;">Hour(s)</p>
            
        </div>
    </div>

    <!--Page 4 come back and finish this !!!!!!-->
    <?php if($mode === 'online'):?>
    <div class="page">
        <h1>Set Online Link</h1><br>
        <div>
            <div class="input-label">Zoom Link</div>
            <input class="form-cols" name="zoomlink" id="zoomlink" type="text" placeholder="84839230"><br>
        </div>
    </div>
    <?php endif;?>

    <?php if($mode === 'offline'):?>
    <div class="page">
        <h1>Set the Event Location</h1><br>
        <div>
            <div class="input-label">Event Location</div>
            <input class="form-cols" name="eventLocation" id="eventLocation" type="text" placeholder="St. Lucia" style="width:70%"><br>
            <h1 id="choosen_location"></h1>
            <input type="hidden" name="choosen_address" id="choosen_address">
        </div>
        <div id="google_map"></div>
        <input type="hidden" id="location-lat" name="location[]"/>
        <input type="hidden" id="location-lng" name="location[]"/>
        <input type="hidden" id="event_mode" name="event_mode" value="<?=$mode?>"/>
    </div>
    <?php endif;?>

    <!--Page 5-->
    <div class="page">
        <h1>Set the Event Limits</h1><br>
        <div id="limitPage">
            <div class="input-label">No. of participants</div> 
            <div class="d-flex">
                <div class="col-2" style="font-size:3rem;"><p>Max</p></div>
                <input class="form-cols col-4" type="number" name="eventPeople" style="width:30%;" required>
                <div class="col-3" style="font-size:3rem;"><p> people</p></div>
            </div><br>
            <div class="input-label">Event Type</div> 
            <div class="form-element">
                <select name="eventType" id="eventType">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
        </div>
    </div>

    <!--Buttons-->
    <div id="buttonSets" class="button_c d-flex" style="justify-content: space-around;">
        <!--return to complete onclick-->
        <a href="<?php echo base_url();?>post/create" id='back-btn' class="btn btn-dark btn-lg col-5">Previous</a>
        <button class="btn btn-dark btn-lg col-5" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button class="btn btn-warning btn-lg col-5" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        <input type="submit" name="insert" id='submit-btn' value="Submit" class="btn btn-warning btn-lg col-5"/>
    </div>
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
#google_map{
    height:36vh;
    width:95%;
    position:relative;
    left:48%;
    transform: translateX(-50%);
    overflow:hide;
    border-radius:15px;
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
  
.event_imgs{
    height: 15vh;
    overflow:hidden;
}

.event_descript{
    padding: 3%;
}
#checkPage h1{
    text-align:center
}
</style>
<script>
    var currentTab = 0; 
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName("page");
        x[n].style.display = "block";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("submit-btn").style.display = "none";
            document.getElementById("back-btn").style.display = "inline";
        } else {
            document.getElementById("back-btn").style.display = "none";
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").classList.remove('col-12');
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submit-btn").style.display = "inline";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("submit-btn").style.display = "none";
        }
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("page");
        
        // if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            // document.getElementById("regForm").submit();
            // window.location.href='success.html'
            
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("input-box");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("point")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            if(x[i].classList.contains("active") && i<n){
                x[i].className = x[i].className.replace(" active", " finish");
            };
            if(x[i].classList.contains("active") && i>n){
                x[i].className = x[i].className.replace(" active", "");
            };
            
            
        }
        //... and adds the "active" class to the current step:
        if(x[n].classList.contains("finish")){
            x[n].className = x[n].className.replace(" finish", "");
        }
        x[n].className += " active";
    }
</script>
<!-- <script src="application/assets/js/create.js"></script> -->
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
                    url:'<?php echo base_url().'post/upload_img'?>',
					method:"post",
					data:{'image':base64data},
                    error: function() {
                        alert("Something is wrong");
                    },
					success:function(data)
					{
						$modal.modal("hide");
                        photoNum++;
                        showPhoto(photoNum);
                        $('#img'+photoNum).attr('src', "https://deco3801-teamwetried.uqcloud.net/together/assets/img/events/"+data);
                        $('#event-img-inputs').append('<input type="hidden" id="eventImg'+photoNum+'" name="eventImg[]" value="">');
                        $('#eventImg'+photoNum).attr('value', data);
                        var base_url = '<?php echo base_url();?>';
                        var photo = $('#eventImg1').val();
                        $("#event-photo").attr('src', base_url+'assets/img/events/'+photo);
					}
				});
			};
		});
	});
	
});
</script>
<script>
    var photoNum = 0;
    showPhoto(photoNum);
    function showPhoto(n){
        var i, x = document.getElementsByClassName("event-img-box");
        if(n === 0){
            x[0].style.display = "block";
            for (i = 3; i > n; i--){
                x[i].style.display = "none";
            }
        };
        if(n > 0){
            x[0].style.display = "none";
            for (i = 1; i <= n; i++){
                x[i].style.display = "block";
            };
            for (i = 3; i > n; i--){
                x[i].style.display = "none";
            }
        };
        if(n === 3){
            $('#add-label').hide();
        }else{
            $('#add-label').show();
        };
    };
</script>
<script>
    function deletePhoto(n){
        // alert($('#img1').attr('src'));
        if(n === 'remove1'){
            deleteImg(1);
            if(photoNum === 1){
                emptyImg(1);
            }else if(photoNum === 2){
                moveImgFromNext(1);
                emptyImg(2);
            }else{
                moveImgFromNext(1);
                moveImgFromNext(2);
                emptyImg(3);
            }; 
        };
        if(n === 'remove2'){
            deleteImg(2);
            if(photoNum === 2){
                emptyImg(2);
            }else{
                moveImgFromNext(2);
                emptyImg(3);
            };
        };
        if(n === 'remove3'){
            deleteImg(3);
            emptyImg(3);
        }
    };

    function emptyImg(num){
        $('#img'+num).attr('src', '');
        $('#eventImg'+num).remove();
        photoNum--;
        showPhoto(photoNum);
    };

    function moveImgFromNext(num){
        var next = num+1;
        var next_img = $('#img'+next).attr('src');
        var next_value = $('#eventImg'+next).attr('value');
        $('#img'+num).attr('src', next_img);
        $('#eventImg'+num).attr('value', next_value);
    };

    function deleteImg(num){
        var img_file = $('#eventImg'+num).attr('value');
        $.ajax({
            url:'<?php echo base_url().'post/delete_img'?>',
            method:"post",
            data:{'image':img_file},
            error: function() {
                alert("Something is wrong");
            },
            success:function(data)
            {
                // alert('success');
            }
        });
    }
</script>
<script src="<?php echo base_url(); ?>assets/js/google-map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATbfMry6IVzAwEg6THCoxqanEy_D1NABM&callback=initAutocomplete&libraries=places&v=weekly"></script>
<style>
.pac-item{
    font-size: 3rem;
    line-height: 60px;
    padding: 10px 4px;
}
.pac-item-query{
    font-size: 3rem;
}
</style>