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
                    <h3 class="block-title">팝업 상세보기</h3>
                    <div class="block-options" onclick="location.href='/admin/manage/popup_modify'">
                                <button type="submit" class="btn btn-dark" >수 정</button>  
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-4">
                            <label>팝업페이지</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">

                        </div>
                        <div class="col-4 ">
                            <label>출력순서</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 " style="position:relative;">

                        </div>

                    </div>
                    <div class="form-group">
                        <label>이미지</label>
                        <div style="width:100%; padding:10px; border-radius:5px; border:1px solid #d5dce1;"></div>
                    </div>
                    <div class="form-group">
                        <label>링크</label>
                        <input type="text" class="form-control focus_x" value="URL" readonly="readonly">
                    </div>
                    
                    <div class="form-group form-row">


                        <div class="col-8 ">
                            <label>이미지설명</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 ">

                        </div>

                    </div>
                    <div class="form-group form-row">

                        <div class="col-4">
                            <label>출력여부</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 ">
                            <label>시작시간</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 " style="position:relative;">
                            <label>종료시간</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
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
    {{-- END Page Container --}}

    @endsection