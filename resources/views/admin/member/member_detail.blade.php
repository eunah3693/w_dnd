@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
<script>
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
@section('content')

            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1400px">
                   {{-- 회원상세정보--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">회원 상세정보</h3>
                            <div class="block-options" onclick="location.href='/api/admin/user/update/status?status=D&user_idx={{$user->idx}}'">
                                <button type="submit" class="btn btn-dark" >탈퇴</button>
                            </div>
                            <div class="block-options" onclick="location.href='/api/admin/user/update/status?status=S&user_idx={{$user->idx}}'">
                                <button type="submit" class="btn btn-dark" >정지/차단</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            <div class="block-content">
                                    <table class="table  table-vcenter">
                                        
                                        <tbody>
                                            <tr>
                                                <th class="text-center">순번</th>
                                                <td class="text-center" id="member_table_idx">{{ $user->idx }}</td>
                                                <th class="d-none d-sm-table-cell text-center">이메일</th>
                                                <td class="text-center" >{{ $user->email }}</td>
                                            </tr>


                                            <tr>
                                                <th class="text-center" scope="row">이름(닉네임)</th>
                                                <td class="font-size-sm text-center" >
                                                    <span >{{ $user->nickname }}</span>
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
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">알림수신여부</span>
                                                </th>
                                                <td class="text-center">
                                                    <span>SMS:{{ $user->sms_agree }} | MAIL:{{ $user->email_agree }} | PUSH:{{ $user->push_agree }} | ALIMTALK:{{ $user->alimtalk_agree }}
                                                    </span>
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
                                                <th class="text-center" scope="row">토큰</th>
                                                <td class=" font-size-sm text-center" >
                                                    <span style="display:inline-block;width:250px; overflow-x:auto;">{{ $user->fcm_token }}</span>
                                                </td>
                                                <th class="d-none d-sm-table-cell text-center">
                                                    <span class="">패스워드</span>
                                                </th>
                                                <td class="text-center">
                                                    <input value="" id="password" type="password" placeholder="비밀번호 변경">
                                                    <button type="button" onclick="updatePassword({{$user->idx}})" class="btn btn-sm btn-secondary">비밀번호 바꾸기</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">자기소개</th>
                                                <td class=" font-size-sm  text-left"  style="padding-left:50px">
                                                    <span>{{ $user->my_feed }}</span>
                                                </td>
                                                <th class="text-center" scope="row">프로필사진</th>
                                                <td class=" font-size-sm  text-left">
                                                    @if($user->file_idx) <img width="80px" src="/files/{{$user->file_idx}}"> @else <span>없음</span> @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>

                    {{-- 회원상세정보--}}
                    {{-- 반려견 상세정보 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">반려견 상세정보</h3>
                            <div class="block-options" onclick="location.href='/admin/member/animal_modify?user_idx={{$user->idx}}'">
                                <button type="submit" class="btn btn-dark" >수 정</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- Topics --}}
                            @foreach ($pet as $p)
                            <div class="block-content">
                                <table class="table table-vcenter">
                                    <tbody>
                                        <tr>
                                            <th class="text-center  ">이름</th>
                                            <td class="text-center ">{{ $p->name }}</td>
                                            <th class="d-none d-sm-table-cell text-center">견종</th>
                                            <td class="text-center">{{ $p->breed }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center" scope="row">생일</th>
                                            <td class="font-size-sm text-center">
                                                <span>{{ $p->birth }}</span>
                                            </td>
                                            <th class="text-center" scope="row">프로필사진</th>
                                            <td class=" font-size-sm text-center">
                                                @if($p->file_idx) <img width="80px" src="/files/{{$p->file_idx}}"> @else <span>없음</span> @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr style="border-top:4px solid #e1e6e9">
                            </div>
                            @endforeach

                        </div>
                        {{-- 반려견 상세정보 --}}

                    </div>
                        {{-- 트릿상세내역 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">트릿상세내역</h3>
                            <div class="block-options" onclick="location.href='/admin/member/treat_modify?user_idx={{$user->idx}}'">
                                <button type="submit" class="btn btn-dark" >수 정</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>추가/차감</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($treat as $t)
                                    <tr>
                                        <td class="text-center font-size-sm">
                                            <span class="text-gray-darker font-w600">
                                                <span>{{ $t->treat }}</span>
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">{{ $t->memo }}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $t->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $treat->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- 트릿상세내역 --}}

                    {{-- 레벨상세내역--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">레벨상세내역</h3>
                            <div class="block-options" onclick="location.href='/admin/member/level_modify?user_idx={{$user->idx}}'">
                                <button type="submit" class="btn btn-dark" >수 정</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>추가/차감</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($logexp as $l)
                                    <tr>
                                        <td class="text-center font-size-sm">
                                            <span class="text-gray-darker font-w600" >
                                                <span>{{ $l->exp }}</span>
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">{{ $l->memo }}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $l->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $logexp->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- 레벨상세내역 --}}
                    {{-- 피드상세내역--}}
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">전체피드내역</h3>
                            <div class="block-options">

                            </div>
                        </div>
                        <div class="block-content">


                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>미션</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>이미지</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>좋아요</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>신고수</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>감추기</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>삭제</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $p)
                                        <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="text-gray-darker font-w600" >
                                                    <span>{{ $p->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                @if ($p->mission)
                                                {{$p->mission->missionPool->title}}
                                                @else
                                                일상
                                                @endif
                                            </td>
                                            <td class="text-left" style="width:400px; overflow-y:auto; white-space:normal; word-break:normal;">
                                                {{$p->content}}
                                            </td>
                                            <td class="d-none d-xl-table-cell text-center font-size-sm">
                                                @if(count($p->files))
                                                    @foreach ($p->files as $f)
                                                    <img src="/thum/{{$f->idx}}" width="80px">
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                <span>{{ count($p->like) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="btn btn-sm font-w400" >
                                                    {{ $p->report }}
                                                </span>

                                            </td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">
                                                @if ($p->is_public == 1)
                                                <i onclick="updatePostPublic({{$p->idx}}, 0)" class="fa fa-fw fa-eye"></i>
                                                @else
                                                <i onclick="updatePostPublic({{$p->idx}}, 1)" class="far fa-fw fa-eye-slash"></i>
                                                @endif
                                            </td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">
                                                <i class="fa fa-fw fa-times"></i>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $post->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- END All Orders --}}
                    {{-- 피드상세내역 --}}
                    {{-- 댓글상세내역--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">댓글내역</h3>

                        </div>
                        <div class="block-content">
                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>순번</span></th>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>포스트번호</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>감추기</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($post_reply as $pr)
                                    <tr>
                                        <td class="text-center font-size-sm">
                                            <span class="text-gray-darker font-w600" >
                                                <span>{{ $pr->idx }}</span>
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{$pr->post_idx}}</td>
                                        <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">{!! $pr->content !!}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{$pr->created_at}}</td>
                                        <td class="d-xl-table-cell text-center font-size-sm cursor">
                                            @if ($pr->is_public == 1)
                                            <i onclick="updatePostPublic({{$pr->idx}}, 0)" class="fa fa-fw fa-eye"></i>
                                            @else
                                            <i onclick="updatePostPublic({{$pr->idx}}, 1)" class="far fa-fw fa-eye-slash"></i>
                                            @endif
                                        </td>
                                        <td class="d-xl-table-cell text-center font-size-sm cursor">
                                                <i class="fa fa-fw fa-times"></i>
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            {{ $post_reply->appends(request()->input())->links() }}
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- 댓글상세내역 --}}

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
