
        {{-- 헤더: 설정버튼 클릭시 사이드바 --}}
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            {{-- Side Overlay--}}
            <aside id="side-overlay">
                {{-- Side Header --}}
                <div class="content-header border-bottom">
                    {{-- User Avatar --}}

                    {{-- END User Avatar --}}

                    {{-- User Info --}}
                    <div class="ml-2">
                        <a class="text-dark font-w600 font-size-sm">관리자님</a>
                    </div>
                    {{-- END User Info --}}

                    {{-- Close Side Overlay --}}
                    {{-- Layout API, functionality initialized in Template._uiApiLayout() --}}
                    <a class="ml-auto btn btn-sm btn-alt-danger"  data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                    {{-- END Close Side Overlay --}}
                </div>
                {{-- END Side Header --}}

                {{-- Side Content --}}
                <div class="content-side">
                    {{-- Side Overlay Tabs --}}
                    <div class="block block-transparent pull-x pull-t">

                        <div class="block-content tab-content overflow-hidden">
                            {{-- Overview Tab --}}
                            <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel">
                                {{-- Activity --}}
                                <div class="block">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">내정보 관리</h3>

                                    </div>
                                    <div class="block-content">
                                        {{-- Activity List --}}
                                        <ul class="nav-items mb-0">
                                            <li >
                                                <a class="text-dark media py-2 form-group">
                                                    <div class="col-3 font-w600 font-size-sm">
                                                        아이디
                                                    </div>
                                                    <div class=" col-8" >
                                                        <div class="font-size-m ">admin</div>

                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-dark media py-2 form-group">
                                                    <div class="col-3 font-w600 font-size-sm">
                                                        이름
                                                    </div>
                                                    <div class=" col-8" >
                                                        <div class="font-size-m ">관리자</div>

                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-dark media py-2 form-group">
                                                    <div class="col-3 font-w600 font-size-sm">
                                                        상태
                                                    </div>
                                                    <div class=" col-8" >
                                                        <div class="font-size-m ">정상회원</div>

                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-dark media py-2 form-group">
                                                    <div class="col-3 font-w600 font-size-sm">
                                                        이메일
                                                    </div>
                                                    <div class=" col-8" style="width:120px;">
                                                        <span class="font-size-sm " >admin@GUWORLDWIDE.com</span>

                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        {{-- END Activity List --}}
                                    </div>
                                </div>
                                {{-- END Activity --}}

                            </div>
                            {{-- END Overview Tab --}}


                        </div>
                    </div>
                    {{-- END Side Overlay Tabs --}}
                </div>
                {{-- END Side Content --}}
            </aside>
            {{-- 헤더: 설정클릭시 사이드바--}}

           {{-- 추가 --}}
           <nav id="sidebar" aria-label="Main Navigation">
                {{-- Side Header --}}
                <div class="content-header bg-white-5">
                    {{-- Logo --}}
                    <a class="font-w600 text-dual" href="/admin/index">
                        <span class="smini-visible">
                            <i class="fa fa-circle-notch text-primary"></i>
                        </span>
                        <span class="smini-hide font-size-h5 tracking-wider">
                            DND<span class="font-w400"></span>
                        </span>
                    </a>
                    {{-- END Logo --}}


                </div>
                {{-- END Side Header --}}

                {{-- Sidebar Scrolling --}}
                <div class="js-sidebar-scroll">
                    {{-- Side Navigation --}}
                    <div class="content-side">
                        <ul class="nav-main">

                            <li class="nav-main-item{{ request()->is('admin/member/*') ? ' open' : '' }}" >
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon si si-users"></i>
                                    <span class="nav-main-link-name" >회원관리</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/member*') ? ' active' : '' }}"  href="/admin/member/member">

                                            <span class="nav-main-link-name">회원관리</span>
                                        </a>

                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/animal*') ? ' active' : '' }}"  href="/admin/member/animal">

                                            <span class="nav-main-link-name">반려동물관리</span>
                                        </a>

                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/delivery*') ? ' active' : '' }}"  href="/admin/member/delivery">

                                            <span class="nav-main-link-name">배송관리</span>
                                        </a>

                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/address*') ? ' active' : '' }}"  href="/admin/member/address">

                                            <span class="nav-main-link-name">배송지관리</span>
                                        </a>

                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/treat*') ? ' active' : '' }}"  href="/admin/member/treat">

                                            <span class="nav-main-link-name">트릿관리</span>
                                        </a>

                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/member/level*') ? ' active' : '' }}"  href="/admin/member/level">

                                            <span class="nav-main-link-name">경험치관리</span>
                                        </a>

                                    </li>


                                </ul>
                            </li>

                            <li class="nav-main-item{{ request()->is('admin/manage/*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon si si-wrench"></i>
                                    <span class="nav-main-link-name">사이트관리</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/banner*') ? ' active' : '' }}"  href="/admin/manage/banner">
                                            <span class="nav-main-link-name">배너관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/popup*') ? ' active' : '' }}"   href="/admin/manage/popup">
                                            <span class="nav-main-link-name">팝업관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/terms*') ? ' active' : '' }}"    href="/admin/manage/terms">
                                            <span class="nav-main-link-name">이용약관/개인정보</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                         <a class="nav-main-link{{ request()->is('admin/manage/manage*') ? ' active' : '' }}"  href="/admin/manage/manage">
                                            <span class="nav-main-link-name">관리자권한설정</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/app_setting*') ? ' active' : '' }}" href="/admin/manage/app_setting">
                                            <span class="nav-main-link-name">앱설정관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/file*') ? ' active' : '' }}" href="/admin/manage/file">
                                            <span class="nav-main-link-name">파일관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/breed*') ? ' active' : '' }}" href="/admin/manage/breed">
                                            <span class="nav-main-link-name">견종관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/manage/alram*') ? ' active' : '' }}" href="/admin/manage/alarm">
                                            <span class="nav-main-link-name">알람관리</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-main-item{{ request()->is('admin/mission_manage/*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon si si-trophy"></i>
                                    <span class="nav-main-link-name">미션관리</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/story*') ? ' active' : '' }}" href="/admin/mission_manage/story">
                                            <span class="nav-main-link-name">스토리퀘스트</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/mission*') ? ' active' : '' }}" href="/admin/mission_manage/mission">
                                            <span class="nav-main-link-name">전체미션관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/accepted_mission*') ? ' active' : '' }}" href="/admin/mission_manage/accepted_mission">
                                            <span class="nav-main-link-name">발급미션관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/member_mission_list*') ? ' active' : '' }}" href="/admin/mission_manage/member_mission_list">
                                            <span class="nav-main-link-name">회원미션내역</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/report*') ? ' active' : '' }}" href="/admin/mission_manage/report">
                                            <span class="nav-main-link-name">신고관리</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/mission_manage/reply*') ? ' active' : '' }}" href="/admin/mission_manage/reply">
                                            <span class="nav-main-link-name">댓글관리</span>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                            <li class="nav-main-item{{ request()->is('admin/board*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon si si-list"></i>
                                    <span class="nav-main-link-name">게시판관리</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/notice*') ? ' active' : '' }}" href="/admin/board/notice">
                                            <span class="nav-main-link-name">공지사항</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/ask*') ? ' active' : '' }}" href="/admin/board/ask">
                                            <span class="nav-main-link-name">이용문의</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/frequently_ask*') ? ' active' : '' }}" href="/admin/board/frequently_ask">
                                            <span class="nav-main-link-name">자주하는질문</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/event*') ? ' active' : '' }}" href="/admin/board/event">
                                            <span class="nav-main-link-name">이벤트</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board_event/exchange*') ? ' active' : '' }}" href="/admin/board_event/exchange">
                                            <span class="nav-main-link-name">교환소</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board_event/review*') ? ' active' : '' }}" href="/admin/board_event/review">
                                            <span class="nav-main-link-name">리뷰관리</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/guide*') ? ' active' : '' }}" href="/admin/board/guide">
                                            <span class="nav-main-link-name">이용안내</span>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/board/pet*') ? ' active' : '' }}" href="/admin/board/pet">
                                            <span class="nav-main-link-name">펫시피</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="nav-main-item{{ request()->is('admin/marketing/*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="nav-main-link-icon si si-envelope"></i>
                                    <span class="nav-main-link-name">마케팅관리</span>
                                </a>
                                <ul class="nav-main-submenu">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/marketing/marketing_*') ? ' active' : '' }}" href="/admin/marketing/marketing_list">
                                            <span class="nav-main-link-name">마케팅내역</span>
                                        </a>
                                    </li>

                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/marketing/app_push*') ? ' active' : '' }}" href="/admin/marketing/app_push">
                                            <span class="nav-main-link-name">앱푸쉬 발송</span>
                                        </a>
                                    </li>

                                    {{-- <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/marketing/mail*') ? ' active' : '' }}" href="/admin/marketing/mail">
                                            <span class="nav-main-link-name">메일 발송</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/marketing/mess*') ? ' active' : '' }}" href="/admin/marketing/mess">
                                            <span class="nav-main-link-name">문자 발송</span>
                                        </a>
                                    </li>
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/marketing/alarm_talk*') ? ' active' : '' }}" href="/admin/marketing/alarm_talk">
                                            <span class="nav-main-link-name">알림톡 발송</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="nav-main-item{{ request()->is('admin/log/*') ? ' open' : '' }}" href="/admin/log">
                                <a class="nav-main-link nav-main-link-submenu{{ request()->is('admin/log') ? ' active' : '' }}"  href="/admin/log">
                                    <i class="nav-main-link-icon si si-envelope"></i>
                                    <span class="nav-main-link-name">로그기록</span>
                                </a>

                            </li>

                        </ul>
                    </div>
                    {{-- END Side Navigation --}}
                </div>
                {{-- END Sidebar Scrolling --}}
            </nav>
            {{-- END Sidebar --}}

           {{-- 추가 --}}

            {{-- END Sidebar --}}

            {{-- 인클루드 : 헤더  --}}
            <header id="page-header">
            <div class="content-header">
                    {{-- Left Section --}}
                    <div class="d-flex align-items-center">
                        {{-- Toggle Sidebar --}}
                        {{-- Layout API, functionality initialized in Template._uiApiLayout()--}}
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        {{-- END Toggle Sidebar --}}

                        {{-- Toggle Mini Sidebar --}}
                        {{-- Layout API, functionality initialized in Template._uiApiLayout()--}}
                        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>
                        {{-- END Toggle Mini Sidebar --}}


                        {{-- Search Form (visible on larger screens) --}}
                        <div class=" d-md-inline-block font-w700 font-size-h4"  >
                            DND 관리자페이지
                        </div>
                        {{-- END Search Form --}}
                    </div>
                    {{-- END Left Section --}}

                    {{-- Right Section --}}
                    <div class="d-flex align-items-center">


                        {{-- 헤더: 홈버튼--}}
                        <div class="">
                            <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-bell"></i>
                                <span class="text-primary">•</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown" style="">
                                <div class="p-2 bg-primary-dark text-center rounded-top">
                                    <h5 class="dropdown-header text-uppercase text-white">Alarm</h5>
                                </div>
                                <ul class="nav-items mb-0">
                                    <li>
                                        <a class="text-dark media py-2" href="/admin/member/member">
                                            <div class="mr-2 ml-3">
                                                <i class="far fa-fw fa-check-circle"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600">포스트가 <span id="alram_post">00</span>건 등록되었습니다. </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="/admin/mission_manage/reply">
                                            <div class="mr-2 ml-3">
                                                <i class="far fa-fw fa-check-circle"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600" >댓글이 <span id="alram_reply">00</span>건 등록되었습니다. </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="/admin/mission_manage/report">
                                            <div class="mr-2 ml-3">
                                                <i class="far fa-fw fa-check-circle"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600" >신고가 <span id="alram_report">00</span>건 등록되었습니다. (어제~오늘)</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="/admin/member/delivery">
                                            <div class="mr-2 ml-3">
                                                <i class="far fa-fw fa-check-circle"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600" >이벤트 당첨자 <span id="alram_event">00</span>명 입니다. (어제~오늘)</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark media py-2" href="/admin/board/ask">
                                            <div class="mr-2 ml-3">
                                                <i class="far fa-fw fa-check-circle"></i>
                                            </div>
                                            <div class="media-body pr-2">
                                                <div class="font-w600" >답변하지 않은 1:1 문의가 <span id="alram_board">00</span>건 있습니다.</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="p-2 bg-primary-dark text-center rounded-top">
                                    <h5 class="dropdown-header text-uppercase text-white"></h5>
                                </div>
                            </div>
                        </div>
                        <script>
                            $.get('/admin/alarm', function(res){
                                if(res.status == 200)
                                {
                                    console.log(1);
                                    $('#alram_post').text(res.data.post);
                                    $('#alram_reply').text(res.data.reply);
                                    $('#alram_report').text(res.data.report);
                                    $('#alram_event').text(res.data.event);
                                    $('#alram_board').text(res.data.board);
                                }
                            })
                        </script>
                        {{-- 헤더: 홈버튼--}}

                        {{-- 헤더: 설정버튼--}}
                        {{-- Layout API, functionality initialized in Template._uiApiLayout() --}}
                        <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                                <i class="fa fa-cog"></i>
                        </button>
                        {{-- 헤더: 설정버튼--}}
                    </div>
                    {{-- END Right Section --}}
                </div>
            </header>
            {{-- 인클루드 : 헤더  --}}
