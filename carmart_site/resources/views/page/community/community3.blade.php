@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="css/page/community/community_style3.css">
<script src="js/page/community/community_script3.js"></script>
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
        <li><a href="{{ route('community') }}">자동차 용품</a></li>
        <li><a href="{{ route('community2') }}" >자동차 인기뉴스</a></li>
        <li><a>자동차 갤러리 &nbsp(이미지)  ▶</a></li>
        <li><a>이용후기</a></li>
      </ul>
    </aside>
    <article id="main2_visual">
      <div id="main2_wrap">
        <div id="main2_title">자동차&nbsp <span style="color:#add01e" > 갤러리</span></div><br />


        <label id="upload_button" for="upload_hidden" class="btn btn-secondary">이미지 업로드</label>
        <input type="file" id="upload_hidden" name="upload" accept=".jpg, .jpeg, .png">
        <span style="font-size:0.85em; font-weight:bold">
           &nbsp * JPG, JPEG, PNG 파일만 업로드 가능
        </span>

        <div id="main2_board">
          <iframe src="{{route('gallery')}}" scrolling="no" width="830px" height="750px;"></iframe>
        </div>
      </div>

    </article>

  </div>

</section>

@endsection
