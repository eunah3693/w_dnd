$(document).ready(function () {
    $(".chkall_box").click(function () {
        $(".chk.all").click();
    });
    $(".chk_box").click(function () {
        $(this).parent().find(".chk.ele").click();
    });

    $("input:checkbox").change(function () {
        var chkLength = $(".ele:checked").length;
        if ($(this).is(".chk.all")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "image/icon/check_ok.svg");
                if (chkLength != 3) {
                    $(".chk.ele")
                        .prop("checked", true)
                        .parent()
                        .find(".chk_box")
                        .attr("src", "image/icon/small_check_ok.svg");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "image/icon/check_no.svg");
                $(".chk.ele").trigger("click");
            }
        } else if ($(this).is(".chk.ele")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_ok.svg");

                if (chkLength == 3) {
                    $(".chk.all").trigger("click");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_no.svg");
                if (chkLength != 3) {
                    $(".chk.all")
                        .prop("checked", false)
                        .parent()
                        .find(".chkall_box")
                        .attr("src", "image/icon/check_no.svg");
                }
            }
        }
    });

    var arrow_num = 0;
    $(".arrow_down").click(function () {
        if (arrow_num == 0) {
            $(".ui-selectmenu-button.ui-button").trigger("click");
            arrow_num = 1;
        } else {
            $(".ui-selectmenu-button.ui-button").blur();
            arrow_num = 0;
        }
    });
});


