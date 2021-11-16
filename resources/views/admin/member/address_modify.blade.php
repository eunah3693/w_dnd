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

                    {{-- 반려견 상세정보 --}}
                    <div class="block block-rounded">
                        <form action="/api/admin/member/address/{{ $data->idx }}" method="post">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">주소 상세보기</h3>
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">수정</button>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}

                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center ">이름</th>
                                                <td class="text-center "><input name="name" value="{{ $data->name }}"></td>
                                                <th class="d-none d-sm-table-cell text-center">사용자이름</th>
                                                <td class="text-center cursor" onclick="location.href='/admin/member/member_detail?user_idx={{ $data->user_idx }}'">{{ $data->user->nickname }}</td>
                                            </tr>


                                            <tr>
                                                <th class="text-center">전화번호</th>
                                                <td class="text-center"><input name="tel" value="{{ $data->tel }}"></td>
                                                <th class="text-center">
                                                    <span class="">우편번호</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class=""><input name="zip" value="{{ $data->zip }}"></span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th class="text-center">
                                                    <span class="">주소</span>
                                                </th>
                                                <td class="text-center" >
                                                    <span class=""><input name="addr1" value="{{ $data->addr1 }}"><input  name="addr2" value="{{ $data->addr2 }}"></span>
                                                </td>
                                                <th class="text-center">
                                                    <span class="">배송메시지</span>
                                                </th>
                                                <td class="text-center" >
                                                    <span class=""><input name="msg" value="{{ $data->msg }}"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </form>
                        {{-- 반려견 상세정보 --}}
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
