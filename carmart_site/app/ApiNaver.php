<?php
namespace App;
  class ApiNaver {
    private static $status_code ;
    private static $search_result;
    public function __construct(){
      $client_id = "wZAlHMEkSXN9h9CfsWE8";
      $client_secret = "FqULTHmdqI";
      $encText = urlencode("출시 신차");
      $url = "https://openapi.naver.com/v1/search/news.json?query=".$encText."&sort=date&start=1&display=15";
      $is_post = false;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POST,$is_post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      $headers = array();
      $headers[] = "X-Naver-Client-Id: ".$client_id;
      $headers[] = "X-Naver-Client-Secret: ".$client_secret;
      curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
      $response = curl_exec($ch);
      self::$search_result = json_decode($response, true);
      self::$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
    }
    public static function getApiJson(){
      if(self::$status_code == 200) {
        return self::$search_result["items"];
        //foreach($this->search_result["items"] as $items) {
        //  print $items['title']."<br />";
        //  print $items['link']."<br />";
        //}
      }
    }
  }
?>
