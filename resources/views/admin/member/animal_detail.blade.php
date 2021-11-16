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
                        <div class="block-header block-header-default">
                            <h3 class="block-title">반려견정보 상세보기</h3>
                            <div class="block-options" onclick="location.href='/admin/member/animal_modify'">
                                <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">수정</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table table-hover table-vcenter">
                                        <tbody>
                                            <tr>
                                                <th class="text-center ">이름</th>
                                                <td class="text-center ">{{ $pet->name }}</td>
                                                <th class="d-none d-sm-table-cell text-center">사용자이름</th>
                                                <td class="text-center cursor" onclick="location.href='/admin/member/member_detail?user_idx={{ $pet->user_idx }}'">{{ $pet->user->nickname }}</td>
                                            </tr>


                                            <tr>
                                                <th class="d-none d-sm-table-cell text-center">견종</th>
                                                <td class="text-center">{{ $pet->breed }}</td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">생일</span>
                                                </th>
                                                <td class="text-center">
                                                    <span class="">{{ $pet->birth }}</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">소개</span>
                                                </th>
                                                <td class="text-center" style="width:50%;">
                                                    <span class="">{{ $pet->memo }}</span>
                                                </td>
                                                <th class="text-center" scope="row">프로필사진</th>
                                                <td class=" font-size-sm text-left" style="padding-left:50px">
                                                   @if($pet->file_idx)
                                                    <img width="80px" src="/thum/{{ $pet->file_idx }}">
                                                   @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
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
