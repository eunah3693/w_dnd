@extends('main.layouts.layout')

@section('title', '포스트 수정')
@section('nav', 100001)
@section('top_back', 'javascript:window.history.back()')

@section('css')
<link rel="stylesheet" href="/css/DND-STYLE/mission_post.css">
<link rel="stylesheet" href="/js/plugins/mentiony/css/jquery.mentiony.css">
@endsection

@section('js')
<script src="/js/plugins/mentiony/js/jquery.mentiony.js"></script>
<script src="/js/DND-JS/mission_post.js"></script>
@if (count($pet) === 0)
<script>
alert("팻 등록이 필요합니다");
window.location = "/mypet";
</script>
@endif
<script>

function uploadFile(){
    var form = new FormData();
    form.append( "file", $("#pic")[0].files[0] );
    form.append("user_idx", $("#user_idx").val());
    form.append("table_name", "post_tbl");
    form.append("table_idx",$("#post_idx").val());
    $('#pic').val('');
    $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/files',
            processData: false,
            contentType: false,
            data: form,
            type: 'POST',
            success: function(result){
                console.log(result);
                if(result.success == true)
                {
                    var html = '';
                    if(result.type == 'video'){
                        html =  '<li id="list_'+result.idx+'" class="li_list">'+
                                '<label class="pic-label">'+
                                '<video poster="/thum/'+result.idx+'" src="/files/'+result.idx+'" controls></video>'+
                                '<i onclick="deleteFile(\'/files/'+result.idx+'\', '+result.idx+')" class="xi-close-circle-o xi-3x"></i>'+
                                '</label>'+
                                '</li>';
                    }else{
                        html =  '<li id="list_'+result.idx+'" class="li_list">'+
                                '<label class="pic-label">'+
                                '<img src="/thum/'+result.idx+'" alt="">'+
                                '<i onclick="deleteFile(\'/files/'+result.idx+'\', '+result.idx+')" class="xi-close-circle-o xi-3x"></i>'+
                                '</label>'+
                                '</li>';
                    }
                    $('#image_list').before(html);
                }else if(result.success == false)
                {
                    alert(result.msg);
                }
            },
            error:function(request,status,error){
                console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                alert("오류입니다.");
            }
        });
}
function deleteFile(src, idx)
{
    if(confirm('사진을 삭제하시겠습니까?'))
    {
        $("#list_"+idx).remove()
        var idx_list = $('#delete_idx').val();
        if(idx_list) idx_list +=','+idx;
        else idx_list = idx;
        $('#delete_idx').val(idx_list);
    }
}

function missionSubmit(idx){
    // 검증
    if($("input:checkbox:checked").length == '0')
    {
        alert("하나이상의 펫을 선택하세요");
        return false;
    }
    if($('#textarea').val() == '')
    {
        alert("내용을 작성해주세요!");
        return false;
    }
    console.log('22');
    console.log($('.li_list').length);
    // 업로드된 사진이나 영상이 있는지 확인
    if($('.li_list').length == 0)
    {
        alert("하나 이상의 사진 혹은 동영상을 업로드해주세요");
        return false;
    }
    if(confirm('수정하시겠습니까?'))
    {
        $('#mission_form').submit();
    }



    return false;
}
$('.mentiony-content').html('{!! $data->content !!}').change();
</script>
@endsection

@section('content')
<form action="/api/post/user_update" method="POST" id="mission_form">
    <section>
        <div class="mission-description">
            <!-- <h2>미션 안내</h2> -->
            @isset($data->mission->missionPool)
            <h3 class="md-h2">{!! preg_replace("/\]/", "]</span>", preg_replace("/\[/", "<span>[", $data->mission->missionPool->title)) !!}</h3>
                <p>
                    {{ $data->mission->missionPool->sub_title }}
                </p>
            @else
            <h3 class="md-h2">일상</h3>
                <p>
                    반려견과의 소중한 일상을 올려요
                </p>
            @endisset
                <p style="color:red;display:none" id="alert_msg">하나 이상의 사진 혹은 동영상을 업로드해주세요!</p>
        </div>
        <div class="pet-filter clearboth">
            @foreach ($pet as $item)
                <label class="box-radio-input">
                    <input type="checkbox" name="pet_idx[]" {{ substr_count($data->pet_idx,  $item->idx) >= 1 ? 'checked':'' }} value="{{ $item->idx }}">
                    <div>
                        @if ($item->file_idx)
                        <img src="/files/{{ $item->file_idx }}" alt="{{ $item->pet }}">
                        @else
                        <img src="/image/icon/pet_profile.svg" alt="{{ $item->pet }}">
                        @endif
                    </div>
                </label>
            @endforeach
        </div>
        <input type="hidden" name="post_idx" id="post_idx" value="{{ $data->idx }}">
        <input type="hidden" name="delete_idx" id="delete_idx" value="">
        <input type="hidden" name="user_idx" id="user_idx" value="{{ $data->user_idx }}">
        <div class="horizontal-scroll-menu">
            <ul class="filter-scroll">
                @foreach ($data->files as $item)
                @if (false !== mb_strpos( $item->mime_type, "video"))
                <li id="list_{{ $item->idx }}" class="li_list">
                    <label class="pic-label">
                        <video poster="/thum/{{ $item->idx }}" controls src="/files/{{ $item->idx }}" ></video>
                        <i onclick="deleteFile('/files/{{ $item->idx }}', {{ $item->idx }})" class="xi-close-circle-o xi-3x"></i>
                    </label>
                </li>
                @else
                <li id="list_{{ $item->idx }}" class="li_list">
                    <label class="pic-label">
                        <img src="/thum/{{ $item->idx }}" alt="">
                        <i  onclick="deleteFile('/files/{{ $item->idx }}', {{ $item->idx }})" class="xi-close-circle-o xi-3x"></i>
                    </label>
                </li>
                @endif
                @endforeach
                <li  id="image_list">
                    <input type="file" id="pic" onchange="uploadFile()" accept="image/*,video/*">
                    <label class="pic-label after" for="pic"><div class="after-div"><img src="/image/mission-plus.svg" alt=""></div></label>
                </li>
            </ul>
        </div>
        <div class="cont-box1">
            <h2>글 작성</h2>
            <div class="txt-box">
                <textarea id="textarea" name="content" class="textarea" rows="12" placeholder="글을 작성 해 주세요" >{{  $data->content }}</textarea>
                @isset($data->mission->missionPool)
                <span class="tag-box">
                    @foreach ( explode(', ',$data->mission->missionPool->tag) as $item)
                    #{{ $item }}
                    @endforeach
                </span>
                @endisset
            </div>
        </div>
        <a class="save-btn" id="btn_popup_open" onclick="missionSubmit({{$data->idx}})">수정</a>
        <!-- <a href="javascript:void(0)" id="btn_popup_open">팝업 열기</a> -->
        <div class="popup_panel">
            <div class="popup_bg"></div>
            <div class="popup_contents">
                <a href="javascript:void(0)" id="btn_popup_close">닫기</a>
            </div>
        </div>
    </section>
</form>
@endsection
