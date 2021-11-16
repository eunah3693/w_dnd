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
                    <h3 class="block-title">공지상세보기</h3>
                    <div class="block-options" onclick="location.href='/admin/board/modify/notice?idx={{ $data->idx }}'">
                        <button type="submit" class="btn btn-dark" >수 정</button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group form-row">
                        <div class="col-12">
                            <label>공지글 제목</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->title }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col-4">
                            <label>상단고정</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->top_fixed ? 'Y' : 'N' }}" readonly="readonly">
                        </div>
                        <div class="col-4">
                            <label>작성자</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->user->nickname }}" readonly="readonly">
                        </div>
                        <div class="col-4">
                            <label>작성일시</label>
                            <input type="text" class="form-control focus_x" value="{{ $data->created_at }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>내용</label>
                        <div style="width:100%; padding:10px; border-radius:5px; border:1px solid #d5dce1;">
                            {!! $data->content !!}
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
