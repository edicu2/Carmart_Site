@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="css/page/join/join_style1.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="js/page/join/joincheck1.js"></script>
<section>
  <article>
    <div id="join_visual">
      <div id="join_ment">
        <h1>회원가입</h1>
        <div id="join_grade_img">
          <img src="/storage/layouts/join_grade0.png" />
        </div>
      </div>
      <div id="join_ment2">
        <h1> <span style='color:#adde14'>중고차마켓</span>에 오신 것을 환영합니다.</h1>
        <h6>지금 회원가입을 하시면 중고차마켓에서 제공하는</h6>
        <h6>다양한 서비스를 이용하실 수 있습니다.</h6>
      </div>

      <div id="join_select">
        <div id="join_select_img">
          <img src="/storage/layouts/join_ment2.png" />
        </div>

        <form id="form1"  method="post" action=" {{ route('regisCheck1') }} ">
           {{ csrf_field() }}
          <div id="join_select_nomal">
            <a>
              <input type="text" name="divide" value="1"></p>
              <img src="/storage/layouts/user24.png" />
              <h5>일반회원</h5>
              <span>중고차 구입 및 판매를 원하시는 만 14세 미만 이상의 일반회원</span>
              <button>일반회원 가입</button>
            </a>
          </div>
        </form>

        <form id="form2" method="post" action="{{ route('regisCheck1') }}">
           {{ csrf_field() }}
          <div id="join_select_diller">
            <a>
              <input type="text" name="divide" value="2"></p>
              <img src="/storage/layouts/manager24.png"/>
              <h5>딜러회원</h5>
              <span>중고차 구입 및 판매를 원하시는 만 14세 미만 이상의 일반회원</span>
              <button>딜러회원 가입</button>
            </a>
          </div>
        </form>

      </div>
    </div>
  </article>
</section>

@endsection
