function displayInput(){
var x = document.querySelector('.input-init');
  if (x.style.visibility === "hidden") {
    x.style.visibility = "visible";
  } else {
    x.style.visibility = "hidden";
  }
}

function displayInputTwo(){
    var x = document.querySelector('.input-init-two');
      if (x.style.visibility === "hidden") {
        x.style.visibility = "visible";
      } else {
        x.style.visibility = "hidden";
      }
    }

/*CAROUSEL GALLERY*/

let slidePosition = 0;
const slides = document.getElementsByClassName('carousel_item');
const totalSlides = slides.length;

document.getElementById('carousel_button--next').addEventListener("click",function(){
  movetoNextSlide();
});

document.getElementById('carousel_button--prev').addEventListener("click",function(){
  movetoPreviouseSlide();
});

function updateSlidePosition(){
  for (let slide of slides){
    slide.classList.remove('carousel_item--visible');
    slide.classList.add('carousel_item--hidden');
  }

  slides[slidePosition].classList.add('carousel_item--visible');
};

function movetoNextSlide(){
  
  if(slidePosition === totalSlides - 1){
    slidePosition = 0;
  }else{
    slidePosition++;
  }
  updateSlidePosition();
}

function movetoPreviouseSlide(){
  
  if(slidePosition === 0 ){
    slidePosition = 0;
  }else{
    slidePosition--;
  }
  updateSlidePosition();
}

/*CAROUSEL GALLERY*/

$( document ).ready(function() {

  setInterval(function(){ 
    $("#carousel_button--next").click();
 },3000);

});