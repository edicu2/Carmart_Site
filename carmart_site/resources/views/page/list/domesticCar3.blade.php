@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="css/page/list/domestic_style3.css">
<script src="/js/page/list/domestic_script3.js"></script>
<section>
  <div id="section_wrap">
    <aside id="side_visual">
      <h5>차량검색</h5>
      <ul>
        <li><a href="{{ route('domesticCar') }}" >국산차 </a></li>
        <li><a href="{{ route('globalCar') }}">수입차 </a></li>
        <li><a href="{{ route('domesticCar2') }}" >국산차 차종별검색</a></li>
        <li><a href="{{ route('globalCar2') }}">수입차 차종별검색</a></li>
        <li><a href="{{ route('domesticCar3') }}">가격대별검색 ▶</a></li>
      </ul>
    </aside>
    <article id="main1_visual">
      <form id="selection_form" action="{{route('domesticCar3')}}" method="get" >
        <ul id="selection_tap">
          <li><a href="{{route('domesticCar')}}">제조사별 검색</a></li>
          <li><a href="{{route('domesticCar2')}}">차종별 검색</a></li>
          <li><a href="{{route('domesticCar3')}}">가격대별 검색</a></li>
        </ul>
        <div id="selection_category">
          <a href="{{route('domesticCar3')}}?price=0,200">200만원 이하</a>
          <a href="{{route('domesticCar3')}}?price=200,400">200만원 ~ 400만원</a>
          <a href="{{route('domesticCar3')}}?price=400,600">400만원 ~ 600만원</a>
          <a href="{{route('domesticCar3')}}?price=600,800">600만원 ~ 800만원</a>
          <a href="{{route('domesticCar3')}}?price=800,1000">800만원 ~ 1000만원</a>
          <a href="{{route('domesticCar3')}}?price=1000,1500">1000만원 ~ 1500만원</a>
          <a href="{{route('domesticCar3')}}?price=1500,2000">1500만원 ~ 2000만원</a>
          <a href="{{route('domesticCar3')}}?price=2000,2500">2000만원 ~ 2500만원</a>
          <a href="{{route('domesticCar3')}}?price=2500,3000">2500만원 ~ 3000만원</a>
          <a href="{{route('domesticCar3')}}?price=3000">3000만원 이상</a>
        </div>
        <div id="selection_category2">
          <b style="color:black"> 가격 직접 입력 : </b>
          <input id="start_price"  name="price1" type="number" /> 만원 ~
          <input id="finish_price" name="price2" type="number" /> 만원
          <input id="search_button" type="submit" value="차량검색   "/>
        </div>
      </form>
    </article>
    <article id="main2_visual">
    @if( $price[0] == null )
      <div id="search_ment">
        <h1> <span style='color:#adde14'>차량</span>을 검색해주세요.</h1>
        <h6>위의 검색창을 이용하시면 중고차마켓에서 제공하는</h6>
        <h6>다양한 차량을 조회하실 수 있습니다.</h6>
      </div>
    @else
      @if(count($cregs)>0)
      <div id="main_menu">
        <div id="search_title">
          검색한 매물
        </div>
        <ul>
        @foreach($cregs as $creg)
          <li>
            <a href='#'>
              <img src='/storage/cBoardImg/{{ $creg->id}}.jpg' width='150px' height='110px' />
              <div class='car_txt'>
                {{ $creg->kind}}
                <br />
                <span class='car_price'>{{ $creg->price }}<span>만원</span></span>
              </div>
            </a>
          </li>
        @endforeach
        </ul>
      @else
        <div id="not_search">
          <div id="not_search_ment">
            <h1> <span style='color:#adde14'>검색한 차량</span>은 없는 매물입니다.</h1>
            <h6>위의 검색창을 다시 이용하여 중고차마켓에서 제공하는</h6>
            <h6>다양한 차량을 조회하실 수 있습니다.</h6>
          </div>
        </div>
      </div>
      @endif
    @endif
    </article>
  </div>
</section>

@endsection
