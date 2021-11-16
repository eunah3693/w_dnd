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
                        <h3 class="block-title">자주하는질문 추가</h3>
                        <button type="submit" class="btn btn-dark" style="position:absolute; right:10px; top:5px;" id="btn_plus">추 가</button>

                    </div>
                    <div class="block-content">
                        <div class="form-group form-row border-bottom" style="padding-bottom:30px;">

                            <div class="col-1">
                                <label for="one-ecom-product-name">질문</label>

                            </div>
                            <div class="col-10">
                                <input type="text" class="form-control form_title"  value="">
                            </div>


                        </div>
                        <div class="form-group form-row border-bottom" style="padding-bottom:30px;">
                            <div class="col-1">
                                <label for="one-ecom-product-name">질문내용</label>

                            </div>
                            <div class="col-10">
                                <textarea class="form-control terms_area1 form_txt"  rows="4" placeholder=""></textarea>
                            </div>
                        </div>

                        <div class="form-group form-row border-bottom" style="padding-bottom:20px;">

                            <div class="col-1">
                                <label for="one-ecom-product-name">답변</label>
                            </div>

                            <div class="col-10">
                                <div class="js-summernote"></div>
                            </div>
                        </div>


                        <div class="block-content">
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
    {{-- END Page Container --}}

    <script>
        $(function() {
            //추가버튼누르면 제출
            $("#btn_plus").click(function() {
                var form_title = $(".form_title").val(); //질문제목
                //console.log(form_title);
                var form_txt = $(".form_txt").val(); //질문내용
                //console.log(form_txt);
                var form_answer = $('.js-summernote').summernote('code'); //답변
                //console.log(form_answer);



                //추가정보 넘기기 
                $.ajax({
                    url: "/",
                    data: {
                        form_title,
                        form_txt,
                        form_answer
                    },
                    type: "POST",
                }).done(function() {
                    console.log(form_title);
                    console.log(form_txt);
                    console.log(form_answer);
                    //location.reload();
                });
            })
        });

    </script>
@endsection