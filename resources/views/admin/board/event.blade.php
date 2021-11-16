@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
<script src="/js/admin/board.js"></script>
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1400px;">
            {{-- 현황 --}}
                        <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="block block-rounded block-link-shadow text-center" >
                        <div class="block-content block-content-full">
                            <div class="font-size-h2 text-primary">{{ $total_count }}</div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w400 font-size-m text-muted mb-0">전체 게시물 수</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="block block-rounded block-link-shadow text-center" >
                        <div class="block-content block-content-full">
                            <div class="font-size-h2 text-primary">{{ $today_count }}</div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w400 font-size-m text-muted mb-0">금일 등록 게시물 수</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 현황 --}}

            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">이벤트</h3>
                    <div class="block-options" onclick="location.href='/admin/board/modify/{{ $category }}'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="event">추 가</button>
                    </div>
                </div>
                <div class="block-content">
                    {{-- 검색창 --}}
                   <form action="/admin/board/event" method="get">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend" style="margin-right:0;">
                                <select  name="search" onchange=""  style="width: 100px; height: 38px; border: 1px solid #777; border-radius: 0.25rem; color:#777;">
                                    <option @if(Request::get('search') == "title") selected @endif value="title">제목</option>
                                    <option @if(Request::get('search') == "user_id") selected @endif value="user_id">작성자아이디</option>
                                    <option @if(Request::get('search') == "content") selected @endif value="content">내용</option>
                                </select>
                            </div>
                            <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요">
                            <div class="input-group-append" onclick="$('form').submit()">
                                <span class="input-group-text bg-body border-0">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>

                    </div>
                </form>
                {{-- 검색창 --}}

                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="event">
                            <thead>
                                <tr>
                                    <th class="text-center">순번</th>
                                    <th class="d-none d-sm-table-cell text-center">이벤트명</th>
                                    <th class="d-none d-sm-table-cell text-center">미리보기</th>
                                    <th class="text-center">이벤트기간</th>
                                    <th class="d-none d-xl-table-cell text-center">출력순서</th>
                                    <th class="d-none d-sm-table-cell text-center">출력여부</th>
                                    <th class="d-none d-sm-table-cell text-center">수정</th>
                                    <th class="d-none d-sm-table-cell text-center">삭제</th>

                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $item)
                                <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span id="table_idx">{{ $data->total() - $data->firstItem() - $loop->iteration + 2 }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor"  onclick="location.href='/admin/board/detail/{{ $category }}?idx={{ $item->idx }}'">
                                        <span style="display:inline-block; width:200px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">{{ $item->title }}</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor"  onclick="location.href='/admin/board/detail/{{ $category }}?idx={{ $item->idx }}'">
                                        <span style="display:inline-block; width:400px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">{{ $item->sub_title }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $item->startdate }} - {{ $item->enddate }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $item->order }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <a href="#" class="btn_visible" data-idx="{{ $item->idx }}"><i class="fa fa-fw fa-eye{{ $item->hidden == 'Y' ? '-slash' : ''}}"></i></a>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a href="/admin/board/modify/{{ $category }}/{{ $item->idx }}"><i class="si si-pencil fa-fw"></i></a>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a href="#" class="btn_delete" data-idx="{{ $item->idx }}"><i class="fa fa-fw fa-times"></i></a>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                    {{-- Pagination --}}
                    <div style="display:flex; justify-content:center;">
                    {{ $data->appends(request()->input())->links() }}
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
        $(function() {
            //검색 버튼클릭시
            $("#btn_search").click(function() {
                if ($("#search_input").val() == "") {
                    alert("검색어를 입력해주세요.");
                    return true;
                }
                var search_select = $(".search_select").val(); //검색 select 값
                //console.log(search_select);
                var search_input = $("#search_input").val(); //검색 input 값
                //console.log(search_input);
                var duration_select1 = $(".duration_select").find("input:visible").first().val(); //select 첫번째값
                //console.log(duration_select1);
                var duration_select2 = $(".duration_select").find("input:visible").last().val(); //select 두번째값
                //console.log(duration_select2);

                //검색정보 넘기기
                $.ajax({
                    data: {
                        search_select,
                        search_input,
                        duration_select1,
                        duration_select2
                    },
                    type: "GET",
                }).done(function() {
                    console.log(search_select);
                    console.log(search_input);
                    console.log(duration_select1);
                    console.log(duration_select2);
                    //location.reload();
                });

            });
            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("이벤트명");
                    }

            })
            $(".filter_member").click(function(){
                var filter_member_num=$(this).index();
                console.log(filter_member_num);
                if(filter_member_num=="0"){
                    $(".filter_member_name").text("출력");
                }else if(filter_member_num=="1"){
                    $(".filter_member_name").text("미출력");
                }else if(filter_member_num=="2"){
                    $(".filter_member_name").text("전체");
                }

            })
            $(".filter_member2").click(function(){
                var filter_member_num2=$(this).index();
                console.log(filter_member_num2);
                if(filter_member_num2=="0"){
                    $(".filter_member_name2").text("진행");
                }else if(filter_member_num2=="1"){
                    $(".filter_member_name2").text("미진행");
                }else if(filter_member_num2=="2"){
                    $(".filter_member_name2").text("전체");
                }

            })



        });

    </script>
@endsection
