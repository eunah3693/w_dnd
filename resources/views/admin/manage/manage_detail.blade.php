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

            {{-- All Orders --}}
            <form method="POST" action="/api/admin/manage/insert" enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default" style="position:relative;">
                        <h3 class="block-title">관리자 상세보기</h3>
                    </div>
                    <div class="block-content">
                        <table class="table  table-vcenter">
                            <tbody>
                                <tr>
                                    <th class="text-center">순번</th>
                                    <td class="text-center" id="member_table_idx">{{ $user->idx }}</td>
                                    <th class="d-none d-sm-table-cell text-center">아이디</th>
                                    <td class="text-center" >{{ $user->id }}</td>
                                </tr>


                                <tr>
                                    <th class="text-center" scope="row">이름</th>
                                    <td class="font-size-sm text-center" >
                                        <span >{{ $user->name }}</span>
                                    </td>
                                    <th class="d-none d-sm-table-cell text-center">
                                        <span class="">이메일</span>
                                    </th>
                                    <td class="text-center">
                                        <span class="">{{ $user->email }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">핸드폰</th>
                                    <td class=" font-size-sm text-center">
                                        <span >{{ $user->tel }}</span>
                                    </td>
                                    <th class="text-center" scope="row"></th>
                                    <td class=" font-size-sm text-center">
                                        <span ></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="row">가입일</th>
                                    <td class=" font-size-sm text-center">
                                        <span >{{ $user->created_at }}</span>
                                    </td>
                                    <th class="d-none d-sm-table-cell text-center">
                                        <span class="">마지막로그인</span>
                                    </th>
                                    <td class="text-center">
                                        <span class="">{{ $user->last_login_date }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="d-none d-sm-table-cell text-center">
                                        <span class="">패스워드</span>
                                    </th>
                                    <td class="text-center">
                                        <input value="" id="password" type="password" placeholder="비밀번호 변경">
                                        <button type="button" onclick="updatePassword({{$user->idx}})" class="btn btn-sm btn-secondary">비밀번호 바꾸기</button>
                                    </td>
                                    <th class="d-none d-sm-table-cell text-center">
                                        <span class="">otp</span>
                                    </th>
                                    <td class="text-center">
                                        <div id="QR_Image"></div>
                                        <span id="2fa_key">{{ $otp_key }}</span>
                                        <button type="button"  onclick="setOTP({{$user->idx}})" class="btn btn-sm btn-secondary"> QR코드 발급</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>

        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}
    </div>

    <script>
function setOTP(idx)
{
    if(confirm('재발급일 경우 기존 OTP는 사용할수 없습니다. 계속진행하시려면 확인을 눌러주세요.')){
        $.get('/admin/manage/manage/2fa/'+idx, function(res)
        {
            if(res.status == 200)
            {
                $('#QR_Image').html(res.QR_Image);
                $('#2fa_key').text(res.key);
            }
        })
    }
}
function updatePassword(idx)
{
    var pw = $('#password').val();
    var data = {
        user_idx : idx,
        pw : pw
    }
    $.post('/api/admin/user/passupdate', data, function(res){
        if(res.status == 200)
        {
            alert(res.msg);
            location.reload();
        }
    })
}
    </script>
@endsection
