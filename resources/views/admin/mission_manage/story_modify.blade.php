@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1400px">

                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default" style="position:relative;">
                            <h3 class="block-title">스토리퀘스트 @isset($title){{ $title }}@endisset</h3>
                        </div>
                        <div class="block-content">
                            <form method="POST"  id="story_save" action="@isset($title){{ $type }}@endisset" enctype="multipart/form-data" onsubmit="setFormSubmitting()">
                                @csrf
                                <div class="form-group form-row">
                                    <div class="col-4">
                                    <label >미션종류</label>
                                        <select class="form-control form_mission" name="category">
                                            <option value="스토리미션">스토리미션</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label >타입</label>
                                            <select class="form-control form_mission" name="group">
                                                <option @isset($data){{ $data->group == '' ? 'selected':'' }}@endisset value="">없음</option>
                                                <option @isset($data){{ $data->group === 0 ? 'selected':'' }}@endisset value="0">퍼피</option>
                                                <option @isset($data){{ $data->group == 1 ? 'selected':'' }}@endisset value="1">성견</option>
                                                <option @isset($data){{ $data->group == 2 ? 'selected':'' }}@endisset value="2">노령견</option>
                                            </select>
                                        </div>
                                </div>
                                <input name="idx" type="hidden" value="@isset($data){{ $data->idx }}@endisset">
                                <div class="form-group form-row">
                                    <div class="col-3">
                                    <label >공개여부</label>
                                    <select class="form-control form_show" name="is_public">
                                        <option @isset($data){{ $data->is_public == 1 ? 'selected':'' }}@endisset value="1">공개</option>
                                        <option @isset($data){{ $data->is_public == 0 ? 'selected':'' }}@endisset value="0">비공개</option>
                                    </select>
                                    </div>
                                    <div class="col-3">
                                        <label >미션 완료 경험치</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_start" name="exp" placeholder="미션 완료시 제공 경험치" value="@isset($data){{ $data->exp }}@endisset" required >
                                    </div>
                                    <div class="col-2" style="position:relative;">
                                        <label >참여가능횟수</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="participation_count" placeholder="참여 가능 횟수" value="@isset($data){{ $data->participation_count }}@endisset" required >
                                    </div>
                                    <div class="col-2" style="position:relative;">
                                        <label >쿨다운 (시간)</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="cooldown" placeholder="없을시 사용 안함" value="@isset($data){{ $data->cooldown }}@endisset">
                                    </div>
                                    <div class="col-2">
                                    <label >난이도</label>
                                        <input type="number" min="1" max="5" class="js-flatpickr form-control bg-white form_end" name="difficulty" placeholder="난이도" value="@isset($data){{ $data->difficulty }}@endisset" required >
                                    </div>
                                </div>
                                <div class="form-group form-row">
                                    <div class="col-3">
                                    <label >선행미션</label>
                                    <select class="form-control form_show" name="precede_idx">
                                        <option value="0">없음</option>
                                        @foreach ($mission_list as $item)
                                            <option value="{{ $item->idx }}" @isset($data){{ $data->precede_idx == $item->idx ? 'selected':'' }}@endisset>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-3">
                                        <label >미션완료트릿</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_start" name="point" placeholder="50" value="@isset($data){{ $data->point }}@endisset" required>
                                    </div>
                                    <div class="col-3" style="position:relative;">
                                        <label >참여가능횟수 모두 참여시 제공되는 트릿</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="success_point" placeholder="20" value="@isset($data){{ $data->success_point }}@endisset" required>
                                    </div>
                                    <div class="col-3" style="position:relative;">
                                        <label >미션태그(,로 구분)</label>
                                        <input type="text" class="js-flatpickr form-control bg-white form_end" name="tag" placeholder="미션, 스토리미션, 튜토리얼" value="@isset($data){{ $data->tag }}@endisset" required >
                                    </div>
                                </div>
                                <div class="form-group form_txt">
                                    <label >제목</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="title" placeholder="제목을 작성해주세요." value="@isset($data){{ $data->title }}@endisset" required >
                                </div>
                                <div class="form-group form_txt">
                                    <label >미리보기내용 ( 24자 이내 )</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="preview" placeholder="미리보기 내용을 작성해주세요" value="@isset($data){{ $data->preview }}@endisset" required >
                                </div>
                                <div class="form-group form_txt">
                                    <label >요약</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="sub_title" placeholder="요약 내용을 적어주세요" value="@isset($data){{ $data->sub_title }}@endisset" required >
                                </div>
                                <div class="form-group form_txt">
                                    <label >미션내용</label>
                                    <textarea name="content" rows="10" placeholder="내용 입력" style="width:100%; border: 1px solid #d5dce1;">@isset($data){{ $data->content }}@endisset</textarea>
                                </div>
                                <div class="form-group form_txt">
                                    <label >유튜브 (iframe 코드 작성 url에 파라미터 ?playsinline=1 필수)</label>
                                    <textarea name="youtube" rows="3" placeholder="iframe 코드 작성 url에 파라미터 ?playsinline=1 필수" style="width:100%; border: 1px solid #d5dce1;">@isset($data){{ $data->youtube }}@endisset</textarea>
                                </div>
                                <div class="form-group form_txt">
                                    <label >목표</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="goal" placeholder="목표 내용을 적어주세요" value="@isset($data){{ $data->goal }}@endisset" required >
                                </div>
                                <div class="form-group form_txt">
                                    <label >방법</label>
                                    <textarea  name="how" rows="5" placeholder="방법 내용을 적어주세요" style="width:100%; border: 1px solid #d5dce1;">@isset($data){{ $data->how }}@endisset</textarea>
                                </div>
                                <div class="form-group form_txt">
                                    <label >기본팁</label>
                                    <textarea  name="tips" rows="5" placeholder="기본팁 내용을 적어주세요" style="width:100%; border: 1px solid #d5dce1;">@isset($data){{ $data->tips }}@endisset</textarea>
                                </div>
                                <div class="form-group form_txt">
                                    <label >히든팁</label>
                                    <textarea  name="tips2" rows="5" placeholder="히든팁 내용을 적어주세요" style="width:100%; border: 1px solid #d5dce1;">@isset($data){{ $data->tips2 }}@endisset</textarea>
                                </div>
                                <div class="form-group form_txt">
                                    <label >이런아이들에게좋아요 (최대 4개까지만 선택가능)</label>
                                    <br>
                                    @foreach ($target as $t)
                                        <span style="margin-right: 5px;"><input type="checkbox" class='target' @foreach ($user_target as $t2) {{ $t2 == $t[0] ? 'checked':'' }}@endforeach name="target[]" value="{{ $t[0] }}">{{ $t[0] }}</span>
                                    @endforeach
                                </div>
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-6 col-lg-6">
                                        <label >썸네일 이미지 720*720 (메인페이지에서 보여질 이미지)</label><br>
                                        <input type="file" name="thum_file" id="thum_file" onchange="handleImgFileSelect(this)" @empty($data) required @endisset>
                                        <img id="img_thum_file" width="100%" @isset($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endisset>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label >대표 이미지 720*300  (도전미션페이지에서 보여질 이미지)</label><br>
                                        <input type="file" name="main_file" id="main_file" onchange="handleImgFileSelect(this)" @empty($data) required @endisset>
                                        <img id="img_main_file" width="100%" @isset($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endisset>
                                    </div>
                                    <input type="hidden" name="thum_file_idx" value="@isset($data->thum_file_idx){{ $data->thum_file_idx }}@endif">
                                    <input type="hidden" name="main_file_idx" value="@isset($data->main_file_idx){{ $data->main_file_idx }}@endif">
                                </div>
                                <br>
                                <div class="form-group text-right">
                                    <button type="button" onclick="tempSave()" class="btn btn-primary">임시저장 및 미리보기</button>
                                    <a href="/admin/mission_manage/story" class="btn btn-dark">취소</a>
                                    <button type="submit" class="btn btn-danger">최종저장</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- END Page Content --}}
            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- END Footer --}}

            {{-- Apps Modal --}}

            {{-- END Apps Modal --}}
        </div>
        {{-- END Page Container --}}


        <script>
            $(function(){
                //추가버튼누르면 제출
                $("form").submit(function(){
                    // 유효성 검증

                    if(confirm("내용을 저장하시겠습니까?"))
                    {

                    }else{
                        return false;
                    }
                })
            });

            function handleImgFileSelect(id) {
                var files = id.files;
                var filesArr = Array.prototype.slice.call(files);

                filesArr.forEach(function(f) {
                    if(!f.type.match("image.*")) {
                        alert("이미지만 업로드 가능합니다.");
                        return;
                    } else {
                        alert("이미지가 변경되었습니다.");
                    }

                    sel_file = f;

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#img_"+id.id).attr("src", e.target.result);
                    }
                    reader.readAsDataURL(f);
                });
            }

            $('.target').click(function(){
                if($("input:checkbox:checked").length > 4)
                {
                    $(this).prop("checked", false);
                }
            });
            // 임시저장
            function tempSave() {
                var form = $('#story_save')[0]
                var data = new FormData(form);
                console.log(data);
                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "/api/admin/mission_manage/story/update",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                        console.log('--->', data);
                        if(data.status)
                        {
                            if(confirm(data.msg))
                            {
                                window.open('/admin/mission_detail?tidx='+data.idx, '_blank');
                            }
                        }
                    },
                    error: function (e) {
                        alert('fail');
                    }
                });
            }

            var formSubmitting = false;
            var setFormSubmitting = function() { formSubmitting = true; };

            window.onload = function() {
                window.addEventListener("beforeunload", function (e) {
                    if (formSubmitting) {
                        return undefined;
                    }

                    var confirmationMessage = 'It looks like you have been editing something. '
                                            + 'If you leave before saving, your changes will be lost.';

                    (e || window.event).returnValue = confirmationMessage; //Gecko + IE
                    return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
                });
            };
        </script>
@endsection
