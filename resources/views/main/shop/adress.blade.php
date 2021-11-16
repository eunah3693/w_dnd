@extends('main.layouts.layout')

@section('title', '배송지 입력')
@section('nav', 100002)

@section('top_back', '/myhistory')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/css/DND-STYLE/adress.css">
<link rel="stylesheet" href="/css/DND-STYLE/my_history.css">
@endsection


@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/DND-JS/adress.js"></script>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

<script>
var element_wrap = document.getElementById('wrap');
function foldDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_wrap.style.display = 'none';
}

function DaumPostcode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }


                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('zipcode').value = data.zonecode;
                document.getElementById("addr1").value = addr;
                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'flex';
}
function selectOrderMsg(val){
    var msg = $('#note').val();
    if(val != '직접 입력')
    {
        $('#msg').val(msg);//.attr('type','hidden');
        $(".adress-form .select_wrap").css({
           "padding-bottom":"10px"
        })
    }else{
        $('#msg').val('');//.attr('type','text');
        $(".adress-form .select_wrap").css({
           "padding-bottom":"0"
        })
    }
}
function changeAddr(val)
{
    if(val != '')
    {
        $.post('/api/user/addr', {idx:val}, function(res){
            if(res.status == 200)
            {
                $('#name').val(res.data.name).attr('disabled','true');
                $('#tel').val(res.data.tel).attr('disabled','true');
                $('#zipcode').val(res.data.zip).attr('disabled','true');
                $('#addr1').val(res.data.addr1).attr('disabled','true');
                $('#addr2').val(res.data.addr2).attr('disabled','true');
                $('#msg').val(res.data.msg);
                $('.addr_save').css('display','none');
                $("input:checkbox[id='addr_save']").prop('checked',false);
            }
        });
    }else
    {
        $('#name').val('').attr('disabled',false);
        $('#tel').val('').attr('disabled',false);
        $('#zipcode').val('').attr('disabled',false);
        $('#addr1').val('').attr('disabled',false);
        $('#addr2').val('').attr('disabled',false);
        $('#msg').val('');
        $('.addr_save').css('display','');
        $("input:checkbox[id='addr_save']").prop('checked',true);
    }
}
$(function(){
    $("#note").selectmenu({
        change: function (event, data) {
            console.log(data.item.value);
            selectOrderMsg(data.item.value);
        },
    });
    $('.adress-history').selectmenu({
        change: function (event, data) {
            changeAddr(data.item.value);

        },
    });
})
</script>
@endsection

