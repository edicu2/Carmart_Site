<?php
namespace App;
class Api11st {
  private $load_string ;
  public function __construct($page){
   $key = "167c2f55ce400f33d6191e5bbea6f32c";
   $encText = urlencode("car");
   $url = "https://openapi.11st.co.kr/openapi/OpenApiService.tmall?key=".$key."&apiCode=ProductSearch&keyword=".$encText."&sortCd=CP&pageSize=20&pageNum=".$page;

   $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https 접속시
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL, $url);
    $url_source = curl_exec($ch);
    $this->load_string = simplexml_load_string($url_source);
    curl_close($ch);
  }

  function getApiXml(){
    return $this->load_string;
  }

//  for ($i=0 ; $i < 15 ; $i++ ){
//    print  $load_string->xpath('//ProductName')[$i]."<br>";
//    print  $load_string->xpath('//ProductPrice')[$i]."<br>";
//    print  $load_string->xpath('//ProductImage')[$i]."<br>";
//    print  $load_string->xpath('//DetailPageUrl')[$i]."<br>";
//    print  $load_string->xpath('//ProductName')[$i]."<br><br>";
//  }
//echo  $load_string->xpath('//ProductName')[0];
}
?>
