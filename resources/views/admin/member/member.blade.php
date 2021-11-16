@extends('admin.layouts.admin_layout')

@section('content')

            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1600px;">
                    {{-- 현황 --}}
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $total_user }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 회원수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_join }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 가입수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_login }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 접속수
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $deactivate }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 탈퇴자수
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 현황 --}}



                <form method="get" action="/admin/member/member">
                    {{-- 리스트 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">전체회원 리스트</h3>
                            {{-- 회원구분 필터 --}}
                            <div class="block-options">

                                <!-- 수정 -->
                                <select name="status" onchange="searchSubmit()"  style="width: 150px; height: 35px; color:#666; border:0; background-color:#f6f7f8; padding-left:10px;">
                                    <option @if(Request::get('status') == "") selected @endif value="" >전체회원</option>
                                    <option @if(Request::get('status') == "Y") selected @endif value="Y" >일반회원</option>
                                    <option @if(Request::get('status') == "D") selected @endif value="D">탈퇴회원</option>
                                    <option @if(Request::get('status') == "S") selected @endif value="S" >차단회원</option>
                                </select>
                                <!-- 수정 -->



                                <select name="sms_agree" onchange="searchSubmit()" >
                                    <option @if(Request::get('sms_agree') == "") selected @endif value="">SMS수신여부</option>
                                    <option @if(Request::get('sms_agree') == "Y") selected @endif value="Y">수신</option>
                                    <option @if(Request::get('sms_agree') == "D") selected @endif value="N">거부</option>
                                </select>
                                <select name="push_agree" onchange="searchSubmit()" >
                                    <option @if(Request::get('push_agree') == "") selected @endif value="">앱푸시수신여부</option>
                                    <option @if(Request::get('push_agree') == "Y") selected @endif value="Y">수신</option>
                                    <option @if(Request::get('push_agree') == "D") selected @endif value="N">거부</option>
                                </select>
                                <select name="alimtalk_agree" onchange="searchSubmit()" >
                                    <option @if(Request::get('alimtalk_agree') == "") selected @endif value="">알림톡수신여부</option>
                                    <option @if(Request::get('alimtalk_agree') == "Y") selected @endif value="Y">수신</option>
                                    <option @if(Request::get('alimtalk_agree') == "D") selected @endif value="N">거부</option>
                                </select>
                                <select name="email_agree" onchange="searchSubmit()" >
                                    <option @if(Request::get('email_agree') == "") selected @endif value="">이메일수신여부</option>
                                    <option @if(Request::get('email_agree') == "Y") selected @endif value="Y">수신</option>
                                    <option @if(Request::get('email_agree') == "D") selected @endif value="N">거부</option>
                                </select>
                            </div>
                            {{-- 회원구분 필터 --}}
                            {{-- 관리자 필터 --}}
                            {{-- <div class="block-options">
                                    <button type="button" class="btn-block-option " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="filter_member_name2">회원구분</span> <i class="fa fa-angle-down ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                            관리자
                                            <span class="badge badge-secondary badge-pill">35</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                            일반회원
                                            <span class="badge badge-secondary badge-pill">15</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 filter_member2" style="font-size:15px" >
                                            전체
                                            <span class="badge badge-secondary badge-pill">20</span>
                                        </a>
                                </div>
                            </div> --}}
                            {{-- 회원구분 필터 --}}
                            {{-- <div class="block-options" onclick="location.href='/admin/member/member_add'">
                                <button type="button" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                            </div> --}}

                        </div>
                        <div class="block-content" style="padding-bottom:1rem;">
                            {{-- 검색창 --}}
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="margin-right:0;">
                                            <select  name="search" onchange=""  style="width: 100px; height: 38px; border: 1px solid #777; border-radius: 0.25rem; color:#777;">
                                                <option @if(Request::get('search') == "nickname") selected @endif value="nickname">닉네임</option>
                                                <option @if(Request::get('search') == "email") selected @endif value="email">이메일</option>
                                                <option @if(Request::get('search') == "tel") selected @endif value="tel">핸드폰</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                        <div class="input-group-append" onclick="searchSubmit()">
                                            <span class="input-group-text bg-body border-0">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            {{-- 검색창 --}}

                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter " id="table_list" data-table="member">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle">
                                                <span>순번</span>
                                            </th>
                                            <th class="text-center" style="vertical-align:middle"><span>이름(닉네임)</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>이메일</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>핸드폰번호</span></th>
                                            <th class="d-none d-sm-table-cell text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_alarm"><span>알림수신</span></th>
                                            <th class="text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_level"><span>레벨</span></th>
                                            <th class="text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_ex"><span>경험</span></th>
                                            <th class="text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_treat"><span>트릿</span></th>
                                            <th class="text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_join"><span>가입일</span></th>
                                            <th class="text-center table_align" style="vertical-align:middle; cursor:pointer;" id="table_login"><span>마지막<br>로그인</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach( $user as $v)
                                        <tr onclick="location.href='/admin/member/member_detail?user_idx={{ $v->idx }}'" >
                                            <td class="text-center font-size-sm">
                                                <span class="text-gray-darker font-w400" >
                                                    <span id="table_idx">{{ $v->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="member_name text-center cursor"">
                                                {{ $v->nickname }}
                                            </td>
                                            <td class="d-none text-center d-xl-table-cell font-size-sm member_email">
                                                <span class="text-gray-darker font-w400"  >{{ $v->email }}</span>
                                                @if ($v->is_sns == '1')
                                                <span class="badge badge-warning" style="margin-left:3px;">{{ $v->sns_type }}</span>
                                                @endif
                                            </td>
                                            <td class="d-none d-xl-table-cell text-center font-size-sm member_phone">
                                                <span class="text-gray-darker font-w400" >{{ $v->tel }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" >
                                                <span>SMS:{{ $v->sms_agree }}|MAIL:{{ $v->email_agree }}|PUSH:{{ $v->push_agree }}|ALIMTALK:{{ $v->alimtalk_agree }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class=" btn-sm font-w400" >
                                                    {{ $v->level }}
                                                </span>

                                            </td>
                                            <td class="text-center">
                                                <span class=" btn-sm font-w400" >
                                                    {{ $v->exp }}
                                                </span>

                                            </td>
                                            <td class="text-center">
                                                <span class=" btn-sm font-w400" >
                                                    @if ($v->total_treat)
                                                    {{ $v->total_treat }}
                                                    @else
                                                    0
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class=" btn-sm font-w400"   >
                                                    {{ $v->created_at }}
                                                </span>

                                            </td>
                                            <td class="text-center">
                                                <span class=" btn-sm font-w400">
                                                    {{ $v->last_login_date }}
                                                </span>

                                            </td>
                                            <td class="text-center cursor"  onclick="location.href='/admin/member/member_modify?user_idx={{ $v->idx }}'">
                                                <span class=" btn-sm font-w400"  >
                                                <i class="si si-pencil fa-fw"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $user->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark" onclick="location.href='/api/admin/user/export?{{ Request::getQueryString() }}'">엑셀파일 다운로드</button>
                </form>
                    {{-- 리스트 --}}
                    <br>
                </div>
                {{-- END Page Content --}}
            </main>
            {{-- END Main Container --}}

            {{-- 푸터 --}}
            @include('admin.layouts.footer')
            {{-- 푸터 --}}


            </div>
        {{-- END Page Container --}}
        <script>
            function deleteMemeber(idx)
            {
                if(confirm('해당 회원을 삭제하시겠습니까?'))
                {

                }
            }
            function searchSubmit()
            {
                $('form').submit();
            }
            $(function(){

                $(".filter_name").click(function(){
                    console.log("클릭");
                    $(this).parent().toggleClass("show")
                    $(this).siblings("button").attr("aria-expanded","true")

                })

                $(".filter_name").siblings("button").click(function(){
                    console.log("아래로")
                })

                $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("아이디");
                    }else if(option_num=="1"){
                        $(".filter_name").text("이메일");
                    }else if(option_num=="2"){
                        $(".filter_name").text("핸드폰");
                    }else if(option_num=="3"){
                        $(".filter_name").text("이름");
                    }

                })
                $(".filter_member").click(function(){
                    var filter_member_num=$(this).index();
                    console.log(filter_member_num);
                    if(filter_member_num=="0"){
                        $(".filter_member_name").text("전체회원");
                    }else if(filter_member_num=="1"){
                        $(".filter_member_name").text("탈퇴회원");
                    }else if(filter_member_num=="2"){
                        $(".filter_member_name").text("차단회원");
                    }

                })
                $(".filter_member2").click(function(){
                    var filter_member_num2=$(this).index();
                    console.log(filter_member_num2);
                    if(filter_member_num2=="0"){
                        $(".filter_member_name2").text("관리자");
                    }else if(filter_member_num2=="1"){
                        $(".filter_member_name2").text("일반회원");
                    }else if(filter_member_num2=="2"){
                        $(".filter_member_name2").text("전체");
                    }

                })
            });
        </script>
@endsection
