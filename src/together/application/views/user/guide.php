<div class="guidecontainer">
    <div class="mySlides">
      <img src="<?php echo base_url().'assets/img/guide/home_page.png';?>" class="slide_img">
      <!-- <div class="text" >Home page</div> -->
    </div>
  
    <div class="mySlides" style="text-align: center;">
      <img src="<?php echo base_url().'assets/img/guide/create_page.png';?>" class="slide_img">
      <!-- <div class="text">Create event</div> -->
    </div>
  
    <div class="mySlides" style="text-align: center;">
      <img src="<?php echo base_url().'assets/img/guide/social_page.png';?>" class="slide_img">
      <!-- <div class="text">Social page</div> -->
    </div>
    
    <div class="mySlides" style="text-align: center;">
        <img src="<?php echo base_url().'assets/img/guide/event_page.png';?>" class="slide_img">
        <!-- <div class="text">Join event</div> -->
    </div>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>
  <div style="text-align:center">
    <span class="point" onclick="currentSlide(1)"></span>
    <span class="point" onclick="currentSlide(2)"></span>
    <span class="point" onclick="currentSlide(3)"></span>
    <span class="point" onclick="currentSlide(4)"></span>
  </div>
  <a href="<?php echo base_url()?>" class="btn btn-warning btn-lg col-6 full-btn" id="skip">Skip</a>
<style>
    /* * {box-sizing:border-box} */
body{
    margin: 2vh 0 1vh 0;
}
.guidecontainer {
  max-width: 1000px;
  margin: auto;
  align-items:center;
}
.mySlides {
  display: none;
}
.mySlides>img{
    position:relative;
    left:50%;
    transform:translateX(-50%)
}
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  margin-top: -22px;
  padding: 3px;
  color: #F37022;
  font-weight: bold;
  font-size: 100px;
  transition: 0.6s ease;
  border-radius: 0 5px 5px 0;
  user-select: none;
}
.prev{
  left:2rem;
}
.next {
  right: 2rem;
  border-radius: 5px 0 0 5px;
}
.text {
  color: #F37022;
  font-size: 25px;
  padding: 0px 12px;
  position: absolute;
  width: 100%;
  text-align: center;
}
.point{
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  margin-top: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}
#skip{
    position:relative;
    left:50%;
    transform:translateX(-50%)
}
.slide_img{
    width:75%; margin: 0 auto;
}
</style>
<script>
var slidenumber = 1;
show(slidenumber);
function plusSlides(n) {
  show(slidenumber += n);
}
function currentSlide(n) {
  show(slidenumber = n);
}
function show(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("point");
  if (n > slides.length) {slidenumber = 1}
  if (n < 1) {slidenumber = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slidenumber-1].style.display = "inline";
  dots[slidenumber-1].className += " active";
}
</script>