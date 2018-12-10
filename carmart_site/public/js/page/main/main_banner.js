jQuery(function() {
  var rolling_time = 7000;
  var effect_time = 1500;

  var $rolling_img = $("#rolling_img > img");
  $rolling_img.not(":first").hide();

  setInterval(rolling, rolling_time);

  function rolling()
  {
      $visible_img = $rolling_img.filter(":visible");
      $visible_img.fadeOut(effect_time);

      $next_img = $visible_img.next();
      if ($next_img.length === 0) {
          $next_img = $rolling_img.filter(":first");
      }
      $next_img.fadeIn(effect_time);
  }
});
