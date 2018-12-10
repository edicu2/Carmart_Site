@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="/css/page/counsel/counselSee_style.css">
<script src="/js/page/counsel/update_script.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

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
        <h1>상담신청</h1>
        <h4>상담신청입력</h4><p>*항목은 반드시 작성해주십시오.</p>
        <div id="main1_inputform">
          <form action="{{route('counselWriteCheck')}}" method="post" autocomplete="off">
            {{ csrf_field() }}
            <table>
              <tr>
                <td>
                  <label for="name">이름</label>
                </td>
                <td>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $info->name }}" readonly>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="id">아이디</label>
                </td>
                <td >
                  <input type="text" class="form-control" id="id" name="id" maxlength="12" value="{{ $info->id }}" readonly >
                  <span id="id_error" class="error"></span>
                </td>
              </tr>

              <tr>
                <td>*상담 구분</td>
                <td>
                  <select id="select" name="divide" class="form-control">
                    <option value="yet" selected>- 구분 선택 -</option>
                    <option value="bargain_pur">가격흥정<차량구매></option>
                    <option value="bargain_sell">가격흥정<차량판매></option>
                    <option value="sell">차량판매</option>
                    <option value="purchase">차량구매</option>
                    <option value="etc">기타</option>
                  </select>
                </td>
              </tr>
                <td>
                  <label for="title">*제목</label>
                </td>
                <td >
                  <input type="text" class="form-control" id="title" name="title" placeholder="제목 (상담 구분을 전부 선택하시면 자동으로 입력됩니다.)" readonly>
                  <span id="id_error" class="error"></span>
                </td>
              <tr>
              <tr>
                <td>
                  <label for="content">*내용</label>
                </td>
                <td colspan="3">
                  <textarea class="form-control" rows="15" id="content" name="content" placeholder="내용 입력"   ></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="phone1">*연락처</label>
                </td>
                <td>
                  <input id="phone1" name="phone1" type="tel" class="form-control" maxlength="3"  > -
                  <input id="phone2" name="phone2" type="tel" class="form-control" maxlength="4"  > -
                  <input id="phone3" name="phone3" type="tel" class="form-control" maxlength="4"  >
                  <span id="phone_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="checkbox">*비밀글 여부</label>
                </td>
                <td>
                  <label><input id="checkbox" name="checkbox" type="checkbox" checked /><span id="checkbox_p">&nbsp*체크된 상태가 비밀글</span></label>
                </td>
              </tr>
            </table>
            <button id="btn1" type="submit" class="btn btn-outline-dark"><a>확인</a></button>
            <button id="btn2" type="button" class="btn btn-outline-secondary"
                    onclick="script=history.back()"><a>취소</a></button>
          </form>
        </div>
      </div>
    </div>
  </article>

  <article>

  </article>
  <aside>

  </aside>
</section>


  @endsection
