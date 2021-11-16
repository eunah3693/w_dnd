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
                                        총 신고 수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        오늘 신고 수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}

                    <form action="/admin/mission_manage/report" method="get">
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">신고 리스트</h3>
                            <div class="block-options">
                                <div class="">
                                    <button type="button" class="btn-block-option "  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="">신고일자</span> <i class="fa fa-angle-down ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom " style="font-size:15px" >
                                        <input type="text" class="js-masked-date-dash form-control js-masked-enabled" name="created_at" value="@if(Request::get('created_at')) {{ Request::get('created_at') }} @endif" placeholder="yyyy-mm-dd" style="margin-right:1rem;">
                                        <i onclick="searchSubmit()" class="fa fa-search"></i>
                                        </a>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- 검색창 --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="margin-right:0;">
                                        <select name="search" onchange="" style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;" >
                                            <option @if(Request::get('search') == "content") selected @endif value="content">신고내용</option>
                                            <option @if(Request::get('search') == "count") selected @endif value="count">신고횟수</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control form-control-alt" name="text" value="@if(Request::get('text')){{Request::get('text')}}@endif" placeholder="검색어를 입력하세요" >
                                    <div class="input-group-append" onclick="searchSubmit()">
                                        <span class="input-group-text bg-body border-0">
                                            <i  onclick="formsubmit()" class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- 검색창 --}}

                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="report">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="vertical-align:middle">순번</th>
                                            <th class="d-none d-sm-table-cell text-center">아이디</th>
                                            <th  class="text-center" >포스트인덱스</th>
                                            <th class="d-none d-xl-table-cell text-center">신고날짜</th>
                                            <th class="d-none d-sm-table-cell text-center">감추기</th>
                                            <th class="d-none d-sm-table-cell text-center">삭제</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $k)
                                    @if($k->post)
                                        <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="" href="be_pages_ecom_order.html">
                                                    <span id="table_idx">{{ $k->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm ">
                                                <a href="/admin/member/member_detail?user_idx={{ $k->user->idx }}">{{ $k->user->nickname }}</a>
                                            </td>
                                            <td class="text-center cursor">
                                                <span style="display:inline-block; width:400px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;" onclick="location.href='/admin/mission_manage/member_mission_detail?post_idx={{ $k->post_idx }}'">{{ $k->post_idx }} -> {{ $k->content }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                <span>{{ $k->created_at }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm cursor">

                                                @if ($k->post->is_public == 1)
                                                <i onclick="updatePostPublic({{$k->post->idx}}, 0)" class="fa fa-fw fa-eye"></i>
                                                @else
                                                <i onclick="updatePostPublic({{$k->post->idx}}, 1)" class="far fa-fw fa-eye-slash"></i>
                                                @endif
                                            </td>

                                            <td class="d-xl-table-cell text-center font-size-sm cursor" onclick="deleteReport({{ $k->idx }})">
                                                    <i class="fa fa-fw fa-times"></i>
                                            </td>
                                        </tr>
                                    @endif
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
                </form>
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
            function searchSubmit()
            {
                $('form').submit();
            }
            function updatePostPublic(idx, type)
            {
                var data = {
                    post_idx : idx,
                    is_public : type
                }
                $.post('/api/admin/post/visible', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
            function deleteReport(idx)
            {
                if(confirm('신고를 삭제하시겠습니까?'))
                {
                    var data = {
                        report_idx : idx,
                    }
                    $.post('/api/admin/report/delete', data, function(res){
                        if(res.status == 200)
                        {
                            alert(res.msg);
                            location.reload();
                        }
                    })
                }
            }
        </script>
@endsection
