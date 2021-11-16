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
            {{-- <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">35</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 회원수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">120</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 가입수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">260</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 접속수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">69841</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 접속수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    {{-- 현황 --}}
            {{-- All Orders --}}
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">전체 견종 리스트</h3>
                        <div class="block-options"  onclick="location.href='/admin/manage/breed_modify'">
                        <button type="submit" class="btn btn-dark" id="btn_add" data-btn="banner">추 가</button>
                         </div>
                </div>
                <div class="block-content">

                            {{-- 검색창 --}}
                            <form action="/admin/manage/breed" method="get" >
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="margin-right:0;">
                                            <select name="search" onchange=""   style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;">
                                                <option @if(Request::get('search') == "breed") selected @endif value="breed">견종</option>
                                            </select>
                                        </div>
                                        <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-body border-0" onclick="formsubmit()">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            {{-- 검색창 --}}
                    {{-- All Orders Table --}}
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="banner">
                            <thead>
                                <tr>
                                    <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                    <th class="text-center" style="vertical-align:middle"><span>견종</span></th>
                                    <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>감추기</span></th>
                                    <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $val)
                                <tr >
                                    <td class="text-center font-size-sm"><span id="table_idx">{{ $val->idx }}</span></td>
                                    <td class="d-sm-table-cell text-center font-size-sm"><input class="form-control" value="{{ $val->breed }}" id="breed_name{{ $val->idx }}" style="width: 70%;display: inline-block;"> <button class="btn btn-dark" onclick="updateBreedName({{$val->idx}})" type="button">수정</button></td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        @if ($val->visible == 'Y')
                                        <i onclick="updatePublic({{$val->idx}}, 'N')" class="fa fa-fw fa-eye"></i>
                                        @else
                                        <i onclick="updatePublic({{$val->idx}}, 'Y')" class="far fa-fw fa-eye-slash"></i>
                                        @endif
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor"  onclick="deleteData({{ $val->idx }})"><i class="fa fa-fw fa-times"></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- END All Orders Table --}}
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
        function updatePublic(idx, type)
            {
                var data = {
                    idx : idx,
                    visible : type
                }
                $.post('/api/admin/breed/update/visible', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }

        function updateBreedName(idx)
        {
            if(confirm('이름을 수정하시겠습니까?'))
            {
                var data = {
                    idx : idx,
                    breed : $('#breed_name'+idx).val(),
                }
                $.post('/api/admin/breed/update/breed', data, function(res){
                    if(res.status == 200)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                })
            }
        }
        function deleteData(idx)
        {
            if(confirm('삭제하시겠습니까?'))
            {
                var data = {
                    idx : idx,
                }
                $.post('/api/admin/breed/delete', data, function(res){
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
