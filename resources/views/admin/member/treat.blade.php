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
                    {{-- 현황 --}}
                    <div class="row">
                            <div class="col-6 col-lg-3">
                                <a class="block block-rounded block-link-shadow text-center" >
                                    <div class="block-content block-content-full">
                                        <div class="font-size-h2 text-primary">{{ $total }}</div>
                                    </div>
                                    <div class="block-content py-2 bg-body-light">
                                        <p class="font-w400 font-size-m text-muted mb-0">
                                            총 적립/사용 트릿
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        {{-- 현황 --}}

                    {{-- 트릿상세내역 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">트릿상세내역</h3>
                            <div class="block-options" onclick="location.href='/admin/member/treat_modify'">
                                <button type="button" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                            </div>
                        </div>

                        <div class="block-content">
                            {{-- 검색창 --}}
                            <form action="/admin/member/treat" method="get">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="margin-right:0;">
                                            <select name="search" onchange=""   style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;">
                                                <option @if(Request::get('search') == "memo") selected @endif value="memo">내용</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-body border-0" onclick="formsubmit()">
                                                <i  class="fa fa-search"></i>
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
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>인덱스</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>아이디</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>트릿</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>내용</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($treat as $t)
                                    <tr>
                                        <td class="text-center font-size-sm">
                                            <span  class="text-gray-darker font-w600">
                                                <span>{{ $t->idx }}</span>
                                            </span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/member/member_detail?user_idx={{ $t->user->idx }}'" >{{ $t->user->nickname }}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $t->treat }}</td>
                                        <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px" onclick="location.href='/admin/member/treat_detail?treat_idx={{ $t->idx }}'">{{ $t->memo }}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $t->created_at }}</td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/member/treat_modify?treat_idx={{ $t->idx }}'"  ><i class="si si-pencil fa-fw"></i></td>
                                        <td class="d-none d-sm-table-cell text-center font-size-sm cursor" ><i onclick="deletedata({{ $t->idx }})" class="fa fa-fw fa-times"></i></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $treat->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- 트릿상세내역 --}}
                </div>
                {{-- END Page Content --}}
            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- END Footer --}}
        {{-- END Page Container --}}
        </div>


        <script>
            function formsubmit(){
                $('form').submit();
            }
            function deletedata(idx)
            {
                if(confirm('트릿을 정말 삭제 하시겠습니까?'))
                {
                    var data = {
                        treat_idx : idx
                    }
                    $.post('/api/admin/treat/delete', data, function(res){
                        if(res.status == '200')
                        {
                            alert(res.msg);
                            location.reload();
                        }
                    })
                }
            }


        </script>
@endsection
