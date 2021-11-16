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

@section('title', '미션 메타 정보')
@section('sub-title', '미션 관련 메타 정보들을 확인 및 수정, 삭제 할 수 있습니다.')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                    @foreach ($Category as $cate)
                    @if ($cate->category_idx == '0')
                    <div class="block-header">
                        <h3 class="block-title">{{ $cate->name }} 관리</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>카테고리명</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Category as $cate2)
                            @if ($cate2->category_idx == $cate->idx)
                            <tr>
                                <td>{{$loop->index}}</td>
                                <td>{{$cate2->name}}</td>
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
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @endforeach

                    <div class="block-header">
                        <h3 class="block-title">미션 주기 관리</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>주기</th>
                                <th>편집</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Cycle as $cycle)
                            <tr>
                                <td>{{$cycle->idx}}</td>
                                <td>{{$cycle->number}} {{$cycle->cycle}}</td>
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
