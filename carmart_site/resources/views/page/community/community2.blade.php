@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="css/page/community/community_style2.css">
<section>
    <article id="main1_visual">
      <div id="main1_wrap">
        <div id="main1_ment">
          <h4>갤러리, 핫딜상품 등의</h4>
          <h1>휴식 <b style="color:#add01e">커뮤니티</b></h1>
          <p>&nbsp&nbsp여러가지 제공된 자료들로 여러분들의<br />
           &nbsp&nbsp휴식을 도와드립니다.</p>
        </div>
      </div>
    </article>
    <div id="section_wrap">
      <aside id="side_visual">
        <h5>커뮤니티</h5>
        <ul>
          <li><a href="{{ route('community') }}">자동차 용품 </a></li>
          <li><a>자동차 인기뉴스 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ▶</a></li>
          <li><a href="{{ route('community3') }}">자동차 갤러리</a></li>
          <li><a>이용후기</a></li>
        </ul>
      </aside>
      <article id="main2_visual">
        <div id="main2_wrap">
          <div id="main2_title"><b>오늘의</b><span style="font-size:1.0em; color:#add01e" > 인기뉴스</span></div>
          <div id="main2_board">
            <table class="table">
              <tbody>
              <!--블래이드 문법 사용하기 -->

              <?php $num=0; ?>
                @foreach($apiResult as $items)
                <tr onclick="window.open('{{ $items['originallink'] }}','_blank')" >
                  <td <?php if($num<=4) echo "style='color:#ade01e'"; ?> > <?=$num += 1?> </td>
                  <td> {!! $items['title'] !!} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </article>
    </div>
  </section>


  @endsection
