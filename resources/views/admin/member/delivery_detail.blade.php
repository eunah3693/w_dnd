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
                   {{-- 회원상세정보--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">배송 상세정보</h3>
                            <div class="block-options" onclick="location.href='/admin/member/delivery_modify?order_idx={{ $order->idx }}'">
                                <button type="submit" class="btn btn-dark" >수 정</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center" >순번</th>
                                                <td class="text-center" id="member_table_idx">{{ $order->idx }}</td>
                                                <th class="d-none d-sm-table-cell text-center">유저닉네임</th>
                                                <td class="text-center" >{{ $order->user->nickname }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">이메일</th>
                                                <td class="font-size-sm text-center" >
                                                    <span >{{ $order->email }}</span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">주문자이름</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class="">{{ $order->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">주문자핸드폰</th>
                                                <td class=" font-size-sm text-center">
                                                    <span >{{ $order->tel }}</span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">상품명</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class="">{{ $order->event->title }} ( {{ $order->count }} )</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">금액</th>
                                                <td class=" font-size-sm text-center">
                                                    <span>{{ $order->total_amount }}</span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">송장번호</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class="">{{ $order->delivery_num }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">주문상태</th>
                                                <td class=" font-size-sm  text-center">
                                                    <span >{{ $order->status }}</span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class=""></span>
                                                </th>
                                                <td class="text-center">
                                                    <span class=""></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">주소</th>
                                                <td class=" font-size-sm  text-center">
                                                    <span>({{ $order->zip }}) {{ $order->addr1 }} {{ $order->addr2 }}</span>
                                                </td>
                                                <th class="text-center" scope="row">주문자메시지</th>
                                                <td class=" font-size-sm  text-center">
                                                    <span>{{ $order->msg }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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


        @endsection
