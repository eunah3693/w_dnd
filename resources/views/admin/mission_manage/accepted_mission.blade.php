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
                                    <div class="font-size-h2 text-primary">{{  $total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        총 발급 미션
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{  $today }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        금일 발급 미션
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}

                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">발급된 미션</h3>
                        </div>

                        <div class="block-content">


                            {{-- All Orders Table --}}
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="vertical_center text-center" style="vertical-align:middle"><span>순번</span></th>
                                            <th class="d-none d-sm-table-cell text-center" style="vertical-align:middle"><span>카테고리</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>미션이름</span></th>
                                            <th class="text-center" style="vertical-align:middle"><span>공개여부</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>미션날짜</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>생성날짜</span></th>
                                            <th class="d-none d-xl-table-cell text-center" style="vertical-align:middle"><span>상태</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $val)
                                        @isset($val->missionPool)
                                        <tr onclick="location.href='/admin/mission_manage/mission_detail?idx={{ $val->mission_pool_idx }}'">
                                            <td class="text-center font-size-sm cursor"><span id="table_idx">{{ $val->idx }}</span></td>
                                            <td class="cursor">{{ $val->missionPool->category }}</td>
                                            <td class="cursor">{{ $val->missionPool->title }}</td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">{{ $val->missionPool->is_public == 1 ? '공개':'비공개' }}</td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">{{ $val->startdate }} ~ {{ $val->enddate }} </td>
                                            <td class="d-xl-table-cell text-center font-size-sm cursor">{{ $val->created_at }}</td>
                                            <th class="d-xl-table-cell text-center font-size-sm cursor">
                                                @if ( strtotime(date("Y-m-d H:i:s")) < strtotime($val->startdate) )
                                                    진행예정
                                                @elseif ( strtotime($val->enddate) > strtotime(date("Y-m-d H:i:s")) )
                                                    진행중
                                                @elseif ( strtotime($val->enddate) < strtotime(date("Y-m-d H:i:s")) )
                                                    종료
                                                @endif
                                            </th>
                                        </tr>
                                        @endisset
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


            });
        </script>
        @endsection
