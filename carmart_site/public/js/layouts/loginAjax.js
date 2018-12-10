$(function() {
  var loginForm = $("#login_form");
    loginForm.submit(function(e){
    e.preventDefault();
    //var formData = $("#login_form").serialize();
    var formData = JSON.stringify({
      id:$("#login_form").find('[name=id]').val(), email:$('#email').val(),
      pwd : $("#login_form").find('[name=pwd]').val()
    });
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url:'/tLogin',
        type:'POST',
        data:formData,
        success:function(formData){
            data = JSON.parse(formData);
            ment = data['ment'];
            $ .alert( ment , "this is message" );
            setTimeout(function(){
              if( ment == '로그인 하였습니다.'){
                location.href = data['url'];
              }
            }, 500);
        }
    });
  });
});
