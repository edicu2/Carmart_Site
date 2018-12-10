@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="css/page/main/main_style.css">
<script src="js/page/main/main_banner.js"></script>
<script src="js/page/main/main_script.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<section>
    <aside id="fix_visual">
  @if(Session::get('divide') == 2)
      <div id="carRegis">
        <a href="{{route('carRegis')}}">
          <img src='/storage/layouts/carRegis_img.png' />
        </a>
      </div>
  @endif
      <div id="fix_wrap">
        <a href="{{route('domesticCar')}}"><div>
          <img src='/storage/layouts/fixbar_img1.png' />
        </div></a>
        <a href="{{route('globalCar')}}"><div>
          <img src='/storage/layouts/fixbar_img2.png' />
        </div></a>
        <a href="{{route('domesticCar')}}"><div>
          <img src='/storage/layouts/fixbar_img3.png' />
        </div></a>
        <div id="search_price">
          <div id="search_price_title">
            가격대별 검색
          </div>
          <div id="search_price_select">
            <div onclick="location.href='{{route('domesticCar3')}}?price1=0&price2=500'">0 ~<br /> 500만원</div>
            <div onclick="location.href='{{route('domesticCar3')}}?price1=500&price2=1000'">500 ~<br /> 1000만원</div>
            <div onclick="location.href='{{route('domesticCar3')}}?price1=1000&price2=1500'">1000 ~<br /> 1500만원</div>
            <div onclick="location.href='{{route('domesticCar3')}}?price1=1500&price2=2500'">1500 ~<br /> 2500만원</div>
            <div onclick="location.href='{{route('domesticCar3')}}?price1=2500&price2=4000'">2500 ~<br /> 4000만원</div>
            <div onclick="location.href='{{route('domesticCar3')}}?price1=4000&price2=10000'">4000만원<br /> 이상</div>
          </div>
        </div>

      </div>
    </aside>
    <aside id="main1_visual">
      <div id="main1_wrap">
        <div id="main1_slidebox">
          <ul id="slider">
            <li id="rolling_img">
              <img src="/storage/layouts/car_banner2.png" />
              <img src="/storage/layouts/car_banner1.png" />
              <img src="/storage/layouts/car_banner4.png" />
              <img src="/storage/layouts/car_banner5.png" />
              <img src="/storage/layouts/car_banner3.png" />
      		</li>
          </ul>
        </div>
        <div id="main1_councel_form">

          <div id="counsel_box">
            <form id="counsel_form" method="post" action="{{ route('counselSMS')}}">
               {{ csrf_field() }}
              <div>
                <ul id="p_s">
                  <li id="purchase"><input name="purchase" type="hidden" value="1"/>내차 구입</li>
                  <li id="sell"><input name="sell"  type="hidden" value="0"/>내차 판매</li>
                </ul>
              </div>
              <table id="info">
                <tr>
                  <td colspan=2>
                  <select id="car1" name="car1" class="form-control">
                    <option value="" >제조사 선택</option>
                  @foreach($kind_lists as $list)
                    <option value="{{ $list->company }}">
                       {{$list->company}}
                    </option>
                  @endforeach
                  </select>
                  </td>
                </tr>
                <tr>
                  <td colspan=2>
                    <select id="car2" name="car2" class="form-control">
                      <option value="">모델 선택</option>
                    </select>
                  </td>
                </tr>

                <tr>
                  <td>
                    <input name="checkbox" type="checkbox" id="info_p"   @if(old('checkbox')) checked @endif/>
                  </td>
                  <td>
                    <label for="info_p">개인정보 취급방침 동의</label>
                  </td>
                </tr>

                <tr>
                  <td colspan=2>
                    <input id="tel" type="tel" name="tel" placeholder=" 연락처" class="form-control" value="{{ old('tel') }}"/>
                  </td>
                </tr>

                <tr>
                  <td colspan=2>
                    <input id="submit" type="submit" value="상담신청하기" class="btn form-control btn-outline-dark" />
                  </td>
                </tr>
                </table>
            </form>
          </div>
          <!--<img src="../img\councel_img1.png" />-->
        </div>
      </div>
    </aside>

    <article id="main2_visual">
      <div id="main2_wrap">
        <div id="main2_menubar" class="navbar navbar-inverse">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <button class="nav-link" focus >전체</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >경차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >소형차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >준중형차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >중형차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >대형차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >RV/SUV</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >승합차</a>
            </li>
            <li class="nav-item">
              <button class="nav-link" >화물/트럭</a>
            </li>
          </ul>
        </div>

        <div id="main2_menu">
          <ul>
            @foreach($cPosts as $post)
            <li>
              <a href="/CarSee/{{$post->id}}">
                <img src="/storage/carRegis_image/{{$post->filename}}" width="150px" height="110px" />
                <div class="car_txt">
                  {{ $post->kind }}
                  <br />
                  <span class="car_price">{{ $post->price }}<span>만원</span></span>
                </div>
              </a>
            </li>
          @endforeach
          </ul>
        </div>
      </div>
    </article>

    <article>

    </article>
    <aside>

    </aside>
  </section>

@endsection
