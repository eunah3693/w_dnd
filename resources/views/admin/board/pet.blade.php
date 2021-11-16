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
            {{-- 현황 --}}
            <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">35</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 회원수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">120</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 가입수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">260</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 접속수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">69841</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 접속수
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 현황 --}}
                    
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">펫시피 관리</h3>
                    <div class="block-options" onclick="location.href='/admin/board/pet_detail'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="pet">추 가</button>
                    </div>
                </div>
                <div class="block-content">


                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                         {{-- 검색창 --}}
                         <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary filter_name">Filter</button>
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item border-bottom filter_option" >
                                                    <i class="fa fa-2x fa-check"  style="font-size:0.8rem; padding-right:1rem;"></i>글제목
                                                </a>
                                                <a class="dropdown-item border-bottom filter_option" >
                                                    <i class="fa fa-2x fa-check"  style="font-size:0.8rem; padding-right:1rem;"></i>작성자
                                                </a>
                                                
                                            </div>
                                        </div>
                                        <input type="text" class="form-control form-control-alt"  placeholder="Search" aria-label="Text input with dropdown button">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-body border-0">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            {{-- 검색창 --}}
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="pet">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>글제목</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>게시날짜</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>출력순서</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>작성자</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>작성일시</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>


                                </tr>
                            </thead>
                            <tbody>
                               @for ($i = 0; $i < 10; $i++)
                                <tr >
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span id="table_idx">1</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/board/pet_one'">
                                        <span style="display:inline-block; width:400px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영환영</span>
                                    </td>
                                    <td class="text-center">
                                        20.03.01
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        <span class="text-gray-darker font-w600 ">1</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">관리자</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">20.03.01</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm cursor " onclick="location.href='/admin/board/pet_modify'">
                                        <span class="text-gray-darker"><i class="si si-pencil fa-fw"></i></span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm cursor">
                                        <span class="text-gray-darker"><i class="fa fa-fw fa-times"></i></span>
                                    </td>


                                </tr>
                              @endfor

                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                    {{-- Pagination --}}
                    <div style="display:flex; justify-content:center;">
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
                    </div>
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
            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("글제목");
                    }else if(option_num=="1"){
                        $(".filter_name").text("작성자");
                    }
                    
                })
        })
    </script>
    @endsection
