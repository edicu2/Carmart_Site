<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/GetKeyword', 'MasterController@GetKeyword')->name('getKeyword');

Route::resource('/','MainController');
Route::post('/counselSMS','MainController@counselSMS')->name('counselSMS');
// 이렇게 하며 postConroller가 등록한 내용을 확인한다 .
Route::get('/carKindSearch','MainController@CarKindSearch')->name('CarKindSearch');
Route::get('/carListUpdate','MainController@CarListUpdate')->name('CarListUpdate');


// Login Top
Route::post('/tLogin', 'MasterController@Logincheck')->name('login');
Route::get('/tLogout', 'MasterController@Logoutcheck')->name('logout');



//Register

Route::get('/register', function(){
  return view('page.join.join1');
})->name('regis1');

Route::post('/registerCheck1','RegisterController@registerCheck1')->name('regisCheck1');

Route::get('/register2', function(){
  return view('page.join.join2');
})->name('regis2');

Route::get('/registerCheck2','RegisterController@registerCheck2')->name('regisCheck2');

Route::get('/register3', function(){
  return view('page.join.join3');
})->name('regis3');

Route::get('/register4','RegisterController@register4')->name('regis4');

Route::get('/register4_1',function(){
  return view('page.join.join4');
})->name('regis4_1');
Route::get('/emailCheck','RegisterController@EmailCheck')->name('emailCheck');

Route::post('/register3/addFile','RegisterController@addFile')->name('addFile');

Route::post('/IdDuplicationCheck','RegisterController@IdDuplication')->name('idCheck');

Route::post('/regisRequestCheck','RegisterController@RegisterRequest')->name('regisRequest');




// myPage
Route::get('/myInfo','MyController@MyInfo')->name('myInfo')->middleware('CheckLogin');

Route::post('/myUpdate','MyController@MyUpdate')->name('myUpdate')->middleware('CheckLogin');


// carRegister
Route::get('/carRegister','CarRegisterController@CarRegister')->name('carRegis');
Route::post('/carRegister/registration','CarRegisterController@CarRegisterRequest')->name('carRegisRequest');

Route::post('/carRegister/image_upload','UploadController@upload')->name('carRegis_imageUpload');
Route::post('/carRegister/image_delete','UploadController@delete')->name('carRegis_imageDelete');
Route::post('/carRegister/image_upload_content','UploadController@upload_content')->name('carRegis_imageUpload_content');

Route::get('/CarSee/{regnum}','CarSeeController@CarSee')->name('carSee');


// login P
Route::get('/login',function(){
  return view('page.login.login');
})->name('loginP');

Route::post('/PLogin', 'LoginController@LoginCheck')->name('loginCheck');

Route::get('/IdSearch', function() {
  return view('page.login.IdSearch');
})->name('idSearch');
Route::get('/PwSearch', function() {
  return view('page.login.PwSearch');
})->name('pwSearch');

Route::post('/IdSearchCheck', 'LoginController@IdSearchMail')->name('idSearchCheck');
Route::post('/PwSearchCheck', 'LoginController@PwSearchMail')->name('pwSearchCheck');

Route::get('/Social', 'LoginController@Social')->name('social');


// community
Route::get('/Community','CommunityController@Community1')->name('community');

Route::get('/Community2','CommunityController@Community2')->name('community2');

Route::get('/Community3','CommunityController@Community3')->name('community3');

Route::post('/Community3/addFile', 'CommunityController@C3addFile')->name('c3add');

Route::get('/Gallery','CommunityController@Gallery')->name('gallery');





// counsel
Route::get('/CounselPurchase', 'CounselController@Purchase')->name('counselPur');

Route::get('/Counsel', 'CounselController@SeePage')->name("counselSee")->middleware('CheckLogin');
Route::post('/CounselCommentReg', 'CounselController@CommentReg')->name('commentReg');
Route::post('/CounselReCommentReg', 'CounselController@CommentReg')->name('recommentReg');
Route::post('/CounselReCommentDel', 'CounselController@CommentDel')->name('commentDel');



Route::post('/Counsel/update', 'CounselController@UpdatePage')->name("counselUpdate")->middleware('CheckLogin');

Route::post('/Counsel/updateCheck' , 'CounselController@Update')->name('counselUpdateCheck')->middleware('CheckLogin');

Route::get('/Counsel/deleteCheck' , 'CounselController@Delete')->name('counselDeleteCheck')->middleware('CheckLogin');
//Route::post('/Counsel/update', 'CounselController@update')->name("counselUpdate");

Route::get('/CounselSell', 'CounselController@Sell')->name('counselSell');

Route::get('/Counsel/write', 'CounselController@WritePage')->name('counselWrite')->middleware('CheckLogin');
Route::post('/Counsel/writeCheck', 'CounselController@Write')->name("counselWriteCheck")->middleware('CheckLogin');




Route::any("/SearchCar", "CarListController@SearchCar")->name('searchCar');
Route::post("/SearchCar2", "CarListController@SearchCar2")->name('searchCar2');

Route::any("/DomesticCar", 'CarListController@Domestic')->name('domesticCar');
Route::get("/DomesticCar2", 'CarListController@Domestic2')->name('domesticCar2');
Route::get("/DomesticCar3", 'CarListController@Domestic3')->name('domesticCar3');

Route::get("/GlobalCar", 'CarListController@global')->name('globalCar');
Route::get("/GlobalCar2", 'CarListController@global2')->name('globalCar2');

Route::any("/CategoryCheck", 'CarListController@CategoryCheck')->name('companyCheck');

Route::get("/DomesticSearch", 'CarListController@DomesticSearch')->name('domesticSearch');

Route::get("/DomesticSearch2_1", 'CarListController@DomesticSearch2_1')->name('domesticSearch2_1');

Route::get("/DomesticSearch2_2", 'CarListController@DomesticSearch2_2')->name('domesticSearch2_2');


//Route::get()

//Route::post('/counselSell',);



Route::get('/google/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/google/callback', 'SocialAuthGoogleController@callback');

Route::get('/facebook/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/facebook/callback', 'SocialAuthFacebookController@callback');

Route::get('/github/redirect', 'SocialAuthGithubController@redirect');
Route::get('/github/callback', 'SocialAuthGithubController@callback');
