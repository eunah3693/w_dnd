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
                                    <h3 class="block-title">OTP인증</h3>
                                </div>
                                <div class="block-content">
                                        <div class="container">
                                            <div class="row">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <form class="form-horizontal" method="POST" action="/2fa">
                                                                {{ csrf_field() }}

                                                                <div class="form-group">
                                                                    <label for="one_time_password" class="col-md-12 control-label"></label>

                                                                    <div class="col-md-12">
                                                                        <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="col-md-6 col-md-offset-4">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            인증하기
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>
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
