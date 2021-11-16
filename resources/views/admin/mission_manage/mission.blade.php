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
                    {{-- 현황 --}}
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 미션 수
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $daily }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        일일미션
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $weekly }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        주간미션
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $free }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        자유미션
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">전체 미션리스트</h3>
                            <div class="block-options">
                            <form action="/admin/mission_manage/mission" method="get">
                                <select name="category" onchange="$('form').submit()" >
                                    <option @if(Request::get('category') == "") selected @endif value="">전체</option>
                                    <option @if(Request::get('category') == "일일미션") selected @endif value="일일미션">일일미션</option>
                                    <option @if(Request::get('category') == "자유미션") selected @endif value="자유미션">자유미션</option>
                                    <option @if(Request::get('category') == "주간미션") selected @endif value="주간미션">주간미션</option>
                                </select>
                            </div>
                            {{-- <div class="block-options">
                                <div class="">
                                    <button type="button" class="btn-block-option " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="filter_member_name2">발급여부</span> <i class="fa fa-angle-down ml-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-ecom-filters">
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                            발급
                                            <span class="badge badge-secondary badge-pill">35</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                            미발급
                                            <span class="badge badge-secondary badge-pill">15</span>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between font-w400 border-bottom filter_member2" style="font-size:15px" >
                                            전체
                                            <span class="badge badge-secondary badge-pill">20</span>
                                        </a>


                                    </div>
                                </div>
                            </div> --}}
                            <div class="block-options" onclick="location.href='/admin/mission_manage/mission_modify'">
                            <button type="button" class="btn btn-dark" id="btn_add" data-btn="total_mission">추  가</button>
                            </div>
                        </div>
                        <div class="block-content">


                        {{-- All Orders Table --}}
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-vcenter" id="table_list" data-table="story">
                                <thead>
                                    <tr>
                                        <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                        <th class="d-sm-table-cell text-center" style="vertical-align:middle"><span>카테고리</span></th>
                                        <th class="text-center" style="vertical-align:middle"><span>미션이름</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>선행미션</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>공개여부</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>트릿</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>경험치</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>태그</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>참여가능횟수</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>최근발급인덱스</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>미리보기</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                        <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>
                                        <th>보기</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $val)
                                <tr>
                                    <td class="text-center font-size-sm"><span id="table_idx">{{ $val->idx }}</span></td>
                                    <td class="d-sm-table-cell text-center font-size-sm">{{ $val->category }}</td>
                                    <td class="font-w600 cursor"  onclick="location.href='/admin/mission_manage/mission_detail?idx={{ $val->idx }}'">{{ $val->title }}</td>
                                    <td>
                                        @foreach ($val->precede as $item)
                                            ({{ $item->idx }}) {{ $item->title }}
                                        @endforeach
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm">{{ $val->is_public == 1 ? '공개':'비공개' }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm">{{ $val->point }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm">{{ $val->exp }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm">{{ $val->tag }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm">{{ $val->participation_count }}</td>
                                    <td class="d-xl-table-cell text-center font-size-sm">
                                        @foreach ($val->mission as $item)
                                            @if ($loop->last)
                                                ({{ $item->idx }}). {{ $item->startdate }} ~ {{ $item->enddate }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <img width="50px" src="/thum/{{ $val->thum_file_idx }}">
                                        <img width="50px" src="/thum/{{ $val->main_file_idx }}">
                                    </td>
                                    <td class="d-xl-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/mission_manage/mission_modify?idx={{ $val->idx }}'">
                                            <i class="si si-pencil fa-fw"></i>
                                    </td>

                                    <td class="d-xl-table-cell text-center font-size-sm cursor">
                                        <a onclick="delete_story({{ $val->idx }})"><i class="fa fa-fw fa-times"></i></a>
                                    </td>
                                    <td><a class="btn" target="_blank" href="/admin/mission_detail?idx={{ $val->idx }}">보기</a></td>
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


                $(".filter_member").click(function(){
                    var filter_member_num=$(this).index();
                    console.log(filter_member_num);
                    if(filter_member_num=="0"){
                        $(".filter_member_name").text("일일미션");
                    }else if(filter_member_num=="1"){
                        $(".filter_member_name").text("주간미션");
                    }else if(filter_member_num=="2"){
                        $(".filter_member_name").text("이벤트미션");
                    }else if(filter_member_num=="3"){
                        $(".filter_member_name").text("전체");
                    }

                })
                $(".filter_member2").click(function(){
                    var filter_member_num2=$(this).index();
                    console.log(filter_member_num2);
                    if(filter_member_num2=="0"){
                        $(".filter_member_name2").text("발급");
                    }else if(filter_member_num2=="1"){
                        $(".filter_member_name2").text("미발급");
                    }else if(filter_member_num2=="2"){
                        $(".filter_member_name2").text("전체");
                    }

                })

            });

            function delete_story(idx)
            {
                if(confirm('정말 삭제 하시겠습니까? '))
                {
                    window.location.href = '/admin/mission_manage/story/delete?idx='+idx;
                }
            }
        </script>
        @endsection
