$(document).on('click', '.ele', function(){
    var totLength = $('.ele').length;
    var chkLength = $('.ele:checked').length;

    if (totLength > 0 && totLength == chkLength) {
        $('.all').prop("checked",true);
    } else {
        $('.all').prop("checked",false);
    }
});

$(document).ready(function(){
    init_orderid();
    $("#allagree").click(function(){
        if($(".all").is(':checked')){
            $("input[type=checkbox]").prop("checked",true);
        } else {
            $("input[type=checkbox]").prop("checked", false);
        }
    });
});

//비밀번호 유효성
function join_pw_chk(){

    var pwExt = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,25}$/;

    var pw = $("#pw").val();
    var r_pw = $("#r_pw").val();

    // 조합 여부
    if(!pwExt.test(pw)){
      $(".confirm-text.pw").css('color','red').text('숫자+영문자+특수문자 조합으로 8자리 이상');
      _pw_chk = false;
      return false;
    }

    // 비밀번호 확인
    if(pw != r_pw){
      $(".confirm-text.pw").css('color','red').text('비밀번호가 서로 같지 않습니다.');
      _pw_chk = false;
      return false;
    }
    // 사용 가능 문자
    $(".confirm-text.pw").css('color','yellow').css('float','right').text('사용가능합니다.');
    _pw_chk = true;
  }


// 인증창 종료후 인증데이터 리턴 함수
function auth_data( frm )
{
    console.log(frm);
    if(frm.code == 00){
        console.log("성공");
        $.post('/api/find_pw', function(res){
            if(res.status == 201)
            {
                alert(res.msg);
                location.reload();
            }else if(res.status == 200)
            {
                $('#user_id').val(res.id);
                $('#user_idx').val(res.idx);
                $('#auth_section').css('display', 'none');
                $('#pw_section').css('display', '');
            }
        });
    }
    //스마트폰 처리
    if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
    {
        document.getElementById( "cert_info" ).style.display = "";
        document.getElementById( "kcp_cert"  ).style.display = "none";
        document.getElementById( "join_data"  ).style.display = "";
    }

}

// 인증창 호출 함수
function auth_type_check()
{
    var auth_form = document.form_auth;
    console.log(auth_form);

    if( auth_form.ordr_idxx.value == "" )
    {
        alert( "요청번호는 필수 입니다." );

        return false;
    }
    else
    {
        if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
        {
            auth_form.target = "kcp_cert";

            document.getElementById( "cert_info" ).style.display = "none";
            document.getElementById( "kcp_cert"  ).style.display = "";
            document.getElementById( "join_data"  ).style.display = "none";
        }
        else
        {
            var return_gubun;
            var width  = 410;
            var height = 500;

            var leftpos = screen.width  / 2 - ( width  / 2 );
            var toppos  = screen.height / 2 - ( height / 2 );

            var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
            var position = ",left=" + leftpos + ", top="    + toppos;
            var AUTH_POP = window.open('','auth_popup', winopts + position);

            auth_form.target = "auth_popup";
        }

        auth_form.action = "/kcp/SMART_ENC/smartcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소

        auth_form.submit();

        return true;
    }
}

// 요청번호 생성 예제 ( up_hash 생성시 필요 )
init_orderid();
function init_orderid()
{
    var today = new Date();
    var year  = today.getFullYear();
    var month = today.getMonth()+ 1;
    var date  = today.getDate();
    var time  = today.getTime();

    if(parseInt(month) < 10)
    {
        month = "0" + month;
    }

    var vOrderID = year + "" + month + "" + date + "" + time;

    document.form_auth.ordr_idxx.value = vOrderID;
}
$("#join_form").submit(function(e){
    if(_pw_chk && _ni_chk && _em_chk && _ph_chk){
        return true;
    }else{
        alert("필수입력란을 확인해주세요.");
    }
    return false;
});

