<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>MemoPad × mnemonic</title>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap"
      rel="stylesheet"> -->

      
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous">
      <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/map.css">
    <script
    src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AqjcOy5RSUYE1PdyrNDxWjk0kkezoIW_coZaPFzxZhZxbhmL3hWfeYJqSGbjhWz2'
    async defer></script>
    <script src="./js/BmapQuery.js"></script>
  
  </head>
  <body class="body">
    <header class="text-center">
      <div class="header-top">
        <h1 class="h1">MemoPad × mnemonic</h1>
        <!-- <h1 class="h1">MemoPad × mnemonic <a id="mnemonic-btn" class="mnemonic-btn" target="_blank">記憶術場所法とは？</a></h1> -->
        <div id="popup-wrapper02" class="popup-wrapper">
        <div id="popup-inside02" class="popup-inside">
        <div id="popup-close02" class="popup-close">×</div>
        <div id="message02" class="message">
        <h2 id="popup-title02" class="popup-title02">記憶術場所法とは</h2>
        <p id="popup-q" class="popup-q">場所法とは、私たちの脳が情報を記憶する際に活用する有力な手法の一つです。脳の記録容量は14.5テラバイトとされており、この膨大な容量を持つ脳はほぼすべての人が共有しています。しかし、その情報を必要な時に効果的に引き出すことができるかどうかが、記憶力の差を生み出します。<br><br>

          場所法では、他の情報と結び付けて覚えることが重要です。場所は生き物にとって極めて重要な情報であり、外敵に出会った場所や食料を得た場所などは生存に直結します。このような理由から、脳は場所の情報を覚えることに優れています。<br><br>
          
          具体的には、「場所細胞」と呼ばれる神経細胞が記憶の「紐付け」の索引として活用されます。海馬という記憶の情報処理の要となる器官の神経細胞の20％もが場所細胞で占められています。そのため、場所の情報と結び付けて覚えることで、記憶力を数倍に増強することができると考えられます。<br><br>
          
          要するに、情報を場所と結び付けて覚えることで、必要な情報を引き出しやすくなるのです。</p>
        </div></div></div>
        <div class="user_info">
          <div class="user_info_top">
            <div id="status"> Login... </div>
            <p class="user_icon"><img src id="prof"></p>
            <p class="user_name">ようこそ <span id="uname"></span> さん</p>
          </div>
          <button id="out"><i class="bi bi-box-arrow-right"></i></button>
        </div>
      </div>

      <div class="main_header" id="main_header">
        <div contenteditable="true" id="title" role="textbox"></div>
        <div contenteditable="true" id="text" role="textbox"></div>
        <img id="upimage">
        <input type="file" id="upfile">
        <div class="tool_box">
          <a class="memory" data-key="'+key+'" title="場所追加"><i class="bi bi-pin-map"></i></a>
          <!-- <a class="reminder" data-key="'+key+'" title="リマインダー"><i class="bi bi-bell"></i></a> -->
          <a class="label" data-key="'+key+'" title="ラベル追加"><i class="bi bi-bookmark"></i></a>
          <a class="pencil" data-key="'+key+'" title="編集"><i class="bi bi-pencil"></i></a>
          <a class="pallet" data-key="'+key+'" title="色"><i class="bi bi-palette"></i></a>
          <a class="trash" data-key="'+key+'" title="ゴミ箱"><i class="bi bi-trash3"></i></a>
        </div>
      </div>
      <ul id="memo_btn">
        <li id="save">Save</li>
        <li id="clear">Clear</li>
      </ul>
    </header>
    <div class="content_wrap">
      <div class="side">
        <div class="side_category" id="side_category">
          <!-- ここにカテゴリー追記 -->
          <div class="memo_btn" role="button" id="side_memo_btn">メモ</div>
          <ul id="side_category_list" class="side_category_list">

          </ul>
          <div class="memo_btn add_label_link" id="add_label_link"
            role="button">
            ラベル編集 <span class="add_label">+</span>
          </div>
          <a href="./geolocation.html" class="sanpo_btn">散歩でGO</a>
        </div>
      </div>
      <main class="main" id="main">
        <div id="memo_list" class="memo_list">
          <!-- ここに追加データが挿入される -->

        </div>
        <div id="add_label_wrap" class="add_label_wrap"><h2 class="add_label_title">ラベルの編集</h2>
          <div class="add_label_form_box" id="add_label_form_box"><button id="clear_label_btn" class="clear_label_btn"><i class="bi bi-x"></i></button><input type="text" id="add_label_input" class="add_label_input" placeholder="新しいラベルを作成"><button id="add_label_btn" class="add_label_btn"><i class="bi bi-check-lg"></i></button></div><ul id="add_label_list" class="add_label_list"></ul><div id="label_form_btn" class="label_form_btn">完了</div></div>
        
          <div id="add_label_wrap02" class="add_label_wrap">
          <h2 class="add_label_title">メモにつけるラベル</h2><ul id="add_label_list02" class="add_label_list02"></ul><div id="label_form_btn" class="label_form_btn">完了</div></div>
      
          <div id="add_label_wrap03" class="add_label_wrap">
            <h2 class="add_label_title">地図から場所を取得する</h2>
            <div id="geocode">ReverseGeocode:data</div>
            <div id="map"></div>
            <ul class="map_form_box">
              <li id="map_clear_btn" class="map_form_btn"><i class="bi bi-trash3"></i></li>
              <li id="map_decision_btn" class="map_form_btn"><i class="bi bi-check-circle"></i></li>
              <li id="map_close_btn" class="map_form_btn">完了</li>
            </ul>
            <input type="hidden" name="" id="lat_hidden">
            <input type="hidden" name="" id="lon_hidden">
            <input type="hidden" name="" id="geo_hidden">
          </div>

                <!-- ここにチャット機能追加 -->
      <div class="chat-wrap" id="chat-wrap">
        <div class="chat-header">全文検索<span class="chat-btn"><i class="bi bi-journal-arrow-up"></i></span></div>
        <section role="list" class="chat-area" id="chat-area">
        </section>
        <div class="chat-message-area">
          <div class="chat-message-area-text">
            <textarea id="chat-text"></textarea>
          </div>
          <div class="chat-message-area-button">
            <button id="send_chat" class="disabled-button"><i class="bi bi-send"></i></button>
          </div>
        </div>
      </div>
        </main>

    </div>

    <!-- JQuery -->
    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script
      src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <!-- JQuery -->

    <!--** 以下Firebase **-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"></script>
      <script src="./js/app.js" type="module"></script>
      <!-- <script src="./js/top.js" type="module"></script> -->
      <script src="./js/map.js"></script>

  </body>
</html>