@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="css/page/list/searchCar_style.css">
<script src="/js/page/list/searchCar_script.js"></script>
<section>
  <div id="section_wrap">
    <aside id="side_visual">
      <h5>차량검색</h5>
      <ul>
        <li><a href="{{ route('domesticCar') }}" >국산차</a></li>
        <li><a href="{{ route('globalCar') }}">수입차 </a></li>
        <li><a href="{{ route('domesticCar2') }}" >국산차 차종별검색</a></li>
        <li><a href="{{ route('globalCar2') }}">수입차 차종별검색</a></li>
        <li><a href="{{ route('domesticCar3') }}">가격대별검색</a></li>
      </ul>
    </aside>
    <article id="main1_visual">
      <form id="selection_form" method="post" >
        <input type="hidden" name="send" value=" " >
        {{ csrf_field() }}
        <ul id="selection_tap">
          <li><a href="{{route('domesticCar')}}">제조사별 검색</a></li>
          <li><a href="{{route('domesticCar2')}}">차종별 검색</a></li>
          <li><a href="{{route('domesticCar3')}}">가격대별 검색</a></li>
        </ul>
        <div id="selection_category">
          <table>
            <tr>
              <td>
                <div>제조사</div>
              </td>
              <td>
                <div>대표모델</div>
              </td>
              <td>
                <div>세부모델</div>
              </td>
              <td>
                <div>등급</div>
              </td>
            </tr>
            <tr>
              <td>
                <select id='company' name='company' size='6' style="width:145px">
              @foreach($company_lists as $list)
                  <option value="{{ $list->company }}" > {{$list->company}} </option>
              @endforeach
                </select>
              </td>
              <td>
                <div> 제조사를 선택하시면<br /> 리스트가 나타납니다.</div>
              </td>
              <td>
                <div> 대표모델을 선택하시면<br /> 리스트가 나타납니다.</div>
              </td>
              <td>
                <div> 세부모델을 선택하시면<br /> 리스트가 나타납니다.<br /> (ctrl + click 으로 다중선택가능)</div>
              </td>
            </tr>
          </table>
        </div>
        <div id="selection_category2">
          연식&nbsp
          <select id="year" name='year' style="width:140px">
            <option value='' selected>- 년도 선택  - </option>
            <option value='2000,2005'>2000년 ~ 2005년</option>
            <option value='2006,2010'>2006년 ~ 2010년</option>
            <option value='2011,2015'>2011년 ~ 2015년</option>
            <option value='2016,2018'>2016년 ~ 2018년</option>
          </select>
          가격&nbsp
          <select id="price" name='price' >
            <option value='' selected>- 가격 선택  - </option>
            <option value='100,1000'>100만 ~ 1000만</option>
            <option value='1000,2000'>1000만 ~ 2000만</option>
            <option value='2000,3000'>2000만 ~ 3000만</option>
            <option value='3000,5000'>3000만 ~ 5000만</option>
            <option value='5000,10000'>5000만 ~ 10000만</option>
          </select>
          연료&nbsp
          <select id="oil" name='oil'>
            <option value='' selected>- 연료 선택  - </option>
            <option value='gasolin'>휘발유</option>
            <option value='diesel'>경유</option>
            <option value='lpg'>LPG</option>
            <option value='gl'>가솔린LPG겸용</option>
            <option value='hybrid'>하이브리드</option>
          </select>
          변속기&nbsp
          <select id="gearbox" name='gearbox'>
            <option value='' selected>- 변속기 선택  - </option>
            <option value='auto'>오토</option>
            <option value='hand'>수동</option>
          </select>
          <input id="search_button" type="button" value="차량검색   "/>
        </div>
      </form>
    </article>
    <article id="main2_visual">
      <div id="main_menu">
        <div id="search_title">
          검색한 매물
        </div>
        <ul>
          @foreach($cregs as $creg)
          <li>
            <a href="/CarSee/{{$creg->id}}">
              <img src="/storage/carRegis_image/{{$creg->filename}}" width="150px" height="110px" />
              <div class="car_txt">
                {{ $creg->kind }}
                <br />
                <span class="car_price">{{ $creg->price }}<span>만원</span></span>
              </div>
            </a>
          </li>
        @endforeach
        </ul>

        <div id="not_search">
          <div id="not_search_ment">
            <h1> <span style='color:#adde14'>검색한 차량</span>은 없는 매물입니다.</h1>
            <h6>위의 검색창을 다시 이용하여 중고차마켓에서 제공하는</h6>
            <h6>다양한 차량을 조회하실 수 있습니다.</h6>
          </div>
        </div>

      </div>
    </article>
  </div>
</section>

@endsection