function saveAddr()
{
    if($("input:checkbox[name='all_agree']").is(":checked")  == true)
    {
        $('#addr_form').submit();
    }else{
        alert('개인정보 제 3자 정보 제공 동의는 필수입니다.')
    }
}
// 이용약관 팝업
function termsLayerPopup(type) {
    var $panel = $(".popup_panel_terms");
    console.log($panel);
    var $panelContents = $panel.find(".popup_contents_terms");
    var $panelContents =
        "본 이용약관은 서비스를 이용하는 인터넷 사용자들의 기본권인 사생활 비밀과 자유 및 통신 비밀을 보장하고 불법적인 도청, 정보 유출로 인한 인권침해가 나타나지 않도록 하고자 명시하는 것입니다.<br><br>고객님의 개인정보보호를 매우 중요시하며, 『정보통신망이용촉진및정보보호에관한 법률』상의 개인정보보호규정 및 정보통신부가 제정한『개인정보보호지침』을 준수하고 있습니다.<br><br>개인정보보호정책을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다. <br><br>01.개인 정보의 수집 목적 및 이용<br><br>고객님에게 서비스를 제공하기 위해 위한 최소한의 정보를 필수 사항으로 수집합니다. 제공하신 모든 정보는 상기 목적에 필요한 용도 이외로는 사용되지 않으며 수집 정보의 범위나 사용 목적, 용도가 변경될 시에는 반드시 고객님께 사전 동의를 구할 것입니다. <br><br>02.개인 정보 수집 항목 및 보유, 이용 기간 보유, 이용 기간<br><br>분양자료 제공을 위해 제공 받는 고객님의 정보는 이름,전화번호, E-mail 주소, 핸드폰 번호, 입니다. 고객님이 제공하는 개인정보는 상담서비스를 받은 후 특별한 이유 없이는 즉시파기 합니다. <br><br>03.개인 정보 제공 및 공유<br><br>원칙적으로 고객님의 개인정보를 서비스와 무관한 타 기업, 기관에 공개하지 않습니다. 다만,고객님의 개인정보를 공유하는 경우 다음과 같습니다. <br><br>이외에는 아래의 경우에 준합니다.<br><br>- 관계법령에 의하여 수사상의 목적으로 관계기관으로부터의 요구가 있을 경우 <br>- 통계작성학술연구나 시장조사를 위하여 특정 개인을 식별할 수 없는 형태로 광고주협력사나 연구단체 등에 제공하는 경우 <br>- 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우 <br>- 그러나 예외 사항에서도 관계법령에 의하거나 수사기관의 요청에 의해 정보를 제공한 경우에는 이를 당사자에게 고지하는것을 원칙으로 운영하고 있습니다. <br><br>법률상의 근거에 의해 부득이하게 고지를 하지 못할 수도 있습니다. <br><br>본래의 수집목적 및 이용목적에 반하여 무분별하게 정보가 제공되지 않도록 최대한 노력하겠습니다. <br><br>04.개인정보수집에 대한 동의 <br><br>고객님이 분양상담 요청시 개인정보보호방침 「동의」를 체크하면 개인정보 수집에 대해 동의한 것으로 봅니다.<br><br>05.개인정보의 수집 이용,제공에 대한 동의 철회<br><br>개인정보의 수집 이용,제공에 대한 동의 철회 <br><br>06.개인정보의 열람 및 정정 <br><br>「개인정보보호법 제35조(개인정보의 열람), 제36조(개인정보의 정정·삭제), 제37조(개인정보의 처리정지 등)에 따라 정보주체는 우리 관이 보유하고 있는 개인정보의 열람 및 정정, 삭제 및 처리정지를 청구할 수 있습니다. <br><br>07.개인정보의 보유기간 및 이용기간<br><br>고객님의 개인정보는 다음과 같이 개인정보의 수집목적 또는 제공받은 목적이 달성되면 파기됩니다. 단, 상법 등 관련 법령의 규정에 의하여 다음과 같이 거래 관련 권리 의무 관계의 확인 등을 이유로 일정기간 보유하여야 할 필요가 있을 경우에는 일정기간 보유합니다.<br><br>- 계약 또는 청약철회 등에 관한 기록 : 5년 <br>- 대금결제 및 재화등의 공급에 관한 기록 : 5년 <br>- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년<br><br>08.개인정보호를 위한 관리대책 <br><br>귀하의 개인정보를 취급함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 대책을 강구하고 있습니다. <br><br>- 귀하의 개인정보는 관리자의 메일로 전송되어 서버에 따로 저장하지 않습니다.<br>- 해킹 등 외부 침입에 대비하여 메일 수신후 상담 및 상품소개를 마친후에는 정보를 즉시 삭제하고 있습니다.<br><br>개인정보에 대한 접근권한을 아래와 같이 제한하고 있습니다. <br><br>- 상담 및 상품소개 업무를 수행하는자 <br>- 개인정보관리책임자 및 담당자 등 개인정보관리업무를 수행하는 자 <br>- 기타 업무상 개인정보의 취급이 불가피한 자는 이용자 개인의 실수나 기본적인 인터넷의 위험성 때문에 일어나는 일들에 대해 책임을 지지 않습니다. 고객님 본인의 개인정보를 보호하기 위해서 예약번호를 적절하게 관리하고 여기에 대한 책임을 져야 합니다.<br><br>09.이용자의 권리와 의무<br><br>고객님의 개인정보를 정확하게 입력하여 사고예방에 만전을 기해 주시기 바랍니다. 이용자가 입력한 부정확한 정보로 인해 발생하는 사고의 책임은 이용자 자신에게 있으며 타인 정보의 도용 등 허위정보를 입력할 경우 요청하신 상담 및 상품소개가 불가하며 『정보통신망이용촉진및정보보호등에관한법률』등에 의해 처벌받을 수 있습니다. <br><br>10.개인정보의 파기관리 <br><br>고객님의 요청이 있거나, 개인정보의 수집목적 또는 제공받은 목적을 달성하였을때 아래와 같은 방법으로 파기관리를 하고 있습니다. <br><br>-종이에 출력된 개인정보: 분쇄기를 이용하여 분쇄 <br>-전자적파일형태로 저장된 개인정보: 개인정보는 남기지 않으며, 기록을 재생할수 없는 방법을 통하여 기록삭제 <br><br>11.도용된 개인정보에 대한 조치 <br><br>고객이 타인의 기타 개인정보를 도용하여 회원가입 등을 하였음을 알게된 때, 지체없이 필요한 조치를 취하게 됩니다. <br><br>13.개인정보보호 정책의 개정에 관한 사항 <br><br>고객이 타인의 기타 개인정보를 도용하여 회원가입 등을 하였음을 알게된 때, 지체없이 필요한 조치를 취하게 됩니다. <br><br>○ 개인정보침해신고센터 <br>- 전화 : 1336 <br>- URL : http://www.cyberprivacy.or.kr <br><br>○ 정보보호마크 인증위원회 <br>- 전화 : 02-580-0533 <br>- URL : http://www.privacymark.or.kr <br><br>○ 대검찰청 인터넷범죄수사센터 <br>- 전화 : 02-3500-3600 <br>- URL : http://icic.sppo.go.kr <br><br>○ 경찰청 사이버 테러 대응 센터 <br>- URL : http://www.ctrc.go.kr ";
    $panel.fadeIn();
    //console.log(res.data.content);
    $(".popup-title").html(type);
    $(".main-contents-terms").html($panelContents);
}

function termsLayerPopupClose() {
    var $panel = $(".popup_panel_terms");
    $panel.fadeOut();
}
