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

@section('title', '미션관리')
@section('sub-title', '미션의 정보를 확인 및 수정 삭제 할 수 있습니다.')

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
                                    <th class="text-center" style="width: 150px;">미션주기</th>
                                    <td>
                                    <select class="form-control" id="example-select" name="status">
                                        @foreach ($Cycle as $cycle)
                                            <option {{ request()->status == $cycle->number.' '.$cycle->cycle ? ' selected' : ''  }} value="{{$cycle->number}} {{$cycle->cycle}}">{{$cycle->name}}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <th class="text-center" style="width: 150px;">
                                        <select class="form-control" id="example-select" name="date">
                                            <option {{ request()->date == 'created_at' ? ' selected' : ''  }} value="created_at">생성날짜</option>
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
                                    <th class="text-center" style="width: 150px;">카테고리</th>
                                    <td>
                                    <select class="form-control" id="example-select" name="status">
                                        @foreach ($Category as $cate)
                                            <option {{ request()->status == $cate->idx.' '.$cate->idx ? ' selected' : ''  }} value="{{$cate->idx}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    </td>
                                    <th class="text-center" style="width: 150px;">
                                    </th>
                                    <td style="width: 48%;">
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
                            <th>주기</th>
                            <th>종류</th>
                            <th>공개여부</th>
                            <th>카테고리</th>
                            <th>제목</th>
                            <th>서브제목</th>
                            <th>포인트</th>
                            <th>경험치</th>
                            <th>제공날짜</th>
                            <th>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Mission as $mission)
                        <tr>
                            <td class="text-center">{{ $mission->idx }}</td>
                            <td>{{ $mission->cycle->name }}</td>
                            <td class="d-none d-sm-table-cell">{{ $mission->is_single == '1' ? '단일미션':'단계별미션' }}</td>
                            <td>{{ $mission->is_public == '1' ? '공개':'비공개' }}</td>
                            <td>{{ $mission->category->name }}</td>
                            <td>{{ $mission->title }}</td>
                            <td>{{ $mission->sub_title }}</td>
                            <td>{{ $mission->point }} pt</td>
                            <td>{{ $mission->exp }} exp</td>
                            <td>{{ $mission->startdate }} ~ {{ $mission->enddate }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="" href="/admin/mission/mission/view?idx={{ $mission->idx }}" data-original-title="수정페이지 이동">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="" data-original-title="삭제">
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
