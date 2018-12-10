//script 만들기
var script = document.createElement("script");
script.src = "../inputConst.js";
document.getElementsByTagName("head")[0].append(script);

$(function() {
  $('#upload_hidden').change(function() {
    var sData = new FormData();
    sData.append("upload", $("#upload_hidden")[0].files[0]);
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: "/Community3/addFile",
      data: sData,
      contentType: false,
      processData: false,
      success: function(data){
        alert(data);
        window.location.href="/Community3";
      },
      error:function(request,status,error){
           alert(error);
      }
    });
  });
});
