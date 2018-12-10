@extends('layouts.master')
@section('content1')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/page/login/login_style.css">
<script src="js/page/login/loginAjax.js"></script>
<script src="js/page/login/checkBox.js"></script>
<section>
  <article>
    <div id="login_visual">
      <div id="login_wrap">
        <h1>로그인</h1>
        <p>로그인을 하시면 다양한 서비스 이용이 가능합니다. </p>
        <form id="login_formP" method="post">
          <table id="login_table">
            <tr>
              <td>
                <label for="id"> 아이디 </label>
              </td>
              <td>
                <input id="id" name="id" type="text" value="{{ Cookie::get('auto_id')}}" class="form-control"/>
              </td>
              <td rowspan='2'>
                  <input type="submit" class="btn btn-outline-dark" value="로그인"/ />
              </td>
            </tr>
            <tr>
              <td>
                <label for="pwd"> 비밀번호 </label>
              </td>
              <td>
                <input id="pwd" name="pwd" type="password" class="form-control"/>
              </td>
            </tr>
          </table>
          <label><input id="auto_id" name="auto_id" type="checkbox"
            @if(Cookie::get('auto_id'))
              checked=true
            @endif /> 아이디 저장 </label>
          <label>&nbsp<input id="auto_login" name="auto_login" type="checkbox" /> 자동 로그인</label>
          <div id="google_button" onclick='location.href="{{ url('/google/redirect') }}"' >Google 로그인</div>
          <div id="facebook_button" onclick='location.href="{{ url('/facebook/redirect') }}"'>Facebook 로그인</div>
          <div id="github_button" onclick='location.href="{{ url('/github/redirect') }}"'>Github 로그인</div>

        </form>
      </div>
      <div id="login_wrap2">
        <div id="join_move" onclick="location.href='{{ route('regis1')}}'">
          <a>

            <h5>아직 회원이 아니신가요?</h5>
            <span>지금 회원가입하시고<br /> 다양한혜택을 누리세요.</span><br />
            <button>회원가입</button>
          </a>
        </div>
        <div id="id_search" onclick="location.href='{{ route('idSearch')}}'">
          <a>

            <h5>아이디를 잊어버리셨나요?</h5>
            <span>잊어버린 고객님의 <br />아이디를 찾아드립니다.</span><br />
            <button>아이디 찾기</button>
          </a>
        </div>
        <div id="pw_search" onclick="location.href='{{ route('pwSearch')}}'">
          <a>

            <h5>비밀번호를 잊어버리셨나요?</h5>
            <span>잊어버린 고객님의<br /> 비밀번호를 찾아드립니다.</span><br />
            <button>비밀번호 찾기</button>
          </a>
        </div>
      </div>
    </div>
  </article>
</section>


@endsection
