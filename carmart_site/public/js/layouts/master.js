function bookmark_add() {
     bookmark_url  = "localhost/mainPage/mainPage.php";
     bookmark_name = "자동차 마켓";

     try {
      window.external.AddFavorite(bookmark_url,bookmark_name);
     } catch(e) {
      alert('이 브라우저는 즐겨찾기 추가 기능을 지원하지 않습니다.\n( Internet Explorer지원 )');
      return false;
     }
 }

 function set_start() {
   var agt = navigator.userAgent.toLowerCase();
   if(agt.indexOf("msie") != -1){
     document.body.style.behavior='url(#default#homepage)';
     document.body.setHomePage('localhost/mainPage/mainPage.php');
   } else{
     alert('이 브라우저는 시작페이지 설정 기능을 지원하지 않습니다.\n( Internet Explorer지원 )' );
     return false;
   }
 }

$(function(){
  $(document).on('click','a#rank_a',function(){
    $('input[name=search]').val($(this).html());
    $('#search_form').submit();
  });
});
