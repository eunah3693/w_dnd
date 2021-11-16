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
                    <h3 class="block-title">알림톡 템플릿 추가</h3>
                    <button type="submin" class="btn btn-dark" style="position:absolute; right:10px; top:5px;">템플릿 저장</button>

                </div>
                <div class="block-content">
                {{-- 템플릿 테이블 --}}
                    <table class="table table-borderless">
                                <tbody>
                                    <tr class="table-active">
                                        <td class="d-none d-sm-table-cell">
                                            <label>템플릿 선택</label>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="d-none d-sm-table-cell" >
                                        <input type="file" name="file" id="file" required="" style="padding-bottom:1rem;">
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                        <td class="d-none d-sm-table-cell" >
                                        <img src="/image/admin_test.jpg" alt="강아지">
                                        </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                    {{-- 템플릿 테이블 --}}
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
