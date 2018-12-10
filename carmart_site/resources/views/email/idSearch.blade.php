<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>

    </style>
  </head>
  <body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/email/idSearch_style.css">

    <section>
      <img id="logo" src="http://www.carmarts.shop/storage/layouts/email_homelogo.png" />
      <article>
        <div id="search_visual">

          <div id="search_wrap">
          </div>
          <div id="search_wrap2">
            <div id="search_input">
              <div id="idSearchForm">
                <table>
                  <tr>
                    <td>
                      {!!"\"".$data['name']." \"회원님의 아이디는<b style='color:#adde14'> \"".$data['id']."\"</b>입니다." !!}<br />
                      <a id="move" href="{{ $data['serverIp'] }}" target="_self">
                         로그인 페이지
                      </a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
      </article>
    </section>
  </body>
</html>
