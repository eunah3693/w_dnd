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
            @csrf
            <div class="block-header block-header-default" style="position: relative;">
                <h3 class="block-title">이용약관/개인정보처리방침 상세보기</h3>
                <div class="block-options" onclick="location.href='/admin/manage/terms_detail?idx={{ $data->idx }}'">
                    <button class="btn btn-dark" id="btn_add"  data-btn="notice">수정</button>
                </div>
            </div>
            <div class="block-content">
                <div class="form-group form-row">
                    <div class="col-8">
                        <label>카테고리선택</label>
                         <select name="category" disabled>
                             <option @if($data->category == '이용약관') selected @endif value="이용약관">이용약관</option>
                             <option @if($data->category == '개인정보처리방침') selected @endif value="개인정보처리방침">개인정보처리방침</option>
                         </select>
                    </div>
                    <input name="board_idx" type="hidden" value="{{ $data->idx }}">
                    <div class="col-4 "></div>
                    <div class="col-2 " style="position: relative;"></div>
                </div>
                <div class="form-group form-row">
                    <div class="col-8">
                        <label>제목</label> <input disabled type="text" name="title" class="form-control" value="@isset($data->title){{$data->title}}@endisset">
                    </div>
                    <div class="col-4 "></div>
                    <div class="col-2 " style="position: relative;"></div>
                </div>
                <div class="form-group">
                    <label>내용</label>
                   <div>{!! $data->content  !!}</div>
                </div>
                <div class="block-content"></div>
            </div>
    </div>
</div>
{{-- END Page Content --}}
</main>
{{-- END Main Container --}}

{{-- Footer --}}
@include('admin.layouts.footer')
{{-- END Footer --}}
@endsection
