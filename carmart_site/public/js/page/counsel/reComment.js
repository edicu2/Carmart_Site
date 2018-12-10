
$(function(){
  $( document ).on( 'click', '#dapreg', function () {
    commentreg =$( "#commentreg" ).clone();
    c_num = $(this).parent().attr('class');
    $(this).closest('div').after(commentreg).show();
    commentreg.wrap("<div id='comment2_ment' class='"+c_num+"'></div>");
    $(this).remove();
   });
});
