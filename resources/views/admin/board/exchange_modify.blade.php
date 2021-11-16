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
                <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
                <div class="block-header block-header-default" style="position:relative;">
                    <h3 class="block-title">교환소 {{ $type }}</h3>
                    <div class="block-options" >
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="exchange">완료</button>
                    </div>

                </div>

                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-6">
                            <label>상품명</label>
                            <input type="text" class="form-control" required name="title" value="{{ $data->title }}">
                        </div>
                        <div class="col-6">
                            <label>요약</label>
                            <input type="text" class="form-control" required name="preview" value="{{ $data->preview }}">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>계정당 응모횟수(없을시 사용안함)</label>
                            <input type="text" class="form-control" name="participation_count" value="{{ $data->participation_count }}">
                        </div>
                        <div class="col-4 ">
                            <label>소모트릿갯수</label>
                            <input type="text" class="form-control" required name="participation_point" value="{{ $data->participation_point }}">
                        </div>

                        <div class="col-4 ">
                            <label>출력여부</label>
                            <select class="form-control" required name="is_public">
                                <option value="1">예</option>
                                <option value="0">아니오</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>당첨확률</label>
                            <input type="text" class="form-control" required name="perc" value="{{ $data->perc }}">
                        </div>
                        <div class="col-4 ">
                            <label>상품재고</label>
                            <input type="text" class="form-control" required name="stock"  value="{{ $data->stock }}">
                        </div>
                        <div class="col-4 ">
                            <label>노출순서</label>
                            <input type="text" class="form-control" name="order" value="{{ $data->order }}">
                        </div>
                    </div>
                    <div class="form-group form-row">

                    <div class="col-4 ">
                        <label>시작시간</label>
                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->startdate)) }}@endisset" tabindex="1" required name="startdate" type="datetime-local">
                    </div>
                    <div class="col-4 " style="position:relative;">
                        <label>종료시간</label>
                        <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_end" value="@isset($data->enddate){{ date('Y-m-d\TH:i', strtotime($data->enddate)) }}@else{{ '2055-01-01T00:00' }}@endisset" tabindex="1" required name="enddate" type="datetime-local">
                    </div>
                    <input name="idx" type="hidden" value="@isset($data->idx){{ $data->idx }}@endisset">


                    </div>
                    <div class="form-group">
                        <label>상세내용</label>
                        <textarea class="js-summernote" name="content">{{ $data->content }}</textarea>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-md-6 col-lg-6">
                            <label>썸네일 이미지 720*720</label><br>
                            <input type="file" name="thum_file" id="thum_file" onchange="handleImgFileSelect(this)" @empty($data->idx) required @endisset >
                            <img id="img_thum_file" width="100%" @isset($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endisset>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>대표 이미지 720*720</label><br>
                            <input type="file" name="main_file" id="main_file" onchange="handleImgFileSelect(this)" @empty($data->idx) required @endisset>
                            <img id="img_main_file" width="100%"  @isset($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endisset>
                        </div>
                    </div>

                    <div class="block-content">
                    </div>
                </div>
            </form>
            </div>
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

    </script>

    @endsection
