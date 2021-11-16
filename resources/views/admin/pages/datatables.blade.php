@extends('admin.layouts.sidebar')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('title', 'DataTables')
@section('sub-title', '데이터테이블~')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Info -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Plugin Example</h3>
            </div>
            <div class="block-content">
                <p class="font-size-sm text-muted">
                    This page showcases how easily you can add a plugin’s JS/CSS assets and init it using custom JS code.
                </p>
            </div>
        </div>
        <!-- END Info -->
        <!-- Dynamic Table with Export Buttons -->
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">Dynamic Table <small>Export Buttons</small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th style="width: 15%;">Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 5; $i++)
                        <tr>
                            <td class="text-center">{{ $i }}</td>
                            <td class="font-w600">
                                <a href="javascript:void(0)">John Smith</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                client{{ $i }}<em class="text-muted">@example.com</em>
                            </td>
                            <td>
                                <em class="text-muted">{{ rand(2, 10) }} days ago</em>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table with Export Buttons -->
    </div>
    <!-- END Page Content -->
@endsection
