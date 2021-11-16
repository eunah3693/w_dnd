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
                    <h3 class="block-title">교환소 상세보기</h3>
                    <div class="block-options" onclick="location.href='/admin/board/exchange_modify'">
                                <button type="submit" class="btn btn-dark" >수 정</button>  
                    </div>

                </div>
                <div class="block-content">
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label>상품명</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">

                        </div>
                        <div class="col-4 ">

                        </div>
                        <div class="col-2 " style="position:relative;">

                        </div>

                    </div>

                    <div class="form-group">
                        <label>상세내용</label>
                        <div  style="width:100%; padding:10px; border-radius:5px; border:1px solid #d5dce1;"></div>
                    </div>
                    <div class="row" style="padding-bottom:20px;">
                        <div class="col-md-6 col-lg-6">
                            <label>썸네일 이미지 720*300</label><br>
                            <input type="file" name="thum_file" id="thum_file" onchange="handleImgFileSelect(this)" required="" >
                            <img id="img_thum_file" width="100%">
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <label>대표 이미지 720*720</label><br>
                            <input type="file" name="main_file" id="main_file" onchange="handleImgFileSelect(this)" required="">
                            <img id="img_main_file" width="100%">
                        </div>

                    </div>
                    <div class="form-group">
                        <label>링크</label>
                        <input type="text" class="form-control focus_x" value="URL" readonly="readonly">
                    </div>
                    
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>소모트릿갯수</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 ">
                            <label>출력여부</label>
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                        </div>
                        <div class="col-4 ">

                        </div>

                    </div>
                    <div class="form-group form-row">
                        <div class="col-4 ">
                            <label>응모횟수</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="col-4 ">
                            <label>당첨자수</label>
                            <input type="text" class="form-control" value="">
                        </div>
                        <div class="col-4 ">
                        </div>
                    </div>
                    <div class="form-group form-row">

                        <div class="col-8">
                            <label>당첨자발표예약</label>
                            <div class="input-daterange input-group js-datepicker-enabled" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                            <input type="text" class="form-control focus_x" value="" readonly="readonly">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text font-w600">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control focus_x" value="" readonly="readonly">
                            </div>

                        </div>
                        <div class="col-4 ">

                        </div>
                        <div class="col-2 " style="position:relative;">

                        </div>

                    </div>

                    <div class="block-content">
                    </div>
                </div>
            </div>
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">교환소 당첨세부내역</h3>
                     {{-- 당첨여부 필터 --}}
                     <div class="block-options">
                                
                                <button type="button" class="btn-block-option " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="filter_member_name">당첨여부</span> <i class="fa fa-angle-down ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member" style="font-size:15px" >
                                        당첨
                                        <span class="badge badge-secondary badge-pill">35</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member" style="font-size:15px" >
                                        미당첨
                                        <span class="badge badge-secondary badge-pill">15</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 filter_member" style="font-size:15px" >
                                        전체
                                        <span class="badge badge-secondary badge-pill">20</span>
                                    </a>
                            </div>
                    </div>
                    {{-- 당첨여부 필터 --}}
                    {{-- 리뷰여부 필터 --}}
                    <div class="block-options">
                                
                                <button type="button" class="btn-block-option " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="filter_member_name2">리뷰여부</span> <i class="fa fa-angle-down ml-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                        등록
                                        <span class="badge badge-secondary badge-pill">35</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                        미등록
                                        <span class="badge badge-secondary badge-pill">15</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 filter_member2" style="font-size:15px" >
                                        전체
                                        <span class="badge badge-secondary badge-pill">20</span>
                                    </a>
                            </div>
                    </div>
                    {{-- 리뷰여부 필터 --}}
                </div>
                <div class="block-content">


                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">순번</th>
                                
                                    <th class="text-center">신청아이디</th>
                                    
                                    <th class="d-none d-xl-table-cell text-center">당첨여부</th>
                                    <th class="d-none d-xl-table-cell text-center">배송입력여부</th>
                                    <th class="d-none d-sm-table-cell text-center">리뷰여부</th>


                                </tr>
                            </thead>
                            <tbody>
                               @for ($i = 0; $i < 10; $i++) 
                                <tr onclick="location.href='/admin/board/exchange_one'" style="cursor:pointer;">
                                    <td class="text-center font-size-sm">
                                        <span class="" >
                                            <span>1</span>
                                        </span>
                                    </td>
                                    
                                    <td class="text-center font-size-sm">
                                        <span>아이디아이디</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        <span href="be_pages_ecom_customer.html">Wayne Garcia</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span >Y</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm">
                                        <span>Y</span>
                                    </td>
                                </tr>
                               @endfor
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                    {{-- Pagination --}}
                    <nav aria-label="Photos Search Navigation">
                        <ul class="pagination pagination-sm justify-content-end mt-2">
                            <li class="page-item">
                                <a class="page-link"  tabindex="-1" aria-label="Previous">
                                    Prev
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" >1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" >2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" >3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" >4</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link"  aria-label="Next">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                    {{-- END Pagination --}}
                </div>
            </div>
            {{-- END All Orders --}}
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
        
        $(".filter_member").click(function(){
            var filter_member_num=$(this).index();
            console.log(filter_member_num);
            if(filter_member_num=="0"){
                $(".filter_member_name").text("당첨");
            }else if(filter_member_num=="1"){
                $(".filter_member_name").text("미당첨");
            }else if(filter_member_num=="2"){
                $(".filter_member_name").text("전체");
            }
            
        })
        $(".filter_member2").click(function(){
            var filter_member_num2=$(this).index();
            console.log(filter_member_num2);
            if(filter_member_num2=="0"){
                $(".filter_member_name2").text("등록");
            }else if(filter_member_num2=="1"){
                $(".filter_member_name2").text("미등록");
            }else if(filter_member_num2=="2"){
                $(".filter_member_name2").text("전체");
            }
            
        })
    })
</script>
    @endsection
