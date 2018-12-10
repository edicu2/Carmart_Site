<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>중고차 마트</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script type="javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://js.pusher.com/4.1/pusher.min.js"/></script>
  <script src="/js/layouts/bootstrap-flash-alert.js"></script>
  <!--<//?=// csrf_field() ds>-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="/js/layouts/master.js"></script>
  <script src="/js/layouts/loginAjax.js"></script>
  <script src="/js/layouts/logoutAjax.js"></script>
  <script src="/js/layouts/keywordPusher.js"></script>
  <link rel="stylesheet" href="/css/layouts/master.css" />
  @yield('meta')
</head>

<body>
  @if ($errors->any())
      <div >
        @php
          $error = $errors->first();
        @endphp
        <script>
          $ .alert( "{!! $error !!} ", "this is message" );
        </script>
      </div>
  @endif

  {{ Session::put('url',url()->current() )}}
  @if(Session::has('Alert'))
    <script type="text/javascript" >
      $ .alert( "   {{Session::get('Alert')}}   ","This is a default message" );
    </script>
  @endif
  <!--header start -->
  <header>
    <div id="top1_visual">
      <div id="top1_wrap">
        <div id="top1_wrap_1">
          <div id="startPage_set" onClick="set_start()"><a href='#'><img src="/storage/layouts/icon_home.png"> 시작페이지 설정</a></div>
          <div id="bookMark_set" onclick="bookmark_add()" ><a href='#'><img src="/storage/layouts/icon_star.png"> 즐겨찾기 추가 </a></div>
        </div>
        <div id="top1_wrap_2">

    @if(!Session::has('name'))

          <div id=login_box>
            <form id="login_form" method="post" >
              <label><img src="/storage/layouts/user.png" /></label><input type="text" class="id" name="id" placeholder="아이디">
              <label><img src="/storage/layouts/lock.png" /></label><input type="password" class="pw" name="pwd" placeholder="비밀번호">
              <input id="login_btn" type="submit" value="로그인">
            </form>
          </div>
        </div>
          <div id="top1_wrap_3">
            <div id="loginPage_move"><a href="{{ route('loginP') }}">로그인 [페이지]</a>&nbsp/</div>
            <div id="register_move"> <a href="{{ route('regis1') }}">&nbsp회원가입</a></div>
          </div>

    @else

          <div id="login_box">
            <b> {{ Session::get('name') }} </b>님 환영합니다 !
          </div>
        </div>
          <div id="top1_wrap_3">
            <div id="logoutPage_move">&nbsp&nbsp&nbsp<a href="{{ route('logout') }}">로그아웃</a>&nbsp&nbsp/</div>
            <div id="myPage_move"> <a href="{{ route('myInfo') }}">&nbsp마이페이지</a></div>
          </div>

    @endif
      </div>
    </div>

    <div id="top2_visual">
      <div id="top2_wrap">
        <table>
          <tr>
            <td>
              <div id="home_logo">
                <a href="/">
                  <img src="/storage/layouts/homepageLogo.png" />
                </a>
              </div>
            </td>
            <td>
              <div id="search">
                  <div id="search_window">
                    <form id="search_form" method="post" action="{{ route('searchCar')}}">
                      {{ csrf_field() }}
                      <input type="text" name="search" placeholder="원하시는 차량을 입력하세요." />
                      <input type="submit" value=" " />
                    </form>
                  </div>
                  <b>인기검색어</b>
                  <span id="search_many">

                  </span>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>


  </header>
  <!--header end -->

  <!--nav start -->
  <nav>

    <div id="nav_visual" class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('domesticCar') }}">국산차</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('globalCar') }}">수입차</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('counselPur')  }}">내 차 구입</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('counselSell')  }}">내 차 판매</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('community') }}">커뮤니티</a>
        </li>
      </ul>
    </div>
  </nav>
  <!--nav end -->

  <!--section -->

        @yield('content1')
        <!-- 이 부분이 들어가야한다 . -->
        @yield('content2')


  <!--footer -->
  <footer>
    <div id="footer_visual">
      <div id="footer_ment">
        <h6> 주문식 기술과 학습으로 중고차 시장의 혁신 CAR MARKET! </h6>
        <br />
        이용약관   |   개인정보보호정책   |   고객센터   |   문의접수 <br />
        <br />
        대구광역시 부구 복현동 영진전문대학㈜ | 대표이사 : 서보민 | 사업자등록번호 : 053-845-1222<br />
        준법감시인 심의필 번호 : N20180524-0012COPYRIGHT 2018 KB CAPITAL.CO.,LTD. ALL RIGHTS RESERVED.
      </div>
    </div>
  </footer>
</body>
</html>
