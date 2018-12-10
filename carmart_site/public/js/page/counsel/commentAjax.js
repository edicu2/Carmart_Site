$(function(){
  $(document).on( 'click', '#reg', function () {

    tag = $(this);
    preNum = $(this).parents("div#comment2_ment").attr('class');
    preTag = tag.parents('div#comment2_ment').siblings('div.'+preNum);
    comment = tag.parents('div#commentregButtons').prev('textarea#commentArea').val().replace(/\n/g, "<br>");
    preComment="";
    preId="";

    if(!$('#commentArea').val()){
      $ .alert( "댓글을 입력 후 등록해주세요." , "this is message" );
      return false;
    }
    if(preTag.attr('id') == 'comment_ment'){
      preId = preTag.children().eq(1).html();
      preComment = preTag.children().eq(2).html();
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
        preId :  preId,
        preComment: preComment,
        comment : comment
      },
      success : function(data) {
        $ .alert( "댓글 등록완료." , "this is message" );
        if(tag.parents('div#comment2_ment').attr('id') == "comment2_ment" || tag.parents('div#comment2_ment').attr('id') == "comment_ment"){
          comment =
          "<div id='comment2_ment' class='"+data['preBoard']+"'>"+
              $("#profile").html()+
              "<div id='comment'>"+
                  data['comment']+
              "</div>"+
              "<div id='create_at'>"+
                  data['createdTime']+
              "</div>"+
              "<input id='deleteComment' type='button' value='삭제'>"+
          "</div>"+
          "<div id='comment2_ment'>"+
              "<input id='dapreg' type='button' value='댓글'>"+
          "</div>";
          tag.parents('div#comment2_ment').after(comment).show();
          tag.parents('div#comment2_ment').remove();

        }else{
          comment =
          "<div id='comment_ment' class='"+data['preBoard']+"'>"+
              $("#profile").html()+
              "<div id='comment'>"+
                  data['comment']+
              "</div>"+
              "<div id='create_at'>"+
                  data['createdTime']+
              "</div>"+
              "<input id='deleteComment' type='button' value='삭제'>"+
          "</div>"+
          "<div id='comment2_ment'>"+
              "<input id='dapreg' type='button' value='댓글'>"+
          "</div>";
          $("#regMove").after(comment).show();
        }
        $("#commentArea").val("");
      }
    });
  });
});
