
@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')


            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1400px;">
                    {{-- 현황 --}}
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $total_order }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 배송 수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_order }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        오늘 추가된 주문건수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $addr }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        배송지 미입력 건수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}


                <form method="get" action="/admin/member/delivery">
                    {{-- 리스트 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">배송 리스트</h3>

                            <div class="block-options">
                                <select name="status" onchange="formsubmit()"   >
                                    <option @if(Request::get('status') == "") selected @endif value="">전체상태</option>
                                    @foreach($status as $s )
                                    <option @if(Request::get('status') == "{{ $s[0] }}") selected @endif value="{{ $s[0] }}">{{ $s[0] }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- 검색창 --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="margin-right:0;">
                                        <select name="search" onchange=""  style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;" >
                                            <option @if(Request::get('search') == "name") selected @endif value="name">주문자</option>
                                            <option @if(Request::get('search') == "delivery_num") selected @endif value="delivery_num">송장번호</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-body border-0">
                                            <i  onclick="formsubmit()" class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- 검색창 --}}

                            {{-- All Orders Table --}}
                            <div class="table-responsive" >
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="vertical-align:middle">순번</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">상품명</th>
                                            <th class="text-center" style="vertical-align:middle">회원닉네임</th>
                                            <th class="text-center" style="vertical-align:middle">주문자</th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle">주문상태</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">주문일</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">수정</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">삭제</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($order as $o)
                                         <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="" >
                                                    <span>{{ $o->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                <a href="/admin/board_event/exchange?idx={{ $o->event->idx }}">{{ $o->event->title }}</a>
                                            </td>
                                            <td class="text-center cursor"  onclick="location.href='/admin/member/member_detail?user_idx={{ $o->user->idx }}'">
                                                <span>{{ $o->user->nickname }}</span>
                                            </td>
                                            <td class="text-center cursor"  onclick="location.href='/admin/member/delivery_detail?order_idx={{ $o->idx }}'">
                                            <span>{{ $o->name }}</span>
                                            </td>
                                            <td class="d-none d-xl-table-cell font-size-sm text-center">
                                                <button type="button" class="btn btn-rounded btn-sm badge-warning">{{ $o->status }}</button>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center" >
                                                <span class="" >{{ $o->created_at }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center cursor" onclick="location.href='/admin/member/delivery_modify?order_idx={{ $o->idx }}'">
                                            <i class="si si-pencil fa-fw"></i>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center cursor" >
                                            <i onclick="deleteData({{ $o->idx }})" class="fa fa-fw fa-times"></i>
                                            </td>

                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $order->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{--리스트--}}
                </form>
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
            function formsubmit(){
                $('form').submit();
            }
            function deleteData(idx)
            {
                if(confirm('주문건을 정말 삭제 하시겠습니까?'))
                {
                    var data = {
                        order_idx : idx
                    }
                    $.post('/api/admin/order/delete', data, function(res){
                        if(res.status == '200')
                        {
                            alert(res.msg);
                            location.reload();
                        }
                    })
                }
            }
        </script>
@endsection
