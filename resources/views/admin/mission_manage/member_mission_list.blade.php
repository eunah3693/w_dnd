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
                                    <div class="font-size-h2 text-primary">{{ $post_count }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 미션
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_mission_count }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 미션 완료
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_life_count }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 일상
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}

                    {{-- 피드상세내역--}}
                    <form method="get" action="/admin/mission_manage/member_mission_list">
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">회원미션내역</h3>
                            <div class="block-options">
                                <select name="category" onchange="searchSubmit()" >
                                    <option @if(Request::get('category') == "") selected @endif value="">전체</option>
                                    <option @if(Request::get('category') == "일일미션") selected @endif value="일일미션">일일미션</option>
                                    <option @if(Request::get('category') == "자유미션") selected @endif value="자유미션">자유미션</option>
                                    <option @if(Request::get('category') == "주간미션") selected @endif value="주간미션">주간미션</option>
                                    <option @if(Request::get('category') == "스토리미션") selected @endif value="스토리미션">스토리미션</option>
                                    <option @if(Request::get('category') == "일상") selected @endif value="일상">일상</option>
                                </select>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- 검색창 --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="margin-right:0;">
                                        <select name="search" onchange="" style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;" >
                                            <option @if(Request::get('search') == "tag") selected @endif value="tag">태그</option>
                                            <option @if(Request::get('search') == "user_id") selected @endif value="user_id">유저아이디</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                    <div class="input-group-append" onclick="searchSubmit()">
                                        <span class="input-group-text bg-body border-0">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- 검색창 --}}

                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="member_mission">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>아이디</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>이름</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>미션</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>이미지</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>댓글수</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>좋아요</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>감추기</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>삭제</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($post as $p)
                                        <tr  >
                                            <td class="text-center font-size-sm">
                                                <span class="font-w600" class="text-gray-darker">
                                                    <span id="table_idx">{{ $p->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/member/member_detail?user_idx={{ $p->user_idx }}'">{{ $p->user->id }}</td>
                                            <td class="text-center cursor" onclick="location.href='/admin/mission_manage/member_mission_detail?post_idx={{ $p->idx }}'">
                                                {{ $p->user->nickname }}
                                            </td>
                                            <td class="d-none d-xl-table-cell font-size-sm text-center cursor"  onclick="location.href='/admin/mission_manage/member_mission_detail?post_idx={{ $p->idx }}'">
                                                @if($p->mission)
                                                {{ $p->mission->missionPool->title }}
                                                @else
                                                일상
                                                @endif
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                @foreach ($p->files as $f)
                                                    <img width="80px" src="/thum/{{ $f->idx }}">
                                                @endforeach
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="btn btn-sm font-w400" href="#" >
                                                    {{ count($p->like) }}
                                                </span>

                                            </td>
                                            <td class="text-center">
                                                <span class="btn btn-sm font-w400" href="#" >
                                                    {{ count($p->reply) }}
                                                </span>

                                            </td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">
                                                @if ($p->is_public == 1)
                                                <i onclick="updatePostPublic({{$p->idx}}, 0)" class="fa fa-fw fa-eye"></i>
                                                @else
                                                <i onclick="updatePostPublic({{$p->idx}}, 1)" class="far fa-fw fa-eye-slash"></i>
                                                @endif
                                            </td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor" onclick="deletePost({{ $p->idx }})">
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
                            {{ $post->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{-- END All Orders --}}
                </form>
                    {{-- 피드상세내역 --}}
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
