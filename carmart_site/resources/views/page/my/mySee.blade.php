@extends('layouts.master')
@section('content1')
<link rel="stylesheet" href="css/page/my/mySee_style.css">
<script src="/js/page/my/mySeeConst.js"></script>
<script src="/js/page/my/mySee_script.js"></script>
<section>
  <article>
    <div id="updateInfo_visual">

      <div id="updateInfo_ment">
        <h1>회원정보수정</h1>
      </div>
      <div id="updateInfo_wrap">
        <h4>회원정보</h4><p>*빈칸 없이 수정해주십시오.</p>
        <div id="updateInfo_info">
          <form id="update_form" action="{{ route('myUpdate')}}" method="post">
            {{ csrf_field() }}
            <table>
              <tr>
                <td>
                  <label for="id">*아이디</label>
                </td>
                <td >
                  <input type="text" name="id" class="form-control" id="id" value="{{ $cmember->user_id }}"readonly ><span> *수정 불가</span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="pwd">*비밀번호</label>
                </td>
                <td>
                  <input type="password" class="form-control" id="pwd" maxlength="12" value="{{ $cmember->pw }}"  >
                  <span id="pwd_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="pwc">*비밀번호 확인</label>
                </td>
                <td>
                  <input type="password" class="form-control" id="pwc" name="pwc" maxlength="12" value="{{$cmember->pw}}" ><span id="pwc_error" class="error"></span>
                  <p id="pwce">* 비밀번호는 영문자와 숫자, 특수문자를 혼합하여 6~12자 사이로 설정하셔야합니다.</p>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="name">*이름</label>
                </td>
                <td>
                  <input type="text" class="form-control" id="name" name="name" value="{{$cmember->name}}">
                </td>
              </tr>
              <tr>
                <td>
                  <label for="email1">*이메일</label>
                </td>
                <td>
                  @php $email =explode('@' , $cmember->email); @endphp
                  <input type="email" class="form-control" id="email1" name="email1" value="{{$email[0]}}">
                  @<input type="email" class="form-control" id="email2" name="email2" value="{{$email[1]}}" >
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
                  <input id="phone1" type="tel" name="tel1" class="form-control" maxlength="3" value={{substr($cmember->phone,0,3)}} >-
                  <input id="phone2" type="tel" name="tel2" class="form-control" maxlength="4" value={{substr($cmember->phone,3,4)}} >-
                  <input id="phone3" type="tel" name="tel3" class="form-control" maxlength="4" value={{substr($cmember->phone,7,4)}} >
                  <span id="phone_error" class="error"></span>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="phone">SMS 수신</label>
                </td>
                <td>


                  <input name="resms" type="radio" id="resms1" value="Y" @if( ($cmember->sms) =='Y') checked @endif >동의합니다.
                  <input name="resms" type="radio" id="resms2" value="N" @if( ($cmember->sms) =='N') checked @endif >동의하지 않습니다.
                </td>
              </tr>
            @if($cmember->divide==2)
              <div id="hidden">
                <tr>
                  <td>
                    <label for="company"> 소속회사명</label>
                  </td>
                  <td>
                    <input type="text" id="company" name="company" class="form-control" value="{{$cmember->company}}">
                  </td>
                </tr>
                <tr>
                  <td>
                    <label > 증명사진 등록</label>
                  </td>
                  <td>
                    <input id="upload_name" name="upload_name" class="form-control" value="{{$cmember->ipicture}}" disabled="disabled">
                    <label id="upload_button"  for="upload_hidden" class="btn btn-secondary">업로드</label>
                    <input type="file" id="upload_hidden" accept=".jpg, .jpeg, .png">
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
                    <input type="text" id="postcode" name="postcode" class="form-control" onclick="execDaumPostcode()" value="{{$cmember->postcode}}" placeholder="">
                    <button type="button" id="addr_search" onclick="execDaumPostcode()" class="btn btn-secondary">주소 찾기</button><br>
                    <input type="text" id="address" name="address1" class="form-control" onclick="execDaumPostcode()" value="{{$cmember->address}}" placeholder="">
                    <input type="text" id="address2" name="address2" class="form-control" placeholder="">
                  </td>
                </tr>
              </div>
            @endif
            </table>
          </form>
        </div>

        <div id="update_btn">
          <button id="update" type="button" class="btn btn-outline-dark"><a>수정완료</a></button>
          <button type="button" class="btn btn-outline-secondary"
                  onclick="location.href='../mainPage/mainPage.php'"><a>취소</a></button>
        </div>
      </div>
    </div>
  </article>


</section>

@endsection
