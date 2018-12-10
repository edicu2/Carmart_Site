
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=0">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>jQuery Smooth Gallery Plugin Example</title>
	<link rel="stylesheet" type="text/css" href="css/page/community/smoothgallery.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

	<style type="text/css">
	body {

	  font-family: sans-serif;
	}

	.demo-wrap {
	  max-width: 960px;
	  margin: 0 auto;
	}

	.button {
	  text-decoration: none;
	  color: #F0353A;
	  border: 2px solid #F0353A;
	  padding: 6px 10px;
	  display: inline-block;
	  font-size: 18px;
	}

	.button:hover {
	  background: #F0353A;
	  color: #fff;
	}
	</style>
</head>
<body>
	<div class="sg" style="width:800px;margin:10 auto">
		<?php foreach ($result as $item) : ?>
	  <div class="sg-item"> <a href="<?='/storage/galleryPicture/'.$item["name"]?>" title="갤러리 이미지_<?=$item['name']?>"><img src=" <?='/storage/galleryPicture/'.$item["name"]?>"></a> <br>
	  </div>
	  <?php endforeach ?>
	</div>
	<br>
	<div class="sg-paginate"> <a href="#" class="sg-up">▲</a><a href="#" class="sg-down">▼</a> </div>
	<br>
	<br>


<script type='text/javascript' src="js/page/community/smoothgallery.min.js"></script>
<script type="text/javascript">
$(window).load( function() {
    // use default options
    $(document).smoothGallery({
        animSpeed:400,
        delaySpeed:50,
        visibleRows: 3,
        animEasing: 'easeOutQuart'
    });
});
</script>

</body>
</html>
