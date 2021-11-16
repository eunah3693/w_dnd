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
                            <h3 class="block-title">이용문의 설정</h3>
                            <a class="btn btn-dark" style="position:absolute; right:10px; top:5px;" href="/admin/board/modify/ask/{{ $data->idx }}">수정</a>

                        </div>
                        <div class="block-content">
                                <div class="form-group form-row border-bottom">
                                            <div class="col-1">
                                                <label >제목</label>

                                            </div>
                                            <div class="col-10">
                                                {{ $data->title }}
                                            </div>
                                </div>
                                <div class="form-group form-row border-bottom" style="padding-bottom:30px;">
                                            <div class="col-1">
                                                <label >내용</label>

                                            </div>
                                            <div class="col-10">
                                                {{ $data->content }}
                                            </div>
                                </div>
                                <div class="form-group form-row border-bottom" style="padding-bottom:20px;">

                                    <div class="col-md-2 col-lg-1">
                                        <label >답변</label>
                                    </div>

                                    <div class="col-md-10 col-lg-11">
                                        <div class="">{{ $data->content2 }}</div>
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
        {{-- END Page Container --}}


        <script>
            $(function(){
                //추가버튼누르면 제출
                $("#btn_plus").click(function(){

                    var form_txt = $('.js-summernote').summernote('code');//내용
                    //console.log(form_txt);


                    //추가정보 넘기기
                    $.ajax({
                        url:"/",
                        data: {form_txt},
                        type: "POST",
                    }).done(function () {

                        console.log(form_txt);

                        //location.reload();
                    });
                })
            });

        </script>
@endsection
