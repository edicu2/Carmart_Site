@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="css/page/community/community_style1.css">
<section>
  <article id="main1_visual">
    <div id="main1_wrap">
      <div id="main1_ment">
        <h4>갤러리, 핫딜상품 등의</h4>
        <h1>휴식 <b style="color:#add01e">커뮤니티</b></h1>
        <p>&nbsp&nbsp여러가지 제공된 자료들로 여러분들의<br />
         &nbsp&nbsp휴식을 도와드립니다.</p>
      </div>
    </div>
  </article>
  <div id="section_wrap">
    <aside id="side_visual">
      <h5>커뮤니티</h5>
      <ul>
        <li><a>자동차 용품  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ▶</a></li>
        <li><a href="{{ route('community2') }}" >자동차 인기뉴스</a></li>
        <li><a href="{{ route('community3') }}">자동차 갤러리</a></li>
        <li><a>이용후기</a></li>
      </ul>
    </aside>
    <article id="main2_visual">
      <div id="main2_wrap">
        <div id="main2_title">자동차 용품  <span style="font-size:0.7em; color:#add01e" > *실시간 업데이트 11번가 핫딜상품 !</span></div>
        <div id="main2_board">
          <table class="table">
            <thead>
              <tr>
                <!-- 평점 ,  -->

                <th>물건</th>
                <th>물건 이름</th>
                <th>가격</th>
                <th>평점</th>
              </tr>
            </thead>
            <tbody>
            @php
              $pageNum = isset($_REQUEST["page"])?$_REQUEST["page"]:1;
              $num = 10*($pageNum-1);

              for($i=0 ; $i< 10 ; $i++ ){
                 $satisfy = $apiResult->xpath('//BuySatisfy')[$i]/20;
                 $s_img = "";
                for($j=5; $j >=1 ; $j--){
                  if($j >= $satisfy)
                    $s_img .="☆";
                  else
                    $s_img .="★";
                }
                $priceResult = (int)$apiResult->xpath('//ProductPrice')[$i];
                $titleResult = substr($apiResult->xpath('//ProductName')[$i],0,100)."...";
            @endphp
                  <tr onclick="window.open('{{ $apiResult->xpath('//DetailPageUrl')[$i] }}','_blank')">
                   <td> <img src="{{ $apiResult->xpath('//ProductImage')[$i] }}"> </td>
                   <td> {!! $titleResult !!} </td>
                   <td> {{ number_format($priceResult)."원"  }} </td>
                   <td> {{ $s_img }} </td>
                  </tr>
            @php
              }
            @endphp


          </tbody>
        </table>
      </div>
      <div id="main2_Paging">

            @for($i=1 ; $i<= 5 ; $i++)
              @if($pageNum == $i)
                <a><b><font color="#FF3636">{{$i}}</font></b></a>
              @else
                <a href="?page={{$i}}"><b>{{$i}}</b></a>
              @endif
            @endfor
            @if($pageNum < 5 )
                    <a href="?page=5"><img src="/storage/layouts/last.png" /></a>
            @endif
      </div>
    </div>
  </article>
  </div>
</section>

  @endsection
