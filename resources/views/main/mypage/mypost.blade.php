@extends('main.layouts.layout')

@section('title', 'μΌμ μμ±')
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
                alert("μ€λ₯μλλ€.");
            }
        });
}
function deleteFile(src, idx)
{
    if(confirm('μ¬μ§μ μ­μ νμκ² μ΅λκΉ?'))
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
    // μλ‘λλ μ¬μ§μ΄λ μμμ΄ μλμ§ νμΈ
}
function missionSubmit(idx){
    // κ²μ¦
    if($("input:checkbox:checked").length == '0')
    {
        alert("νλμ΄μμ ν«μ μ ννμΈμ");
        return false;
    }
    if($('#textarea').val() == '')
    {
        alert("λ΄μ©μ μμ±ν΄μ£ΌμΈμ!");
        return false;
    }
    // μλ‘λλ μ¬μ§μ΄λ μμμ΄ μλμ§ νμΈ
    $.post('/api/post/file', { post_idx : idx }, function(res){
        if(res.count != 0){
            if(confirm('μΌμμ μλ‘λ νμκ² μ΅λκΉ?'))
            {
                $('#mission_form').submit();
            }
        }
        else{
            alert("νλ μ΄μμ μ¬μ§ νΉμ λμμμ μλ‘λν΄μ£ΌμΈμ");
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
            <h2>μΌμ</h2>
            <p>
                λ°λ €κ²¬κ³Όμ μμ€ν μΌμμ μ¬λ €μ
            </p>
            <p class="upload-guide">* μμμ 30μ΄ μ΄λ΄λ‘ μλ‘λ ν΄ μ£ΌμΈμ. *</p>

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
            <h2>κΈ μμ±</h2>
            <div class="txt-box">
                <textarea id="textarea" name="content" class="textarea" rows="12"></textarea>
                <span class="tag-box">
                    #μΌμ
                </span>
            </div>
        </div>

        <a class="save-btn" id="btn_popup_open" onclick="missionSubmit({{$post->idx}})">μΌμμλ‘λ</a>
        <!-- <a href="javascript:void(0)" id="btn_popup_open">νμ μ΄κΈ°</a> -->
        <div class="popup_panel">
            <div class="popup_bg"></div>
            <div class="popup_contents">
                <a href="javascript:void(0)" id="btn_popup_close">λ«κΈ°</a>
            </div>
        </div>
    </section>
</form>
@endsection
