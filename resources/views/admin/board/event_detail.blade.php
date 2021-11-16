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
                    <h3 class="block-title">이벤트 상세보기</h3>
                    <div class="block-options" onclick="location.href='/admin/board/modify/{{ $id }}/{{ $data->idx }}'">
                        <button type="submit" class="btn btn-dark" >수 정</button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>이벤트 명</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->title }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>미리보기 내용</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->sub_title }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>상세 내용</label>
                            <div style="width:100%; padding:10px; border-radius:5px; border:1px solid #d5dce1;">{!! $data->content !!}</div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-md-6 col-lg-6">
                            <label>썸네일 이미지 720*300 (이벤트 페이지에서 보여질 이미지)</label><br>
                            <img id="img_thum_file" width="360" height="150" @if($data->thum_file_idx)src="/files/{{ $data->thum_file_idx }}"@endif />
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>대표 이미지 720*720 (메인 페이지에서 보여질 이미지)</label><br>
                            <img id="img_main_file" width="360" height="360" @if($data->main_file_idx)src="/files/{{ $data->main_file_idx }}"@endif />
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>외부 링크</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->link_url }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-3">
                            <label>시작일시</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->startdate }}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>종료일시</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->enddate }}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>감추기</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->hidden }}" readonly="readonly">
                        </div>
                        <div class="col-3">
                            <label>출력순서</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->order }}" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}


    </div>
    @endsection
