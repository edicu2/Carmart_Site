$(function(){
    
    if( $('#main_menu').find('li').length){
      $('div#not_search').hide();
    }else{
      $('#not_search').show();
    }
  $(document).on( 'click', 'select', function (){
    divide = $(this).prop('id');
    check = $(this);

    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        url:'/CategoryCheck',
        type:'POST',
        data: {
          divide : divide,
          check : check.val()
        },
        success:function(data){
          kind = check.parent().next();
          kind.children().remove('select');
          kind.children('div').hide();
          select =  $('<select />', {
	           id: data['divide'],
             name :data['divide'],
             size : '6',
          });
          kind.append(select);
          if(data['divide']== 'grade'){
            kind.children('select').prop('multiple','multiple');
          }
          data['list'].forEach(function(list,index){
            select.append("<option value='"+list[data['divide']]+"'>"+list[data['divide']]+"</option>");
          });
            kind.next().next().children().remove('select');
            kind.next().next().children('div').show();
            kind.next().children().remove('select');
            kind.next().children('div').show();
          console.log(data['list']);
        }
    });
  });

    $('#search_button').click(function (){

      category = $('#selection_form').serialize();
      $.ajax({
          url:'/DomesticSearch',
          type:'get',
          data: category,
          success:function(data){
            carList = $('div#main_menu').children('ul');
            carList.empty();
            console.log(data);
            if(data.length == 0){
              $('#not_search').show();
            }else{
                data.forEach(function(item,index){
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

});
// select 바꾸면 될거고
