<div class="js-sidebar-scroll">
    <div class="content-side">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                    <i class="nav-main-link-icon si si-cursor"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            <li class="nav-main-heading">사용자</li>
            <li class="nav-main-item{{ request()->is('admin/users/*') ? ' open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">사용자</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/users/manage') ? ' active' : '' }}" href="/admin/users/manage">
                            <span class="nav-main-link-name">회원관리</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-heading">미션</li>
            <li class="nav-main-item{{ request()->is('admin/mission/*') ? ' open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">미션관리</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/mission/manage') ? ' active' : '' }}" href="/admin/mission/manage">
                            <span class="nav-main-link-name">미션 메타 설정</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/mission/mission*') ? ' active' : '' }}" href="/admin/mission/mission">
                            <span class="nav-main-link-name">미션 관리</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('admin/mission/user/list') ? ' active' : '' }}" href="/admin/mission/user/list">
                            <span class="nav-main-link-name">회원 미션 관리</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-heading">관리자</li>
            <li class="nav-main-item{{ request()->is('admin/*') ? ' open' : '' }}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">관리자</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}" href="/pages/datatables">
                            <span class="nav-main-link-name">DataTables</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-heading">More</li>
            <li class="nav-main-item open">
                <a class="nav-main-link" href="/">
                    <i class="nav-main-link-icon si si-globe"></i>
                    <span class="nav-main-link-name">Landing</span>
                </a>
            </li>
        </ul>
    </div>
</div>
