$(function() {
  $("#commentArea").keyup(function(){
    textarea = $(this).val().replace(/\n/g, "<br>");
    var a = textarea;
    var results = a.match(/<br>/g);
    var height;
    if(results != null) {
      if(results.length>4){
        height =26*(results.length+3);
        $(this).css('height' , height+"px");
      }  else {
        height =26*results.length;
        if(height < 190)
          height = 190;
        $(this).css('height' , height+"px");
      }
      // 2개이므로 2가 출력된다!
    }
  });
});
