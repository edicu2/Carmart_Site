$(function(){
  $(document).on( 'click', '#deleteComment', function () {
    id = $(this).siblings('span#user_id').html();
    comment = $(this).siblings('div#comment').html();
    root = "";
    thisBox = $(this).parents('div#comment2_ment').attr('id') || $(this).parent('div#comment_ment').attr('id');
    alert(thisBox);

    if(thisBox == 'comment2_ment'){
      $(this).parents('div#comment2_ment').remove();
      root = 0;
    }else {
      root = 1;
    }
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type : "post",
      url : "/CounselReCommentDel",
      data : {
        user_Id :  id,
        comment: comment,
        root : root
      },
      success : function(data) {
        if(root==1 )
          window.location.reload(true);

      }
    });


  });
});
