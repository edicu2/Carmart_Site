$(function() {
  var bool = true;
  $("#phone_error").data("check",true);
  $("#select").on("change", function() {
    bool = false;
    $("#kind").remove();
    var val = $(this).val();
    if(val =="sell" || val =="purchase" || val =="bargain_sell" || val =="bargain_pur" ){
      var inputTag = "<input id='kind' type='text' class='form-control' placeholder='원하는 차량의 이름을 입력'>";
      var $div = $(inputTag);
      $div.insertAfter($('#select'));
    }else if(val =="etc"){
      var msg = " 기타문의";
      $("#title").val(msg);
    }else{
      var msg = "제목 (상담 구분을 전부 선택하시면 자동으로 입력됩니다.)";
      $("#title").val(msg);
    }
  });

  $(document).on("change","#kind",function(event){
    if($("#select").val() == "sell"){
      var msg = $("#kind").val() + " 차량의 판매상담을 원합니다.";
    }else if($("#select").val() == "bargain_sell"){
      var msg = $("#kind").val() + " 차량의 가격흥정 신청(차량판매)";
    }else if($("#select").val() == "bargain_pur"){
      var msg = $("#kind").val() + " 차량의 가격흥정 신청(차량구매)";
    }else{
      var msg = $("#kind").val() + " 차량의 구매상담을 원합니다.";
    }
    $("#title").val(msg);
  });

  $("#btn1").click(function(){
    if(bool == false){
      if($("#select").val() == "yet"){
        alert("구분을 선택해주세요.");
        return false;
      }
      if(!$("#kind").val()){
        alert("희망하는 차종을 입력해주세요.");
        return false;
      }
    }
    if(!$("#content").val()){
      alert("내용 입력 후 다시 시도해주세요.");
      return false;
    }
    phone_c = $("#phone_error").data("check");
    if(!phone_c){
      alert("휴대폰번호를 형식에 맞게 입력 후 다시 시도해주세요.");
      return false;
    }
  });

  for(i=1; i<4; i++){
    $("#phone"+i).blur(function(){
      var phone = $("#phone1").val() + $("#phone2").val() + $("#phone3").val();
      var regex = /^01[016789][0-9]{7,8}$/;
      var test1 = regex.test(phone);
      if(!test1){
        var text ="*휴대폰번호를 형식에 맞게 입력해주세요.";
        var bool = false;
        var color = 'red';
      } else {
        var text = " 휴대폰 작성 완료. ";
        var color = 'black';
        var bool = true;
      }
      $("#phone_error").html(text);
      $("#phone_error").data("check",bool);
      $("#phone_error").css("color",color);
    });
  }
});
function cancel_check(){
  if(confirm('수정을 취소하시겠습니까?')){
    history.back();// 뒤로가기
  }
}
function delete_check(url){
  if(!confirm('정말로 삭제하시겠습니까?')){

  }else {
    location.href=url;
  }
}
