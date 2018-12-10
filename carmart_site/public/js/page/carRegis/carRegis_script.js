var num = [];
$(function(){
  $('#submit_button').hide();
  $(window).scroll(function(){
    var height = $(document).scrollTop();
    if(height >= 1150){
      if(!$('#submit_button').is(':visible'))
        $('#submit_button').show().animate({height:"50px"},100);
    }else{
      if($('#submit_button').is(':visible'))
        $('#submit_button').hide().animate({height:"0px"},400);
    }
  });

  $('#submit_button').on('click',function(){
      $('#category_wrap').submit();
  });


  $('form#my-dropzone').on({
      dragenter: function(e) {
          $('form#my-dropzone').css('background-image','url(/storage/layouts/drag1.png)');
      },
      dragleave: function(e) {
          $('form#my-dropzone').css('background-image','url(/storage/layouts/drag0.png)');
      },
      drop: function(e) {
          e.stopPropagation();
          e.preventDefault();
      },
      mouseup: function(e) {
          $('form#my-dropzone').css('background-image','url(/storage/layouts/drag0.png)');
      },
      mouseout: function(e) {
          $('form#my-dropzone').css('background-image','url(/storage/layouts/drag0.png)');
      }
  });

  $(document).on('change' ,'select#grade', function(){
    company = $('#company').val();
    model = $('#model').val();
    grade = $('#grade').val();
    carName = company +" "+model+" "+grade;
    $('#carName').html(carName);
  });


  $('#pre_apply').on('click', function(){
      pre_body = $('#pre_info_body').children('div')
      year =  $('[name="year"').val();
      pre_body.eq(0).children('span').eq(1).html(year);
      color =  $('[name="color"]').val();
      pre_body.eq(1).children('span').eq(1).html(color);
      distinct =  $('[name="distinct"]').val();
      pre_body.eq(0).children('span').eq(3).html(distinct);
      gear =  $('[name="gear"] option:selected').text();
      pre_body.eq(1).children('span').eq(3).html(gear);
      accident =  $('[name="accident"] option:selected').text();
      pre_body.eq(2).children('span').eq(1).html(accident);
      oil =  $('[name="oil"] option:selected').text();
      pre_body.eq(2).children('span').eq(3).html(oil);
      carNum=  $('[name="carnum"]').val();
      pre_body.eq(3).children('span').eq(1).html(carNum);
      price =  $('[name="price"]').val()+"만원";
      $('#carPrice').children('strong').text(price);
        $ .alert( "조건을 적용하였습니다.<br>아래의 페이지미리보기를 확인해주세요.","This is a default message" );
  });



  $(document).on('click', '#img_delete_button', function(){
    $('#sumnail_image_num').val($('#sumnail_image_num').val()-1);
    this_src = $(this).prev('img').prop('src');
    $(this).prev('img').attr('src','/storage/layouts/nophoto0.png');
    parentTag = $(this).parent('div.mySlides');
    alert(this_src);
    this_num = parentTag.index('div.mySlides');
    alert(this_num);
    $('#pre_car_img').find('img').eq(this_num).remove();
    $('#pre_content').find('img').eq(this_num).remove();
    num.splice(num.indexOf(this_num),1);
    $(this).remove();
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
      });
      $.ajax({
        type: "POST",
        url: "/carRegister/image_delete",
        data:{
          this_src : this_src,
        },
        success: function(data){
          console.log(data)
        },
        error:function(request,status,error){
          alert(request);
        }
      });
    });


  });





  function dropHandler(ev) {
    console.log('File(s) dropped');
    ev.preventDefault();
    var file = [];
    var img_num = [];
    if (ev.dataTransfer.items) {
      for (var i = 0; i < ev.dataTransfer.items.length; i++) {
        sunmail_img_num = $('[name=sumnail_image_num]').val();
        $('[name=sumnail_image_num]').val(parseInt(sunmail_img_num)+1);
        if (ev.dataTransfer.items[i].kind === 'file') {
          for(var j=0; j<20 ;j++){
            if(num.indexOf(j) == -1){
              console.log(j);
              num.push(j);
              img_num.push(j);
              file.push(ev.dataTransfer.items[i].getAsFile());
              break;
            }
          }
        }
      }
    }
    var sData = new FormData();
    for(i=0 ; i < file.length ; i++){
      sData.append("upload"+i , file[i]);
      sData.append('img_num'+i,img_num[i]);
    }
    sData.append('img_size',file.length);
    console.log(sData);
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    });
    $.ajax({
      type: "POST",
      url: "/carRegister/image_upload",
      data:
        sData,
      contentType: false,
      processData: false,
      success: function(data){
        $ .alert( " 사진을 등록하였습니다.<br> 아래의 페이지미리보기를 확인해주세요.","This is a default message" );
        console.log(data)

        for(var i=0; i < data['upload_successes'].length; i++){
          $('#preSumnail').find('div').eq(img_num[i]).find('img').attr(
            {"src":"/storage/"+data['upload_successes'][i],
             "width":"76px",
             "height":"64px",
            });
            $('#preSumnail').find('div').eq(img_num[i])
            .append("<button id='img_delete_button'>x</button>");
            $('#preview').find('img').attr('src',"/storage/"+data['upload_successes'][i]);
              $('div.text').html((i+1)+ " / 20");
            $('#pre_car_img').append("<img src="+"/storage/"+data['upload_successes'][i]+">");
          }
      },
      error:function(request,status,error){
        alert(error);
      }
    });
    removeDragData(ev);
  }


  function dragOverHandler(ev) {
    console.log('File(s) in drop zone');
    ev.preventDefault();
  }



  function removeDragData(ev) {
    console.log('Removing drag data');

    if (ev.dataTransfer.items) {
      ev.dataTransfer.items.clear();
    } else {
      ev.dataTransfer.clearData();
    }
  }
