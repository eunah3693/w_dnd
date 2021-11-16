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
                                        총 댓글 수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 댓글 수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}




                    {{-- 레벨상세내역--}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">댓글관리</h3>
                            <div class="block-options">

                            </div>
                        </div>
                        <div class="block-content">


                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle; width:200px;"><span>순번</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>아이디</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>댓글</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>날짜</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">

                                                    감추기

                                            </th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">

                                                    삭제

                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $v)


                                        <tr>
                                        <td class="text-center font-size-sm">
                                                <span class="" class="text-gray-darker">
                                                    <span>{{ $v->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" >
                                                <a href="/admin/member/member_detail?user_idx={{ $v->user_idx }}">{{ $v->user->nickname }}</a>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-left font-size-sm" style="padding-left:20px">
                                                <a href="/admin/mission_manage/member_mission_detail?post_idx={{ $v->parent_idx }}">{{ $v->content }}</a></td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm" >{{ $v->created_at }}</td>
                                            <th class="d-none d-sm-table-cell text-center cursor" style="vertical-align:middle">
                                                @if ($v->is_public == 1)
                                                <i onclick="updatePostPublic({{$v->idx}}, 0)" class="fa fa-fw fa-eye"></i>
                                                @else
                                                <i onclick="updatePostPublic({{$v->idx}}, 1)" class="far fa-fw fa-eye-slash"></i>
                                                @endif
                                            </th>
                                            <th class="d-none d-sm-table-cell text-center cursor" style="vertical-align:middle" onclick="deletePost({{ $v->idx }})">
                                                <i class="fa fa-fw fa-times"></i>
                                            </th>

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
                    {{-- 레벨상세내역 --}}



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
            function searchSubmit()
            {
                $('form').submit();
            }
            function updatePostPublic(idx, type)
            {
                var data = {
                    post_idx : idx,
                    is_public : type
                }
                $.post('/api/admin/post/visible', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
            function deletePost(idx)
            {
                if(confirm('삭제하시겠습니까?'))
                {
                    var data = {
                        post_idx : idx,
                    }
                    $.post('/api/admin/post/delete', data, function(res){
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
