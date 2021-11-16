<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/DND-STYLE/uikit.css">
    <script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
</head>
<body>
    <div class="typography ui-div">
        <h4 class="ui-header">typography</h4>
        <h1 class="nav-title">"h1" - Noto Sans KR - 29px - h1</h1>
        <h2 class="main-title">"h2" - Noto Sans KR - 27px - h2</h2>
        <h3 class="sub-title">"h3" - Noto Sans KR - 25px - h3</h3>
        <p class="body-font">"body-font" - Noto Sans KR - 23px - p</p>
        <p class="caption">"caption" - 가장 작은 폰트. 오류 안내문 등  - Noto Sans KR - 20px - p</p>
    </div>
    <!-- <div class="typography-color ui-div">
        <h4 class="ui-header">typography-color</h4>
        <p class="dark-font">"dark-font"- color: #4e4e4e; </p>
        <p class="medium-font">"medium-font" - color: #7e7e7e;</p>
        <p class="light-font">"light-font" - color: #bdbdbd;</p>
    </div> -->
    <div class="colors ui-div">
        <h4 class="ui-header">background-colors</h4>
        <div class="navy">navy</div>
        <div class="lightgray">lightgray</div>
        <div class="lightyellow">lightyellow</div>
        <div class="lightpink">lightpink</div>
        <div class="darkpink">darkpink</div>
        <div class="blue">blue</div>
    </div>
    <div class="colors ui-div">
        <h4 class="ui-header">typography-colors</h4>
        <div class="font-d">font-d</div>
        <div class="font-m">font-m</div>
        <div class="font-l">font-l</div>
    </div>
    <div class="switch ui-div">
        <h4 class="ui-header">switch</h4>
        <!-- <p>알림 설정</p> -->
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="push" type="checkbox">
                <label class="toggle-item" for="push"></label>
            </div>
        </div>
    </div>
    <div class="buttons ui-div">
        <h4 class="ui-header">buttons</h4>
        <a href="#"class="link-btn">링크 이동 A태그 버튼</a>
        <button class="btn-s">.btn-s</button>
        <button class="btn-m">.btn-m</button>
        <button class="btn-l">.btn-l</button>
        <button class="btn-d">.btn-d</button>
        <button class="btn-navy">.btn-navy</button>
        <button class="btn-lightgray">.btn-lightgray</button>
        <button class="btn-lightyellow">.btn-lightyellow</button>
        <button class="btn-lightpink">.btn-lightpink</button>
        <button class="btn-darkpink">.btn-darkpink</button>
        <button class="btn-blue">.btn-blue</button>
        <button class="btn-filter">.btn-filter</button>
        <button class="btn-filter-active">.btn-filter-active</button>
    </div>
    <div class="check-box ui-div">
        <h4 class="ui-header">check-btn</h4>
        <input type="checkbox" id="c1" name="cc" />
        <label for="c1"><span></span>c1</label>
        <p>
        <input type="checkbox" id="c2" name="cc" />
        <label for="c2"><span></span>c2</label>
        <p><br/>
    </div>
    <div class="radio-box ui-div">
        <h4 class="ui-header">radio-btn</h4>
        <input type="radio" id="r1" name="rr" />
        <label for="r1"><span></span>r1</label>
        <p>
        <input type="radio" id="r2" name="rr" />
        <label for="r2"><span></span>r2</label>
    </div>
    <div class="input ui-div">
        <h4 class="ui-header">input</h4>
        <div class="input-wrap">
            <p class="input-title">이메일</p>
            <label class="input-label"><input placeholder="입력 폼" type="text" required><p class="confirm-text nickname">이미 사용중인 아이디 입니다요!</p></label><br>
        </div>
    </div>
    <div class="ui-div">
        <h4 class="ui-header">select-box custom</h4>
        <div class="custom-select" style="width:200px;">
            <select>
                <option value="0">정렬</option>
                <option value="1">인기순</option>
                <option value="2">최신순</option>
                
                <!-- <option value="3">어쩌개</option>
                <option value="4">퍼그</option>
                <option value="5">저쩌개</option>
                <option value="6">똥개</option>
                <option value="7">개똥</option>
                <option value="8">삽살이</option>
                <option value="9">진돗개</option>
                <option value="10">치와와</option>
                <option value="11">비숑</option>
                <option value="12">흰둥이</option> -->
            </select>
        </div>
    </div>
    <div class="select-box select-script">
        <label for="selectbox">최신순</label>
        <select id="selectbox" title="선택 구분">
            <!-- <option selected="selected">선택해 주세요</option> -->
            <option  selected="selected">최신순</option>
            <option>인기순</option>
            <!-- <option>선택3</option> -->
            <!-- <option>선택4</option> -->
        </select>
    </div>


    <script src="/js/DND-JS/ui_kit.js"></script>

</body>
</html>