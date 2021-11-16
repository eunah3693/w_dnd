@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content"  style="max-width:1400px;">
             {{-- 현황 --}}
             <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 상품
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_event }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 등록된 상품수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_join_event }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일응모횟수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_join_event2 }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일당첨자수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}



            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">교환소 상품 리스트</h3>
                    <div class="block-options"  onclick="location.href='/admin/board_event/exchange_modify'">
                        <button type="button" class="btn btn-dark" id="btn_add" data-btn="exchange">추 가</button>
                    </div>
                </div>
                <div class="block-content">
                    {{-- 검색창 --}}
                    <form action="/admin/board_event/exchange" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend" style="margin-right:0;">
                                    <select name="search" onchange="" style="width: 100px; height: 38px; border: 1px solid #777; border-radius: 0.25rem; color:#777;">
                                        <option @if(Request::get('search') == "title") selected @endif value="title">제목</option>
                                        <option @if(Request::get('search') == "content") selected @endif value="content">컨텐츠내용</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                <div class="input-group-append" onclick="$('form').submit();">
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
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="exchange">
                            <thead>
                                <tr>
                                    <th class="text-center">순번</th>
                                    <th class="d-none d-sm-table-cell text-center">상품명</th>
                                    <th class="d-none d-xl-table-cell text-center">총상품갯수</th>
                                    <th class="d-none d-sm-table-cell text-center">현재까지당첨자수</th>
                                    <th class="text-center">소모트릿</th>
                                    <th class="d-none d-sm-table-cell text-center">당첨확률</th>
                                    <th class="d-none d-xl-table-cell text-center">정렬순서</th>
                                    <th class="d-none d-xl-table-cell text-center">오픈날짜</th>
                                    <th class="d-none d-sm-table-cell text-center">수정</th>
                                    <th class="d-none d-sm-table-cell text-center">삭제</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $v)
                                <tr >
                                    <td class="text-center font-size-sm">
                                        <span class="font-w600" href="be_pages_ecom_order.html">
                                            <span id="table_idx">{{ $v->idx }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor"  onclick="location.href='/admin/board_event/exchange_detail?idx={{ $v->idx }}'">
                                        <span style="display:inline-block; width:200px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">{{ $v->title }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="">{{ $v->stock }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell font-size-sm text-center">
                                        <span class="" href="be_pages_ecom_customer.html">{{ count($v->eventJoinCount)}}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="" href="be_pages_ecom_order.html">{{ $v->participation_point }}</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm">
                                        <span>{{ $v->perc }}% @if( $default_event_perc->value != 0)( {{ $default_event_perc->value }}배 이벤트 적용 중.... 최종확률 {{ $default_event_perc->value * $v->perc }}% )@endif</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="">{{ $v->order }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="" href="be_pages_ecom_order.html">{{ $v->startdate }}~{{ $v->enddate }}</span>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm  cursor" onclick="location.href='/admin/board_event/exchange_modify?idx={{ $v->idx }}'"><i class="si si-pencil fa-fw"></i></td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor" onclick="deleteData({{ $v->idx }})"><i class="fa fa-fw fa-times"></i></td>

                                </tr>
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
         function deleteData(idx)
        {
            if(confirm('삭제하시겠습니까?'))
            {
                var data = {
                    idx : idx,
                }
                $.post('/api/admin/exchange/delete', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }
        $(function() {
            /////검색 버튼클릭시 ////////////////////////////////
            $("#btn_search").click(function() {
                if ($(this).siblings("input").val() == "") {
                    alert("검색어를 입력해주세요.");
                    return true;
                }
                var search_select = $(".search_select").val(); //select 값
                console.log(search_select);
            });
            var duration_select1, duration_select2;
            /////기간 선택시 ////////////////////////////////
            $(".duration_select").find("input:visible").last().on("change", function() {
                var duration_select1 = $(this).val(); //select 두번째값
                console.log(duration_select1);
            })
            $(".duration_select").find("input:visible").first().on("change", function() {
                var duration_select2 = $(this).val(); //select 첫번째값
                console.log(duration_select2);
            })

            $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("상품명");
                    }else if(option_num=="1"){
                        $(".filter_name").text("소모트릿갯수");
                    }else if(option_num=="2"){
                        $(".filter_name").text("총상품갯수");
                    }

            })
            $(".filter_member").click(function(){
                var filter_member_num=$(this).index();
                console.log(filter_member_num);
                if(filter_member_num=="0"){
                    $(".filter_member_name").text("종료");
                }else if(filter_member_num=="1"){
                    $(".filter_member_name").text("진행");
                }else if(filter_member_num=="2"){
                    $(".filter_member_name").text("전체");
                }

            })
            $(".filter_member2").click(function(){
                var filter_member_num2=$(this).index();
                console.log(filter_member_num2);
                if(filter_member_num2=="0"){
                    $(".filter_member_name2").text("발표");
                }else if(filter_member_num2=="1"){
                    $(".filter_member_name2").text("미발표");
                }else if(filter_member_num2=="2"){
                    $(".filter_member_name2").text("전체");
                }

            })

        });

    </script>
@endsection
