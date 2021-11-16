@extends('main.layouts.layout')

@section('title', '일상 작성')
@section('nav', 100004)
@section('top_back', 'javascript:window.history.back()')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mission_post.css">
<link rel="stylesheet" href="js/plugins/mentiony/css/jquery.mentiony.css">
@endsection

@section('js')
<script src="js/plugins/mentiony/js/jquery.mentiony.js"></script>
<script src="/js/DND-JS/mission_post.js"></script>
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
                        html =  '<li id="list_'+result.idx+'">'+
                                '<label class="pic-label">'+
                                '<video poster="/thum/'+result.idx+'" src="/files/'+result.idx+'" controls></video>'+
                                '<i onclick="deleteFile(\'/files/'+result.idx+'\', '+result.idx+')" class="xi-close-circle-o xi-3x"></i>'+
                                '</label>'+
                                '</li>';
                    }else{
                        html =  '<li id="list_'+result.idx+'">'+
                                '<label class="pic-label">'+
                                '<img src="/thum/'+result.idx+'" alt="">'+
                                '<i onclick="deleteFile(\'/files/'+result.idx+'\', '+result.idx+')" class="xi-close-circle-o xi-3x"></i>'+
                                '</label>'+
                                '</li>';
                    }
                    $('#image_list').before(html);
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
        $.ajax({
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            method: 'DELETE',
            url: src,
            cache: false,
            success: function success(result) {
                if(result.success == true)
                {
                    $("#list_"+idx).css('display','none');
                }
            },
            error: function error(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR, textStatus + " " + errorThrown);
            }
        });
    }
}
function missionFileList(){
    // 업로드된 사진이나 영상이 있는지 확인
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
    // 업로드된 사진이나 영상이 있는지 확인
    $.post('/api/post/file', { post_idx : idx }, function(res){
        if(res.count != 0){
            if(confirm('일상을 업로드 하시겠습니까?'))
            {
                $('#mission_form').submit();
            }
        }
        else{
            alert("하나 이상의 사진 혹은 동영상을 업로드해주세요");
            return false;
        }
    });
    return false;
}
</script>
@endsection

@section('content')
<form action="/api/post/dailylife" method="POST" id="mission_form">
    <section>
        <div class="mission-description">
            <h2>일상</h2>
            <p>
                반려견과의 소중한 일상을 올려요
            </p>
            <p class="upload-guide">* 영상은 30초 이내로 업로드 해 주세요. *</p>

        </div>
        <div class="pet-filter clearboth">
            @foreach ($pet as $item)
                <label class="box-radio-input">
                    <input type="checkbox" name="pet_idx[]" {{ $loop->index == 0 ? 'checked':'' }} value="{{ $item->idx }}">
                    <div>
                        @if ($item->file_idx)
                        <img src="/files/{{ $item->file_idx }}" alt="{{ $item->pet }}">
                        @else
                        <img src="/image/app/no_user_profile.png" alt="{{ $item->pet }}">
                        @endif
                    </div>
                </label>
            @endforeach
        </div>
        <input type="hidden" name="post_idx" id="post_idx" value="{{ $post->idx }}">
        <input type="hidden" name="user_idx" id="user_idx" value="{{ $post->user_idx }}">
        <div class="horizontal-scroll-menu">
            <ul class="filter-scroll">
                @foreach ($post->files as $item)
                @if (false !== mb_strpos( $item->mime_type, "video"))
                <li id="list_{{ $item->idx }}">
                    <label class="pic-label">
                        <video poster="/thum/{{ $item->idx }}" controls src="/files/{{ $item->idx }}" ></video>
                        <i onclick="deleteFile('/files/{{ $item->idx }}', {{ $item->idx }})" class="xi-close-circle-o xi-3x"></i>
                    </label>
                </li>
                @else
                <li id="list_{{ $item->idx }}">
                    <label class="pic-label">
                        <img src="/thum/{{ $item->idx }}" alt="">
                        <i  onclick="deleteFile('/files/{{ $item->idx }}', {{ $item->idx }})" class="xi-close-circle-o xi-3x"></i>
                    </label>
                </li>
                @endif
                @endforeach
                <li id="image_list">
                    <input type="file" id="pic" onchange="uploadFile()" accept="image/*,video/*">
                    <label class="pic-label after" for="pic"><div class="after-div"><img src="/image/mission-plus.svg" alt=""></div></label>
                </li>
            </ul>
        </div>
        <div class="cont-box1">
            <h2>글 작성</h2>
            <div class="txt-box">
                <textarea id="textarea" name="content" class="textarea" rows="12"></textarea>
                <span class="tag-box">
                    #일상
                </span>
            </div>
        </div>

        <a class="save-btn" id="btn_popup_open" onclick="missionSubmit({{$post->idx}})">일상업로드</a>
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
