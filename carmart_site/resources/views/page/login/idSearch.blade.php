@extends('layouts.master')
@section('content1')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/page/login/idSearch_style.css">
<script src="/js/page/login/idSearchAjax.js"></script>
<section>
  <article>
    <div id="search_visual">

      <div id="search_ment">
        <h1> <span style='color:#adde14'>아이디 찾기 </span>서비스</h1>
        <h6>로그인을 하시면 중고차마켓에서 제공하는</h6>
        <h6>다양한 서비스를 이용하실 수 있습니다.</h6>
      </div>

      <div id="search_wrap">
      </div>
      <div id="search_wrap2">
        <div id="search_input">
          <div id="idSearchForm">
            {{ csrf_field() }}
            <table>
              <tr>
                <td>
                  <label for="name">이름 </label>
                </td>
                <td>
                  <input name='name' type="text" class="form-control" id="name">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="email">이메일 </label>
                </td>
                <td>
                  <input name='email' type="text" class="form-control" id="email">&nbsp@&nbsp<input name='email2' type="text" class="form-control" id="email2">
                </td>
              </tr>
            </table>
            <button id="btn1" type="submit" class="btn btn-outline-dark"><a>아이디 찾기</a></button>
            <button id="btn2" type="button" class="btn btn-outline-secondary"
                    onclick="location.href='{{ route("loginP") }}'"><a> 로그인 페이지 </a></button>
          </div>
        </div>
      </div>
  </article>
</section>

@endsection
