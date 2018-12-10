$(function(){
  $('#reg').click(function(){

    if(!$('#commentArea').val()){
      $ .alert( "댓글을 입력 후 등록해주세요." , "this is message" );
      return false;
    }
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type : "post",
      url : "/CounselCommentReg",
      data : {
        comment : $("#commentArea").val().replace(/\n/g, "<br>")
      },
      success : function(data) {
        // comment_ment 만들고 그다음 tag를 추가 하기
        $ .alert( "댓글 등록완료." , "this is message" );
        commentBox = "<div id='comment_ment'> </div>";
        comment =
        "<div id='comment2_ment'>"+
            $("#profile").html()+
            "<div id='comment'>"+
                data['comment']+
            "</div>"+
            "<div id='create_at'>"+
                data['createdTime']+
            "</div>"+
            "<input id='dapreg' type='button' value='답글'>"+
        "</div>";
        $(this).closest("#commentreg").remove();
        //$(this).closest("#comment2_ment").append(comment).show();
      }
    });
  });
});
