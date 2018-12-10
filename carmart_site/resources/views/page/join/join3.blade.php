@extends('layouts.master')
@section('content1')

<link rel="stylesheet" href="/css/page/join/join_style3.css">
<script src="/js/page/join/joinCheck3Const.js"></script>
<script src="/js/page/join/joinCheck3.js"></script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script src="/js/page/join/address_api.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<section>
  <article>
    <div id="join_visual">

      <div id="join_ment">
        <h1>회원가입</h1>
        <div id="join_grade_img">
          <img src="/storage/layouts/join_grade2_1.png" />
        </div>
      </div>
      <div id="join_input_wrap">
        <h4>회원정보입력</h4><p>*항목은 반드시 작성해주십시오.</p>
        <div id="join_input">
          <form action="{{ route('regisRequest')}}" method="post">
            <table>
              <tr>
                <td>
                  <label for="id">*아이디</label>
                </td>
                <td >
                  <input type="text" class="form-control" id="id" maxlength="12" >
                  <button type="button" class="btn btn-secondary"  id="idc">아이디 증복확인</button>
                  <span id="id_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="pwd">*비밀번호</label>
                </td>
                <td>
                  <input type="password" class="form-control" id="pwd" maxlength="12"  >
                  <span id="pwd_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="pwc">*비밀번호 확인</label>
                </td>
                <td>
                  <input type="password" class="form-control" id="pwc" maxlength="12"  ><span id="pwc_error" class="error"></span>
                  <p id="pwce">* 비밀번호는 영문자와 숫자, 특수문자를 혼합하여 6~12자 사이로 설정하셔야합니다.</p>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="name">*이름</label>
                </td>
                <td>
                  <input type="text" class="form-control" id="name">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="email1">*이메일</label>
                </td>
                <td>
                  @php
                    $sEmail = explode('@',(Session::get('socialEmail')))??"";
                  @endphp
                  <input type="email" class="form-control" id="email1"
                  @if($sEmail[0]??"") value="{{ $sEmail[0]}}" readonly @endif >
                  @<input type="email" class="form-control" id="email2"
                  @if($sEmail[1]??"") value="{{ $sEmail[1]}}" readonly @endif >
                  <select id="select" name="emailSelect">
                    <option value="">직접입력</option>
                    <option value="yahoo.co.kr">yahoo.co.kr</option>
                    <option value="hanmail.net">hanmail.net</option>
                    <option value="nate.com">nate.com</option>
                    <option value="lycos.co.kr">lycos.co.kr</option>
                    <option value="hotmail.com">hotmail.com</option>
                    <option value="dreamwiz.com">dreamwiz.com</option>
                    <option value="naver.com">naver.com</option>
                    <option value="hitel.net">hitel.net</option>
                    <option value="netian.com">netian.com</option>
                    <option value="empal.com">empal.com</option>
                    <option value="hanmir.com">hanmir.com</option>
                    <option value="chollian.net">chollian.net</option>
                  </select>
                  <span id="email_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="phone">*휴대폰 번호</label>
                </td>
                <td>
                  <input id="phone1" type="tel" class="form-control" maxlength="3"  >-
                  <input id="phone2" type="tel" class="form-control" maxlength="4"  >-
                  <input id="phone3" type="tel" class="form-control" maxlength="4"  >
                  <span id="phone_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="phone">SMS 수신</label>
                </td>
                <td>
                  <input name="resms" type="radio" id="resms1" value="Y" checked="checked">동의합니다.
                  <input name="resms" type="radio" id="resms2" value="N">동의하지 않습니다.
                </td>
              </tr>
            </table>
          </form>
        </div>

      @if(Session::get('divide')==2)
        <div id="hidden">
          <h4>딜러정보입력</h4><p> 해당내용을 반드시 입력해야하는 사항입니다.</p>
          <div id="join_input2">
            <form>
              <table>
                <tr>
                  <td>
                    <label for="company"> 소속회사명</label>
                  </td>
                  <td>
                    <input type="text" id="company" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label > 증명사진 등록</label>
                  </td>
                  <td>
                    <input id="upload_name" class="form-control" value="선택된 파일 없음" disabled="disabled">
                    <label id="upload_button" for="upload_hidden" class="btn btn-secondary">업로드</label>
                    <input type="file" id="upload_hidden" name="upload" accept=".jpg, .jpeg, .png">
                    <p id="pwce">
                      &nbsp( 사진크기 : 150 x 150 또는 1:1 비율 ) &nbsp * JPG, JPEG, PNG 파일만 업로드 가능
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="postcode"> 주소 등록</label>
                  </td>
                  <td>
                    <input type="text" id="postcode" class="form-control" onclick="execDaumPostcode()" placeholder="">
                    <button type="button" id="addr_search" onclick="execDaumPostcode()" class="btn btn-secondary">주소 찾기</button><br>
                    <input type="text" id="address" class="form-control" onclick="execDaumPostcode()" placeholder="">
                    <input type="text" id="address2" class="form-control" placeholder="상세 주소">
                  </td>
                </tr>
              </table>
            </form>
          </div>
          </div>
          @endif
        </div>

        <div id=join_btn>
          <button id="btn1" type="submit" class="btn btn-outline-dark">
            <a>확인</a></button>
          <button type="button" class="btn btn-outline-secondary"
                  onclick="location.href='{{ route("index") }}'"><a>취소</a></button>
        </div>
      </div>
    </div>
  </article>
</section>

@endsection
