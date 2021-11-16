@extends('main.layouts.layout')

@section('title', '알림 설정')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/setting.css">
<link rel="stylesheet" href="css/DND-STYLE/setting_notification.css">


@endsection

@section('js')
<script>
    $('input').click(function(){
        var val = $(this).is(":checked") === true ? 'Y':'N';
        var data = {
            val : val,
            key : $(this).data('col')
        }
        var name = $(this).data('name');
        $.post('/api/myconfig/update', data, function(res) {
            if(res.status == 200)
            {
                alert( name + (res.msg).replace(/\\n/g,"\n"));
                location.reload();
            }
        }, 'json');
    });
</script>
@endsection

@section('content')
    <section>
        <div class="lists">
            <p>푸시 알림</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="push" type="checkbox" data-name="앱푸시"  data-col="push_agree" @if($data->push_agree == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="push"></label>
            </div>
        </div>
    </section>
    <section>
        <div class="lists">
            <p>좋아요 푸시</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="like" type="checkbox" data-name="좋아요푸시" data-col="push_like" @if($data->push_like == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="like"></label>
            </div>
        </div>
    </section>
    <section>
        <div class="lists">
            <p>댓글 푸시</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="comment" type="checkbox" data-name="댓글푸시" data-col="push_reply" @if($data->push_reply == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="comment"></label>
            </div>
        </div>
    </section>
    <section>
        <div class="lists">
            <p>SMS</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="sms" type="checkbox" data-name="SMS" data-col="sms_agree" @if($data->sms_agree == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="sms"></label>
            </div>
        </div>
    </section>
    <section>
        <div class="lists">
            <p>알림톡</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="talk" type="checkbox" data-name="알림톡" data-col="alimtalk_agree" @if($data->alimtalk_agree == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="talk"></label>
            </div>
        </div>
    </section>
    <section>
        <div class="lists">
            <p>이메일</p>
        </div>
        <div class="toggle-wrapper">
            <div class="toggle normal">
                <input id="email" type="checkbox" data-name="이메일" data-col="email_agree" @if($data->email_agree == 'Y') checked @endif value="1"/>
                <label class="toggle-item" for="email"></label>
            </div>
        </div>
    </section>
@endsection
