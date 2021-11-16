@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1400px">
        <form method="get" action="/admin/marketing/marketing_list">
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default" style="position:relative;">
                    <h3 class="block-title">마케팅 작업내역</h3>
                    <div class="block-options">
                    <select onchange="$('form').submit()"  name="category">
                        <option  @if(Request::get('category') == "") selected @endif value="">종류</option>
                        <option  @if(Request::get('category') == "앱푸쉬") selected @endif value="앱푸쉬">앱푸쉬</option>
                        <option  @if(Request::get('category') == "알림톡") selected @endif value="알림톡">알림톡</option>
                        <option  @if(Request::get('category') == "메일") selected @endif value="메일">메일</option>
                        <option  @if(Request::get('category') == "문자") selected @endif value="문자">문자</option>
                    </select>
                    </div>
                </div>
                <div class="block-content">

                       {{-- 검색창 --}}
                       <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend" style="margin-right:0;">
                                <select name="search" onchange=""  style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;" >
                                    <option @if(Request::get('search') == "title") selected @endif value="title">제목</option>
                                    <option @if(Request::get('search') == "content") selected @endif value="content">컨텐츠</option>
                                </select>
                            </div>
                            <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                            <div class="input-group-append">
                                <span class="input-group-text bg-body border-0">
                                    <i  onclick="formsubmit()" class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- 검색창 --}}

                    <div class="block-content" style="padding-bottom:1rem;">

                        {{-- 테이블 --}}
                        <table class="table table-striped table-border table-vcenter">
                                <thead class="border-bottom">
                                    <tr>
                                        <th class=" text-center">순번</th>
                                        <th class="d-none d-md-table-cell text-center">종류</th>
                                        <th class="d-none d-md-table-cell text-center">제목</th>
                                        <th class="d-none d-md-table-cell text-center">요청수</th>
                                        <th class="d-none d-md-table-cell text-center">날짜</th>
                                    </tr>
                                </thead>
                                <tbody class="border-bottom">
                                @foreach ($data as $v )
                                <tr>
                                    <td class="text-center">
                                        {{ $v->idx }}
                                    </td>
                                    <td class="d-none d-md-table-cell text-center">
                                        {{ $v->category }}
                                    </td>
                                    <td class="d-none d-md-table-cell text-center" style="cursor:pointer;" onclick="location.href='/admin/marketing/marketing_detail?idx={{ $v->idx }}'">
                                        {{ $v->title }}
                                    </td>
                                    <td class="d-none d-md-table-cell text-center">
                                        {{ $v->count }}
                                    </td>
                                    <td class="d-none d-md-table-cell text-center">
                                        {{ $v->created_at }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        {{-- 테이블 --}}

                    </div>


                </div>
                {{-- START Page Content --}}
                {{ $data->appends(request()->input())->links() }}
                {{-- END Page Content --}}
            </div>
        </form>
        </div>


    </main>
    {{-- END Main Container --}}

    {{-- Footer --}}
    @include('admin.layouts.footer')
    {{-- END Footer --}}


    </div>
    {{-- END Page Container --}}
    <script>
        $(function(){

        })
    </script>
    @endsection
