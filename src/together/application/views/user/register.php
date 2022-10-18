<form id="regForm" novalidate class="container login-form" action="<?php echo base_url().'user/register'?>" method="post" id="form-upload" enctype="multipart/form-data">
    <img src="<?php echo base_url()?>assets/img/logos/logo_dark.png" id="entry-logo">
    <h1 class="title register-title"><?= $title ?></h1>
    <br><br>
    <?php echo validation_errors();?>
    <!-- First box -->
    <div class="input-box">
        <?php if($this->session->flashdata('register_failed')){?>
            <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('register_failed').'</p>';?>
        <?php }; ?>
        <div class="input-label">USERNAME</div>
        <input class="form-cols" name="username" id="username" type="text" placeholder="Please enter your name">
        <div class="input-label">EMAIL</div>
        <input class="form-cols" name="email" id="email" type="email" placeholder="Please enter your email">
        <div class="input-label">PASSWORD</div>
        <input class="form-cols" name="password" id="password" type="password" placeholder="Please enter your password">
    </div>
    <!-- Second box -->
    <div class="input-box">
        <div class="input-label">GENDER</div>
        <div class="radio-group gender-option">
            <input type="radio" id="type-one" name="gender-option" class='radio-input type-option' value="M" checked>
            <label class='radio-label begin' for="type-one">Male</label>
            <input type="radio" id="type-three" name="gender-option" class='radio-input type-option' value="F">
            <label class='radio-label final' for="type-three">Female</label>
        </div>
        
        <div class="input-label">BIRTHDAY</div>
        <input class="form-cols" type='date' name="birthdate" id="birthdate">
        <div class="input-label">COUNTRY</div>
        <div class="form-element">
            <select class="form-country">
                <option>AUS</option>
                <option>CN</option>
                <option>UK</option>
                <option>Other</option>
            </select>
        </div>
    </div>
    <!-- Third box -->
    <div class="input-box" style="margin:0;">
        <div class='preference-box d-flex align-content-start flex-wrap' style="margin-left:12%">
            <?php foreach($categories as $category):?>
                <div class="prefer-item">
                    <input type="checkbox" class='checkbox-input' id="cate-<?= $category['id']?>" name="preferences[]" value="<?= $category['id']?>">
                    <label class='category-label' for="cate-<?= $category['id']?>"><i class="material-icons"><?= $category['icon']?></i><?php echo $category['name']?></label>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    
    <div style="text-align:center;margin-top:0;">     
        <span class="point"></span>
        <span class="point"></span>
        <span class="point"></span>
    </div>

    <div style="overflow:auto;text-align:center;">
        <div class="button_c d-flex" style="justify-content: space-around;">
            <button class="btn btn-dark btn-lg col-5" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button class="btn btn-warning btn-lg col-5" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            <input type="submit" name="insert" id='submit-btn' value="Submit" class="btn btn-warning btn-lg col-5"/>
        </div>
        <a class="txt" href="<?php echo base_url().'user/login'?>" style="font-size:3rem;">Back to sign in</a>
    </div>

    
</form>

<style>
    .input-box{
        display:none;
        font-size: 3.7vh;
        height:42.5vh;
    }
    input {
        width: 100%;
        font-size: 3rem;
        border: 1px solid #aaaaaa;
    }
    #prevBtn, #nextBtn, #submit-btn{
        font-size: 3rem;
        margin: 50px 0;
    }
    .input-label{
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .form-country{
        width: 50%;
        text-align-last: center;
        background:none;
        font-size: 3rem;
        border-radius:15px;
        padding:15px 20px;
        margin: 8px 3px;
        height: 6vh;
        border: 1.4px solid #495057;;
    }
    
</style>
<script>
    var currentTab = 0; 
    showTab(currentTab); 

    function showTab(n) {
        var x = document.getElementsByClassName("input-box");
        x[n].style.display = "block";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("submit-btn").style.display = "none";
            document.getElementById("nextBtn").classList.add('col-12');
            document.getElementById("nextBtn").style.display = "inline";
        } else {
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
        var x = document.getElementsByClassName("input-box");
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
        var i, x = document.getElementsByClassName("point");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }
</script>