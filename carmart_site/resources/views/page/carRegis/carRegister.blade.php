@extends('layouts.master')

@section('content1')

<link rel="stylesheet" href="/css/page/carRegis/carRegis_style.css">
<script src="/js/page/carRegis/carRegis_script.js"></script>
<script src="/js/page/list/domestic_script.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script type="text/javascript">

$(function(){
  CKEDITOR.replace( 'summary-ckeditor', {
        filebrowserUploadUrl: '/carRegister/image_upload_content?_token={{csrf_token()}}&type=image',height:'400px',
      });
  CKEDITOR.instances ['summary-ckeditor'].on ( 'change', function () {
    $('#pre_content').html(this.getData())
    $('[name=content]').val(this.getData());
  });

});
</script>
<section>
  <div id="carReis_ment">
    <h1>자동차 매물 등록</h1>
    <div id="downPoint0"></div>
  </div>
  <div id="carRegis_wrap">
    <h4>자동차 등록</h4>
    <div id="carRegis_form">
      <div id="carRegis_form_1">

        <div id="left">
          <form action="{{ route('carRegis_imageUpload') }}" id="my-dropzone"
                enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)"/>
          </form>
            <br>
        </div>
        <div id="right">
          <form id="category_wrap" action="{{route('carRegisRequest')}}" method="post">
            <input type="hidden" name='content' value="" />
            <input type="hidden" name="sumnail_image_num" value=0 />
          {{ csrf_field() }}
            <div id="selection_category">
              <table>
                <tr>
                  <td>
                    <div>제조사</div>
                  </td>
                  <td>
                    <div>대표모델</div>
                  </td>
                  <td>
                    <div>세부모델</div>
                  </td>
                  <td>
                    <div>등급</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <select id='company' name='company' size='6'>
                  @foreach($company_lists as $list)
                      <option value="{{ $list->company }}" > {{$list->company}} </option>
                  @endforeach
                    </select>
                  </td>
                  <td>
                    <div> 제조사를 선택하시면<br /> 리스트가 나타납니다.<br /> <strong style="color:red">*등급까지 <br />전부 선택해주세요.</strong></div>
                  </td>
                  <td>
                    <div> 대표모델을 선택하시면<br /> 리스트가 나타납니다.<br /> <strong style="color:red">*등급까지 <br />전부 선택해주세요.</strong></div>
                  </td>
                  <td>
                    <div> 세부모델을 선택하시면<br /> 리스트가 나타납니다.<br />(ctrl + click 으로 다중선택가능)<br /> <strong style="color:red">*등급까지<br /> 전부 선택해주세요.</strong></div>
                  </td>
                </tr>
              </table>
            </div>
            <div id="selection_category2">
              <label>
                <span>연식</span>
                <select name="year">
                  <option value=" ">선택</option>
                @for($i=2000; $i<=date("Y"); $i++)
                  <option value="{{$i}}">
                    {{$i."년"}}
                  </option>
                @endfor
                </select>
              </label>
              <label>
                <span>주행거리</span>
                <input type="text" placeholder="입력해주세요." value="{{old('distinct')}}" name="distinct"/>
                km
              </label>
              <label>
                <span>색상</span>
                <input type="text" placeholder="입력해주세요. "value="{{old('color')}}" name="color"/>
              </label>
              <label>
                <span>변속기</span>
                <select name="gear">
                  <option value=" ">선택</option>
                  <option @if(old('gear') == 'auto') selected @endif value="auto">오토</option>
                  <option @if(old('gear') == 'hand') selected @endif value="hand">수동</option>
                </select>
              </label>
              <label>
                <span>사고</span>
                <select name="accident">
                  <option value=" ">선택</option>
                  <option @if(old('accident') == 'no') selected @endif value="no">무사고 차량</option>
                  <option @if(old('accident') == 'yes') selected @endif value="yes">사고 차량</option>
                </select>
              </label>
              <label>
                <span>연료</span>
                <select name="oil">
                  <option value=" ">선택</option>
                  <option @if(old('oil') == 'gasolin') selected @endif value="gasolin">휘발유</option>
                  <option @if(old('oil') == 'disel') selected @endif value="disel">경유</option>
                  <option @if(old('oil') == 'lpg') selected @endif value="lpg">LPG</option>
                  <option @if(old('oil') == 'gl') selected @endif value='gl'>가솔린LPG겸용</option>
                  <option @if(old('oil') == 'hybrid') selected @endif value="hybrid">하이브리드</option>
                </select>
              </label>
              <label>
                <span>차량번호</span>
                <input name="carnum" type="text" value="{{old('carnum')}}" placeholder="입력해주세요."/>
              </label>
              <label>
                <span>가격</span>
                <input name="price" type="text" value="{{old('price')}}" placeholder="입력해주세요."/>
                만원
              </label>
              <input id="pre_apply" type="button" value= "미리보기페이지에 적용시켜보기  "/>
            </div>
          </form>
        </div>
      </div>
    </div>
    <h4>차량설명 작성</h4>
    <textarea class="form-control" id="summary-ckeditor" placeholder="이미지를 드래그하여 추가할 수 있습니다.!"> </textarea>
    <div id="downPoint"></div>
    <h4>페이지 미리보기</h4>
    <div id="carRegis_preview">
      <div id="carRegis_bar">
        <div>
          <a href="#" style="color:white; background-color:#373737">표지</a>
          <a href="#">차량설명</a>
          <a href="#">차량사진</a>
          <a href="#">보증내용</a>
          <a href="#">동일한 차량매물</a>
        </div>
      </div>
      <div id="pre_img">
        <div id="preview" class="slideshow-container fade">
          <img src="/storage/layouts/nophoto0.png" width="420px" height="315px"/>
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>
          <div class="text"> 1 / 20</div>
        </div>
        <div id="preSumnail">
          @for($i=0 ; $i < 20 ; $i++)
          <div class="mySlides">
            <img src="/storage/layouts/nophoto0.png" width='76px' height="64px"/>
          </div>
          @endfor
        </div>
      </div>
      <div id="pre_info">
        <div id="pre_info_title">
          <div id="carName">
          </div>
          <div id="carPrice">
            <span>차량가격</span>  <strong></strong><span><img src="/storage/layouts/icon_install.png"/> <img src="/storage/layouts/icon_36.png"/> &nbsp; {{ceil(380/36*1.1)}}만원</span>
          </div>
        </div>
        <div id="pre_info_body">
          <div>
             <span>연식</span> <span></span>
             <span>주행거리</span> <span></span>
          </div>
          <div>
            <span>색상</span> <span></span>
            <span>변속기</span> <span></span>
          </div>
          <div>
            <span>사고</span> <span></span>
            <span>연료</span> <span></span>
          </div>
          <div>
            <span>차량번호</span> <span></span>
          </div>
        </div>
        <div id="sell_profile">
          <div id="profile_img" >
            <img src="/storage/MemberPicture/{{$user->user_id}}.jpg" width="150px" height="150px";/>
          </div>
          <div id="profile">
            <div>판매자   <b>{{$user->name}}</b></div>
            <div>연락처   <strong> {{$user->phone}}</strong></div>
            <div id="ment">
              판매자와의 연락을 통해 좋은 결과 있기를 바랍니다.
            </div>
          </div>
        </div>
        <div id="counsel"></div>
      </div>
      <div id="carRegis_bar">
        <div>
          <a href="#">표지</a>
          <a href="#" style="color:white; background-color:#373737">차량설명</a>
          <a href="#">차량사진</a>
          <a href="#">보증내용</a>
          <a href="#">동일한 차량매물</a>
        </div>
      </div>
      <div id="pre_content">

      </div>

      <div id="carRegis_bar">
        <div>
          <a href="#">표지</a>
          <a href="#">차량설명</a>
          <a href="#" style="color:white; background-color:#373737">차량사진</a>
          <a href="#">보증내용</a>
          <a href="#">동일한 차량매물</a>
        </div>
      </div>
      <div id="pre_car_img">
      </div>
      <div id="carRegis_bar">
        <div>
          <a href="#">표지</a>
          <a href="#">차량설명</a>
          <a href="#">차량사진</a>
          <a href="#" style="color:white; background-color:#373737">보증내용</a>
          <a href="#">동일한 차량매물</a>
        </div>
      </div>
      <div id="pre_guarantee">
					<strong style="color:#717171">보증내용</strong><br><br style="line-height:5px; color:#717171">
				자동차관리법 시행규칙 제120조의 규정에 따라 별지 제82호서식 『중고자동차성능.상태점검기록부』를 발행한 성능. 상태점검자 및 매매업자는 아래의보증기간 또는 보증거리 이내에 중고자동차성능.상태점검기록부에 기재된 내용과 자동차의 실제 성능.상태가 다른 경우 계약 또는 관계법령에 따라 매수인에 대하여 책임을 집니다.<br><br>
				<strong style="color:#717171">보증기간 / 보증거리</strong><br><br style="line-height:5px;">
				자동차 인도일로부터 30일, 자동차 인도일로부터 2천킬로미터 ( 그 중 먼저 도래한 것을 적용합니다.)<br><br>
				- 중고자동차매매업자를 통해 차량을 구입하실 경우 반드시 "중고자동차성능.상태점검기록부"를 교부 받으셔야 하며 매매업자는 반드시 의무 교부 하여야 합니다.<br>
				- 중고자동차의 구조.장치 등의 성능.상태를 고지하지 아니한 자, 거짓으로 점검하거나 거짓 고지한 자는「자동차관리법」제80조제4호의2 내지 제80조4호의3에 따라 2년 이하의 징역 또는 500만원 이하의 벌금에 처합니다.<br><br>
				<span class="f_red">※주의※</span><br>
위 게제한 내용은 2010년 3월 31일 현재 사항 이며 관계법령의 개정이 있을 수 있으므로 차량 구입일 현재의 법령을 확인 하시기 바랍니다.
      </div>
      <div id="carRegis_bar">
        <div>
          <a href="#">표지</a>
          <a href="#">차량설명</a>
          <a href="#">차량사진</a>
          <a href="#">보증내용</a>
          <a href="#" style="color:white; background-color:#373737">동일한 차량매물</a>
        </div>
    </div>
  </div>
  <div>
    <button id="submit_button">차량 등록하기</button>
  </div>
</section>

  <script src="/js/page/carRegis/img_slider.js"></script>

@endsection
