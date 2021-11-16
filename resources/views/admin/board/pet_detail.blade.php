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
            <form>
                {{-- All Orders --}}
                <div class="block block-rounded">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">펫시피 추가</h3>
                        <button type="submit" class="btn btn-dark" style="position:absolute; right:10px; top:5px;" id="btn_plus">추 가</button>

                    </div>
                    <div class="block-content">
                        <div class="form-group form-row">

                            <div class="col-8">
                                <label >제목</label>
                                <input type="text" class="form-control form_title"  value="">

                            </div>
                            <div class="col-4 ">

                            </div>
                            <div class="col-2 " style="position:relative;">

                            </div>

                        </div>

                        <div class="form-group">
                            <label >상세내용</label>
                            <div class="js-summernote"></div>
                        </div>
                        <div class="form-group">
                            <label >링크</label>
                            <input type="text" class="form-control form_link"  value="URL">
                        </div>
                        
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label >출력여부</label>
                                <select class="form-control form_show">
                                    <option value="0">출력여부</option>
                                    <option value="1">예</option>
                                    <option value="2">아니오</option>
                                </select>
                            </div>
                            <div class="col-8">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- END Page Content --}}
            </form>
        </div>
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    
@include('admin.layouts.footer')
    {{-- END Footer --}}

    
    </div>

    <script src="/js/oneui.core.min.js"></script>

    <script src="/js/oneui.app.min.js"></script>
    <script src="/js/plugins/dropzone/dropzone.min.js"></script>
    <script src="/js/plugins/summernote/summernote.js"></script>
    <script src="/js/pages/summernote.js"></script>
    <script>
        $(function() {
            //추가버튼누르면 제출
            $("#btn_plus").click(function() {
                var form_title = $(".form_title").val(); //배너위치
                //console.log(form_title);
                var form_txt = $('.js-summernote').summernote('code'); //내용
                //console.log(form_txt);
                var form_link = $(".form_link").val(); //출력순서
                //console.log(form_link);
                var form_img = $(".form_img").val(); //이미지
                //console.log(form_link);
                var form_alt = $(".form_alt").val(); //이미지설명
                //console.log(form_alt);
                var form_show = $(".form_show").val(); //출력순서
                //console.log(form_show);


                //추가정보 넘기기 
                $.ajax({
                    url: "/",
                    data: {
                        form_title,
                        form_txt,
                        form_link,
                        form_img,
                        form_alt,
                        form_show
                    },
                    type: "POST",
                }).done(function() {
                    console.log(form_title);
                    console.log(form_txt);
                    console.log(form_link);
                    console.log(form_img);
                    console.log(form_alt);
                    console.log(form_show);

                    //location.reload();
                });
            })
        });

    </script>
@endsection
