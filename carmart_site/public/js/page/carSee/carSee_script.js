
$(function(){
  $('#back_button').hide();
  $(window).scroll(function(){
    var height = $(document).scrollTop();
    if(height >= 550){
      if(!$('#back_button').is(':visible'))
        $('#back_button').show().animate({height:"130px"},100);
    }else{
      if($('#back_button').is(':visible'))
        $('#back_button').hide().animate({height:"0px"},400);
    }
  });
});
