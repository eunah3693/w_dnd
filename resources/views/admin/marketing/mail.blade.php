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
                            <h3 class="block-title">메일 관리</h3>
                            <button type="submit" class="btn btn-dark" style="position:absolute; right:10px; top:5px;" id="btn_plus">발 송</button>
                            <button type="button" class="btn btn-dark" style="position:absolute; right:90px; top:5px;"  onclick="location.href='/admin/marketing/mail_add'">템플릿 추가</button>
                            
                        </div>
                       
                        
                        <div class="block-content">
                {{-- 템플릿 테이블 --}}
                    <table class="table table-borderless">
                                <tbody>
                                    <tr class="table-active">
                                        <td class="d-none d-sm-table-cell">
                                            <label>템플릿 선택</label>
                                        </td>
                                        <td class="font-size-sm text-muted">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                                                <select class="custom-select" id="example-select-multiple-custom" name="example-select-multiple-custom" size="5" multiple="">
                                                    <option value="1">Option #1</option>
                                                    <option value="2">Option #2</option>
                                                    <option value="3">Option #3</option>
                                                    <option value="4">Option #4</option>
                                                    <option value="5">Option #5</option>
                                                    <option value="6">Option #6</option>
                                                    <option value="7">Option #7</option>
                                                    <option value="8">Option #8</option>
                                                    <option value="9">Option #9</option>
                                                    <option value="10">Option #10</option>
                                                </select>
                                        </td>
                                        <td style=" padding:20px;">
                                        <img src="/image/admin_test.jpg" alt="강아지">
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                    {{-- 템플릿 테이블 --}}
                </div>
                <div class="block-content">
                
                    <div class="block-content" >
                    <input type="file" name="file" id="file" required="" style="padding-bottom:1rem;">
                        {{-- 테이블 --}}
                        <table class="table table-striped table-border table-vcenter">
                                <thead class="border-bottom">
                                    <tr>
                                        <th ></th>
                                        <th class=" text-center">순번</th>
                                        <th class="d-none d-md-table-cell text-center" >아이디</th>
                                        <th class="d-none d-md-table-cell text-center" >기기번호</th>
                                        <th class="d-none d-md-table-cell text-center" >발송상태</th>
                                        <th class="d-none d-md-table-cell text-center" >응답</th>
                                    </tr>
                                </thead>
                                <tbody class="border-bottom">
                                    <tr>
                                        <td class="text-center" style="width: 40px;">
                                            <input type="checkbox" style="vertical-align:middle;">
                                        </td>
                                        <td class="text-center">
                                            1
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            아이디아이디
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            010-0000-0000
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            발송
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            응답
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" style="width: 40px;">
                                            <input type="checkbox" style="vertical-align:middle;">
                                        </td>
                                        <td class="text-center">
                                            2
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            아이디아이디
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            010-0000-0000
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            발송
                                        </td>
                                        <td class="d-none d-md-table-cell text-center">
                                            응답
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>

                        {{-- 테이블 --}}
                        
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