// 생성자
$(function() {
  // Page3

  if($('#email1').val() !="" ){
    $('#email1').data('check',true);
    $('#email2').data('check',true);
  };


  $("#btn1").click(function() {
    var check = {
      'id':'아이디',
      'pwc':'비밀번호',
      'name':'이름',
      'email1':'이메일',
      'email2':'이메일',
      'phone1':'휴대폰 번호',
      'phone2':'휴대폰 번호',
      'phone3':'휴대폰 번호',
      'resms1':'sms수신 여부',
      'company':'소속회사명',
      'upload_name':"증명 사진 업로드",
      'postcode':'주소',
      'address':'주소',
      'address2':'주소'
    };
    len = 0;
    h_display = $("#hidden").css('display');
    for(var key in check){
      var c=$('#'+key);
      if(!c.data('check') || key =='resms1'){
        if(key=="resms1"){
        }else if(!c.data('check')) {
          alert(check[key] + TOTAL_ERROR_WORD );
          return false;
        }
      }
      if((h_display == undefined && len==8) || (h_display == "block" && len==13)){
        registerRequest();
        return false;
      }
      len+=1;
    }
  });

  function registerRequest(){
    $ .alert( " 해당정보를 확인하고 있습니다." , "this is message" );
    $.ajax({
      url: '/regisRequestCheck',
      type: 'post',
      data: {
        _token : $('meta[name="csrf-token"]').attr('content'),
        "id" : $('#id').val(),
        "pwc" : $('#pwc').val(),
        "name" : $('#name').val(),
        "email" : $('#email1').val()+"@"+$('#email2').val(),
        "phone" : $('#phone1').val()+ $('#phone2').val()+$('#phone3').val(),
        "sms" : $('#resms1').val(),
        "company" : $('#company').val(),
        "upload_name" : $('#upload_name').val(),
        "postcode" : $('#postcode').val(),
        "address1" : $('#address').val(),
        "address2" : $('#address2').val()
      },
      success: function(data) {
        window.location.href="/register4";
        $("#id").data('check', bool);
        $("#id_error").html(msg);
        $("#id_error").css({color: color});
      }

    });

  }


  $('#id').keyup(function() {
    var text = $(this).val();
    var regex = /^[a-z]+[a-z0-9]{3,11}$/g;
    if (regex.test(text)) {
      msg = ID_OVERLAP_CHECK_PLEASE_WORD;
    } else {
      msg = ID_GRAMMER_WORD;
    }
    $(this).data('check', false);
    $("#id_error").html(msg);
  });


  $('#idc').click(function() {
    $.ajax({
      url: '/IdDuplicationCheck',
      type: 'post',
      data: {
        _token : $('meta[name="csrf-token"]').attr('content'),
        "id": $("#id").val()
      },
      success: function(data) {
        if (data == 1) {
          msg = ID_OK_WORD;
          bool = true;
          color = "black";
        } else if (data == 2) {
          msg = ID_ERROR_OVERLAP_WORD;
          bool = false;
          color = "red";
        } else {
          msg = ID_ERROR_EMPTY_WORD;
          bool = false;
          color = "red";
        }
        $("#id").data('check', bool);
        $("#id_error").html(msg);
        $("#id_error").css({color: color});
      }
    });
  });

  $('#pwd').keyup(function() {
    var text1 = $(this).val();
    // 6글자 이상 소문자 대문자 , 숫자 , 특수문자가 모두 포함되어야한다 .
    if (/[a-z]/.test(text1) && /[A-Z]/.test(text1) && /[0-9]/.test(text1) && /[^a-zA-Z0-9]/.test(text1) && /^\s*(?:\S\s*){6,12}$/.test(text1)) {
      bool = true;
      msg = PW_OK_WORD;
    } else {
      bool = false;
      msg = PW_GRAMMER_WORD;
    }
    $(this).data('check', bool);
    $("#pwd_error").html(msg);

    // email 뒤쪽을 먼저 적고 앞쪽을 적게 될 때
    var pwc = $("#pwc");
    var pwc_err = $('#pwc_error');
    var text2 = pwc.val();
    if (text2) {
      if (!(text2 == text1)) {
        bool = false;
        color = "red";
        msg = PWC_ERROR_WORD;
      } else {
        bool = true;
        color = "black";
        msg = PWC_OK_WORD;
      }
      pwc.data('check', bool);
      pwc_err.css({color: color});
      pwc_err.html(msg);

    }
  });

  $('#pwc').keyup(function() {
    var text1 = $("#pwd").val();
    var text2 = $(this).val();
    if (text1 == text2) {
      bool = true;
      color = "black";
      msg = PWC_OK_WORD;
    } else {
      bool = true;
      color = "red";
      msg = PWC_ERROR_WORD;
    }
    $(this).data('check', bool);
    $("#pwc_error").css({color: color});
    $("#pwc_error").html(msg);
  });

  $('#name').blur(function() {
    var text = $(this).val();
    if (text) {
      $(this).data('check', true);
    } else {
      $(this).data('check', false);
    }
  });

  $('#email2').blur(function() {
    var text1 = $('#email1').val();
    var text2 = $(this).val();
    var regex1 = /^[a-zA-Z0-9]*$/;
    var regex2 = /[a-zA-Z0-9-]{3,}([.][a-zA-Z]{2,}){1,}$/;
    if (regex1.test(text1) && regex2.test(text2)) {
      bool = true;
      msg = EMAIL_OK_WORD;
    } else {
      bool = false;
      msg = EMAIL_ERROR_WORD;
    }
    $("#email1").data('check', bool);
    $(this).data('check', bool);
    $("#email_error").html(msg);
  });

  $('#select').change(function() {
    var text1 = $('#email1').val();
    var text2 = $('#email2').val();
    var select = $('#select').val();
    $('#email2').val(select);
    if (select != '직접입력') {
      if (text1) {
        bool1 = true;
        msg = EMAIL_OK_WORD;
      } else {
        bool1 = false;
        msg = EMAIL_ERROR_WORD;
      }
      bool2 = true;
    } else {
      bool2 = false;
    }
    $("#email1").data('check', bool1);
    $("#email2").data('check', bool2);
    $("#email_error").html(msg);
  });

  for (i = 1; 4 > i; i++) {
    $('#phone' + i).blur(function() {
      var text1 = $("#phone1").val();
      var text2 = $("#phone2").val();
      var text3 = $("#phone3").val();
      var regex1 = /^01[016789]/;
      var regex2 = /[0-9]{3,4}$/;

      if (regex1.test(text1) && regex2.test(text2) && regex2.test(text3)) {
        bool = true;
        msg = PHONE_OK_WORD;
      } else {
        bool = false;
        msg = PHONE_ERROR_WORD;
      }
      $("#phone1").data('check', bool);
      $("#phone2").data('check', bool);
      $("#phone3").data('check', bool);
      $("#phone_error").html(msg);
    });
  }

  $('#company').blur(function() {
    var com_value = $(this).val();
    if (com_value) {
      bool = true;
    } else {
      bool = false;
    }
    $(this).data('check', bool);
  });

  $('#upload_hidden').change(function() {
    var formData = new FormData();
    formData.append("upload", $("#upload_hidden")[0].files[0]);
    formData.append("id",$("#id").val());

    if($('#id').data('check') == true){
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          type: "POST",
          url: "register3/addFile",
          data: formData,
          contentType: false,
          processData: false,
          success: function(data){
            alert(data);
            var filename = $('#upload_hidden')[0].files[0].name;
            $('#upload_hidden').siblings('#upload_name').val(filename);
            $('#upload_name').data('check', true);
          },
          error:function(request,status,error){
               alert("업로드 실패");
          }
      });
    }else {
      alert("ID확인 후 사진을 입력해주세요.");
    }
  });


  $('#address2').change(function() {
    var addr2_value = $(this).val();
    if (addr2_value) {
      bool = true;
    } else {
      bool = false;
    }
    $('#address2').data('check', bool);
  });

  $('#resms1').data('check', true);

  $('#resms1').click(function() {
    $('#resms1').val('Y');
  });
  $('#resms2').click(function() {
    $('#resms1').val('N');
  });

});
