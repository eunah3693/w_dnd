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
                            <h3 class="block-title">문자 템플릿관리</h3>
                            <button type="button" class="btn btn-dark" style="position:absolute; right:10px; top:5px;">템플릿 저장</button>
                            
                        </div>
                       
                        
                    <div class="block-content" style="padding-bottom:1rem;">
                    <div class="form-group form_txt">
                        <textarea style="width:100%; height:300px;"></textarea>
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
                $("#find_wrap").hide();
                $("#btn_find").click(function(){
                    var mailto=$(".mailto").val();
                    var mailto_input=$(".mailto_input").val();
                    if(mailto_input==""){
                        alert("입력해주세요")
                        return true;
                    }
                    $("#find_wrap").show();
                    

                })
                $("#btn_plus").click(function(){
                    var form_txt = $('.js-summernote').summernote('code');//내용
                    //console.log(form_txt);
                    //추가정보 넘기기 
                    $.ajax({
                        url:"/",
                        data: {form_txt},
                        type: "POST",
                    }).done(function () {
                        console.log(form_txt)

                    });
                })
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