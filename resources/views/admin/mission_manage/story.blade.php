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
                                        총 스토리미션
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $g0_total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        퍼피스토리
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $g1_total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        성견스토리
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a class="block block-rounded block-link-shadow text-center" >
                                <div class="block-content block-content-full">
                                    <div class="font-size-h2 text-primary">{{ $g2_total }}</div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="font-w400 font-size-m text-muted mb-0">
                                        노령견스토리
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- 현황 --}}
                    <form method="get" action="/admin/mission_manage/story">
                    {{-- All Orders --}}
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">스토리퀘스트 설정</h3>
                            <div class="block-options">
                                <select name="group" onchange="$('form').submit()"  >
                                    <option @if(Request::get('group') == "") selected @endif value="">전체</option>
                                    <option @if(Request::get('group') == "0") selected @endif value="0">퍼피</option>
                                    <option @if(Request::get('group') == "1") selected @endif value="1">성견</option>
                                    <option @if(Request::get('group') == "2") selected @endif value="2">노령견</option>
                                </select>
                            </div>
                            <div class="block-options"  onclick="location.href='/admin/mission_manage/story_modify'">
                            <button type="button" class="btn btn-dark" id="btn_add" data-btn="story">추  가</button>
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
                                            <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>트릿</span></th>
                                            <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>경험치</span></th>
                                            <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>미리보기</span></th>
                                            <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>수정</span></th>
                                            <th class="d-xl-table-cell text-center" style="vertical-align:middle"><span>삭제</span></th>
                                            <th>보기</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $val)
                                    <tr >
                                        <td class="text-center font-size-sm"><span id="table_idx">{{ $val->idx }}</span></td>
                                        <td class="d-sm-table-cell text-center font-size-sm">{{ $val->category }}</td>
                                        <td class="font-w600 cursor" onclick="location.href='/admin/mission_manage/story_detail?idx={{ $val->idx }}'">{{ $val->title }}</td>
                                        <td>
                                            @foreach ($val->precede as $item)
                                                ({{ $item->idx }}) {{ $item->title }}
                                            @endforeach
                                        </td>
                                        <td class="d-xl-table-cell text-center font-size-sm">{{ $val->point }}</td>
                                        <td class="d-xl-table-cell text-center font-size-sm">{{ $val->exp }}</td>
                                        <td class="d-xl-table-cell text-center font-size-sm cursor" onclick="location.href='/admin/mission_manage/story_modify?idx={{ $val->idx }}'">
                                            <i class="si si-pencil fa-fw"></i>
                                        </td>
                                        <td class="d-xl-table-cell text-center font-size-sm cursor">
                                            <img width="50px" src="/thum/{{ $val->thum_file_idx }}">
                                            <img width="50px" src="/thum/{{ $val->main_file_idx }}">
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
                    </form>
                </div>
                {{-- END Page Content --}}
            </main>
            {{-- END Main Container --}}

            {{-- Footer --}}
            @include('admin.layouts.footer')
            {{-- END Footer --}}


        </div>
        <script>
            $(function(){

                $(".filter_member").click(function(){
                    var filter_member_num=$(this).index();
                    console.log(filter_member_num);
                    if(filter_member_num=="0"){
                        $(".filter_member_name").text("발급");
                    }else if(filter_member_num=="1"){
                        $(".filter_member_name").text("미발급");
                    }else if(filter_member_num=="2"){
                        $(".filter_member_name").text("전체");
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
