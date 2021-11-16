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
                                    <div class="font-size-h2 text-primary">{{ $total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 리뷰 수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        오늘 리뷰 수
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 현황 --}}




            {{-- 레벨상세내역--}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">리뷰관리</h3>

                </div>
                <div class="block-content">


                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        {{-- 검색창 --}}
                    <form action="/admin/board_event/review" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend" style="margin-right:0;">
                                    <select name="search" onchange="" style="width: 100px; height: 38px; border: 1px solid #777; border-radius: 0.25rem; color:#777;">
                                        <option @if(Request::get('search') == "event_title") selected @endif value="event_title">상품명</option>
                                        <option @if(Request::get('search') == "score") selected @endif value="score">별점</option>
                                        <option @if(Request::get('search') == "content") selected @endif value="content">내용</option>
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
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>순번</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>상품명</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>아이디</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>별점</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>리뷰</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>감추기</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $v)
                                 @isset($v->user)
                                <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span>{{ $v->idx }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm"><a href="/admin/board_event/exchange_detail?idx={{ $v->event_idx }}">{{ $v->event->title }}</a></td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm"><a href="/admin/member/member_detail?user_idx={{ $v->user_idx }}">{{ $v->user->nickname }}</a></td>
                                    <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">{{ $v->score }}</td>
                                    <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">{{ $v->content }}</td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm">{{ $v->created_at }}</td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor">
                                        @if($v->is_public == 1)
                                        <i onclick="updateReview({{ $v->idx }}, 0)" class="fa fa-fw fa-eye"></i>
                                        @else
                                        <i onclick="updateReview({{ $v->idx }}, 1)" class="far fa-fw fa-eye-slash"></i>
                                        @endif
                                        </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="deleteReview({{ $v->idx }})"><i class="fa fa-fw fa-times"></i>
                                    </td>
                                </tr>
                                    @endisset
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
            {{-- 레벨상세내역 --}}



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
         function deleteReview(idx)
        {
            var data = {
                idx :idx
            }
            console.log(data)
            if(confirm('리뷰를 삭제하시겠습니까?'))
            {
                $.post('/api/admin/review/delete',data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }
        function updateReview(idx,is_public)
        {
            var data = {
                idx :idx,
                is_public:is_public
            }
            if(confirm('리뷰를 감추시겠습니까?'))
            {
                $.post('/api/admin/review/update/is_public',data, function(res){
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
