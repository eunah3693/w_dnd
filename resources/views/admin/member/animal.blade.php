@extends('admin.layouts.admin_layout')
@section('css')
@endsection
@section('js')
@endsection
@section('content')


            {{-- Main Container --}}
            <main id="main-container">

                {{-- Page Content --}}
                <div class="content" style="max-width:1400px;">
                    {{-- 현황 --}}
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $total_pet }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 반려견 수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $today_pet }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        오늘 등록된 반려견 수
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}


                <form method="get" id="animal_form" action="/admin/member/animal">
                    {{-- 리스트 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">전체반려동물 리스트</h3>

                            <div class="block-options">
                            </div>
                            <div class="block-options" onclick="location.href='/admin/member/animal_modify'">
                                <button class="btn btn-dark" type="button" id="btn_add" data-btn="banner">추 가</button>
                            </div>
                        </div>
                        <div class="block-content">
                            {{-- 검색창 --}}
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="margin-right:0;">
                                        <select name="search" onchange=""   style="width: 100px; height: 38px; border: 1px solid #888; border-radius: 0.25rem; color:#888;">
                                            <option @if(Request::get('search') == "name") selected @endif value="name">이름</option>
                                            <option @if(Request::get('search') == "breed") selected @endif value="breed">견종</option>
                                            <option @if(Request::get('search') == "birth") selected @endif value="birth">생일</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control form-control-alt" name="text" value=" @if(Request::get('text')) {{Request::get('text')}} @endif" placeholder="검색어를 입력하세요" >
                                    <div class="input-group-append" onclick="searchSubmit()">
                                        <span class="input-group-text bg-body border-0">
                                            <i  onclick="formsubmit()" class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- 검색창 --}}

                            {{-- All Orders Table --}}
                            <div class="table-responsive" >
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="vertical-align:middle">순번</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">아이디</th>
                                            <th class="text-center" style="vertical-align:middle">동물이름</th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle">견종</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">생일</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">수정</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">삭제</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($pets as $p)
                                         <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="" >
                                                    <span>{{ $p->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-none d-sm-table-cell text-center font-size-sm">
                                                <a href="/admin/member/member_detail?user_idx={{ $p->user_idx }}">@if($p->user){{ $p->user->nickname }}@endif</a>
                                            </td>

                                            <td class="text-center cursor"  onclick="location.href='/admin/member/animal_detail?pet_idx={{ $p->idx }}'">
                                            <span>{{ $p->name }}</span>
                                            </td>
                                            <td class="d-none d-xl-table-cell font-size-sm text-center">
                                                <span class="text-gray-darker">{{ $p->breed }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center" >
                                                <span class="" >{{ $p->birth }}</span>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center cursor" onclick="location.href='/admin/member/animal_modify?pet_idx={{ $p->idx }}'">
                                            <i class="si si-pencil fa-fw"></i>
                                            </td>
                                            <td class="d-none d-sm-table-cell  font-size-sm text-center cursor" >
                                            <i onclick="deletePet({{ $p->idx }})" class="fa fa-fw fa-times"></i>
                                            </td>

                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- END All Orders Table --}}

                            {{-- Pagination --}}
                            <div style="display:flex; justify-content:center;">
                            {{ $pets->appends(request()->input())->links() }}
                            </div>
                            {{-- END Pagination --}}
                        </div>
                    </div>
                    {{--리스트--}}
                </form>
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
            function formsubmit(){
                $('#animal_form').submit();
            }
            function deletePet(idx)
            {
                if(confirm('펫을 정말 삭제 하시겠습니까?'))
                {
                    var data = {
                        pet_idx : idx
                    }
                    $.post('/api/admin/pet/delete', data, function(res){
                        if(res.status == '200')
                        {
                            alert(res.msg);
                            location.reload();
                        }
                    })
                }
            }

            $(function(){
                //검색 버튼클릭시
                $("#btn_search").click(function () {
                    if ($("#search_input").val() == "") {
                        alert("검색어를 입력해주세요.");
                        return true;
                    }
                    var search_select = $(".search_select").val();//검색 select 값
                    //console.log(search_select);
                    var search_input = $("#search_input").val();//검색 input 값
                    //console.log(search_input);
                    var shape_select = $(this).val(); //크기 select 값
                    //console.log(shape_select);
                    var birth_select = $(this).val();//생일 select 값
                    //console.log(birth_select);

                    //검색정보 넘기기
                    $.ajax({
                        data: {search_select ,search_input, shape_select,birth_select},
                        type: "GET",
                    }).done(function () {
                        console.log(search_select);
                        console.log(search_input);
                        console.log(shape_select);
                        console.log(birth_select);
                        //location.reload();
                    });

                });

                $(".filter_option").click(function(){
                    var option_num=$(this).index();
                    console.log(option_num);
                    if(option_num=="0"){
                        $(".filter_name").text("반려견이름");
                    }else if(option_num=="1"){
                        $(".filter_name").text("사용자이름");
                    }else if(option_num=="2"){
                        $(".filter_name").text("사용자아이디");
                    }

                })
                $(".filter_member").click(function(){
                    var filter_member_num=$(this).index();
                    console.log(filter_member_num);
                    if(filter_member_num=="0"){
                        $(".filter_member_name").text("소형견");
                    }else if(filter_member_num=="1"){
                        $(".filter_member_name").text("중형견");
                    }else if(filter_member_num=="2"){
                        $(".filter_member_name").text("대형견");
                    }else if(filter_member_num=="3"){
                        $(".filter_member_name").text("전체");
                    }

                })

            });
        </script>
@endsection
