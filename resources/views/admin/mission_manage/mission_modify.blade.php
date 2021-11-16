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
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default" style="position:relative;">
                            <h3 class="block-title">전체미션 {{ $title }}</h3>
                        </div>
                        <div class="block-content">
                            <form method="POST" action="{{ $type }}" enctype="multipart/form-data" id="mission_save" onsubmit="setFormSubmitting()">
                                @csrf
                                <div class="form-group form-row">
                                    <div class="col-4">
                                    <label >미션종류</label>
                                        <select class="form-control form_mission" name="category" id="category" onchange="changeCheckBox()">
                                            <option @isset($data){{ $data->category == '주간미션' ? 'selected':'' }}@endisset value="주간미션">주간미션</option>
                                            <option @isset($data){{ $data->category == '일일미션' ? 'selected':'' }}@endisset value="일일미션">일일미션</option>
                                            <option @isset($data){{ $data->category == '자유미션' ? 'selected':'' }}@endisset value="자유미션">자유미션</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-row" id="now_issue_date" style="display: none">
                                    <div class="col-4 ">
                                        <label>시작시간</label>
                                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->startdate)) }}@endisset" tabindex="1" name="mission_startdate" id="mission_startdate" type="datetime-local">
                                    </div>
                                    <div class="col-4 " style="position:relative;">
                                        <label>종료시간</label>
                                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_end" value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->enddate)) }}@endisset" tabindex="1" name="mission_enddate" id="mission_enddate" type="datetime-local">
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
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_start" name="exp" placeholder="미션 완료시 제공 경험치" value="@isset($data){{ $data->exp }}@endisset" >
                                    </div>
                                    <div class="col-2" style="position:relative;">
                                        <label >참여가능횟수</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="participation_count" placeholder="참여 가능 횟수" value="@isset($data){{ $data->participation_count }}@endisset"  >
                                    </div>
                                    <div class="col-2" style="position:relative;">
                                        <label >쿨다운 (시간)</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="cooldown" placeholder="없을시 사용 안함" value="@isset($data){{ $data->cooldown }}@endisset">
                                    </div>
                                    <div class="col-2">
                                        <label >난이도</label>
                                            <input type="number" min="1" max="5" class="js-flatpickr form-control bg-white form_end" name="difficulty" placeholder="난이도" value="@isset($data){{ $data->difficulty }}@endisset" >
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
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_start" name="point" placeholder="50" value="@isset($data){{ $data->point }}@endisset" >
                                    </div>
                                    <div class="col-3" style="position:relative;">
                                        <label >참여가능횟수 모두 참여시 제공되는 트릿</label>
                                        <input type="number" min="0" class="js-flatpickr form-control bg-white form_end" name="success_point" placeholder="20" value="@isset($data){{ $data->success_point }}@endisset" >
                                    </div>
                                    <div class="col-3" style="position:relative;">
                                        <label >미션태그(,로 구분)</label>
                                        <input type="text" class="js-flatpickr form-control bg-white form_end" name="tag" placeholder="미션, 스토리미션, 튜토리얼" value="@isset($data){{ $data->tag }}@endisset"  >
                                    </div>
                                </div>
                                <div class="form-group form_txt">
                                    <label >제목</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="title" placeholder="제목을 작성해주세요." value="@isset($data){{ $data->title }}@endisset"  >
                                </div>
                                <div class="form-group form_txt">
                                    <label >미리보기내용 ( 24자 이내 )</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="preview" placeholder="미리보기 내용을 작성해주세요" value="@isset($data){{ $data->preview }}@endisset"  >
                                </div>
                                <div class="form-group form_txt">
                                    <label >요약</label>
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="sub_title" placeholder="요약 내용을 적어주세요" value="@isset($data){{ $data->sub_title }}@endisset"  >
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
                                    <input type="text" class="js-flatpickr form-control bg-white form_start" name="goal" placeholder="목표 내용을 적어주세요" value="@isset($data){{ $data->goal }}@endisset"  >
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
                                        <label >썸네일 이미지 720*720</label><br>
                                        <input type="file" name="thum_file" id="thum_file" onchange="handleImgFileSelect(this)" @empty($data)  @endisset>
                                        <img id="img_thum_file" width="100%" @isset($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endisset>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label >대표 이미지 720*300</label><br>
                                        <input type="file" name="main_file" id="main_file" onchange="handleImgFileSelect(this)" @empty($data)  @endisset>
                                        <img id="img_main_file" width="100%" @isset($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endisset>
                                    </div>
                                    <input type="hidden" name="thum_file_idx" value="@isset($data->thum_file_idx){{ $data->thum_file_idx }}@endif">
                                    <input type="hidden" name="main_file_idx" value="@isset($data->main_file_idx){{ $data->main_file_idx }}@endif">
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" onclick="tempSave()" class="btn btn-primary">임시저장 및 미리보기</button>
                                    <a href="/admin/mission_manage/story" class="btn btn-dark">취소</a>
                                    <button type="submit" class="btn btn-danger">최종저장</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if( $type == '/admin/mission_manage/mission/update' )
                    <div class="block block-rounded">
                        <div class="block-header block-header-default" style="position:relative;">
                            <h3 class="block-title">발행기록</h3>
                        </div>
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="story">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>시작시간</span></th>
                                    <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>종료시간</span></th>
                                    <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>발행날짜</span></th>
                                    <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>상태</span></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data->mission as $val)
                            <tr>
                                <td class="text-center font-size-sm"><span id="table_idx">{{ $val->idx }}</span></td>
                                <td class="d-sm-table-cell text-center font-size-sm">
                                    <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="{{ date('Y-m-d\TH:i', strtotime($val->startdate)) }}" tabindex="1" id="startdate{{ $val->idx }}" type="datetime-local">
                                </td>
                                <td class="d-sm-table-cell text-center font-size-sm">
                                    <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="{{ date('Y-m-d\TH:i', strtotime($val->enddate)) }}" tabindex="1" id="enddate{{ $val->idx }}" type="datetime-local">
                                </td>
                                <td class="d-sm-table-cell text-center font-size-sm">{{ $val->created_at }}</td>
                                <td>
                                    @if ( strtotime(date("Y-m-d H:i:s")) < strtotime($val->startdate) )
                                        진행예정
                                    @elseif ( strtotime($val->enddate) > strtotime(date("Y-m-d H:i:s")) )
                                        진행중
                                    @elseif ( strtotime($val->enddate) < strtotime(date("Y-m-d H:i:s")) )
                                        종료
                                    @endif
                                </td>
                                <td>
                                    <button type="button" onclick="updateMissionDate({{ $val->idx }})" class="btn btn-dark">변경</button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="text-center font-size-sm"><span id="table_idx">추가</span></td>
                                <td class="d-sm-table-cell text-center font-size-sm">
                                    <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="" tabindex="1" id="startdate" type="datetime-local">
                                </td>
                                <td class="d-sm-table-cell text-center font-size-sm">
                                    <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="" tabindex="1" id="enddate" type="datetime-local">
                                </td>
                                <td class="d-sm-table-cell text-center font-size-sm"></td>
                                <td>

                                </td>
                                <td>
                                    <button type="button" onclick="insertMissionDate({{ $data->idx }})" class="btn btn-dark">추가발급</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                    @endif
                </div>
                {{-- END Page Content --}}
            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- END Footer --}}


        </div>
        {{-- END Page Container --}}
        <script>
            function insertMissionDate(mission_pool_idx)
            {
                var startdate = $('#startdate').val();
                var enddate = $('#enddate').val();
                var data = {
                    enddate: enddate,
                    startdate: startdate
                }
                $.post('/api/admin/mission/insert/'+mission_pool_idx, data, function(res)
                {
                    alert(res.msg);
                    location.reload();
                });
            }
            function updateMissionDate(idx)
            {
                var startdate = $('#startdate'+idx).val();
                var enddate = $('#enddate'+idx).val();

                var data = {
                    enddate: enddate,
                    startdate: startdate
                }
                $.post('/api/admin/mission/update/'+idx, data, function(res)
                {
                    alert(res.msg);
                    location.reload();
                });
            }
            $(function(){
                //추가버튼누르면 제출
                $("form").submit(function(){
                    // 유효성 검증
                    @if( $type == '/admin/mission_manage/mission/insert' )
                        if($("#category").val() == '자유미션'){
                            if($('#mission_startdate').val() == '' || $('#mission_enddate').val() == '' ){
                                alert('자유미션의 경우 시작시간과 종료시간을 작성해야합니다.');
                                return false;
                            }
                        }
                    @endif
                    if(confirm("내용을 저장하시겠습니까?"))
                    {

                    }else{
                        return false;
                    }
                })
            });
            function changeCheckBox(){
                @if( $type == '/admin/mission_manage/mission/insert' )
                    if($("#category").val() == '자유미션'){
                        $('#now_issue_date').css('display','');
                    }else{
                        $('#now_issue_date').css('display','none');
                    }
                @endif
            }
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

            // 임시저장
            function tempSave() {
                var form = $('#mission_save')[0]
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
