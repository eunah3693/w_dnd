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
            <form method="POST" action="{{ $type }}" enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">배너 {{ $title }}</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group form-row">

                            <div class="col-4">
                                <label>배너위치</label>
                                <select class="form-control form_position" disabled name="page_position">
                                    @foreach ($config as $item => $val)
                                    <option @isset($data){{ $data->page.'_'.$data->position == $config[$item]['key'] ? 'selected':'' }}@endisset value="{{ $config[$item]['key'] }}">{{ $config[$item]['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 ">
                                <label>출력순서</label>
                                <input type="number" class="form-control form_order" readonly name="order" value="@isset($data){{ $data->order }}@endisset">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>링크</label>
                            <input type="text" class="form-control form_link" readonly name="link_url" value="@isset($data){{ $data->link_url }}@endisset"  placeholder="링크" required>
                        </div>
                        <div class="row " style="padding-bottom:20px;">
                            <div class="col-md-6 col-lg-12">
                                <label >대표 이미지</label><br>
                                @foreach ($config as $item => $val)
                                    <p style="margin-bottom: 0;">* {{ $config[$item]['name'] }}({{ $config[$item]['image_size'] }})</p>
                                @endforeach
                                
                                <img id="img_file" width="100%" @isset($data->file_idx)src="/files/{{ $data->file_idx }}"@endisset>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-8 ">
                                <label>이미지설명</label>
                                <input type="text" name="title" class="form-control form_alt" readonly value="@isset($data){{ $data->title }}@endisset" >
                            </div>
                            <div class="col-4 ">

                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>출력여부</label>
                                <select class="form-control form_show" disabled name="is_public" >
                                    <option @isset($data){{ $data->is_public == 1 ? 'selected':'' }}@endisset value="1">공개</option>
                                    <option @isset($data){{ $data->is_public == 0 ? 'selected':'' }}@endisset value="0">비공개</option>
                                </select>
                            </div>
                            <div class="col-4 ">
                                <label>시작시간</label>
                                <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_start" readonly value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->startdate)) }}@endisset" tabindex="1" required name="startdate" type="datetime-local">
                            </div>
                            <div class="col-4 " style="position:relative;">
                                <label>종료시간</label>
                                <input class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile form_end" readonly value="@isset($data){{ date('Y-m-d\TH:i', strtotime($data->enddate)) }}@endisset" tabindex="1" required name="enddate" type="datetime-local">
                            </div>
                            <input name="idx" type="hidden" value="@isset($data){{ $data->idx }}@endisset">
                        </div>
                        <div class="form-group text-right">
                            <a type="" href="/admin/manage/banner_modify?idx=@isset($data){{ $data->idx }}@endisset" class="btn btn-dark">수정</a>
                            <a type="" href="/admin/manage/banner" class="btn btn-dark">취소</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}
    </div>

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
