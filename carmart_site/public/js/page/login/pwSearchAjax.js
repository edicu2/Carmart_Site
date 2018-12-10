$(function() {

  $("#btn1").click(function(){
    name = $('#name').val();
    id = $('#id').val();
    email = $('#email').val();
    email2 = $('#email2').val();
    if( !name || !email || !email2 ){
      $ .alert( "양식을 모두 입력한 후 이용해주세요." , "this is message" );
      return false;
    }
  $ .alert( " 해당정보를 확인하고 있습니다." , "this is message" );
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url:'/PwSearchCheck',
        type:'POST',
        data:{
          name : name,
          id : id,
          email : email,
          email2 : email2
        },
        success:function(data){
          $ .alert( "  작성한 이메일로 전송을완료 하였습니다.  <br> (자동으로 홈페이지로 이동)" , "this is message" );
          setTimeout(function(){
            location.href = "/";
          } ,1000);
        },
        error:function(request,status,error){
          $ .alert( "  해당하는 정보가 없습니다. " , "this is message" );
        }
    });
  });
});
