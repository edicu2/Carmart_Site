$(function() {
  $("#logoutPage_move").on("click", function(e) {
    e.preventDefault();
    $.ajax({
        url:'/tLogout',
        type:'GET',
        success:function(data){
          //setTimeout(function(){return "";},2500);
          if( data['ment'] == "로그아웃하였습니다.!"){
            $ .alert( data["ment"] , "this is message" );
            setTimeout(3000);
            location.href = data['url'];
          }
        }
    });
  });
});
