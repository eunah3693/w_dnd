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
                    <h3 class="block-title">이용문의 보기</h3>
                    <div class="block-options" onclick="location.href='/admin/board/ask_modify'">
                                <button type="submit" class="btn btn-dark" >수 정</button>  
                    </div>

                </div>
                <div class="block-content">
                    <div class="form-group form-row border-bottom">
                        <div class="col-1">
                            <label>제목</label>

                        </div>
                        <div class="col-10">
                            제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:30px;">
                        <div class="col-1">
                            <label>내용</label>

                        </div>
                        <div class="col-10">
                            내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용내용
                        </div>
                    </div>
                    <div class="form-group form-row border-bottom" style="padding-bottom:20px;">

                        <div class="col-md-2 col-lg-1">
                            <label>답변</label>
                        </div>

                        <div class="col-md-10 col-lg-11">
                            답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변답변
                        </div>
                    </div>
                    <div class="block-content">
                        {{-- Topics --}}
                        {{-- END Topics --}}
                        {{-- Pagination --}}
                        {{-- END Pagination --}}
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