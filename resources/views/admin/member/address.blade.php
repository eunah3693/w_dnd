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
                <form method="get" id="" action="/admin/member/address">
                    {{-- 리스트 --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">전체 주소 리스트</h3>

                        </div>
                        <div class="block-content">
                            {{-- All Orders Table --}}
                            <div class="table-responsive" >
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="vertical-align:middle">순번</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">아이디</th>
                                            <th class="text-center" style="vertical-align:middle">배송지이름</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">추가일</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">수정</th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle">삭제</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($data as $p)
                                         <tr>
                                            <td class="text-center font-size-sm">
                                                <span class="" >
                                                    <span>{{ $p->idx }}</span>
                                                </span>
                                            </td>
                                            <td class="d-sm-table-cell text-center font-size-sm">
                                                <a href="/admin/member/member_detail?user_idx={{ $p->user_idx }}">@if($p->user){{ $p->user->nickname }}@endif</a>
                                            </td>

                                            <td class="text-center cursor"  onclick="location.href='/admin/member/address_detail/{{ $p->idx }}'">
                                            <span>{{ $p->name }}</span>
                                            </td>
                                            <td class="d-xl-table-cell font-size-sm text-center">
                                                <span>{{ $p->created_at }}</span>
                                            </td>
                                            <td class="d-sm-table-cell  font-size-sm text-center cursor" onclick="location.href='/admin/member/address_modify/{{ $p->idx }}'">
                                            <i class="si si-pencil fa-fw"></i>
                                            </td>
                                            <td class="d-sm-table-cell  font-size-sm text-center cursor" >
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
                            {{ $data->appends(request()->input())->links() }}
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
                if(confirm('주소를 정말 삭제 하시겠습니까?'))
                {

                    $.post('/api/admin/member/address/delete/'+idx, function(res){
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
