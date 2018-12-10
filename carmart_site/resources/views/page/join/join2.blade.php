@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="/css/page/join/join_style2.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="/js/page/join/joincheck2.js"></script>
<section>

    <article>
      <div id="join_visual">

        <div id="join_ment">
          <h1>회원가입</h1>
          <div id="join_grade_img">
            <img src="/storage/layouts/join_grade1.png" />
          </div>
        </div>

        <div id="join_agree">
          <h4>약관동의</h4>
          <div id="join_breakdown">
            <iframe src="http://www.jc-wow.com/rule.html" frameborder="0" width="1023px" height="210" scrolling="auto"></iframe>
          </div>
          <div id="check_box">
            <input name="chkAgree" id="chkAgree" type="checkbox" value="N">
             위 약관에 동의합니다.
          </div>
        </div>

        <div id="join_agree">
          <h4>개인정보보호정책</h4>
          <div id="join_breakdown">
            <iframe src="http://www.jc-wow.com/privercy.html" frameborder="0" width="1023px" height="210" scrolling="auto"></iframe>
          </div>
          <div id="check_box">
            <input name="chkAgree" id="chkAgree2" type="checkbox" value="N">
             위 약관에 동의합니다.
          </div>
		    </div>

        <div id=join_btn>
          <button id="check_button" type="button" class="btn btn-outline-dark"><a>동의</a></button>
          <button type="button" class="btn btn-outline-secondary"
          onclick="location.href='{{route('index')}}'"><a>동의하지 않음</a></button>
        </div>

      </div>
    </article>
  </section>


@endsection
