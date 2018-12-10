$(function() {
  var loginForm = $("#login_formP");
    loginForm.submit(function(e){
    e.preventDefault();

    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url:'/PLogin',
        type:'POST',
        data:{
             "id" : $("#login_formP").find('[name=id]').val(),
             "pwd" : $("#login_formP").find('[name=pwd]').val(),
             "auto_id" : $("#login_formP").find('[name=auto_id]').val(),
             "auto_login" : $("#login_formP").find('[name=auto_login]').val()
        },
        success:function(formData){
          $ .alert( formData , "this is message" );
          if( formData == '로그인 성공!'){
            location.href = "/";
          }
        },
        error:function(request,status,error){
             alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
  });
});
