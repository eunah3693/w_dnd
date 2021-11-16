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
            <form method="POST" action="/api/admin/manage/insert" enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">관리자 추가</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group form-row">

                            <div class="col-6">
                                <label>이름</label>
                                <input type="text" class="form-control form_order" name="name" value="">
                            </div>

                            <div class="col-6 ">
                                <label>이메일</label>
                                <input type="text" class="form-control form_order" name="email" value="">
                            </div>
                        </div>
                        <div class="row " style="padding-bottom:20px;">
                            <div class="col-6 ">
                                <label>아이디</label>
                                <input type="text" class="form-control form_order" name="id" value="">
                            </div>
                            <div class="col-6">
                                <label >비밀번호</label><br>
                                <input type="password" class="form-control form_order" name="pw" value=""  placeholder="비밀번호" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-dark">저장</button>
                            <button type="button" class="btn btn-dark">취소</button>
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

                if(confirm("관리자를 추가하시겠습니까?"))
                {

                }else{
                    return false;
                }
            })
        });
    </script>
@endsection
