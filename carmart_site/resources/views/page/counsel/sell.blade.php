@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="/css/page/counsel/sell_style.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<section>
  <article id="main1_visual">
    <div id="main1_wrap">
      <div id="main1_ment">
        <h4>허위매물에 지친 당신을 위한</h4>
        <h1>실매물 <b style="color:#add01e">내차판매</b></h1>
        <p>&nbsp&nbsp전문가 믿을 수 있는 안전한 실매물로<br />
         &nbsp&nbsp엄선하여 상담을 진해해드립니다.</p>
      </div>
      <div id="main1_form">
        <button id="counsel_btn" type="button" class="btn btn-success" onclick="location.href='{{ route('counselWrite') }}'">상담신청 (상담게시글 등록)</button>
        <p> * 차량정보 및 고객정보가 정확하지 않는 게시물은 관리자가 삭제합니다.<br />
* 귀하의 IP는 {{  Request::ip() }} 입니다. 장난,허위 입력시 불이익을 당할 수 있습니다.</p>
      </div>
    </div>
  </article>

  <article id="main2_visual">
    <div id="main2_wrap">
      <img src="/storage/layouts/pur_sell_process.jpg" />
    </div>
  </article>
  <article id="main3_visual">
    <div id="main3_wrap">
      <div id="main3_boardCheck">
        <select id="select" name="divide" class="form-control">
          <option value="" selected>한 페이지의 게시글 갯수</option>
          <option value="3">3개</option>
          <option value="5">5개</option>
          <option value="10">10개</option>
          <option value="20">20개</option>
        </select>
      </div>
      <div id="main3_board">
        <table class="table">
          <thead>
            <tr>
              <th>번호</th>
              <th>구분</th>
              <th>게시자</th>
              <th>제목</th>
              <th>등록일</th>
              <th>상담현황</th>
            </tr>
          </thead>
          <tbody>
            @foreach($counselResult as $index => $row)
              <tr onclick="location.href='{{ route('counselSee') }}?num={{ $row->num }}&pages={{ (Request::get('page'))?? 1 }}'">
                  <td> {{ (( REQUEST::get('page')?? 1 ) -1) *10 + $index +1 }} </td>
                  <td> {{ trans("user_definition.$row->divide") }}  </td>
                  <td> {{ $row->id }} </td>
                  <td> {{ $row->title }}
                    <img src='{{ trans("user_definition.PRIVATE$row->private") }}' />
                  </td>
                  <td>{{ $date = explode(" ",$row->created_at)[0] }}</td>
                  <td>{{ trans("user_definition.COUNSEL$row->end") }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div id="main3_Paging">
        {{ $counselResult->links() }}
      </div>
    </div>

  </article>

  <aside>

  </aside>
</section>

@endsection
