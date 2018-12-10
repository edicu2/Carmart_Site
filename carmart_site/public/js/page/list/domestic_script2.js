$(function(){

  $('#search_title').hide();
  $('#not_search').hide();

  $('#category_img').children('li#category_size').click(function(){
    index = $(this).index();
    preindex = $('#size').val()-1;
    $(this).css({
      'background-image':"/storage/layouts/category_img.png",
      'background-position':"-"+105*index+"px 110px"
    });
      $('#category_img').children('li#category_size').eq($('#size').val()-1).css({
        'background-image':"/storage/layouts/category_img.png",
        'background-position':"-"+105*(preindex)+"px 0px"
      });

    $('#size').val($(this).val());
    if(index == preindex){
      $('#size').val('no');
    }
    $.ajax({
        url:'/DomesticSearch2_1',
        type:'get',
        data: {
          size:$('#size').val()
        },
        success:function(data){
          $('#graybox').empty();
          data['cregs'].forEach(function(item, index){
            $('#graybox').append("<label><input type='radio' name='kind' value='"+item['kind']+"' /> "+item['kind']+"</label>");
          });
        }
      });
  });

  $('#search_button').click(function (){

    category = $('#selection_form').serialize();
    size = $('#size').val();
    $.ajax({
        url:'/DomesticSearch2_2',
        type:'get',
        data: category,
        success:function(data){
          carList = $('div#main_menu').children('ul');
          carList.empty();
          console.log(data);
          if(data['cregs'].length == 0){
            $('#not_search').show();
          }else{
            $('#search_recode').append("<form><li>"+
                                        "<div><b>"+data['cregs'][1]['size']+'</b></div>'+
                                        "<div>"+data['kind']+'</div>'+
                                        "<input type='hidden' name='kind'  value='"+ data['kind'] +"'>"+
                                        "<input type='hidden' name='size'  value='"+ data['size'] +"'>"+
                                        "<input type='hidden'  name='oil'  value='"+ data['oil']  +"'>"+
                                        "<input type='hidden' name='year'  value='"+ data['year'] +"'>"+
                                        "<input type='hidden' name='price' value='"+ data['price']+"'>"+
                                        "<img src='/storage/layouts/car_num"+size+".png'>"+
                                      "</li></form>");
              data['cregs'].forEach(function(item,index){
                carList.append("<li>"+
                              "<a href='/CarSee/"+item['id']+"'>"+
                                "<img src='/storage/carRegis_image/"+item['filename']+"'width='150px' height='110px' />"+
                                "<div class='car_txt'>"+
                                  item['kind']+
                                  "<br />"+
                                  "<span class='car_price'>"+item['price']+"<span>만원</span></span>"+
                                "</div>"+
                                "</a>"+
                              "</li>");
            });
            $('#not_search').hide();
          }
          $('#search_ment').remove();
          $('#search_title').show();
        }
    });
  });

  $(document).on('click','div#search_recode form',function(){
     category = $(this).serialize();
    $.ajax({
        url:'/DomesticSearch2_2',
        type:'get',
        data: category,
        success:function(data){
          carList = $('div#main_menu').children('ul');
          carList.empty();
          data['cregs'].forEach(function(item,index){
            carList.append("<li>"+
                            "<a href='#'>"+
                            "<img src='/storage/cBoardImg/"+item['id']+".jpg' width='150px' height='110px' />"+
                            "<div class='car_txt'>"+
                              item['kind']+
                              "<br />"+
                              "<span class='car_price'>"+item['price']+"<span>만원</span></span>"+
                            "</div>"+
                            "</a>"+
                          "</li>");
          });
        }
    });
  });
});
// select 바꾸면 될거고
