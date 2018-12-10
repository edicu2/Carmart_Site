@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="/css/page/counsel/counselSee_style.css">
<script src="/js/page/counsel/see_script.js"></script>
<script src="/js/page/counsel/commentAjax.js"></script>
<script src="/js/page/counsel/deleteAjax.js"></script>
<script src="/js/page/counsel/reComment.js"></script>
<section>
    <article id="main1_visual">

      <div id="main1_wrap">
        <div id="main1_ment_back">
          <div id="main1_ment">
            <br />
            <div id="join_grade_img">
              <img src="/storage/layouts/pur_sell_process.jpg" />
            </div>
          </div>
        </div>
        <div id="main1_write">
          <h1>상담신청 (보기)</h1>
          <h4>상담신청게시글</h4><p>*수정을 원하시면 하단의 수정버튼을 클릭해주세요.</p>
          <div id="main1_inputform">
            <form action="{{ route('counselUpdate') }}" method="post" autocomplete="off">
              {{ csrf_field() }}
              <table>

                <tr>
                  <td>
                    <label for="name">이름</label>
                  </td>
                  <td>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $ccounsel->name }}" readonly>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="id">아이디</label>
                  </td>
                  <td >
                    <input type="text" class="form-control" id="id" name="id" maxlength="12" value="{{ $ccounsel->id }}" readonly >
                    <span id="id_error" class="error"></span>
                  </td>
                </tr>

                <tr>
                  <td>*상담 구분</td>
                  <td>
                    <select id="select" name="divide" class="form-control" disabled>
                      <option value="yet" selected >{{ trans("user_definition.$ccounsel->divide") }}</option>
                    </select>
                  </td>
                </tr>
                  <td>
                    <label for="title">*제목</label>
                  </td>
                  <td >
                    <input type="text" class="form-control" id="title" name="title" value="{{ $ccounsel->title }}" placeholder="제목 (상담 구분을 전부 선택하시면 자동으로 입력됩니다.)" readonly>
                    <span id="id_error" class="error"></span>
                  </td>
                <tr>
                <tr>
                  <td>
                    <label for="content">*내용</label>
                  </td>
                  <td colspan="3">
                    <textarea class="form-control" rows="15" id="content" name="content"  placeholder="내용 입력"  readonly >{{ $ccounsel->content }}</textarea>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="phone1">*연락처</label>
                  </td>
                  <td>
                    <input id="phone1" name="phone1" type="tel" class="form-control" maxlength="3" value="{{ substr( $ccounsel->phone,0,3 ) }}" readonly > -
                    <input id="phone2" name="phone2" type="tel" class="form-control" maxlength="4" value="{{ substr( $ccounsel->phone,3,4 ) }}" readonly > -
                    <input id="phone3" name="phone3" type="tel" class="form-control" maxlength="4" value="{{ substr( $ccounsel->phone,7,4 ) }}" readonly >
                    <span id="phone_error" class="error"></span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="checkbox">*비밀글 여부</label>
                  </td>
                  <td>
                    <label><input id="checkbox" name="checkbox" type="checkbox" @if($ccounsel->private ==1 ) checked @endif  disabled/><span id="checkbox_p">&nbsp*체크된 상태가 비밀글</span></label>
                  </td>
                </tr>

              </table>
              <!--<input type="text" value="{{ Request::get('num') }}" name="num"  style="display:none" />-->
              <button id="btn1" type="submit" class="btn btn-outline-dark"><a>수정</a></button>
              <button id="btn2" type="button" class="btn btn-outline-secondary"
                      onclick="location.href='{{ URL::previous() }}'"><a>목록으로</a></button>
            </form>
          </div>
        </div>
      </div>
    </article>
    <article id="comment_visual">
    <a href="#regcomment" id="regMove"><b>댓글 쓰기</b> </a>
    @foreach($comments as $comment)
      <div id="comment_ment" class="{{ $comment->id }}">
        <img id="user_img" src="https://t1.daumcdn.net/cfile/tistory/2744963F53D1EF1C01"  />
        <span id="user_id">{{ $comment->user_id }}</span>
        <div id="comment">{!! $comment->comment !!}</div>
        <div id="create_at">{{ $comment->created_at}}</div>
      @if(Session::get('id') == $comment->user_id)
        <input id='deleteComment' type='button' value='삭제'>
      @endif
      </div>
      @foreach($dapComments->where('pre_num',$comment->id)->where('board_num',$comment->board_num) as $dapComment )
        <div id="comment2_ment" class="{{ $comment->id }}">
          <img id="user_img" src="{{ $dapComment->img_url }}"  />
          <span id="user_id">{{ $dapComment->user_id }}</span>
          <div id="comment">{!! $dapComment->comment !!}</div>
          <div id="create_at">{{ $dapComment->created_at}}</div>
          @if(Session::get('id') == $comment->user_id)
            <input id='deleteComment' type='button' value='삭제'>
          @endif
        </div>
      @endforeach
        <div id="comment2_ment" class="{{ $comment->id }}">
          <input id='dapreg' type='button' value='답글'>
        </div>
    @endforeach
    <div id="comment_Paging">
      {{ $comments->links() }}
    </div>
      <a name="regcomment"></a>
      <div id="commentreg">
        <div id="profile">
            <img id="user_img" src="https://t1.daumcdn.net/cfile/tistory/2744963F53D1EF1C01"  />
            <span id="user_id"> {{Session::get('id')}} </span>
        </div>
        <textarea class="" id="commentArea" name="contentC" placeholder="댓글을 입력해주세요." wrap="hard"  ></textarea>
        <div id="commentregButtons">
          <input id="photo" type='button' value="사진">
          <input id="reg" type="button" value=" 등록">
        </div>
      </div>

    </article>
    <aside>

    </aside>
  </section>


@endsection
