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
            <form method="POST" action="/api/admin/breed/insert" enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">견종추가</h3>
                    </div>
                    <div class="block-content">

                        <div class="form-group">
                            <label>견종</label>
                            <input type="text" class="form-control form_link" name="breed" value=""  placeholder="견종이름을 적어주세요" required>
                        </div>
                        <div class="form-group">
                            <label>공개여부</label>
                            <div class="custom-control custom-switch custom-control-light custom-control-lg mb-2">
                                <input type="checkbox" class="custom-control-input" name="visible" id="visible" value="Y" checked >
                                비공개 <label class="custom-control-label" for="visible"></label> 공개
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-dark">저장</button>
                            <button type="button" onclick="history.back();" class="btn btn-dark">취소</button>
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
    </script>
@endsection