@section('content')
<section>
        <ul>
            <li class="history-lists">
                <div class="a-group">
                    <div class="img-box">
                        <img src="/files/{{ $data->event->thum_file_idx }}" alt="">
                    </div>
                    <div class="cont-box">
                        <p class="title"><a onclick="return false;">{{ $data->event->title }}</a></p>
                        <p class="status" style="color:#ef998c; margin-top:0;">{{ number_format($data->event->participation_point) }} 트릿</p>

                    </div>
                </div>
            </li>
        </ul>

    <div class="adress-box">
        <div class="head clearboth">
            <p>배송지정보</p>
            <div class="adress-history-box">
            <select class="adress-history" style="display: none">
                <option value="">최근 배송지</option>
                @foreach ($addr as $ar)
                    <option value="{{ $ar->idx }}">{{ $ar->name }}님 배송지</option>
                @endforeach
                <option value="">신규 배송지</option>
            </select>
        </div>
        </div>
        <div class="adress-form address">
            <form class="info clearboth" action="/adress/insert" id="addr_form" method="POST">
                @csrf
                <p>수령인</p><input type="text" name="name" id="name" placeholder="이름을 입력해주세요" value="{{ $data->name }}" required><input type="hidden" name="idx" value="{{ $data->idx }}" >
                <p>휴대폰</p><input type="tel" name="tel"  id="tel" placeholder="번호를 입력해주세요" value="{{ $data->tel }}"  required>
                <p class="clearboth">배송비</p><p style="display:block; float: left; width: calc(100% - 140px); padding-left:15px; ">착 불</p>
                <p class="clearboth">우편번호</p><input  class="zipcode-input" id="zipcode" value="{{ $data->zip }}" name="zip" type="text" required><button type="button" onclick="DaumPostcode()" class="clearboth zipcode">우편번호찾기</button>
                <p>주소지</p><input type="text" id="addr1" value="{{ $data->addr1 }}" name="addr1" required>
                <p>상세주소</p><input type="text" id="addr2" name="addr2" value="{{ $data->addr2 }}" required>
                <div id="wrap" style="display:none;width: 50%;height: 600px;min-height: 600px;max-height: 600px;margin: 5px 0px;position: relative;transform: scale(2);margin: 167px;padding-top: 146px;z-index: 99;"></div>
                <p>배송메모</p>
                <div class="select_wrap">
                <select id="note" >
                    <option style="font-size : 15px;" value="">배송메모를 선택해주세요.</option>
                    <option style="font-size : 15px;" value="배송 전 미리 연락 주세요">배송 전 미리 연락 주세요.</option>
                    <option style="font-size : 15px;" value="문 앞에 놔주세요">문 앞에 놔주세요.</option>
                    <option style="font-size : 15px;" value="택배함에 맡겨주세요">택배함에 맡겨주세요.</option>
                    <option style="font-size : 15px;" value="관리실에 맡겨 주세요">관리실에 맡겨 주세요.</option>
                </select>
                <img src="/image/icon/arrow_down.svg" alt="아래" class="arrow_down">
                </div>
                <input value="{{ $data->msg }}" id="msg" type="text" placeholder="배송메모를 직접 입력 할 수 있습니다." name="msg" class="input_txt">
                <div class="addr_save" @if($data->name && $data->zip) style="display:none;" @endif>
                    <input type="checkbox"  @if(!$data->name && !$data->zip) checked @endif class="" id="addr_save" name="addr_save" value="Y" >
                    <label>배송지 저장 및 기본 배송지로 사용</label>
                </div>
                <fieldset class="chkbox-list">
                    <div class="chkall_line">
                        <input class="chk all" id="allagree" name="all_agree" type="checkbox" value="6">
                        <img src="/image/icon/check_no.svg" alt="동의여부" class="chkall_box">
                        <label for="allagree"><span class="agree_line">개인정보 제 3자 정보 제공 동의</span> <span class="agree_detail" onclick="termsLayerPopup('개인정보 제3자 동의')">[ 보기 ]</span></label>
                    </div>
                    {{--<div class="line"></div>
                    <div class="chk_line">
                         <input class="chk ele" id="cb1"  name="sms_agree" type="checkbox" required value="1">
                         <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                         <label for="cb1"> <span>만 14세 이상 결제 동의</span></label>
                    </div>
                    <div class="chk_line">
                        <input class="chk ele" id="cb3"  name="email_agree" type="checkbox" required value="2">
                        <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                        <label for="cb3"><span>개인정보 제 3자 정보 제공 동의</span></label>
                    </div>
                    <div class="chk_line">
                        <input class="chk ele" id="cb4"  name="email_agree" type="checkbox" required value="3">
                        <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                        <label for="cb4"><span>구매확인 동의</span></label>
                    </div>--}}
                </fieldset>
                <button class="save-btn" type="button" onclick="saveAddr()">입력 완료</button>
            </form>
        </div>
    </div>
</section>
<div class="popup_panel_terms clearboth">
    <div class="popup_contents_terms">
        <h2 class="popup-title">개인정보 제3자 동의</h2>
        <p class="popup-subtitle"></p>
        <div class="main-contents-terms">
        </div>
        <div class="btn-lists">
            <a href="javascript:void(0)" class="close-btn"  onclick="termsLayerPopupClose()">닫기</a>
        </div>
    </div>
</div>
@endsection



