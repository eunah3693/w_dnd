@extends('admin.layouts.layout')

@section('page-container')
    <!-- Hero -->
<div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
        <div class="hero bg-white overflow-hidden">
            <div class="hero-inner">
                <div class="content">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4">
                            <!-- Sign In Block -->
                            <div class="block block-rounded block-themed mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">비밀번호변경</h3>
                                </div>
                                <div class="block-content">
                                    <div class="p-sm-3 px-lg-4 py-lg-5">
                                        <h1 class="h2 mb-1"></h1>
                                        <!-- Sign In Form -->

                                        @if (session('status'))
                                            <div class="alert alert-danger">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form class="js-validation-signin" action="/api/admin/user/pw" method="POST">
                                            @csrf
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-alt form-control-lg" id="login-password" name="pw" placeholder="비밀번호">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-alt form-control-lg" id="login-password-r" name="r_pw" placeholder="비밀번호확인">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-xl-5">
                                                    <button type="submit" class="btn btn-block btn-alt-primary">
                                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> 변경하기
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- END Sign In Form -->
                                    </div>
                                </div>
                            </div>
                            <!-- END Sign In Block -->
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->
    </main>
<!-- END Main Container -->
</div>
<!-- END Page Container -->
@endsection
