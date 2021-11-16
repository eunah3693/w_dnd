@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1600px; ">
                    
                
                    <div class="row">
                    
                        {{-- Story --}}
                        <div class="col-lg-4 js-appear-enabled animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
                            <div class="block block-rounded " >
                                {{-- 이미지슬라이드 --}}
                                    <div class="js-slider"  >
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                        <div><img class="img-fluid" src="/image/admin_test.jpg" alt=""></div>
                                    </div>
                                {{-- 이미지슬라이드 --}}
                                <div class="block-content">
                                    <h4 class="mb-1">미션제목</h4>
                                    <p class="font-size-sm">
                                        <span class="text-primary">작성일시</span> 
                                        <em class="text-muted">#태그#태그#태그</em>
                                    </p>
                                    <p class="font-size-sm">
                                        글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용글내용
                                    </p>
                                    <table class="table table-striped table-borderless table-vcenter">
                                
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="font-w600" >댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <span class="font-w600" >댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <span class="font-w600" >댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글댓글</span>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- END Story --}}
                        {{-- 신고내역 --}}
                        <div class="col-lg-8 push js-appear-enabled animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn" >
                                <div class="block block-rounded block-link-pop"  >
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">신고내역</h3>
                                    <div class="block-options">
                                
                                    </div>
                                </div>
                                <div class="block-content">    
                                    <table class="table table-striped table-borderless table-vcenter">
                                        <thead class="border-bottom">
                                            <tr>
                                                
                                                <th class="d-none d-md-table-cell text-center" >아이디</th>
                                                <th class="d-none d-md-table-cell text-center" >신고횟수</th>
                                                <th class="d-none d-md-table-cell text-center" >신고자 아이디</th>
                                                <th class="d-none d-md-table-cell text-center" >신고사유</th>
                                                <th class="d-none d-md-table-cell text-center">신고날짜</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @for ($i = 0; $i < 3; $i++)
                                            <tr>
                                                <td class="text-center" >
                                                    <span>아이디아이디</span>
                                                </td>
                                                <td class="text-center">
                                                    <span>3</span>
                                                </td>
                                                <td class="d-none d-md-table-cell text-center">
                                                    <span>아이디아이디</span>
                                                </td>
                                                <td class="d-none d-md-table-cell text-center" style="width:500px;">
                                                    <span>신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유신고이유</span>
                                                </td>
                                                <td class="d-none d-md-table-cell text-center">
                                                    <span>20.03.01</span>
                                                </td>
                                                
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                        </div>
                    </div>
                    {{-- 신고내역 --}}
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
                $(".js-slider").slick({
                    slide: 'div'
                });
            })

        </script>

        @endsection
