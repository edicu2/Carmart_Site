
var slideIndex = 1;

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = $(".mySlides");
  if (n > slides.length) {slideIndex = 1}
  if( n < 1) {slideIndex = slides.length}
  img = slides.eq(slideIndex-1).find('img').attr('src');
  $('#preview').find('img').attr('src',img);
  $('div.text').html(slideIndex + " / 20");
}

$(function(){
  $(".mySlides").hover(function(){
    img = $(this).find('img').attr('src');
    index = $(this).index(".mySlides");
    $('#preview').find('img').attr('src',img);
    $('div.text').html((index +1)+" / 20");
  });
});
