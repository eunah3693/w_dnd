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
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">이용약관/개인정보처리방침</h3>
                    <div class="block-options" onclick="location.href='/admin/manage/terms_modify'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="notice">추 가</button>
                    </div>
                </div>
                <div class="block-content">
                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="guide">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>글제목</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>작성자</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>작성일시</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $data as $v )
                                <tr >
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span id="table_idx">{{ $data->total() - $data->firstItem() - $loop->iteration + 2 }}</span>
                                        </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/manage/terms_detail?idx={{ $v->idx }}'" >
                                        <span style="display:inline-block; width:400px; overflow:hidden; text-overflow:ellipsis;white-space:nowrap;">{{ $v->title }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $v->user->name }}</span>
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $v->created_at }}</span>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a href="/admin/manage/terms_modify?idx={{ $v->idx }}"><i class="si si-pencil fa-fw"></i></a>
                                    </td>
                                </tr>
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
        $(function(){
            $(".filter_option").click(function(){
                var option_num=$(this).index();
                console.log(option_num);
                if(option_num=="0"){
                    $(".filter_name").text("질문제목");
                }
            })
        })
    </script>
    @endsection
