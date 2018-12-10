
$(function(){

  //Page2
  $("#check_button").click(function(){
    var agree1 = $('#chkAgree').is(":checked");
    var agree2 = $('#chkAgree2').is(":checked");
    if(!(agree1 && agree2 )){
      alert("항목들을 모두 체크해주세요.!");
    }else {
        window.location.href= "/registerCheck2";
    }
  });
});
