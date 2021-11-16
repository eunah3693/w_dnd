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
                    <h3 class="block-title">앱 푸쉬 템플릿관리</h3>
                    <button type="button" class="btn btn-dark" style="position:absolute; right:10px; top:5px;">템플릿 저장</button>

                </div>
                <div class="block-content">
                    <div class="form-group">
                        <label >제목</label>
                        <input type="text" class="form-control"  value="">
                    </div>
                    <div class="form-group">
                        <label for="one-ecom-product-description-short">내용</label>
                        <div class="js-summernote" ></div>
                    </div>
                    <div class="form-group">
                        <label >링크</label>
                        <input type="text" class="form-control"  value="URL">
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
            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("아이디");
                    }else if(option_num=="1"){
                        $(".filter_name").text("이메일");
                    }else if(option_num=="2"){
                        $(".filter_name").text("핸드폰");
                    }else if(option_num=="3"){
                        $(".filter_name").text("관리자");
                    
                    }else if(option_num=="4"){
                        $(".filter_name").text("비회원");
                    }
                    
                })
        })
    </script>
    @endsection
