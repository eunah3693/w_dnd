@extends('admin.layouts.sidebar')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('/js/global/flatpickr.js') }}"></script>
@endsection

@section('title', '회원관리')
@section('sub-title', '회원의 정보를 확인 및 수정 삭제 할수 있습니다.')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Info -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">검색</h3>
            </div>
            <div class="block-content">
                <p class="font-size-sm text-muted">
                    <form class="mb-5" action="/admin/users/manage" method="GET">
                        <table class="table table-vcenter">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 150px;">회원상태</th>
                                    <td>
                                    <select class="form-control" id="example-select" name="status">
                                        <option {{ request()->status == 'Y' ? ' selected' : ''  }} value="Y">정상</option>
                                        <option {{ request()->status == 'S' ? ' selected' : ''  }} value="S">정지/차단</option>
                                        <option {{ request()->status == 'D' ? ' selected' : ''  }} value="D">탈퇴</option>
                                    </select>
                                    </td>
                                    <th class="text-center" style="width: 150px;">
                                        <select class="form-control" id="example-select" name="date">
                                            <option {{ request()->date == 'created_at' ? ' selected' : ''  }} value="created_at">가입날짜</option>
                                            <option {{ request()->date == 'last_login_date' ? ' selected' : ''  }} value="last_login_date">최근접속날짜</option>
                                        </select>
                                    </th>
                                    <td style="width: 48%;">
                                        <div class="input-group">
                                            <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" name="startdate" placeholder="Y-m-d" value="{{ request()->startdate }}" >
                                            <input type="text" class="js-flatpickr form-control bg-white flatpickr-input" name="enddate" placeholder="Y-m-d" value="{{ request()->enddate }}" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" style="width: 150px;">
                                        <select class="form-control" id="example-select" name="search">
                                            <option {{ request()->search == 'id' ? ' selected' : ''  }} value="id">아이디</option>
                                            <option {{ request()->search == 'name' ? ' selected' : ''  }} value="name">이름</option>
                                        </select>
                                    </th>
                                    <td colspan="3">
                                        <input type="text" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input" id="example-flatpickr-default" name="text" value="{{ request()->text }}" placeholder="검색어를 입력하세요">
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <div class="form-group row">
                            <div class="col-sm-12 ml-auto text-right">
                                <button type="submit" class="btn btn-primary">검색</button>
                            </div>
                        </div>
                    </form>
                </p>
            </div>
        </div>
        <!-- END Info -->
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">리스트</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>이름</th>
                            <th>아이디</th>
                            <th class="d-none d-sm-table-cell" >이메일</th>
                            <th>최근접속일</th>
                            <th>가입일</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Users as $user)
                        <tr>
                            <td class="text-center">{{ $user->idx }}</td>
                            <td class="font-w600"><a href="javascript:void(0)"> {{ $user->name }}</a></td>
                            <td class="d-none d-sm-table-cell">{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login_date }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="" data-original-title="Edit Client">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="" data-original-title="Remove Client">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
