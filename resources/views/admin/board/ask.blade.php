@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
<script src="/js/admin/board.js"></script>
@endsection
@section('content')
    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1400px">
                         {{-- 현황 --}}
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="block block-rounded block-link-shadow text-center" >
                        <div class="block-content block-content-full">
                            <div class="font-size-h2 text-primary">{{ $total_count }}</div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w400 font-size-m text-muted mb-0">전체 게시물 수</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="block block-rounded block-link-shadow text-center" >
                        <div class="block-content block-content-full">
                            <div class="font-size-h2 text-primary">{{ $today_count }}</div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w400 font-size-m text-muted mb-0">금일 등록 게시물 수</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 현황 --}}
            <form action="/admin/board/ask" method="get" >
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">이용문의</h3>
                    {{-- 답변여부 필터 --}}
                    <div class="block-options">

                                {{-- <select name="content2" onchange="searchSubmit()"  >
                                    <option @if(Request::get('content2') == "") selected @endif value="">답변여부</option>
                                    <option @if(Request::get('content2') != null ) selected @endif value="Y">답변</option>
                                    <option @if(Request::get('content2') == null ) selected @endif value="N">미답변</option>


                                </select> --}}
                        </div>

                </div>
                <div class="block-content">
                    {{-- 검색창 --}}
                    <form action="/admin/board/ask" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend" style="margin-right:0;">
                                    <select  name="search" onchange=""  style="width: 100px; height: 38px; border: 1px solid #777; border-radius: 0.25rem; color:#777;">
                                        <option @if(Request::get('search') == "title") selected @endif value="title">제목</option>
                                        <option @if(Request::get('search') == "user_id") selected @endif value="user_id">작성자아이디</option>
                                        <option @if(Request::get('search') == "content") selected @endif value="content">내용</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요">
                                <div class="input-group-append" onclick="$('form').submit()">
                                    <span class="input-group-text bg-body border-0">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </form>
                    {{-- 검색창 --}}

                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="ask">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>작성자</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>게시글제목</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>게시날짜</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>답변자</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>답변여부</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>답변날짜</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span id="table_idx">{{ $data->total() - $data->firstItem() - $loop->iteration + 2 }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $item->user->nickname }}</span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor"  onclick="location.href='/admin/board/detail/{{ $category }}?idx={{ $item->idx }}'">
                                        <span style="display:inline-block; width:400px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">{{ $item->title }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker"> {{ $item->created_at }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $item->admin->nickname ?? '-' }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker"> {{ $item->content2 != null ? 'Y' : 'N' }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker"> {{ $item->answered_at ?? '-' }}</span>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a href="/admin/board/modify/{{ $category }}/{{ $item->idx }}"><i class="si si-pencil fa-fw"></i></a>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a href="#" class="btn_delete" data-idx="{{ $item->idx }}"><i class="fa fa-fw fa-times"></i></a>
                                </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}

                    {{-- Pagination --}}
                    <div style="display:flex; justify-content:center;">
                    {{ $data->appends(request()->input())->links() }}
                    </div>
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
    <script>

    </script>
    @endsection
