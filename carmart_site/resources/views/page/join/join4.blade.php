@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="/css/page/join/join_style4.css">
  <section>
    <article>
      <div id="join_visual">

        <div id="join_ment">
          <h1>회원가입</h1>
          <div id="join_grade_img">
            <img src="storage/layouts/join_grade3.png" />
          </div>
        </div>

        <div id="join_ment2">
          @if( Request::get('emailcheck') == 0)
            <h1> <span style='color:#adde14'>이메일</span>인증 후<br /> 해당 아이디를 사용할 수 있습니다.</h1>
          @else
            <h1> <span style='color:#adde14'>회원가입</span>을 축하합니다.</h1>
          @endif
          <h6><b>회원이 되신 것을 환영합니다.</b></h6>
        </div>


        <div id=join_btn>
          <button type="submit" class="btn btn-outline-dark"
                  onclick="location.href='{{ route('loginP')}}'"><a>로그인</a></button>
          <button type="button" class="btn btn-outline-secondary"
                  onclick="location.href='{{ route('index')}}'"><a>메인페이지</a></button>
        </div>
      </div>
    </article>
  </section>


  @endsection
