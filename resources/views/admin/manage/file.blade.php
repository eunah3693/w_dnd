@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')

    {{-- Main Container --}}
    <main id="main-container">

        {{-- Page Content --}}
        <div class="content" style="max-width:1600px">

            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">파일관리</h3>

                </div>
                <div class="block-content">
                    {{-- 검색창 --}}
                    <form action="/admin/manage/file" method="get">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend" style="margin-right:0;">
                                <select name="search" onchange="" style="width: 120px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;" >
                                    <option @if(Request::get('search') == "table_name") selected @endif value="table_name">테이블명</option>
                                </select>
                            </div>
                            <input type="text" class="form-control form-control-alt" name="text" value="@if(Request::get('text')){{Request::get('text')}}@endif" placeholder="검색어를 입력하세요" >
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
                        <table class="table table-borderless table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>테이블명</span></th>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>테이블인덱스</span></th>
                                    <th class="text-center"><span>경로</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>원본파일명</span></th>
                                    <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>미리보기</span></th>
                                    <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>사이즈</span></th>
                                    <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>타입</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>생성일</span></th>
                                    {{-- <th class="text-center" style="vertical-align:middle"><span>파일 연결 정보</span></th> --}}
                                    <th class="text-center" style="vertical-align:middle"><span>실제파일 존재여부</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>삭제</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $v )
                                <tr>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span>{{ $v->idx }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker" style="">
                                            <span>{{ $v->table_name }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center font-size-sm">
                                        <span class="text-gray-darker">
                                            <span>{{ $v->table_idx }}</span>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-gray-darker" style="width: 150px;word-break: break-all;"> {{ $v->real_path }}</span>
                                    </td>
                                    <td class="text-center" style="width: 150px;word-break: break-all;">
                                        {{ $v->orgin_name }}
                                    </td>
                                    <td class="text-center">
                                        <a href="/files/{{ $v->idx }}"><img src="/thum/{{ $v->idx }}" width="20px"></a>
                                    </td>
                                    <td class="d-xl-table-cell font-size-sm text-center">
                                        <span class="text-gray-darker font-w600 ">{{ $v->size }}</span>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $v->mime_type }}</span>
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        <span class="text-gray-darker">{{ $v->created_at }}</span>
                                    </td>
                                    {{-- <td class="text-center">
                                        @isset($v->file_data->deleted_at)
                                        <span class="text-gray-darker">{{ $v->file_data->deleted_at ? 'N':'Y' }}</span>
                                        @else
                                        <span class="text-gray-darker">찾을 수 없음</span>
                                        @endisset
                                    </td> --}}
                                    <td class="text-center">{{ $v->file_exists }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm" onclick="deleteFile({{ $v->idx }})">
                                        <i class="fa fa-fw fa-times"></i>
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
         function deleteFile(idx)
            {
                if(confirm('삭제하시겠습니까?'))
                {
                    var data = {
                        report_idx : idx,
                    }
                    $.post('/api/admin/file/delete', data, function(res){
                        if(res.status == 200)
                        {
                            alert(res.msg);
                            location.reload();
                        }
                    })
                }
            }
    </script>
    @endsection
