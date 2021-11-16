@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

            {{-- Main Container --}}
            <main id="main-container">
<form method="POST" action="{{ $url }}">
                {{-- Page Content --}}
                <div class="content" style="max-width:1400px">
                   {{-- 회원상세정보--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">배송정보 {{ $type }}</h3>
                            <div class="block-options" >
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">{{ $type }}</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center d">순번</th>
                                                <td class="text-center" id="member_table_idx"><input class="text-center" type="text" readonly name="order_idx" value="{{ $order->idx }}" style="border:0;"></td>
                                                <th class="d-none d-sm-table-cell text-center">아이디</th>
                                                <td class="text-center" ><input class="text-center" type="text" readonly value="{{ $order->user->id }}" style="border:0;"></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">주문자이름</th>
                                                <td class=" text-center" >
                                                    <span ><input class="text-center" type="text" name="name" value="{{ $order->name }}"></span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">이메일</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class=""><input class="text-center" type="text" name="email" value="{{ $order->email }}"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">핸드폰</th>
                                                <td class="  text-center">
                                                    <span ><input class="text-center" type="text" name="tel" value="{{ $order->tel }}"></span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">상품명</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class=""><input class="text-center" type="text" readonly value="{{ $order->event->title }}" style="border:0;"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">주문상태</th>
                                                <td class="text-center">
                                                    <span>
                                                        <select name="status">
                                                            @foreach($status as $s)
                                                            <option @if($s[0] == $order->status ) selected @endif value="{{ $s[0] }}">{{ $s[0] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
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
                                                <td class="   text-left" colspan="3" style="padding-left:50px">
                                                    <input name="zip" value="{{ $order->zip }}">
                                                    <input name="addr1" value="{{ $order->addr1 }}">
                                                    <input name="addr2" value="{{ $order->addr2 }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">배송메시지</th>
                                                <td class="   text-left" colspan="3" style="padding-left:50px">
                                                    <input name="msg" value="{{ $order->msg }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END Page Content --}}
</form>
            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- END Footer --}}
        </div>
        {{-- END Page Container --}}


        @endsection
