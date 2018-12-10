@extends('layouts.master')

@section('content1')

<link rel="stylesheet" href="/css/page/carSee/carSee_style.css">
<script src="/js/page/carSee/carSee_script.js"></script>
  <section>
      <div id="carRegis_preview">
        <div id="carRegis_bar">
          <div>
            <a href="#" style="color:white; background-color:#373737">표지</a>
            <a href="#">차량설명</a>
            <a href="#">차량사진</a>
            <a href="#">보증내용</a>
            <a href="#">동일한 차량매물</a>
          </div>
        </div>
        <div id="pre_img">
          <div id="preview" class="slideshow-container fade">
            <img src="/storage/carRegis_image/{{$car_img[0]->filename}}" width="420px" height="315px"/>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="text"> 1 / 20</div>
          </div>
          <div id="preSumnail">
            @foreach ($car_img as $img)
            <div class="mySlides">
              <img src="/storage/carRegis_image/{{ $img->filename }}" width='76px' height="64px"/>
            </div>
            @endforeach
            @for($i=0 ; $i < (20-$car_info->sumnail_img) ; $i++)
            <div class="mySlides">
              <img src="/storage/layouts/nophoto0.png" width='76px' height="64px"/>
            </div>
            @endfor
          </div>
        </div>
        <div id="pre_info">
          <div id="pre_info_title">
            <div id="carName">
              {{$car_info->company}} {{$car_info->model}} {{$car_info->grade}}
            </div>
            <div id="carPrice">
              <span>차량가격</span>  <strong>{{ $car_info->price}}만원</strong><span><img src="/storage/layouts/icon_install.png"/> <img src="/storage/layouts/icon_36.png"/> &nbsp; {{ceil($car_info->price/36*1.1)}}만원</span>
            </div>
          </div>
          <div id="pre_info_body">
            <div>
               <span>연식</span> <span>{{$car_info->year}}년</span>
               <span>주행거리</span> <span>{{ $car_info->distinct}}km</span>
            </div>
            <div>
              <span>색상</span> <span>{{$car_info->color}}</span>
              <span>변속기</span> <span>{{ trans("user_definition.$car_info->gearbox") }}</span>
            </div>
            <div>
              <span>사고</span> <span>{{ trans("user_definition.accident.$car_info->accident") }}</span>
              <span>연료</span> <span>{{ trans("user_definition.oil.$car_info->oil") }}</span>
            </div>
            <div>
              <span>차량번호</span> <span>{{ $car_info->carnum}}</span>
            </div>
          </div>
          <div id="sell_profile">
            <div id="profile_img" >
              <img src="/storage/MemberPicture/{{$user_info->user_id}}.jpg" width="150px" height="150px";/>
            </div>
            <div id="profile">
              <div>판매자   <b>{{$user_info->name}}</b></div>
              <div>연락처   <strong> {{$user_info->phone}}</strong></div>
              <div id="ment">
                판매자와의 연락을 통해 좋은 결과 있기를 바랍니다.
              </div>
            </div>
          </div>
          <div id="counsel"></div>
        </div>
        <div id="carRegis_bar">
          <div>
            <a href="#">표지</a>
            <a href="#" style="color:white; background-color:#373737">차량설명</a>
            <a href="#">차량사진</a>
            <a href="#">보증내용</a>
            <a href="#">동일한 차량매물</a>
          </div>
        </div>
        <div id="pre_content">
          {!! $car_info->content !!}
        </div>

        <div id="carRegis_bar">
          <div>
            <a href="#">표지</a>
            <a href="#">차량설명</a>
            <a href="#" style="color:white; background-color:#373737">차량사진</a>
            <a href="#">보증내용</a>
            <a href="#">동일한 차량매물</a>
          </div>
        </div>
        <div id="pre_car_img">
          @foreach($car_img as $img)
            <img src="/storage/carRegis_image/{{$img->filename}}" />
          @endforeach
        </div>
        <div id="carRegis_bar">
          <div>
            <a href="#">표지</a>
            <a href="#">차량설명</a>
            <a href="#">차량사진</a>
            <a href="#" style="color:white; background-color:#373737">보증내용</a>
            <a href="#">동일한 차량매물</a>
          </div>
        </div>
        <div id="pre_guarantee">
  					<strong style="color:#717171">보증내용</strong><br><br style="line-height:5px; color:#717171">
  				자동차관리법 시행규칙 제120조의 규정에 따라 별지 제82호서식 『중고자동차성능.상태점검기록부』를 발행한 성능. 상태점검자 및 매매업자는 아래의보증기간 또는 보증거리 이내에 중고자동차성능.상태점검기록부에 기재된 내용과 자동차의 실제 성능.상태가 다른 경우 계약 또는 관계법령에 따라 매수인에 대하여 책임을 집니다.<br><br>
  				<strong style="color:#717171">보증기간 / 보증거리</strong><br><br style="line-height:5px;">
  				자동차 인도일로부터 30일, 자동차 인도일로부터 2천킬로미터 ( 그 중 먼저 도래한 것을 적용합니다.)<br><br>
  				- 중고자동차매매업자를 통해 차량을 구입하실 경우 반드시 "중고자동차성능.상태점검기록부"를 교부 받으셔야 하며 매매업자는 반드시 의무 교부 하여야 합니다.<br>
  				- 중고자동차의 구조.장치 등의 성능.상태를 고지하지 아니한 자, 거짓으로 점검하거나 거짓 고지한 자는「자동차관리법」제80조제4호의2 내지 제80조4호의3에 따라 2년 이하의 징역 또는 500만원 이하의 벌금에 처합니다.<br><br>
  				<span class="f_red">※주의※</span><br>
  위 게제한 내용은 2010년 3월 31일 현재 사항 이며 관계법령의 개정이 있을 수 있으므로 차량 구입일 현재의 법령을 확인 하시기 바랍니다.
        </div>
        <div id="carRegis_bar">
          <div>
            <a href="#">표지</a>
            <a href="#">차량설명</a>
            <a href="#">차량사진</a>
            <a href="#">보증내용</a>
            <a href="#" style="color:white; background-color:#373737">동일한 차량매물</a>
          </div>
      </div>
      <div id="back_button">
        <div>
          <span style="font-size:1.6em">{{$car_info->company}} {{$car_info->model}} {{$car_info->grade}}</span>
          <span style="font-size:1.8em">{{$car_info->price}}</span><span style="font-size:1.6em">만원</span>
          <img src="/storage/layouts/icon_install.png"/> <img src="/storage/layouts/icon_36.png"/>
          <span style="font-size:1.1em">{{ceil($car_info->price/36*1.1)}}만원</span>
        </div>
        <div>
          <span> {{trans("user_definition.$car_info->gearbox")}}  </span>|
          <span> {{$car_info->year}}년  </span>|
          <span> {{$car_info->distinct}}Km  </span>|
          <span> {{$car_info->carnum}}  </span>|
          <span> {{$car_info->color}}  </span>|
          <span> {{trans("user_definition.accident.$car_info->accident")}}</span>
          <span>딜러 연락처</span>
          <span> {{$user_info->phone}}</span>
        </div>
      </div>
    </div>
    <div>

    </div>
  </section>
  <script src="/js/page/carRegis/img_slider.js"></script>

@endsection
