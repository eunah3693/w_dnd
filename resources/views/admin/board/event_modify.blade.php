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
            <form action="{{ $type }}{{ $data->idx }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="block-header block-header-default" style="position:relative;">
                    <h3 class="block-title">이벤트  {{ $title }}</h3>
                    <div class="block-options">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="event"> {{ $title }}</button>
                    </div>

                </div>
                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label>이벤트명</label>
                            <input type="text" name="title" class="form-control" value="@isset($data->title){{$data->title}}@endisset">
                        </div>
                        <div class="col-4 ">
                        </div>
                        <div class="col-2 " style="position:relative;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>미리보기내용</label>
                        <input type="text" name="sub_title" class="form-control" value="{{$data->sub_title}}">
                    </div>
                    <div class="form-group">
                        <label>상세내용 상세이미지 720*%</label>
                        <textarea class="js-summernote" name="content">{!! $data->content !!}</textarea>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-md-6 col-lg-6">
                            <label>썸네일 이미지 720*240</label><br>
                            <input type="file" name="thum_file" id="thum_file" onchange="handleImgFileSelect(this)"  @if(!$data->thum_file_idx)required=""@endif>
                            <img id="img_thum_file" width="360" height="150" @if($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endif />
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>대표 이미지 720*720</label><br>
                            <input type="file" name="main_file" id="main_file" onchange="handleImgFileSelect(this)" @if(!$data->main_file_idx)required=""@endif>
                            <img id="img_main_file" width="360" height="360" @if($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endif />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>링크</label>
                        <input type="text" name="link_url" class="form-control" value="{{ $data->link_url }}">
                    </div>

                    <div class="form-group form-row">


                        <div class="col-4 ">
                            <label>출력순서</label>
                            <input type="number" class="form-control" name="order" value="{{ $data->order ?? 0 }}">
                        </div>
                        <div class="col-4 ">
                            <div class="custom-control custom-switch custom-control-light custom-control-lg">
                            <label>출력여부</label>
                            <input type="checkbox" class="custom-control-input" id="hidden" name="hidden" value="1" {{ $data->hidden == 'Y' ? 'checked="checked"' : '' }}>
                            <label class="custom-control-label" for="hidden"></label>
                        </div>
                        </div>
                        <div class="col-4 ">

                        </div>

                    </div>
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label>이벤트기간</label>
                            <div class="input-daterange input-group js-datepicker-enabled" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                <input name="startdate" value="{{ $data->startdate }}" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile" tabindex="1" type="datetime-local">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input name="enddate" value="{{ $data->enddate }}" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input flatpickr-mobile" tabindex="1" type="datetime-local">
                            </div>
                            <script>
                            $("input[name=startdate]").flatpickr({
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                defaultDate: "{{ $data->startdate }}"
                            });
                            $("input[name=enddate]").flatpickr({
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                                defaultDate: "{{ $data->enddate }}"
                            });
                            </script>
                        </div>
                        <div class="col-4 ">

                        </div>
                        <div class="col-2 " style="position:relative;">

                        </div>

                    </div>

                    <div class="block-content">
                        {{-- Topics --}}


                        {{-- END Topics --}}

                        {{-- Pagination --}}

                        {{-- END Pagination --}}
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

    @endsection
