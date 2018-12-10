$(function() {

  $('#purchase').click(function(){
    $(this).find('input[name=purchase]').val('1');
    $("#sell").find('input[name=sell]').val('0');
    $(this).css('background-color','#909090');
    $("#sell").css('background-color','#757575');
  });

  $('#sell').click(function(){
    $(this).find('input[name=sell]').val('1');
    $("#purchase").find('input[name=purchase]').val('0');
    $(this).css('background-color','#909090');
    $("#purchase").css('background-color','#757575');
  });

  $('#car1').change(function(){
    company = $(this).val();
    $.ajax({
        url:'/carKindSearch',
        type:'get',
        data:{
          company: company
        },
        success:function(data){
          model = $('#car2');
          model.empty();
          model.append("<option value=''>모델 선택</option>");
          console.log(data);
          data.forEach(function(item,index){
            model.append ("<option value="+item['kind']+">"+item['kind']+"</option>");
          });
        }
    });
  });

  $('button.nav-link').first().css('border','2px solid #adadad');
  $('button.nav-link').click(function(){
    $('button.nav-link').css('border','none');
    $(this).css('border','2px solid #afafaf');
    size=$(this).parent().index();
    $.ajax({
        url:'/carListUpdate',
        type:'get',
        data:{
          size: size
        },
        success:function(data){
          carList = $('div#main2_menu').children('ul');
          carList.empty();
          console.log(data);
          data.forEach(function(item,index){
            carList.append ("<li>"+
                                  "<a href='/CarSee/"+item['id']+"'>"+
                                  "<img src='/storage/carRegis_image/"+item['filename']+"'width='150px' height='110px' />"+
                                  "<div class='car_txt'>"+
                                      item['kind']+
                                    "<br />"+
                                    "<span class='car_price'>"+item['price']+"<span>만원</span></span>"+
                                  "</div>"+
                                  "</a>"+
                                 "</li>");
          })
        }
    });

  });
});
