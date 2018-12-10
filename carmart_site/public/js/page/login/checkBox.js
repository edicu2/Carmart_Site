
$(function() {
  $('#auto_id').on("change", function() {
    if($('#auto_id').is(":checked")){
      $('#auto_id').val('true');

    }else {
      $('#auto_id').val("false");

    }
  });

  $('#auto_login').on("change", function() {
    if($('#auto_login').is(":checked")){
      $('#auto_login').val('true');

    }else {
      $('#auto_login').val("false");

    }
  });
});
