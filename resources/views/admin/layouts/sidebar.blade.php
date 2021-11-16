@extends('admin.layouts.layout')

@section('page-container')

<div id="page-container" class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">
    <!-- Sidebar -->
    <nav id="sidebar" aria-label="Main Navigation">
        <div class="content-header bg-white-5">
            <!-- Logo -->
            <a class="font-w600 text-dual" href="/">
                <span class="smini-visible">
                    <i class="fa fa-circle-notch text-primary"></i>
                </span>
                <span class="smini-hide font-size-h5 tracking-wider">
                    관리자페이지
                </span>
            </a>
            <!-- END Logo -->
        </div>
        @include('admin.layouts.menu')
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                    <i class="fa fa-fw fa-ellipsis-v"></i>
                </button>
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ml-2">{{ session()->get('id') }}</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-primary-dark rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                            <p class="mt-2 mb-0 text-white font-w500">{{ session()->get('id') }}</p>
                            <p class="mb-0 text-white-50 font-size-sm">Web Developer</p>
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span class="font-size-sm font-w500">Inbox</span>
                                <span class="badge badge-pill badge-primary ml-2">3</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span class="font-size-sm font-w500">Profile</span>
                                <span class="badge badge-pill badge-primary ml-2">1</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                <span class="font-size-sm font-w500">Settings</span>
                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="/admin/logout">
                                <span class="font-size-sm font-w500">Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Notifications Dropdown -->
                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="text-primary">•</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-2 bg-primary-dark text-center rounded-top">
                            <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                        </div>
                        <ul class="nav-items mb-0">
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">You have a new follower</div>
                                        <span class="font-w500 text-muted">15 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">1 new sale, keep it up</div>
                                        <span class="font-w500 text-muted">22 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-times-circle text-danger"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">Update failed, restart server</div>
                                        <span class="font-w500 text-muted">26 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">2 new sales, keep it up</div>
                                        <span class="font-w500 text-muted">33 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-user-plus text-success"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">You have a new subscriber</div>
                                        <span class="font-w500 text-muted">41 min ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="text-dark media py-2" href="javascript:void(0)">
                                    <div class="mr-2 ml-3">
                                        <i class="fa fa-fw fa-check-circle text-success"></i>
                                    </div>
                                    <div class="media-body pr-2">
                                        <div class="font-w600">You have a new follower</div>
                                        <span class="font-w500 text-muted">42 min ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="p-2 border-top">
                            <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                                <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Notifications Dropdown -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-white">
            <div class="content-header">
                <form class="w-100" action="/dashboard" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                    </div>
                </form>
            </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-white">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        @yield('title') <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">@yield('sub-title')</small>
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" id="breadcrumb_title"></li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="" id="breadcrumb_sub_title"></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
            <div class="row font-size-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                    <a class="font-w600" href="https://1.envato.market/AVD6j" target="_blank">OneUI</a> &copy; <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('#breadcrumb_title').text(jQuery('.nav-main-item.open > a.nav-main-link-submenu > span').text())
        jQuery('#breadcrumb_sub_title').text(jQuery('.nav-main-item.open .nav-main-link.active > span').text())
    });
</script>
@endsection
