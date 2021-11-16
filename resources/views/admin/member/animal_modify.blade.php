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
                <form method="POST" action="{{ $url }}">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">반려견정보 {{ $type }}</h3>
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
                                                <th class="text-center ">이름</th>
                                                <td class="text-center "><input class="text-center" type="text" name="name" value="{{ $pet->name }}" style="border:0;"></td>
                                                <th class="d-none d-sm-table-cell text-center">견종</th>
                                                <td class="text-center"><input class="text-center" type="text" name="breed" value="{{ $pet->breed }}" style="border:0;"></td>
                                            </tr>


                                            <tr>
                                                @if ($type == '수정')
                                                <th class="text-center" scope="row">유저닉네임</th>
                                                <td class=" text-center">
                                                   <a href="/admin/member/memeber_detail?user_idx={{ $pet->user_idx }}">
                                                    {{ $pet->user->nickname }}
                                                    <input name="pet_idx" value="{{ $pet->idx }}" type="hidden">
                                                    <input name="user_idx" value="{{ $pet->user_idx }}" type="hidden">
                                                   </a>
                                                </td>
                                                @else
                                                <th class="text-center" scope="row">유저인덱스</th>
                                                <td class=" text-center">
                                                    <input name="user_idx" value="" type="number">
                                                   </a>
                                                </td>
                                                @endif
                                                <th class="d-none d-sm-table-cell text-center">
                                                   생일
                                                </th>
                                                <td class="text-center">
                                                    <input class="text-center" name="birth" type="text" value="{{ $pet->birth }}" style="border:0;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">메모</th>
                                                <td class=" text-left" colspan="3"  style="padding-left:50px">
                                                <textarea style="width:100%; height:100px; border:0; border-bottom:1px solid #ccc;" name="memo">{{ $pet->memo }}</textarea>
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
