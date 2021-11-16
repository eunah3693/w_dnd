@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1800px">

            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">로그 기록</h3>
                    <div class="block-options">
                        <div class="">
                            <!-- <button type="button" class="btn-block-option "  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="">날짜</span> <i class="fa fa-angle-down ml-1"></i>
                            </button> -->
                            <form action="/admin/log" method="GET">
                            <div class="block-options">
                            <select name="table_name" onchange="$('form').submit()">
                                <option @if(Request::get('table_name') == "log") selected @endif value="log">요청/응답 로그</option>
                                <option @if(Request::get('table_name') == "log_exp_tbl") selected @endif value="log_exp_tbl">경험치 로그</option>
                                <option @if(Request::get('table_name') == "log_app_push_tbl") selected @endif value="log_app_push_tbl">앱푸시 로그</option>
                            </select>
                            </div>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom " style="font-size:15px" >
                                    <input type="text" class="js-masked-date-dash form-control js-masked-enabled" name="id" value="@if(Request::get('id')) {{ Request::get('id') }} @endif" placeholder="yyyy-mm-dd" style="margin-right:1rem;">
                                    <i onclick="$('form').submit()" class="fa fa-search"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="block-content">


                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                @foreach ($col as $c)
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>{{ $c }}</span></th>
                                @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data as $v )
                                <tr>
                                    @foreach ($col as $c)
                                        <th class="vertical_center text-center" style="vertical-align:middle"><span>{{ $v->$c }}</span></th>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                    {{-- Pagination --}}
                    @if($data)
                    {{ $data->appends(request()->input())->links() }}
                    @endif
                    {{-- END Pagination --}}
                </div>
            </div>
            {{-- END All Orders --}}
        </div>
        {{-- END Page Content --}}
    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}


    </div>
    {{-- END Page Container --}}

    @endsection
